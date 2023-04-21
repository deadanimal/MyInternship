<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view_dashboard(Request $request) {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        if ($profile_type == 'admin') {
            $applications = Application::all();
            $applications = Application::all();
            return view('dashboard.admin');
        } else if ($profile_type == 'staff') {
            return view('dashboard.staff');
        } else if ($profile_type == 'employee') {
            return view('dashboard.employee');
        } else if ($profile_type == 'intern') {
            return view('dashboard.intern');
        } else {

        }
        
    }
}
