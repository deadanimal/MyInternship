<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function list_employers(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $employers = Employer::all();
            return view('employer.staff_list', compact('employers'));
        } else {

        }
    }

    public function detail_employer(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        $employer_id = (int) $request->route('employer_id');
        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $employer = Employer::find($employer_id);
            return view('employer.staff_detail', compact('employer'));
        } else if ($profile_type == 'employee') {
            $employer = Employer::where([
                ['id', '=', $employer_id],
                ['employer_id', '=', $profile->employer->id]
            ]);
            return view('employer.employer_detail', compact('employer'));
        } else {

        }
    }

    public function create_employer(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $employer = Employer::create([
                
            ]);
        } else {

        }

        return back();
    }

    public function update_employer(Request $request)
    {

        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        $employer_id = (int) $request->route('employer_id');

        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $employer = Employer::find($employer_id);
            $employer->update([]);
        } else if ($profile_type == 'employee') {
            $employer = Employer::where([
                ['id', '=', $employer_id],
            ])->first();
            $employer->update([]);
        } else {

        }    

        return back();
    }
}
