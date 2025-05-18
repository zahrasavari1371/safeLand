<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\AdminInspectionNotif;
use App\Mail\NewInspectionMail;
use App\Mail\RejectInspectionMail;
use App\Mail\UpdateInspectionMail;
use App\Models\City;
use App\Models\CompanyUnit;
use App\Models\File;
use App\Models\InspectionRequest;
use App\Models\State;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Morilog\Jalali\Jalalian;

class InspectionRequestController extends Controller
{
    public function inspectionsList($type): View
    {
        switch (auth()->user()->getRoleNames()->first()) {
            case 'qc':
            case 'supervisor':
                $units = CompanyUnit::query()->where('company_id', auth()->user()->company_id)->pluck('id')->toArray();
                if ($type === 'close') {
                    $inspections = InspectionRequest::query()
                        ->where(function ($query) use ($units) {
                            $query->where('created_by', auth()->id())
                                ->orWhereIn('unit_id', $units);
                        })
                        ->where('status', 8)
                        ->orderBy('created_at', 'desc')
                        ->get();
                } else
                    $inspections = InspectionRequest::query()
                        ->where(function ($query) use ($units) {
                            $query->where('created_by', auth()->id())
                                ->orWhereIn('unit_id', $units);
                        })
                        ->whereIn('status', [1, 2, 3, 4, 5, 6, 7])
                        ->orderBy('created_at', 'desc')
                        ->get();
                break;
            case 'segment qc':
                if ($type === 'close')
                    $inspections = InspectionRequest::query()
                        ->where(function ($query) {
                            $query->where('created_by', auth()->id())
                                ->orWhere('unit_id', auth()->user()->unit_id);
                        })
                        ->where('status', 8)
                        ->orderBy('id', 'desc')
                        ->get();
                else
                    $inspections = InspectionRequest::query()
                        ->where(function ($query) {
                            $query->where('created_by', auth()->id())
                                ->orWhere('unit_id', auth()->user()->unit_id);
                        })
                        ->whereIn('status', [1, 2, 3, 4, 5, 6, 7])
                        ->orderBy('id', 'desc')
                        ->get();
                break;
            case 'inspector':
                $inspections = InspectionRequest::query()->where('inspector', auth()->id())->get();
                break;
            case 'admin':
                if ($type === 'close')
                    $inspections = InspectionRequest::query()->where('status', 8)->get();
                else
                    $inspections = InspectionRequest::query()->whereIn('status', [2, 4, 6, 7, 6, 8])->get();
                break;
        }

        return view('users.inspections.list', compact('inspections'));
    }

    public function inspectionCreate(): View
    {
        $states = State::all();
        $cities = City::query()->where('state_id', 1)->get();
        return view('users.inspections.create', compact('states', 'cities'));
    }

    public function inspectionStore(Request $request): \Illuminate\Http\JsonResponse
    {
        $validation = Validator::make($request->all(), [
            'location' => 'required|string',
            'manufacturer' => 'required|string',
            'inspection_type' => 'required|in:technical,good',
            'coordinator' => 'required|string',
            'coordinator_mobile' => 'required|regex:/^0?9\d{9}$/',
        ], messages: ['inspection_type.in' => 'لطفا نوع بازرسی را انتخاب کنید.']);

        if ($validation->fails())
            return response()->json(['status' => 422, 'errors' => $validation->errors()]);

        $counter = $request->counter;
        if ((int)$counter == 0)
            return response()->json(['status' => 422, 'errors' => ["list" => "لیست تجهیزات خالی است."]]);

        DB::beginTransaction();
        try {
            $year = Carbon::now()->year;
            $role = auth()->user()->getRoleNames()->first();
            $status = $role == 'segment qc' ? 1 : 2;
            $inspection_ids = [];
            for ($i = 1; $i <= $counter; $i++) {
                $inspection_date = Jalalian::fromFormat('Y/m/d H:i', convertPersianToEnglish($request->inspection_date))->toCarbon();
                if (auth()->user()->getRoleNames()->first() == 'supervisor' || auth()->user()->getRoleNames()->first() == 'qc') {
                    $company_id = auth()->user()->company_id;
                    $unit_id = $request->unit_id < '10' ? '0' . $request->unit_id : $request->unit_id;
                    $work_order = $company_id . '-' . $unit_id . '-' . $year;
                } else {
                    $company_id = auth()->user()->companyUnit->company->id;
                    $unit_id = auth()->user()->company_unit_id < 10 ? '0' . auth()->user()->company_unit_id : auth()->user()->company_unit_id;
                    $work_order = $company_id . '-' . $unit_id . '-' . $year;
                }

                $tests = json_decode($request["tests_$i"], true) ?? [];
                $tests = array_filter($tests, fn($value) => $value !== "0");

                if ($request["description_$i"] != 'ندارد') {
                    $other_test = json_encode(explode(",", $request["description_$i"]));
                } else
                    $other_test = null;

                if ($request->unit_id == 'undefined')
                    $unit_id = auth()->user()->company_unit_id;
                else
                    $unit_id = $request->unit_id;

                $inspection = InspectionRequest::query()->create([
                    'created_by' => auth()->user()->id,
                    'unit_id' => $unit_id,
                    'manufacturer' => $request["manufacturer"],
                    'work_order' => null,
                    'tests' => $tests,
                    'description' => $other_test,
                    'size' => $request["size_$i"],
                    'serial_no' => $request["serial_no_$i"],
                    'equipment_name' => $request["equipment_name_$i"],
                    'location' => $request->location,
                    'inspection_type' => $request->inspection_type,
                    'irn_no' => null,
                    'status' => $status,
                    'start_date' => $inspection_date,
                    'end_date' => null,
                    'next_inspection_date' => null,
                    'inspector' => null,
                    'coordinator' => $request->coordinator,
                    'coordinator_mobile' => $request->coordinator_mobile,
                    'city_id' => $request->city_id
                ]);
                $work_order = $work_order . '-' . $inspection->id;
                $inspection->work_order = $work_order;
                $inspection->save();
                array_push($inspection_ids, $inspection->id);

                if ($request->has("files_$i")) {
                    $files = $request->file("files_$i");

                    // اطمینان از اینکه متغیر یک آرایه است
                    if (!is_array($files)) {
                        $files = [$files];
                    }

                    foreach ($files as $file) {
                        // حذف مقدار نامعتبر و بررسی معتبر بودن فایل
                        if ($file && $file !== "آپلود نشده" && $file->isValid()) {
                            $company_id = $inspection->unit->company->id;
                            $unit_id = str_pad($inspection->unit_id, 2, '0', STR_PAD_LEFT);
                            $filename = "{$company_id}-{$unit_id}-" . now()->timestamp . '-' . $file->getClientOriginalName();
                            $storedPath = 'inspection_files/' . $filename;

                            $file->move(public_path('inspection_files'), $filename);

                            File::query()->create([
                                'inspection_id' => $inspection->id,
                                'user_id' => auth()->id(),
                                'file_path' => $storedPath,
                                'file_name' => $filename,
                            ]);
                        }
                    }
                }
            }
            if (auth()->user()->getRoleNames()->first() == 'segment qc') {
                $staffs = User::query()->where('company_id', auth()->user()->companyUnit->company->id)->get();
                $qc_email = null;
                $supervisor_email = null;

                foreach ($staffs as $staff) {
                    $qc_email = $staff->getRoleNames()->first() === 'qc' ? $staff->email : $qc_email;
                    $supervisor_email = $staff->getRoleNames()->first() === 'supervisor' ? $staff->email : $supervisor_email;
                }

                $data = [
                    'unit' => auth()->user()->companyUnit->name,
                    'creator' => auth()->user()->fullName(),
                ];

                if ($qc_email)
                    Mail::to($qc_email)->send(new NewInspectionMail(data: $data));
                if ($supervisor_email)
                    Mail::to($supervisor_email)->send(new NewInspectionMail(data: $data));

                if ($qc_email == null && $supervisor_email == null) {
                    foreach ($inspection_ids as $inspection_id) {
                        InspectionRequest::query()->where('id', intval($inspection_id))->update(['status' => 2]);
                    }
                    $admin = User::query()->role('admin')->first();
                    Mail::to($admin->email)->send(new NewInspectionMail(data: $data));
                }
            }
            DB::commit();
            return response()->json(['status' => 200, 'message' => 'درخواست شما با موفقیت ثبت شد.', 'url' => route('inspections.list', 'open')]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function inspectionView($id)
    {
        try {
            $inspection = InspectionRequest::query()->findOrFail($id)->load('comments', 'files');
            $tests = Test::query()->where('type', $inspection->inspection_type)->get();
            return view('users.inspections.view', compact('inspection', 'tests'));
        } catch (\Exception $exception) {
            return back();
        }
    }

    public function inspectionEdit($id)
    {
        try {
            $inspection = InspectionRequest::query()->findOrFail($id)->load('comments', 'files');
            $tests = Test::query()->where('type', $inspection->inspection_type)->get();
            $states = State::all();
            $cities = City::query()->where('id', $inspection->city_id)->get();
            return view('users.inspections.edit', compact('inspection', 'tests', 'states', 'cities'));
        } catch (\Exception $exception) {
            return back();
        }
    }

    public function inspectionUpdate(Request $request, $id)
    {
        try {

            $request->merge(['start_date' => Jalalian::fromFormat('Y/m/d H:i', convertPersianToEnglish($request->start_date))->toCarbon()]);
            $inspection = InspectionRequest::query()->findOrFail($id);
            $tests = $request["tests"] ?? [];
            $tests = array_filter($tests, fn($value) => $value !== "0");
            $request->merge(['tests' => $tests]);
            $request->merge(['description' => $request->other_tests ?? null]);
            $inspection->update($request->all());
            if ($request->status == 2) {
                $admin = User::query()->role('admin')->first();
                $data = ['company' => $inspection->unit->company->name, 'unit' => $inspection->unit->name];
                Mail::to($admin->email)->send(new AdminInspectionNotif(data: $data));
            } elseif ($request->status == 3) {
                $data = ['reject_by' => auth()->user()->fullName()];
                Mail::to($inspection->creator->email)->send(new RejectInspectionMail(data: $data));
            }

            if (auth()->user()->getRoleNames()->first() == 'segment qc') {
                $staffs = User::query()->where('company_id', $inspection->unit->company->id)->get();
                $qc_email = null;
                $supervisor_email = null;
                foreach ($staffs as $staff) {
                    $qc_email = $staff->getRoleNames()->first() === 'qc' ? $staff->email : $qc_email;
                    $supervisor_email = $staff->getRoleNames()->first() === 'supervisor' ? $staff->email : $supervisor_email;
                }
                $data = ['updated_by' => auth()->user()->fullName()];

                if ($qc_email)
                    Mail::to($qc_email)->send(new UpdateInspectionMail(data: $data));
                if ($supervisor_email)
                    Mail::to($supervisor_email)->send(new UpdateInspectionMail(data: $data));

                if ($qc_email == null && $supervisor_email == null) {
                    $inspection->status = 2;
                    $inspection->save();
                    $admin = User::query()->role('admin')->first();
                    Mail::to($admin->email)->send(new UpdateInspectionMail(data: $data));
                }
            }
            return response()->json(['status' => 200, 'message' => 'َدرخواست شما با موفقیت به‌روزرسانی شد.', 'url' => route('inspection.view', $id)]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function commentStore(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $inspection = InspectionRequest::query()->findOrFail($request['inspection_id']);
            $inspection->comments()->create([
                'comment' => $request['comment'],
                'user_id' => auth()->id(),
            ]);

            if (auth()->user()->getRoleNames()->first() == 'segment qc') {
                $staffs = User::query()->where('company_id', $inspection->unit->company->id)->get();
                $qc_email = null;
                $supervisor_email = null;
                foreach ($staffs as $staff) {
                    $qc_email = $staff->getRoleNames()->first() === 'qc' ? $staff->email : $qc_email;
                    $supervisor_email = $staff->getRoleNames()->first() === 'supervisor' ? $staff->email : $supervisor_email;
                }
                $data = ['updated_by' => auth()->user()->fullName()];

                if ($qc_email)
                    Mail::to($qc_email)->send(new UpdateInspectionMail(data: $data));
                if ($supervisor_email)
                    Mail::to($supervisor_email)->send(new UpdateInspectionMail(data: $data));

                if ($qc_email == null && $supervisor_email == null) {
                    $inspection->status = 2;
                    $inspection->save();
                    $admin = User::query()->role('admin')->first();
                    Mail::to($admin->email)->send(new UpdateInspectionMail(data: $data));
                }
            }
            return response()->json(['status' => 200, 'message' => 'نظر شما با موفقیت ثبت شد.', 'reload' => true]);

        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function getTests($type): \Illuminate\Http\JsonResponse
    {
        try {
            $tests = Test::query()->where('type', $type)->get();
            return response()->json(['tests' => $tests]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function download($fileName): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $filePath = public_path('inspection_files/' . $fileName); // Get the full path to the file in the public folder

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        return abort(404, 'File not found.');
    }

    public function uploadFiles(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $year = Carbon::now()->year;
            $inspection = InspectionRequest::query()->findOrFail($request['inspection_id']);
            $file = $request->file("file");
            $company_id = $inspection->unit->company->id;
            $unit_id = $inspection->unit_id < '10' ? '0' . $inspection->unit_id : $inspection->unit_id;
            $filename = $company_id . '-' . $unit_id . '-' . $year . '-' . $file->getClientOriginalName();
            $file->move(public_path('inspection_files'), $filename);
            $storedPath = $filename;

            $inspection->files()->create([
                'user_id' => auth()->id(),
                'file_path' => $storedPath,
                'file_name' => $filename,
            ]);
            return response()->json(['status' => 200, 'message' => 'فایل با موفقیت آپلود شد.', 'reload' => true]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function getCities(Request $request)
    {
        try {
            $cities = City::query()->where('state_id', $request['state_id'])->get();
            return response()->json(['cities' => $cities]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

}
