<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function dashboard()
    {
        return view('dashboards.admin');
    }

    public function posts()
    {
        $posts = Post::all()->orderBy('published_at', 'desc');
        return view('dashboards.adminPosts', compact('posts'));
    }
}
