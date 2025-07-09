<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index() 
    {
        $galleries = Gallery::all();
        return view('galeri_index', compact('galleries'));
    }

    public function adminIndex()
    {
        $galleries = Gallery::all();
        return view('admin.galeri', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galeri_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $imageName = time() . '_' . $request->image->getClientOriginalName();
        $request->image->move(public_path('uploads/gallery'), $imageName);

        Gallery::create([
            'title' => $request->title,
            'image_path' => $imageName,
        ]);

        return redirect()->route('admin.galeri')->with('success', 'Foto berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.galeri_edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|mac:5120',
        ]);


        if($request->hasFile('image')) 
        {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/gallery'), $imageName);
            $gallery->image_path = $imageName;
        }

        $gallery->update([
            'title'=> $request->title,
            'image' => $gallery->image,
        ]);

        return redirect()->route('admin.galeri')->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();

        return redirect()->route('admin.galeri')->with('success', 'Foto berhasil dihapus!');
    }
}
