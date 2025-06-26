<h2>Edit Profil Instansi</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Nama Instansi:</label>
    <input type="text" name="nama_instansi" value="{{ $profile->nama_instansi ?? '' }}" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" rows="5" required>{{ $profile->deskripsi ?? '' }}</textarea><br><br>

    <label>Gambar (Opsional):</label>
    <input type="file" name="gambar"><br><br>

    @if($profile && $profile->gambar)
        <img src="{{ asset('uploads/profiles/' . $profile->gambar) }}" width="200"><br><br>
    @endif

    <button type="submit">Simpan</button>
</form>
