<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    public function index()
    {
        $evaluations = Evaluasi::all();
        return view('dashboard_user', compact('evaluations'));
    }

    public function adminIndex()
    {
        $evaluations = Evaluasi::all();
        return view('admin.evaluasi', compact('evaluations'));
    }

    public function create()
    {
        return view('admin.evaluasi_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'document' => 'nullable|mimes:pdf,doc,docx|max:10240'
        ]);

        $imageName = time().'_'.$request->image->getClientOriginalName();
        $request->image->move(public_path('uploads/evaluasi'), $imageName);

        $documentName = null;
        if($request->hasFile('document')) {
            $documentName = time().'_'.$request->document->getClientOriginalName(); // TAMBAHKAN time()
            $request->document->move(public_path('uploads/documents'), $documentName);
        }
        

        Evaluasi::create([
            'title' => $request->title,
            'image' => $imageName,
            'document' => $documentName
        ]);

        return redirect()->route('admin.evaluasi')->with('success', 'Data evaluasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $evaluation = Evaluasi::findOrFail($id);

        return view('admin.evaluasi_edit', compact('evaluation'));
    }

    public function update(Request $request, $id)
    {
        $evaluation = Evaluasi::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'document' => 'nullable|mimes:pdf,doc,docx|max:10240'
        ]);

        if($request->hasFile('image')) {

            if($evaluation->document && file_exists(public_path('uploads/documents/' . $evaluation->document))) {
                unlink(public_path('uploads/documents/' . $evaluation->document));
            }
            
            $imageName = time() .'_'. $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/evaluasi'), $imageName);
            $evaluation->image = $imageName;
        }

        if($request->hasFile('document')) {
            $documentName = time().'_'.$request->document->getClientOriginalName(); // TAMBAHKAN time()
            $request->document->move(public_path('uploads/documents'), $documentName);
            $evaluation->document = $documentName;
        }
        

        $evaluation->title = $request->title;
        $evaluation->save();

        return redirect()->route('admin.evaluasi.show', $evaluation->id)->with('success', 'Data evaluasi berhasil diperbarui');
    }


    public function show($id)
    {
        $evaluation = Evaluasi::findOrFail($id);

        return view('admin.detail_evaluasi', compact('evaluation'));
    }

    public function destroy($id)
    {
        $evaluation = Evaluasi::findOrFail($id);
        $evaluation->delete();

        return redirect()->route('admin.evaluasi')->with('success', 'Evaluasi berhasil dihapus!');
    }

    public function downloadFile($documentName)
    {
        $filePath = public_path('uploads/documents/' . $documentName);

        if(file_exists($filePath)) {
            return response()->file($filePath);
        }
        abort(404);
    }
}
