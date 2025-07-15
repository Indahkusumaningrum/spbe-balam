<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBeritaController extends Controller
{
    public function index()
    {
        $initialLimit = 9;
        $beritas = Berita::orderBy('updated_at', 'desc')
        // ->orderBy('id_berita', 'desc')
        ->take($initialLimit)
        ->get();

        $totalBeritaCount = Berita::count();
        return view('admin.berita', compact('beritas', 'totalBeritaCount', 'initialLimit'));
    }

    public function create()
    {
        return view('admin.berita_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filename = null;
        if ($request->hasFile('gambar'))
        {
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/beritas'), $filename);
        }

        Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $filename,
            'penulis' => Auth::check() ? Auth::user()->name : 'Admin',
        ]);

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita_edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filename = $berita->gambar;
        if ($request->hasFile('gambar')) {
            if ($berita->gambar && file_exists(public_path('uploads/beritas/' . $berita->gambar))) {
                unlink(public_path('uploads/beritas/' . $berita->gambar));
            }
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/beritas'), $filename);
        }

        $berita->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $filename,
        ]);

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar && file_exists(public_path('uploads/beritas/' . $berita->gambar))) {
            unlink(public_path('uploads/beritas/' . $berita->gambar));
        }
        $berita->delete();
        return redirect()->route('admin.berita')->with('success', 'Berita berhasil dihapus');
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->increment('pengunjung');
        return view('admin.detail_berita', compact('berita'));
    }

    public function uploadImageTinyMCE(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $filename = str_replace([' ', '/', '\\'], '_', $filename);

            $path = public_path('uploads/tinymce');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $image->move($path, $filename);

            $imageUrl = trim(url('uploads/tinymce/' . $filename));

            return response()->json(['location' => $imageUrl]);
        }

        return response()->json(['error' => 'File not found'], 400);
    }

// ...
    public function loadMoreBerita(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = 6;

        $query = Berita::orderBy('updated_at', 'desc');
                        // ->orderBy('id_berita', 'desc');

        $beritas = $query->skip($offset)
                        ->take($limit)
                        ->get();

        // Hitung total berita lagi di sini jika ada kemungkinan perubahan data.
        // Atau, lebih baik, hitung total_count sekali di awal dan gunakan itu
        // jika Anda yakin tidak ada perubahan data di antara request.
        $totalActualBeritaCount = Berita::count(); // <-- Hitung ulang untuk hasMore yang akurat

        $html = '';
        foreach ($beritas as $berita) {
            $html .= '
            <div class="berita-card">
                <div class="berita-img">
                    ';
            if ($berita->gambar) {
                $html .= '<img src="' . asset('uploads/beritas/' . $berita->gambar) . '" alt="Gambar Berita">';
            }
            $html .= '
                </div>
                <div class="berita-content">
                    <h3>' . htmlspecialchars($berita->judul) . '</h3>
                    <div class="berita-info">
                        <span class="tanggal">' . $berita->updated_at->diffForHumans() . '</span>
                        <div class="btn-action-group">
                            <a href="' . route('admin.berita.show', $berita->id_berita) . '" class="btn-detail" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="' . route('admin.berita.edit', $berita->id_berita) . '" class="btn-detail btn-edit" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="' . route('admin.berita.destroy', $berita->id_berita) . '" method="POST" onsubmit="return confirm(\'Yakin ingin menghapus berita ini?\')" style="display:inline;">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn-detail btn-delete" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }

        return response()->json([
            'html' => $html,
            'hasMore' => ($totalActualBeritaCount > ($offset + $limit)) // Gunakan hitungan terbaru
        ]);
    }

}
