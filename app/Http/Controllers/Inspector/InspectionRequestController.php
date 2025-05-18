<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use App\Models\CompanyUnit;
use App\Models\InspectionRequest;
use App\Models\Test;
use App\Models\User;
use Illuminate\View\View;


class InspectionRequestController extends Controller
{
    public function inspectionsList($type): View
    {
        if ($type === 'close')
            $inspections = InspectionRequest::query()->where('inspector',auth()->user()->id)->where('status', 8)->orderBy('id', 'desc')->get();
        else
            $inspections = InspectionRequest::query()->where('inspector',auth()->user()->id)->where('status', 6)->orderBy('id', 'desc')->get();
        return view('inspector.inspections.list', compact('inspections'));
    }

    public function inspectionView($id)
    {
        try {
            $inspection = InspectionRequest::query()->where('inspector',auth()->user()->id)->findOrFail($id)->load('comments', 'files');
            $tests = Test::query()->where('type', $inspection->inspection_type)->get();
            return view('inspector.inspections.view', compact('inspection', 'tests'));
        } catch (\Exception $exception) {
            return back();
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
}
