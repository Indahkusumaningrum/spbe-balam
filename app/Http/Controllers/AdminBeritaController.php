<?php

namespace App\Http\Controllers; // Sesuaikan namespace Anda jika berada di subfolder Admin

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Validator; // Tidak lagi diperlukan jika hanya pakai $request->validate()

class AdminBeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        // Pastikan nama view yang benar, misal 'admin.berita.index' atau 'admin.berita'
        return view('admin.berita', compact('beritas'));
    }

    public function create()
    {
        // Pastikan nama view yang benar, misal 'admin.berita.create' atau 'admin.berita_create'
        return view('admin.berita_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string', // Konten akan berupa plain text atau HTML yang diinput manual
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
            'penulis' => Auth::check() ? Auth::user()->name : 'Admin', // Pastikan user login atau berikan default
        ]);

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        // Pastikan nama view yang benar, misal 'admin.berita.edit' atau 'admin.berita_edit'
        return view('admin.berita_edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string', // Konten akan berupa plain text atau HTML yang diinput manual
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filename = $berita->gambar; // Tetap gunakan gambar yang sudah ada secara default
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada dan berbeda dengan yang baru
            if ($berita->gambar && file_exists(public_path('uploads/beritas/' . $berita->gambar))) {
                unlink(public_path('uploads/beritas/' . $berita->gambar));
            }
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/beritas'), $filename);
        }

        $berita->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $filename, // Gunakan $filename yang sudah diperbarui
        ]);

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        // Hapus gambar terkait jika ada
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
        // Pastikan nama view yang benar
        return view('admin.detail_berita', compact('berita'));
    }

    public function uploadImageTinyMCE(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            // Pastikan nama file bersih dari karakter aneh dan spasi berlebih
            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $filename = str_replace([' ', '/', '\\'], '_', $filename); // Ganti spasi/slash dengan underscore

            $path = public_path('uploads/tinymce');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $image->move($path, $filename);

            // Gunakan url() helper untuk mendapatkan URL absolut yang bersih
            // dan trim untuk memastikan tidak ada spasi di akhir
            $imageUrl = trim(url('uploads/tinymce/' . $filename));

            return response()->json(['location' => $imageUrl]);
        }

        return response()->json(['error' => 'File not found'], 400);
    }

    // Method uploadImage telah dihapus karena tidak ada lagi CKEditor
    // public function uploadImage(Request $request) { ... }
}