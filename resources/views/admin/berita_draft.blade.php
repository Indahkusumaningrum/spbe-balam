

// admin/berita_index.blade.php
@foreach($beritas as $berita)
    <h3>{{ $berita->judul }}</h3>
    @if($berita->gambar)
        <img src="{{ asset('uploads/beritas/' . $berita->gambar) }}" width="150">
    @endif
    <p>{{ Str::limit($berita->konten, 100) }}</p>
    <a href="{{ route('admin.berita.edit', $berita->id_berita) }}">Edit</a>
    <form action="{{ route('admin.berita.destroy', $berita->id_berita) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
@endforeach
<a href="{{ route('admin.berita.create') }}">Tambah Berita</a>