<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CompanyUnit;
use App\Models\InspectionRequest;
use Illuminate\View\View;

class UserController extends Controller
{
    public function dashboard():View
    {
        $user=auth()->user();
        if ($user->hasRole('qc') || $user->hasRole('supervisor')) {
            $statuses = [1];
            $unit_ids = CompanyUnit::query()->where('company_id', $user->company_id)->get()->pluck('id')->toArray();
            $open_requests = InspectionRequest::query()->whereIn('unit_id', $unit_ids)->whereIn('status', $statuses)->count();
            $processing = InspectionRequest::query()->whereIn('unit_id', $unit_ids)->where('status', 6)->count();
            $rejected = InspectionRequest::query()->whereIn('unit_id', $unit_ids)->where('status', 7)->count();
        } elseif ($user->hasRole('segment qc')) {
            $statuses = [1, 3, 5, 7];
            $open_requests = InspectionRequest::query()->where('unit_id', $user->company_unit_id)->whereIn('status', $statuses)->count();
            $processing = InspectionRequest::query()->where('unit_id', $user->company_unit_id)->where('status', 6)->count();
            $rejected = InspectionRequest::query()->where('unit_id', $user->company_unit_id)->where('status', 7)->count();
        }

        return view('users.dashboard',compact('open_requests','processing','rejected'));
    }

    public function profile():View
    {
        return view('users.profile');
    }
}
