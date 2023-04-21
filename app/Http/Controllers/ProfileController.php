<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function view_self_profile(Request $request) {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        return view('profile.self');
    }
    
    public function update_self_profile(Request $request) {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;
    }

    public function list_profiles(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $profiles = Profile::all();
            return view('profile.staff_list', compact('profiles'));
        } else if ($profile_type == 'employee') {
            $profiles = Profile::where([
                ['employer_id', '=', $profile->employer->id]
            ])->first();
            return view('profile.employer_list', compact('profiles'));
        } else if ($profile_type == 'intern') {
            $profiles = Profile::where([
                ['applicant_id', '=', $profile_id]
            ])->first();
            return view('profile.intern_list', compact('profiles'));
        } else {

        }
    }

    public function detail_profile(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        $profile_id = (int) $request->route('profile_id');
        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $profile = Profile::find($profile_id);
            return view('profile.staff_detail', compact('profile'));
        } else if ($profile_type == 'employee') {
            $profile = Profile::where([
                ['id', '=', $profile_id],
                ['employer_id', '=', $profile->employer->id]
            ]);
            return view('profile.employer_detail', compact('profile'));
        } else if ($profile_type == 'intern') {
            $profile = Profile::where([
                ['id', '=', $profile_id],
                ['applicant_id', '=', $profile_id]
            ])->first();
            return view('profile.intern_detail', compact('profile'));
        } else {

        }
    }

    public function create_profile(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        if ($profile_type == 'intern') {
            $profile = Profile::create([
                'applicant_id' => $profile_id,
            ]);
        } else {

        }

        return back();
    }

    public function update_profile(Request $request)
    {

        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        $profile_id = (int) $request->route('profile_id');

        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $profile = Profile::find($profile_id);
            $profile->update([]);
        } else if ($profile_type == 'intern') {
            $profile = Profile::where([
                ['id', '=', $profile_id],
                ['applicant_id', '=', $profile_id]
            ])->first();
            $profile->update([]);
        } else {

        }    

        return back();
    }    
}
