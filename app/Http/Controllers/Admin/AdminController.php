<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        // return view('dashboards.admin');
        
        // Redirect to the admin posts index page
        return redirect()->route('admin.posts.index');
    }
}