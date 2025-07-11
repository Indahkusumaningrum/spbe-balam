<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Aspect;
use App\Models\Domain;
use App\Models\Tahun;

use Illuminate\Http\Request;

class IndikatorController extends Controller
{
    public function index(Request $request)
    {
        $tahunList = \App\Models\Tahun::orderBy('tahun', 'asc')->get();
        $tahunTerpilih = $request->input('tahun');

        return view('admin.indikator_index', compact('tahunList', 'tahunTerpilih'));
    }

    public function publicIndex(Request $request)
    {
        $domains = Domain::all();

        // Filter jika ada domain_id
        $query = Indikator::with('aspect.domain');

        if ($request->filled('domain_id')) {
            $query->whereHas('aspect.domain', function ($q) use ($request) {
                $q->where('id', $request->domain_id);
            });
        }

        $indikators = $query->get();

        return view('indikator_list', compact('indikators', 'domains'));
    }


    public function create($tahun_id)
    {
        $tahun = Tahun::findOrFail($tahun_id);
        $domains = Domain::all();
        $aspects = Aspect::all();
        return view('admin.indikator_form', compact('tahun', 'domains', 'aspects'));
    }

    public function store(Request $request, $tahun)
    {
        $request->validate([
            'aspect_id' => 'required|exists:aspects,id',
            'nama' => 'required|string|max:255',
            'penjelasan' => 'required|string',
        ]);

        $indikator = new Indikator();
        $indikator->tahun_id = $tahun;
        $indikator->aspect_id = $request->aspect_id;
        $indikator->nama = $request->nama;
        $indikator->penjelasan = $request->penjelasan;
        $indikator->save();

        return redirect()->route('admin.indikator.tahun', $tahun)->with('success', 'Indikator berhasil ditambahkan.');
    }


    

    public function edit($id)
    {
        $indikator = Indikator::findOrFail($id);
        $domains = Domain::all();
        $aspects = Aspect::all();
        return view('admin.indikator_edit', compact('indikator', 'domains', 'aspects'));
    }

    // Di dalam AdminIndikatorController.php

    public function update(Request $request, $id)
    {
        $indikator = Indikator::findOrFail($id);

        $validatedData = $request->validate([
            'aspect_id' => 'required|exists:aspects,id',
            'nama' => 'required|string|max:255',
            'penjelasan' => 'required|string',
            // Hapus 'tahun_id' kalau memang tidak dipakai
        ]);

        $indikator->update($validatedData);

        // Ambil tahun dari relasi yang benar
        $tahunId = $indikator->aspect->domain->tahun_id ?? null;

        return redirect()->route('admin.indikator.tahun', $indikator->tahun_id)
        ->with('success', 'Indikator berhasil diperbarui.');

    }


    public function destroy($id)
    {
        $indikator = Indikator::findOrFail($id);
        $indikator->delete();

        return redirect()->route('admin.indikator.tahun', $indikator->tahun_id)->with('success', 'Indikator berhasil dihapus.');
    }

    public function indikatorByTahun($tahun_id)
    {
        $tahun = Tahun::findOrFail($tahun_id);
        $indikators = Indikator::with('aspect.domain')->where('tahun_id', $tahun_id)->get();

        return view('admin.indikator_per_tahun', compact('tahun', 'indikators'));
    }

}
