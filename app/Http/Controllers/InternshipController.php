<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;

class InternshipController extends Controller
{
    public function list_internships(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $internships = Internship::all();
            return view('internship.staff_list', compact('internships'));
        } else if ($profile_type == 'employee') {
            $internships = Internship::where([
                ['employer_id', '=', $profile->employer->id]
            ])->first();
            return view('internship.employer_list', compact('internships'));
        } else if ($profile_type == 'intern') {
            $internships = Internship::where([
                ['applicant_id', '=', $profile_id]
            ])->first();
            return view('internship.intern_list', compact('internships'));
        } else {

        }
    }

    public function detail_internship(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        $internship_id = (int) $request->route('internship_id');
        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $internship = Internship::find($internship_id);
            return view('internship.staff_detail', compact('internship'));
        } else if ($profile_type == 'employee') {
            $internship = Internship::where([
                ['id', '=', $internship_id],
                ['employer_id', '=', $profile->employer->id]
            ]);
            return view('internship.employer_detail', compact('internship'));
        } else if ($profile_type == 'intern') {
            $internship = Internship::where([
                ['id', '=', $internship_id],
                ['applicant_id', '=', $profile_id]
            ])->first();
            return view('internship.intern_detail', compact('internship'));
        } else {

        }
    }

    public function create_internship(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        if ($profile_type == 'intern') {
            $internship = Internship::create([
                'applicant_id' => $profile_id,
            ]);
        } else {

        }

        return back();
    }

    public function update_internship(Request $request)
    {

        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        $internship_id = (int) $request->route('internship_id');

        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $internship = Internship::find($internship_id);
            $internship->update([]);
        } else if ($profile_type == 'intern') {
            $internship = Internship::where([
                ['id', '=', $internship_id],
                ['applicant_id', '=', $profile_id]
            ])->first();
            $internship->update([]);
        } else {

        }    

        return back();
    }
}
