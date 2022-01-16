<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('dashboards.adminPosts');
    }
}
