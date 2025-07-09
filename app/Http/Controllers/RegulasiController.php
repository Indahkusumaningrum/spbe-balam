<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regulasi;

class RegulasiController extends Controller
{

    //USER
       public function indexUser()
    {
        $regulations = Regulasi::all()->groupBy('kategori');
        return view('regulasi_list', compact('regulations'));
    }

    //ADMIN
    public function index() {
        $regulations = Regulasi::all();
        return view('admin.regulasi', compact('regulations'));
    }

    public function create() {
        return view('admin.create_regulasi');
    }

    public function store(Request $request) {
        $request->validate([
            'kategori' => 'required|string',
            'judul' => 'required|string',
            'file' => 'required|file|mimes:pdf,docx,xlsx,zip,rar,png,jpg|max:10240',
        ]);

        $fileName = time().'_'.$request->file->getClientOriginalName();
        $filePath = $request->file('file')->move(public_path('uploads/regulasi'), $fileName);


        Regulasi::create([
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'file_path' => $fileName,
        ]);

        return redirect()->route('admin.regulasi')->with('success', 'File berhasil disimpan!');
    }

    public function edit($id)
    {
        $regulasi = Regulasi::findOrFail($id);
        return view('admin.edit_regulasi', compact('regulasi'));
    }

    public function update(Request $request, $id) 
    {
        $regulasi = Regulasi::findOrFail($id);
        
        $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'file' => 'nullable|file|mimes:pdf,docx,xlsx,zip,rar,png,jpg|max:10240',
        ]);

        $regulasi->kategori = $request->kategori;
        $regulasi->judul = $request->judul;

        if ($request->hasFile('file')) {
            // handle file baru jika diupload
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('uploads/regulasi'), $fileName);
            $regulasi->file_path = $fileName;
        }

        $regulasi->save();

        return redirect()->route('admin.regulasi')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $regulasi = Regulasi::findOrFail($id);
        $regulasi->delete();
        return redirect()->route('admin.regulasi')->with('success', 'File berhasil dihapus');
    }

    public function downloadFile($fileName)
    {
        $filePath = public_path('uploads/regulasi/' . $fileName);

        if(file_exists($filePath)) {
            return response()->file($filePath);
        }
        abort(404);
    }
}
