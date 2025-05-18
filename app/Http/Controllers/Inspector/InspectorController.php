<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class InspectorController extends Controller
{
    public function dashboard():View
    {
        return view('admin.dashboard');
    }
}
