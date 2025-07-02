<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Download;

class DownloadController extends Controller
{
    public function index() {
        $downloads = Download::all();
        return view('admin.download', compact('downloads'));
    }

    public function create() {
        return view('admin.create_download');
    }

    // public function edit() {
    //     return view('admin.edit_download');
    // }

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

        return redirect()->route('admin.download')->with('success', 'File berhasil disimpan!');
    }

    public function edit($id)
    {
        $download = Download::findOrFail($id);
        return view('admin.edit_download', compact('download'));
    }

    public function update(Request $request, $id) 
    {
        $download = Download::findOrFail($id);
        
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'content' => 'required',
            'file' => 'nullable|file|mimes:pdf,docx,xlsx,zip,rar,png,jpg|max:10240',
        ]);

        $download->category = $request->category;
        $download->title = $request->title;
        $download->content = $request->content;

        if ($request->hasFile('file')) {
            // handle file baru jika diupload
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('uploads/files'), $fileName);
            $download->file_path = $fileName;
        }

        $download->save();

        return redirect()->route('admin.download')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $download = Download::findOrFail($id);
        $download->delete();
        return redirect()->route('admin.download')->with('success', 'File berhasil dihapus');
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
