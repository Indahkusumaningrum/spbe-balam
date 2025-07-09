<?php

namespace App\Http\Controllers;

use App\Models\Aspect;
use App\Models\Domain;
use Illuminate\Http\Request;

class AspectController extends Controller
{
    public function index()
    {
        $aspects = Aspect::with('domain')->get();
        $domains = Domain::all();

        return view('admin.aspect_index', compact('aspects', 'domains'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'domain_id' => 'required|exists:domains,id',
        ]);

        Aspect::create([
            'nama' => $request->nama,
            'domain_id' => $request->domain_id,
        ]);

        return back()->with('success', 'Aspek berhasil ditambahkan!');
    }
}
