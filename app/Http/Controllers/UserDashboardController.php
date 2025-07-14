<?php

namespace App\Http\Controllers;
use App\Models\Berita;
use App\Models\Evaluasi;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->limit(10)->get();
        $evaluations = Evaluasi::all();

        return view('dashboard', compact('beritas', 'evaluations'));
    }

}
