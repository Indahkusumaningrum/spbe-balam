<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Download;

class DownloadController extends Controller
{
    public function index() {
        $downloads = Download::all();
        return view('admin.download.index', compact('downloads'));
    }

    public function create() {
        return view('admin.create_download');
    }

    public function store(Request $request) {
        $request->validate([
            'category' => 'required|string',
            'title' => 'required|string',
            'content' => 'required|string',
            'file' => 'required|file|max:102400',
        ]);

        $fileName = time().'_'.$request->file->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

        Download::create([
            'category' => $request->category,
            'title' => $request->title,
            'content' => $request->content,
            'file_path' => '/storage/' . $filePath,
        ]);

        return redirect()->route('download.index')->with('success', 'File berhasil ditambahkan!');
    }
}
