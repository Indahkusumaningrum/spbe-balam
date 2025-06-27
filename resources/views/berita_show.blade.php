// user/berita_show.blade.php
<h2>{{ $berita->judul }}</h2>
<p>Penulis: {{ $berita->penulis }}</p>
@if($berita->gambar)
    <img src="{{ asset('uploads/beritas/' . $berita->gambar) }}" width="300">
@endif
<p>{{ $berita->konten }}</p>
