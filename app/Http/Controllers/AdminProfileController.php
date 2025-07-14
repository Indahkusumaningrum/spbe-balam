<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{

    public function show() {
        $profile = \App\Models\Profile::first();
        return view('admin.profile', compact('profile'));
    }

    public function edit()
    {
        $profile = Profile::first();
        return view('admin.edit_profile', compact('profile'));
    }

    public function update(Request $request) {

        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $profile = Profile::first();

        if (!$profile) {
            $profile = new Profile();
        }

        if ($request->hasFile('gambar')) {
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/profiles'), $filename);
            $profile->gambar = $filename;
        }


        $profile->nama_instansi = $request->nama_instansi;
        $profile->deskripsi = $request->deskripsi;
        $profile->save();
        

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
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
}
