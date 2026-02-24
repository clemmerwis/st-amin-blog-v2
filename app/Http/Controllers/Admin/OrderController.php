<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display the orders admin page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboards.admin', ['active' => 'Orders']);
    }
}
