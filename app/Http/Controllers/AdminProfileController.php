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
}
