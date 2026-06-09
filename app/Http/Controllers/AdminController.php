<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    /**
     * Render the admin dashboard view.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
