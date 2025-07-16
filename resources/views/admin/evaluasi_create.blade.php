<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Berita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .berita-container { width: 80%; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); }
        .berita-container h1 {color: #001e74; font-size: 28px; font-weight: 700; margin-bottom: 30px; text-align: center; }
        label { font-weight: 600; display: block; color: #333; }
        input[type="text"], textarea, input[type="file"] { width: 100%; padding: 12px; margin-top: -15px; border: 1px solid #ccc; border-radius: 8px; font-size: 16px; margin-bottom: 20px; box-sizing: border-box; }
        textarea { resize: vertical; }

        button[type="submit"] { background-color: green; color: #fff; padding: 12px 24px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; transition: background-color 0.3s ease; }
        button[type="submit"]:hover { background-color: darkgreen; }
        .btn-kembali { background-color: #ccc; color: #000; padding: 10px 24px; border: none; border-radius: 8px; font-size: 16px; text-decoration: none; display: inline-block; text-align: center; transition: background-color 0.3s ease; }
        .btn-kembali:hover { background-color: #bbb; }
    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Manage Evaluasi')
@section('content')

    <div class="berita-container">
        <h1>Tambah Hasil Evaluasi</h1>

        <form action="{{ route('admin.evaluasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="title">Judul:</label><br>
                <input type="text" name="title" id="title" style="width: 100%;">
            </div>


            <div style="margin-bottom: 15px;">
                <label for="image">Gambar:</label><br>
                <input type="file" name="image" id="image">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="document">Dokumen Pendukung:</label><br>
                <input type="file" name="document" accept=".pdf,.docx,.xlsx,.zip,.rar,.png,.jpg" class="form-control" required>
            </div>  

            <button type="submit">Simpan</button>
            <a href="{{ route('admin.evaluasi') }}" class="btn-kembali">Batal</a>
        </form>
    </div>

@endsection

</body>
</html>
