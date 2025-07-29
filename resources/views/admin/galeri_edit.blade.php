<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Galeri</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .galeri-container {
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .galeri-container h1 {
            color: #001e74;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        img.preview {
            width: 100%;
            max-width: 400px;
            height: auto;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        button[type="submit"] {
            background-color: green;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #006400;
        }

        .btn-kembali {
            background-color: #ccc;
            color: #000;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .btn-kembali:hover {
            background-color: #bbb;
        }

        .required-star {
            color: red;
            margin-left: 4px;
        }
    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Edit Galeri')
@section('content')

<div class="galeri-container">
    <h1>Edit Foto Galeri</h1>

    <form action="{{ route('admin.galeri.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Judul Foto:<span class="required-star">*</span></label>
            <input type="text" name="title" id="title" value="{{ $gallery->title }}" required>
        </div>

        <div>
            <label>Foto Saat Ini:</label><br>
            @if ($gallery->image_path)
                <img src="{{ asset('uploads/gallery/' . $gallery->image_path) }}" alt="Foto Galeri" class="preview">
            @else
                <p style="font-style: italic; color: #666;">Belum ada foto</p>
            @endif
        </div>

        <div>
            <label for="image">Ganti Foto (opsional):</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit">Simpan Perubahan</button>
            <a href="{{ route('admin.galeri') }}" class="btn-kembali">Batal</a>
        </div>
    </form>
</div>

@endsection
</body>
</html>
