<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function list_applications(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $applications = Application::all();
            return view('application.staff_list', compact('applications'));
        } else if ($profile_type == 'employee') {
            $applications = Application::where([
                ['employer_id', '=', $profile->employer->id]
            ])->first();
            return view('application.employer_list', compact('applications'));
        } else if ($profile_type == 'intern') {
            $applications = Application::where([
                ['applicant_id', '=', $profile_id]
            ])->first();
            return view('application.intern_list', compact('applications'));
        } else {

        }
    }

    public function detail_application(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        $application_id = (int) $request->route('application_id');
        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $application = Application::find($application_id);
            return view('application.staff_detail', compact('application'));
        } else if ($profile_type == 'employee') {
            $application = Application::where([
                ['id', '=', $application_id],
                ['employer_id', '=', $profile->employer->id]
            ]);
            return view('application.employer_detail', compact('application'));
        } else if ($profile_type == 'intern') {
            $application = Application::where([
                ['id', '=', $application_id],
                ['applicant_id', '=', $profile_id]
            ])->first();
            return view('application.intern_detail', compact('application'));
        } else {

        }
    }

    public function create_application(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        if ($profile_type == 'intern') {
            $application = Application::create([
                'applicant_id' => $profile_id,
            ]);
        } else {

        }

        return back();
    }

    public function update_application(Request $request)
    {

        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        $application_id = (int) $request->route('application_id');

        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $application = Application::find($application_id);
            $application->update([]);
        } else if ($profile_type == 'intern') {
            $application = Application::where([
                ['id', '=', $application_id],
                ['applicant_id', '=', $profile_id]
            ])->first();
            $application->update([]);
        } else {

        }    

        return back();
    }
}
