<h2>{{ $profile->nama_instansi }}</h2>

@if($profile->gambar)
    <img src="{{ asset('uploads/profiles/' . $profile->gambar) }}" width="300">
@endif

<p>{!! nl2br(e($profile->deskripsi)) !!}</p>
