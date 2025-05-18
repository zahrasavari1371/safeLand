<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InspectionRequest;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard():View
    {
        $open_requests=InspectionRequest::query()->whereIn('status',[2, 4])->count();
        $processing=InspectionRequest::query()->where('status',6)->count();
        $rejected=InspectionRequest::query()->where('status',7)->count();
        $closed=InspectionRequest::query()->where('status',8)->count();
        return view('admin.dashboard',compact('open_requests','processing','rejected','closed'));
    }
}
