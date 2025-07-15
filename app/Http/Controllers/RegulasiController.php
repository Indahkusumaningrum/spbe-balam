<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Download;

class RegulasiController extends Controller
{

    //USER
       public function indexUser()
    {
        $regulations = Download::all()->groupBy('category');
        return view('regulasi_list', compact('regulations'));
    }

    //ADMIN
    public function index() {
        $regulations = Download::all();
        return view('admin.regulasi', compact('regulations'));
    }

    public function create() {
        return view('admin.create_regulasi');
    }

    public function store(Request $request) {
        $request->validate([
            'category' => 'required|string',
            'title' => 'required|string',
            'content' => 'required',
            'file' => 'required|file|mimes:pdf,docx,xlsx,zip,rar,png,jpg|max:10240',
        ]);

        $fileName = time().'_'.$request->file->getClientOriginalName();
        $filePath = $request->file('file')->move(public_path('uploads/files'), $fileName);


        Download::create([
            'category' => $request->category,
            'title' => $request->title,
            'content' => $request->content,
            'file_path' => $fileName,
        ]);

        return redirect()->route('admin.regulasi')->with('success', 'File berhasil disimpan!');
    }

    public function edit($id)
    {
        $regulasi = Download::findOrFail($id);
        return view('admin.edit_regulasi', compact('regulasi'));
    }

    public function update(Request $request, $id) 
    {
        $regulasi = Download::findOrFail($id);
        
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'content' => 'required',
            'file' => 'nullable|file|mimes:pdf,docx,xlsx,zip,rar,png,jpg|max:10240',
        ]);

        $regulasi->category = $request->category;
        $regulasi->title = $request->title;
        $regulasi->content = $request->content;


        if ($request->hasFile('file')) {
            // handle file baru jika diupload
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('uploads/files'), $fileName);
            $regulasi->file_path = $fileName;
        }

        $regulasi->save();

        return redirect()->route('admin.regulasi')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $regulasi = Download::findOrFail($id);
        $regulasi->delete();
        return redirect()->route('admin.regulasi')->with('success', 'File berhasil dihapus');
    }

    public function downloadFile($fileName)
    {
        $filePath = public_path('uploads/files/' . $fileName);

        if(file_exists($filePath)) {
            return response()->file($filePath);
        }
        abort(404);
    }
}
