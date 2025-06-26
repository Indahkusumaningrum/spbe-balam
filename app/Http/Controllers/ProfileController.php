<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
     // Tampilkan halaman profil
    public function index()
    {
        // bisa ambil data dari database kalau perlu
        return view('admin.profile.index'); // misal: resources/views/admin/profile/index.blade.php
    }

    // Tampilkan form edit profil
    public function editProfile()
    {
        return view('admin.edit_profile');
    }

    // Proses update profil
    public function update(Request $request)
    {
        // Validasi data form
        $request->validate([
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|max:102400',
        ]);

        // Simpan ke database, atau ke file .txt sementara untuk testing
        // Misal: menyimpan file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile', 'public');
        }

        // Simpan logika penyimpanan lain jika ada

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
