<?php

namespace App\Http\Controllers;
use App\Models\Berita;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->limit(10)->get();

        return view('dashboard', compact('beritas'));
    }

}
