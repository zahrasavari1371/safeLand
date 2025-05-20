<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Comment;
use App\Models\Company;
use App\Models\CompanyUnit;
use App\Models\File;
use App\Models\InspectionRequest;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function companiesList(): View
    {
        $companies = Company::query()->orderBy('created_at', 'desc')->with('city')->get();
        return view('superAdmin.companies.list', compact('companies'));
    }

    public function createCompany(): View
    {
        $states = State::all();
        $cities = City::query()->where('state_id', 1)->get();
        return view('superAdmin.companies.create', compact('states','cities'));
    }

    public function storeCompany(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $validation = Validator::make($request->all(), [
                'name' => 'required|string',
                'national_id' => 'required|regex:/^[1-9][0-9]{10}$/',
                'economic_code' => 'required|regex:/^\d{12}$/',
                'registration_number' => 'required|regex:/^\d{4,10}$/',
                'office_phone' => 'required',
                'zipcode' => 'required|regex:/^\d{10}$/',
                'address' => 'required|string',
                'city_id' => 'required',
                'logo' => 'required|mimes:jpg,jpeg,png,webp|max:5120',
            ], messages: ['mimes:فرمت لوگو باید png,jpg و یا jpeg باشد', 'max' => 'سایز عکس باید کمتر از 5 مگابایت باشد.']);

            if ($validation->fails())
                return response()->json(['status' => 422, 'errors' => $validation->errors()]);
            $filename = null;
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $filename = time() . '-' . $logo->getClientOriginalName();
                $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/company-logo';
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $logo->move($destinationPath, $filename);
            }

            $company = Company::query()->create([
                'name' => $request->name,
                'national_id' => $request->national_id,
                'economic_code' => $request->economic_code,
                'registration_number' => $request->registration_number,
                'office_phone' => $request->office_phone,
                'zipcode' => $request->zipcode,
                'address' => $request->address,
                'city_id' => $request->city_id,
                'logo' => $filename
            ]);

            $units = array_filter($request['unit_name']);
            if (count($units) > 0) {
                foreach ($units as $unit) {
                    CompanyUnit::query()->create(['name' => $unit, 'company_id' => $company->id]);
                }
            }

            return response()->json(['status' => 200, 'message' => 'اطلاعات شرکت با موفقیت ثبت شد.', 'url' => route('super-admin.companies.list')]);

        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function editCompany($id): View
    {
        $company = Company::query()->findOrFail($id)->withoutRelations();
        $states = State::all();
        $cities = City::query()->where('id', $company->city_id)->get();
        return view('superAdmin.companies.edit', compact('company','states','cities'));
    }

    public function deleteCompany($id): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction(); // شروع تراکنش

            $company = Company::query()->findOrFail($id);

            // دریافت تمام واحدهای مربوط به شرکت
            $units = CompanyUnit::query()->where('company_id', $company->id)->pluck('id');

            if (count($units) > 0) {
                // دریافت تمام درخواست‌های بازرسی مربوط به واحدهای شرکت
                $inspections = InspectionRequest::query()->whereIn('unit_id', $units)->get();

                foreach ($inspections as $inspection) {
                    // حذف تمام فایل‌های مربوط به این درخواست بازرسی
                    File::query()->where('inspection_id', $inspection->id)->delete();

                    // حذف تمام نظرات مربوط به این درخواست بازرسی
                    Comment::query()->where('inspection_request_id', $inspection->id)->delete();

                    // حذف خود درخواست بازرسی
                    $inspection->delete();
                }

                // حذف کاربران (کارمندان) شرکت
                User::query()->where('company_id', $company->id)->orWhereIn('company_unit_id', $units)->delete();
            }
            // حذف واحدهای مرتبط با شرکت
            CompanyUnit::query()->where('company_id', $company->id)->delete();
            // در نهایت، خود شرکت را حذف کن
            $company->delete();

            DB::commit(); // تایید تراکنش
            return response()->json(['status' => 200, 'message' => 'حذف شرکت مورد نظر با موفقیت انجام شد.', 'reload' => true]);
        } catch (\Exception $exception) {
            dd($exception);
            error_log($exception);
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function updateCompany(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            switch ($request->type) {
                case 'company':
                    $validation = Validator::make($request->all(), [
                        'name' => 'required|string',
                        'national_id' => 'required|regex:/^[1-9][0-9]{10}$/',
                        'economic_code' => 'required|regex:/^\d{12}$/',
                        'registration_number' => 'required|regex:/^\d{4,10}$/',
                        'office_phone' => 'required',
                        'zipcode' => 'required|regex:/^\d{10}$/',
                        'address' => 'required|string',
                        'city_id' => 'required',
                    ]);

                    if ($validation->fails())
                        return response()->json(['status' => 422, 'errors' => $validation->errors()]);

                    $company = Company::query()->findOrFail($id);
                    $filename = null;
                    if ($request->hasFile('logo')) {
                        $logo = $request->file('logo');
                        $filename = time() . '-' . $logo->getClientOriginalName();
                        $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/company-logo';
                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0777, true);
                        }
                        $logo->move($destinationPath, $filename);
                    }else
                        $filename=$company->logo;

                    company::query()->where('id', $id)->update([
                        'name' => $request->name,
                        'national_id' => $request->national_id,
                        'economic_code' => $request->economic_code,
                        'registration_number' => $request->registration_number,
                        'office_phone' => $request->office_phone,
                        'zipcode' => $request->zipcode,
                        'address' => $request->address,
                        'city_id' => $request->city_id,
                        'logo' => $filename
                    ]);
                    return response()->json(['status' => 200, 'message' => 'َاطلاعات شرکت با موفقیت به‌روزرسانی شد.', 'reload' => true]);
                case 'units':
                    CompanyUnit::query()->where('id', $request->id)->update([
                        'name' => $request->unit_name,
                    ]);
                    return response()->json(['status' => 200, 'message' => 'اطلاعات بخش با موفقیت به‌روزرسانی شد.', 'reload' => true]);
            }

        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function deleteCompanyUnit($id): \Illuminate\Http\JsonResponse
    {
        try {
            $unit = CompanyUnit::query()->findOrFail($id);
            if (count($unit->user) > 0)
                return response()->json(['status' => 500, 'message' => 'این بخش دارای کارمند است و قابل حذف نیست.', 'reload' => true]);

            CompanyUnit::query()->findOrFail($id)->delete();
            return response()->json(['status' => 200, 'message' => 'َاین بخش با موفقیت حذف شد.', 'reload' => true]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function addUnits(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $units = array_filter($request['unit_name']);
            if (count($units) > 0) {
                foreach ($units as $unit) {
                    CompanyUnit::query()->create(['name' => $unit, 'company_id' => $request->company_id]);
                }
            }

            return response()->json(['status' => 200, 'message' => 'اطلاعات شرکت با موفقیت ثبت شد.', 'reload' => true]);

        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => $exception->getMessage()]);
        }
    }

    public function getCompanyInfo($id): \Illuminate\Http\JsonResponse
    {
        try {
            $units = CompanyUnit::query()->where('company_id', $id)->get();
            $company_units = CompanyUnit::query()->where('company_id', $id)->pluck('id')->toArray();
            $users = User::query()->where('company_id', $id)->orWhereIn('company_unit_id', $company_units)->with(['companyUnit.company', 'roles:name'])->get();
            return response()->json(['units' => $units, 'users' => $users]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function companyUsers($id): \Illuminate\Http\JsonResponse
    {
        try {
            $company_units = CompanyUnit::query()->where('company_id', $id)->pluck('id')->toArray();
            $users = User::query()->where('company_id', $id)->orWhereIn('company_unit_id', $company_units)->get();
            return response()->json(['users' => $users]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => $exception->getMessage()]);
        }
    }

    public function getCities(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $cities = City::query()->where('state_id', $request['state_id'])->get();
            return response()->json(['cities' => $cities]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function search(Request $request)
    {
        try {
            $query = $request->input('query');
            $companies = Company::query()->where('name', 'LIKE', "%{$query}%")->select('name', 'logo')->get();

            return response()->json($companies);
        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }
}
