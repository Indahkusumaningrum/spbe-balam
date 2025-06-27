// admin/berita_create.blade.php
<form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    Judul: <input type="text" name="judul"><br>
    Konten: <textarea name="konten"></textarea><br>
    Gambar: <input type="file" name="gambar"><br>
    <button type="submit">Simpan</button>
</form>