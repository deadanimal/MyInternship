<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function list_posts(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $posts = Post::all();
            return view('post.staff_list', compact('posts'));
        } else if ($profile_type == 'employee') {
            $posts = Post::where([
                ['employer_id', '=', $profile->employer->id]
            ])->first();
            return view('post.employer_list', compact('posts'));
        } else if ($profile_type == 'intern') {
            $posts = Post::where([
                ['applicant_id', '=', $profile_id]
            ])->first();
            return view('post.intern_list', compact('posts'));
        } else {

        }
    }

    public function detail_post(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        $post_id = (int) $request->route('post_id');
        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $post = Post::find($post_id);
            return view('post.staff_detail', compact('post'));
        } else if ($profile_type == 'employee') {
            $post = Post::where([
                ['id', '=', $post_id],
                ['employer_id', '=', $profile->employer->id]
            ]);
            return view('post.employer_detail', compact('post'));
        } else if ($profile_type == 'intern') {
            $post = Post::where([
                ['id', '=', $post_id],
                ['applicant_id', '=', $profile_id]
            ])->first();
            return view('post.intern_detail', compact('post'));
        } else {

        }
    }

    public function create_post(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        if ($profile_type == 'intern') {
            $post = Post::create([
                'applicant_id' => $profile_id,
            ]);
        } else {

        }

        return back();
    }

    public function update_post(Request $request)
    {

        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type;
        $profile_id = $profile->id;

        $post_id = (int) $request->route('post_id');

        if ($profile_type == 'admin' || $profile_type == 'staff') {
            $post = Post::find($post_id);
            $post->update([]);
        } else if ($profile_type == 'intern') {
            $post = Post::where([
                ['id', '=', $post_id],
                ['applicant_id', '=', $profile_id]
            ])->first();
            $post->update([]);
        } else {

        }    

        return back();
    }
}
