// admin/berita_edit.blade.php
<form action="{{ route('admin.berita.update', $berita->id_berita) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    Judul: <input type="text" name="judul" value="{{ $berita->judul }}"><br>
    Konten: <textarea name="konten">{{ $berita->konten }}</textarea><br>
    Gambar: <input type="file" name="gambar"><br>
    @if($berita->gambar)
        <img src="{{ asset('uploads/beritas/' . $berita->gambar) }}" width="150">
    @endif
    <button type="submit">Update</button>
</form>