<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Download;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
        $query = Download::query();
    
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
    
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }
    
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('content', 'like', "%$search%");
            });
        }
    
        $categories = Download::whereNotNull('category')->select('category')->distinct()->pluck('category');
        $years = Download::whereNotNull('year')->select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
      
        $downloads = $query->get();
    
        return view('admin.download', compact('downloads', 'categories', 'years'));
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
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'title' => 'required|string',
            'content' => 'required',
            'file' => 'required|file|mimes:pdf,docx,xlsx,zip,rar,png,jpg|max:10240',
        ]);

        $fileName = time().'_'.$request->file->getClientOriginalName();
        $filePath = $request->file('file')->move(public_path('uploads/files'), $fileName);


        Download::create([
            'category' => $request->category,
            'year' => $request->year,
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
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'title' => 'required',
            'content' => 'required',
            'file' => 'nullable|file|mimes:pdf,docx,xlsx,zip,rar,png,jpg|max:10240',
        ]);

        $download->category = $request->category;
        $download->year = $request->year;
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
