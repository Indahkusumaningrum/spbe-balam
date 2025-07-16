<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Berita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .form-container { max-width: 1200px; margin: 0 auto; background: white; padding: 40px; border-radius: 14px; box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
        h2 { text-align: center; color: #001e74; font-weight: bold; margin-bottom: 30px; }
        .form-label { display: block; font-size: 17px; font-weight: 600; margin-bottom: 8px; color: #001e74; text-align: left; }
        input[type="text"], input[type="file"], textarea { width: 98%; padding: 12px 15px; border: 1px solid #ccc; border-radius: 8px; font-size: 16px; margin-bottom: 20px; transition: all 0.3s ease; }
        input[type="text"]:focus,
        textarea:focus { outline: none; border-color: #facc15; box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.2); }
        textarea { min-height: 150px; resize: vertical; }
        .form-buttons { display: flex; justify-content: flex-end; gap: 10px; }
        
        .btn { padding: 10px 25px; border-radius: 8px; font-weight: bold; border: none; cursor: pointer; font-size: 16px; }
        .btn-green { background-color: green; color: white; }
        .btn-red { background-color: red; color: white; text-decoration: none; display: inline-block; }
        .btn-green:hover{ background-color: darkgreen; }
        .btn-red:hover{ background-color: darkred }

        .gambar { margin-top: 10px; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 30%; }
    </style>

</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Manage Evaluasi')
@section('content')

    <div class="form-container">
        <h2>Mengedit Hasil Evaluasi SPBE</h2>
        <form action="{{ route('admin.evaluasi.update', $evaluation->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label class="form-label">Judul:</label>
            <input type="text" name="title" value="{{ $evaluation->title }}">

            
            <label class="form-label">Gambar:</label>
            <input type="file" name="image">

            <label> Gambar saat ini:</label> <br>
            @if($evaluation->image) 
                <img class="gambar" src="{{ asset('uploads/evaluasi/' . $evaluation->image) }}" width="150">
            @endif

            <label class="form-label" style="margin-top:20px">Dokumen Pendukung:</label>
            <input type="file" name="document">

            <label> Dokumen saat ini:</label>

            @if ($evaluation->document)
                <div style="margin-bottom: 10px;">
                    <a href="{{ route('admin.evaluasi.file', $evaluation->document) }}" target="_blank" class="btn-download">Lihat File</a>
                    <p style="font-style: italic; font-size: 14px;">{{ $evaluation->document }}</p>
                </div>
            @endif

            <div class="form-buttons">
                <button type="submit" class="btn btn-green">Simpan</button>
                <a href="{{ route('admin.evaluasi.show', $evaluation->id) }}" class="btn btn-red">Batal</a>
            </div>
        </form>
    </div>
@endsection
</body>
</html>
