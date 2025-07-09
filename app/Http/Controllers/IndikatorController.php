<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Aspect;
use App\Models\Domain;

use Illuminate\Http\Request;

class IndikatorController extends Controller
{
    public function index()
    {
        $indikators = Indikator::with('aspect.domain')->get();
        return view('admin.indikator_index', compact('indikators'));
    }

    public function create()
    {
        $domains = Domain::all();
        $aspects = Aspect::all();
        return view('admin.indikator_form', compact('domains', 'aspects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'domain_id' => 'required|exists:domains,id',
            'aspect_id' => 'required|exists:aspects,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        Indikator::create($request->all());

        return redirect()->route('indikator.index')->with('success', 'Indikator berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $indikator = Indikator::findOrFail($id);
        $domains = Domain::all();
        $aspects = Aspect::all();
        return view('admin.indikator.edit', compact('indikator', 'domains'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'domain_id' => 'required|exists:domains,id',
            'aspect_id' => 'required|exists:aspects,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $indikator = Indikator::findOrFail($id);
        $indikator->update($request->all());

        return redirect()->route('admin.indikator.index')->with('success', 'Indikator berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $indikator = Indikator::findOrFail($id);
        $indikator->delete();

        return redirect()->route('admin.indikator.index')->with('success', 'Indikator berhasil dihapus.');
    }

}
