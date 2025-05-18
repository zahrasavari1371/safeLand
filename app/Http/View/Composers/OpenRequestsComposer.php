<?php

namespace App\Http\View\Composers;

use App\Models\CompanyUnit;
use Illuminate\View\View;
use App\Models\InspectionRequest;
use Illuminate\Support\Facades\Auth;

class OpenRequestsComposer
{
    public function compose(View $view)
    {
        $user = Auth::user();

        $statuses = [];

        if ($user) {
            if ($user->hasRole('qc') || $user->hasRole('supervisor')) {
                $statuses = [1];
                $unit_ids = CompanyUnit::query()->where('company_id', $user->company_id)->get()->pluck('id')->toArray();
                $openRequestsCount = InspectionRequest::query()->whereIn('unit_id', $unit_ids)->whereIn('status', $statuses)->count();
            } elseif ($user->hasRole('admin') || $user->hasRole('super admin')) {
                $statuses = [2, 4];
                $openRequestsCount = InspectionRequest::query()->whereIn('status', $statuses)->count();
            } elseif ($user->hasRole('inspector')) {
                $statuses = [6];
                $openRequestsCount = InspectionRequest::query()->where('inspector', $user->id)->whereIn('status', $statuses)->count();
            } elseif ($user->hasRole('segment qc')) {
                $statuses = [1, 3, 5, 7];
                $openRequestsCount = InspectionRequest::query()->where('unit_id', $user->company_unit_id)->whereIn('status', $statuses)->count();
            }

            $view->with('openRequestsCount', $openRequestsCount);
        }
    }
}

