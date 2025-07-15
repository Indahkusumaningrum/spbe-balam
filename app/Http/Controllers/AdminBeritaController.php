<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBeritaController extends Controller
{
    public function index()
    {
        // Mengubah query untuk mengurutkan berdasarkan 'updated_at' secara descending (terbaru)
        $beritas = Berita::orderBy('updated_at', 'desc')->get();
        // Pastikan nama view yang benar, misal 'admin.berita.index' atau 'admin.berita'
        return view('admin.berita', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'penulis' => Auth::check() ? Auth::user()->name : 'Admin',
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
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filename = $berita->gambar;
        if ($request->hasFile('gambar')) {
            if ($berita->gambar && file_exists(public_path('uploads/beritas/' . $berita->gambar))) {
                unlink(public_path('uploads/beritas/' . $berita->gambar));
            }
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/beritas'), $filename);
        }

        $berita->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $filename,
        ]);

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar && file_exists(public_path('uploads/beritas/' . $berita->gambar))) {
            unlink(public_path('uploads/beritas/' . $berita->gambar));
        }
        $berita->delete();
        return redirect()->route('admin.berita')->with('success', 'Berita berhasil dihapus');
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->increment('pengunjung');
        return view('admin.detail_berita', compact('berita'));
    }

    public function uploadImageTinyMCE(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $filename = str_replace([' ', '/', '\\'], '_', $filename);

            $path = public_path('uploads/tinymce');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $image->move($path, $filename);

            $imageUrl = trim(url('uploads/tinymce/' . $filename));

            return response()->json(['location' => $imageUrl]);
        }

        return response()->json(['error' => 'File not found'], 400);
    }
}