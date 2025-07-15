<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class UserBeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderBy('updated_at', 'desc')->get();
        return view('berita_index', compact('beritas'));
    }

    public function show($id_berita)
    {
        $berita = Berita::findOrFail($id_berita);
        return view('berita_show', compact('berita'));
    }
}
