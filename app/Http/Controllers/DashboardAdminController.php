<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard_admin');
    }

    public function tahapan(){
        return view ('admin.tahapan_spbe_admin');
    }
}
