<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InspectionConfirmMail;
use App\Mail\InspectionDoneMail;
use App\Mail\RejectInspectionMail;
use App\Models\CompanyUnit;
use App\Models\InspectionRequest;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;

class InspectionRequestController extends Controller
{
    public function inspectionsList($type): View
    {
        $units = CompanyUnit::all();
        if ($type === 'close')
            $inspections = InspectionRequest::query()->where('status', 8)->orderBy('id','desc')->get();
        else
            $inspections = InspectionRequest::query()->whereIn('status', [2, 4, 6, 7, 6])->orderBy('id','desc')->get();
        return view('admin.inspections.list', compact('inspections', 'units'));
    }

    public function inspectionsFilter(Request $request)
    {
        try {
            if ($request->unit_id == null && $request->serial_no == null && $request->equipment_name == null) {
                if ($request->type === 'close')
                    $inspections = InspectionRequest::query()->where('status', 8)->with('unit', 'inspectorr')->get();
                else
                    $inspections = InspectionRequest::query()->whereIn('status', [2, 4, 6, 7, 6])->with('unit', 'inspectorr')->get();
            } else {
                if ($request->type === 'close')
                    $inspections = InspectionRequest::query()->where('unit_id', request('unit_id'))
                        ->with('unit', 'inspectorr')
                        ->where('status', 8)
                        ->orWhere('serial_no', request('serial_no'))
                        ->orWhere('equipment_name', request('equipment_name'))->get();
                else
                    $inspections = InspectionRequest::query()->where('unit_id', request('unit_id'))
                        ->with('unit', 'inspectorr')
                        ->whereIn('status', [2, 4, 6, 7, 6])
                        ->orWhere('serial_no', request('serial_no'))
                        ->orWhere('equipment_name', request('equipment_name'))->get();
            }

            return response()->json(['inspections' => $inspections]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => 'خطایی در سرور رخ داده است. لطفاً مشکل را به پشتیبانی اطلاع دهید و در زمانی دیگر تلاش کنید.']);
        }
    }

    public function inspectionView($id)
    {
        try {
            $inspection = InspectionRequest::query()->findOrFail($id)->load('comments', 'files');
            $tests = Test::query()->where('type', $inspection->inspection_type)->get();
            $inspectors = User::query()->role('inspector')->get();
            return view('admin.inspections.view', compact('inspection', 'tests', 'inspectors'));
        } catch (\Exception $exception) {
            return back();
        }
    }

    public function inspectionUpdate(Request $request, $id)
    {
        try {
            if ($request->status == 6 && $request->inspector == null)
                return response()->json(['status' => 422, 'errors' => ['inspector' => 'برای تأیید درخواست، لازم است یک بازرس تعیین گردد.']]);

            if ($request->status == 8 && $request->end_date)
                $request->merge(['end_date' => Jalalian::fromFormat('Y/m/d H:i', convertPersianToEnglish($request->end_date))->toCarbon()]);
            else
                $request->merge(['end_date' => null]);

            if ($request->status == 8 && $request->next_inspection_date)
                $request->merge(['next_inspection_date' => Jalalian::fromFormat('Y/m/d H:i', convertPersianToEnglish($request->next_inspection_date))->toCarbon()]);
            else
                $request->merge(['next_inspection_date' => null]);

            $inspection = InspectionRequest::query()->findOrFail($id);
            $inspection->update($request->all());

            if ($request->status == 6) {
                $inspector = User::query()->where('id', $inspection->inspector)->first();
                $data = ['admin' => auth()->user()->fullName()];
                Mail::to([$inspection->creator->email, $inspector->email])->send(new InspectionConfirmMail(data: $data));
            } elseif ($request->status == 7) {
                $data = ['reject_by' => auth()->user()->fullName()];
                Mail::to($inspection->creator->email)->send(new RejectInspectionMail(data: $data));
            } elseif ($request->status == 8) {
                Mail::to($inspection->creator->email)->send(new InspectionDoneMail([]));
            }
            return response()->json(['status' => 200, 'message' => 'َدرخواست شما آپدیت شد.', 'url' => route('admin.inspection.view', $id)]);
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
            return response()->json(['status' => 200, 'message' => 'نظر شما با موفقیت ثبت شد.', 'reload' => true]);

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

}
