@extends('layouts.layout_admin')
@section('title', 'Manajemen Domain')

@section('content')
<h2>Tambah Domain</h2>
<form action="{{ route('admin.domain.store') }}" method="POST">
    @csrf
    <input type="text" name="nama" placeholder="Nama Domain" required>
    <button type="submit">Simpan</button>
</form>

<hr>

<h3>Daftar Domain</h3>
<ul>
    @foreach($domains as $domain)
        <li>{{ $domain->nama }}</li>
    @endforeach
</ul>

<a href="{{ route('admin.indikator.index') }}">Kembali</a>
@endsection
