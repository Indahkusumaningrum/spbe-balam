<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Indikator</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .form-container {
            max-width: 80%; margin: 0 auto; padding: 40px; background-color: #fff; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); font-family: 'Poppins', sans-serif; }
        .form-container h2 { font-size: 24px; color: #001e74; margin-bottom: 25px; display: block; padding-bottom: 6px; text-align: center; }
        label { display: block; margin-top: 18px; font-weight: 600; color: #1e293b; margin-bottom: 8px; }
        input[type="text"], select,
        textarea { width: 96%; padding: 12px 16px; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 15px; transition: border-color 0.3s; }
        input:focus, select:focus, textarea:focus { border-color: #1e3a8a; outline: none; }
        textarea { resize: vertical; }
        
        .btn { display: inline-block; margin-top: 25px; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 15px; text-decoration: none; cursor: pointer;  transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease; }
        .btn:hover{ transform: translateY(-2px); }
        .btn-primary { background-color: green; color: white; border: none; }
        .btn-primary:hover { background-color: darkgreen }
        .btn-secondary { background-color: #e2e8f0; color: #1e293b; border: none; margin-left: 10px; }
        .btn-secondary:hover { background-color: #cbd5e1; }
    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', isset($indikator) ? 'Edit Indikator' : 'Tambah Indikator')

@section('content')
<div class="form-container">
    <h2>{{ isset($indikator) ? 'Edit' : 'Tambah' }} Indikator</h2>

    <form action="{{ isset($indikator) ? route('admin.indikator.update', $indikator->id) : route('admin.indikator.store', $tahun) }}" method="POST">
        @csrf
        @if(isset($indikator))
            @method('PUT')
        @endif

        <label>Domain:</label>
        <select name="domain_id" id="domainSelect" class="form-control" style="width: 100%;" required>
            <option value="">-- Pilih Domain --</option>
            @foreach($domains as $domain)
                <option value="{{ $domain->id }}" {{ isset($indikator) && $indikator->aspect->domain_id == $domain->id ? 'selected' : '' }}>{{ $domain->nama }}</option>
            @endforeach
        </select>

        <label>Aspek:</label>

        <input type="hidden" name="tahun_id" value="{{ $tahun->id }}">


        <select name="aspect_id" id="aspectSelect" class="form-control" style="width: 100%;" required>
            <option value="">-- Pilih Aspek --</option>
            @foreach($aspects as $aspect)
                <option value="{{ $aspect->id }}" {{ isset($indikator) && $indikator->aspect_id == $aspect->id ? 'selected' : '' }} data-domain="{{ $aspect->domain_id }}">{{ $aspect->nama }}</option>
            @endforeach
        </select>

        <label>Nama Indikator:</label>
        <input type="text" name="nama" value="{{ $indikator->nama ?? old('nama') }}" required>

        <label>Penjelasan:</label>
        <textarea name="penjelasan" rows="10" required>{{ $indikator->penjelasan ?? old('penjelasan') }}</textarea>

        <button type="submit" class="btn btn-primary">{{ isset($indikator) ? 'Update' : 'Simpan' }}</button>
        <a href="{{ route('admin.indikator.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
    // Filter aspek berdasarkan domain
    const domainSelect = document.getElementById('domainSelect');
    const aspectSelect = document.getElementById('aspectSelect');

    domainSelect.addEventListener('change', () => {
        const domainId = domainSelect.value;

        for (const option of aspectSelect.options) {
            option.style.display = option.dataset.domain === domainId ? 'block' : 'none';
        }

        aspectSelect.value = "";
    });
</script>
@endsection
</body>
</html>
