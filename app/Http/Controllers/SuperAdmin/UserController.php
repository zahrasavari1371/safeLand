<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Mail\RegisterUserMail;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function usersList($type): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        if ($type == 'other') {
            $users = User::query()->whereNotNull('company_id')->orWhereNotNull('company_unit_id')->get();
        } elseif ($type == 'safeLand') {
            $users = User::query()->whereNull(['company_id', 'company_unit_id'])->get();
        } else
            return redirect()->back();

        return view('superAdmin.users.list', compact('users', 'type'));
    }

    public function createUser($type): View
    {
        if ($type == 'other') {
            $roles = Role::query()->whereIn('name', ['qc', 'segment qc', 'supervisor'])->get();
            $companies = Company::all();
        } elseif ($type == 'safeLand') {
            $companies = [];
            $roles = Role::query()->whereIn('name', ['admin', 'inspector', 'super admin'])->get();
        }

        return view('superAdmin.users.create', compact('companies', 'roles', 'type'));
    }

    public function storeUser(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $validation = Validator::make($request->all(), [
                'name' => 'required|string',
                'surname' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'mobile' => 'required|regex:/^0?9\d{9}$/|unique:users,mobile',
            ]);

            if ($validation->fails())
                return response()->json(['status' => 422, 'errors' => $validation->errors()]);

            if ($request->type === 'other') {
                if ((int)$request->role == 4 || (int)$request->role == 6) {
                    $validation = Validator::make($request->all(), [
                        'company_id' => 'required',
                    ]);

                    if ($validation->fails())
                        return response()->json(['status' => 422, 'errors' => $validation->errors()]);

                    $company_id = $request->company_id;
                    $company_unit_id = null;
                } elseif ((int)$request->role == 5) {
                    $validation = Validator::make($request->all(), [
                        'company_id' => 'required',
                        'company_unit' => 'required',
                    ]);

                    if ($validation->fails())
                        return response()->json(['status' => 422, 'errors' => $validation->errors()]);

                    $company_id = null;
                    $company_unit_id = $request->company_unit;
                } else
                    return response()->json(['status' => 422, 'errors' => ['role' => "سمت معتبر انتخاب کنید."]]);

            } elseif ($request->type === 'safeLand') {
                $company_id = null;
                $company_unit_id = null;
            } else
                return response()->json(['status' => 500, 'message' => '']);


            $user = User::query()->create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'company_unit_id' => $company_unit_id,
                'company_id' => $company_id,
            ]);

            $role = Role::query()->findOrFail($request->role);
            $user->assignRole($role->name);
            $data = ['email' => $user->email];
            Mail::to($user->email)->send(new RegisterUserMail($data));

            return response()->json(['status' => 200, 'message' => 'اطلاعات کاربر با موفقیت ثبت شد.', 'url' => route('super-admin.users.list', $request->type)]);

        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function editUser($id, $type): View
    {
        $user = User::query()->findOrFail($id);
        if ($type == 'other') {
            $roles = Role::query()->whereIn('name', ['qc', 'segment qc', 'supervisor'])->get();
            $companies = Company::all();
        } elseif ($type == 'safeLand') {
            $companies = [];
            $roles = Role::query()->whereIn('name', ['admin', 'inspector', 'super admin'])->get();
        }

        return view('superAdmin.users.edit', compact('companies', 'roles', 'user', 'type'));
    }

    public function updateUser(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $validation = Validator::make($request->all(), [
                'name' => 'required|string',
                'surname' => 'required|string',
                'email' => [
                    'required',
                    'email',
                    'unique:users,email,' . $id, // Exclude the current user's email
                ],
                'mobile' => [
                    'required',
                    'unique:users,mobile,' . $id, // Exclude the current user's mobile
                ],
            ]);

            if ($validation->fails())
                return response()->json(['status' => 422, 'errors' => $validation->errors()]);

            $user = User::query()->findOrFail($id);

            if ((int)$request->role == 1 || (int)$request->role == 2 || (int)$request->role == 3) {
                $company_id = null;
                $company_unit_id = null;
            } elseif ((int)$request->role == 4 || (int)$request->role == 6) {
                $validation = Validator::make($request->all(), [
                    'company_id' => 'required',
                ]);

                if ($validation->fails())
                    return response()->json(['status' => 422, 'errors' => $validation->errors()]);

                $company_id = $request->company_id;
                $company_unit_id = null;
            } elseif ((int)$request->role == 5) {
                $validation = Validator::make($request->all(), [
                    'company_id' => 'required',
                    'company_unit' => 'required',
                ]);

                if ($validation->fails())
                    return response()->json(['status' => 422, 'errors' => $validation->errors()]);

                $company_id = null;
                $company_unit_id = $request->company_unit;
            } else
                return response()->json(['status' => 422, 'errors' => ['role' => "سمت معتبر انتخاب کنید."]]);

            $is_active = $request->is_active === "1";

            $user->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'is_active' => $is_active,
                'company_unit_id' => $company_unit_id,
                'company_id' => $company_id,
            ]);
            $role = Role::query()->findOrFail($request->role);
            $user->syncRoles([]);
            $user->assignRole($role->name);

            return response()->json(['status' => 200, 'message' => 'اطلاعات کاربر با موفقیت به‌روزرسانی شد.', 'reload' => true]);

        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }
}
