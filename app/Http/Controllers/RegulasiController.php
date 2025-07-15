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
    public function index(Request $request) {
        $query = Download::query();
    
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
    
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }
    
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%$search%")
                  ->orWhere('content', 'LIKE', "%$search%");
            });
        }
    
        $regulations = $query->get();
    
        $years = Download::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        $categories = Download::select('category')->distinct()->pluck('category');
    
        return view('admin.regulasi', compact('regulations', 'categories', 'years'));
    }
    
    
    public function create() {
        $categories = Download::select('category')->distinct()->pluck('category');
        return view('admin.create_regulasi', compact('categories'));
    }

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

        return redirect()->route('admin.regulasi')->with('success', 'File berhasil disimpan!');
    }

    public function edit($id)
    {
        $regulasi = Download::findOrFail($id);
        $categories = Download::select('category')->distinct()->pluck('category');

        return view('admin.edit_regulasi', compact('regulasi', 'categories'));
    }

    public function update(Request $request, $id) 
    {
        $regulasi = Download::findOrFail($id);
        
        $request->validate([
            'category' => 'required',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'title' => 'required',
            'content' => 'required',
            'file' => 'nullable|file|mimes:pdf,docx,xlsx,zip,rar,png,jpg|max:10240',
        ]);

        $regulasi->category = $request->category;
        $regulasi->year = $request->year;
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
