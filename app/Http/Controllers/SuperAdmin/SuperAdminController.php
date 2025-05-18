<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\InspectionRequest;
use App\Models\User;
use Illuminate\View\View;

class SuperAdminController extends Controller
{

    public function dashboard(): View
    {
        $users = User::query()->whereNotNull('company_id')->orWhereNotNull('company_unit_id')->get()->count();
        $open_requests = InspectionRequest::query()->whereIn('status', [2, 4])->count();
        $processing = InspectionRequest::query()->where('status', 6)->count();
        $rejected = InspectionRequest::query()->where('status', 7)->count();
        return view('superAdmin.dashboard', compact('users', 'open_requests', 'processing', 'rejected'));
    }
}
