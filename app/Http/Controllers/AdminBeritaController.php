<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('admin.berita', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita_create');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);


        $filename = null;
        if ($request->hasFile('gambar')) 
        {
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/beritas'), $filename);
        }

        Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $filename,
            'penulis' => Auth::user()->name,
        ]);
        return redirect()->route('admin.berita')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita_edit', compact('berita'));  
    }

    public function update(Request $request, $id) 
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/beritas'), $filename);
            $berita->gambar = $filename;
        }

        $berita->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $berita->gambar,
        ]);
        
        return redirect()->route('admin.berita')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();
        return redirect()->route('admin.berita')->with('success', 'Berita berhasil dihapus');
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->increment('pengunjung');
        // return view('berita_show', compact('berita'));
        return view('admin.detail_berita', compact('berita'));

    }

}
