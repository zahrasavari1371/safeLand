<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function loginForm(): View
    {
        Artisan::call('cache:clear');
        return view('auth.login');
    }

    public function sendLoginCode(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $validation = Validator::make($request->all(), [
                'email' => 'required',
            ]);

            if ($validation->fails())
                return response()->json(['status' => 422, 'errors' => $validation->errors()]);

            $user = User::query()->where('email', $request->email)->first();

            if (!$user)
                return response()->json(['status' => 422, 'errors' => ['email' => __('No user has registered with this email.')]]);

            if (!$user->is_active)
                return response()->json(['status' => 500, 'message' => 'اکانت شما غیرفعال شده است.']);

            $token = LoginCode::query()->create([
                'user_id' => $user->id
            ]);

            if ($token->sendCode($user->email)) {
                session()->put("code_id", $token->id);
                return response()->json(['status' => 200, 'message' => __('Please enter the code we sent to your email.'), 'code_time' => now()->timestamp]);
            }

            $token->delete();
            return response()->json(['status' => 500, 'errors' => __('An issue has occurred. Please try again later.')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'errors' => __('An issue has occurred. Please try again later.')]);
        }
    }

    public function login(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'email' => 'required|email',
                'code' => 'required|string',
            ]);

            if ($validation->fails())
                return response()->json(['status' => 422, 'errors' => $validation->errors()]);

            $user = User::query()->where('email', request('email'))->first();
            if (!$user)
                return response()->json(['status' => 422, 'errors' => ['email' => __('No user has registered with this email.')]]);

            $code = LoginCode::query()->where('user_id', $user->id)->find(session()->get('code_id'));

            if (!$code)
                return response()->json(['status' => 422, 'errors' => ['code' => __('The code does not exist.')]]);

            if (!$code->isValid())
                return response()->json(['status' => 422, 'errors' => ['code' => __('The code has expired.')]]);

            if ($code->code !== $request->code)
                return response()->json(['status' => 422, 'errors' => ['code' => __('The code is incorrect.')]]);

            $code->used = true;
            $code->save();

            $rememberMe = session()->get('remember');
            auth()->login($user, $rememberMe);
            $request->session()->regenerate();

            $request->session()->regenerate();
            $user = Auth::user();

            // Determine redirect route based on user role
            $redirectRoute = match ($user->getRoleNames()[0]) {
                'super admin' => route('super-admin.dashboard'),
                'admin' => route('admin.dashboard'),
                'inspector' => route('inspector.inspections.list','open'),
                'qc', 'segment qc', 'supervisor' => route('dashboard'),
            };

            return response()->json(['status' => 200, 'message' => 'با موفقیت وارد شدید.', 'url' => $redirectRoute]);

        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function logout(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
