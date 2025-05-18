<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\InspectionRequest;
use App\Models\Test;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class InspectionRequestController extends Controller
{
    public function inspectionsList():View
    {
        $inspections = InspectionRequest::all();
        return view('superAdmin.inspections.list', compact('inspections'));
    }

    public function inspectionCreate(): View
    {
        return view('superAdmin.inspections.create');
    }

    public function inspectionStore(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $validation = Validator::make($request->all(), [
                'name' => 'required|string',
                'surname' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'mobile' => 'required|unique:users,mobile',
                'password' => 'required',
            ]);

            if ($validation->fails())
                return response()->json(['status' => 422, 'errors' => $validation->errors()]);

            return response()->json(['status' => 200, 'message' => 'َاطلاعات کاربر با موفقیت ثبت شد.','url'=>route('super-admin.users.list')]);

        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function getTests($type): \Illuminate\Http\JsonResponse
    {
        try {
            $tests = Test::query()->where('parent_id', $type)->get();
            return response()->json(['tests' => $tests]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }
}
