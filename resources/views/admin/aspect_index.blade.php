@extends('layouts.layout_admin')
@section('title', 'Manajemen Aspek')

@section('content')
<h2>Tambah Aspek</h2>
<form action="{{ route('admin.aspect.store') }}" method="POST">
    @csrf
    <label>Nama Aspek:</label>
    <input type="text" name="nama" required>

    <label>Pilih Domain:</label>
    <select name="domain_id" required>
        <option value="">-- Pilih Domain --</option>
        @foreach($domains as $domain)
            <option value="{{ $domain->id }}">{{ $domain->nama }}</option>
        @endforeach
    </select>

    <button type="submit">Simpan</button>
</form>

<hr>

<h3>Daftar Aspek</h3>
<ul>
    @foreach($aspects as $aspect)
        <li>{{ $aspect->nama }} (Domain: {{ $aspect->domain->nama }})</li>
    @endforeach
</ul>
@endsection
