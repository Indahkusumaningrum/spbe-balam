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

    public function indikatorByTahun(Request $request, Tahun $tahun)
    {
        // Ambil semua domain untuk dropdown filter
        $domains = Domain::all();
        // Ambil semua aspek untuk filtering JavaScript
        $allAspects = Aspect::all();

        // Query dasar untuk indikator berdasarkan tahun
        $indikators = Indikator::whereHas('aspect', function($query) use ($tahun) {
            $query->where('tahun_id', $tahun->id);
        });

        // Terapkan filter berdasarkan request
        if ($request->filled('filter_domain')) {
            // Perbaikan di sini: tambahkan $request ke 'use'
            $indikators->whereHas('aspect.domain', function($query) use ($request) {
                $query->where('id', $request->filter_domain);
            });
        }

        if ($request->filled('filter_aspect')) {
            // Perbaikan di sini: tambahkan $request ke 'use'
            $indikators->where('aspect_id', $request->filter_aspect);
        }

        if ($request->filled('search_indikator')) {
            // Perbaikan di sini: tambahkan $request ke 'use'
            $indikators->where('nama', 'like', '%' . $request->search_indikator . '%');
        }

        $indikators = $indikators->get(); // Eksekusi query

        // Pastikan Anda melewatkan semua variabel yang dibutuhkan ke view
        return view('admin.indikator_per_tahun', compact('tahun', 'indikators', 'domains', 'allAspects'));
    }

    // Menampilkan halaman pemilihan tahun untuk user
public function userIndex(Request $request)
{
    $tahunList = Tahun::orderBy('tahun', 'asc')->get();
    $tahunTerpilih = $request->input('tahun');

    return view('indikator_show', compact('tahunList', 'tahunTerpilih'));
}

// Menampilkan indikator sesuai tahun yang dipilih user
public function userIndikatorByTahun(Request $request, Tahun $tahun)
{
    $domains = Domain::all();
    $allAspects = Aspect::all();

    $indikators = Indikator::whereHas('aspect', function($query) use ($tahun) {
        $query->where('tahun_id', $tahun->id);
    });

    // Filter domain, aspek, dan pencarian jika ada dari form user
    if ($request->filled('filter_domain')) {
        $indikators->whereHas('aspect.domain', function($query) use ($request) {
            $query->where('id', $request->filter_domain);
        });
    }

    if ($request->filled('filter_aspect')) {
        $indikators->where('aspect_id', $request->filter_aspect);
    }

    if ($request->filled('search_indikator')) {
        $indikators->where('nama', 'like', '%' . $request->search_indikator . '%');
    }

    $indikators = $indikators->get();

    return view('indikator_list_tahun', compact('tahun', 'indikators', 'domains', 'allAspects'));
}

}
