<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first();
        return view('admin.profile_edit', compact('profile'));
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
        
        // if ($profile) {

        //     $profile->update([
        //         'nama_instansi' => $request->nama_instansi,
        //         'deskripsi' => $request->deskripsi,
        //         'gambar' => $profile->gambar,
        //     ]);
        // } else {
        //     Profile::create([
        //         'nama_instansi' => $request->nama_instansi,
        //         'deskripsi' => $request->deskripsi,
        //         'gambar' => $filename,
        //     ]);
        // }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
