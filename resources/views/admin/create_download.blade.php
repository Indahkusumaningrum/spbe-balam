<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah File</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .form-container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #001e74;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .form-control {
            width: 100%;
            margin-bottom: 20px;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
            font-size: 16px;
        }

        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-green {
            background-color: green;
            color: white;
        }

        .btn-red {
            background-color: red;
            color: white;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Manage Download')
@section('content')

    <div class="nav-bar">
        <a href="{{ route('dashboardadmin') }}"><img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE"></a>        <div class="nav-container">
            <div class="manage-label">Manage</div>
            <nav class="nav-menu">
                <li><a href="#">Indikator SPBE</a></li>
                <li><a href="{{ route('profile') }}">Profile</a></li>
                <li><a href="{{ route('admin.berita') }}">Berita</a></li>
                <li><a href="{{ route('download') }}" class="active">Download</a></li>
                <li><a href="#">Galeri</a></li>
                <li><a href="#">Kontak</a></li>
            </nav>
        </div>
    </div>
    <div class="form-container">
        <h2>Form Menambah File Baru</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="category" placeholder="Category" class="form-control" required>
            <input type="text" name="title" placeholder="Title" class="form-control" required>
            <textarea name="content" placeholder="Content" rows="5" class="form-control" required></textarea>
            <input type="file" name="file" class="form-control" required>

            <div class="form-buttons">
                <button type="submit" class="btn btn-green">Simpan</button>
                <a href="{{ route('download') }}" class="btn btn-red">Batal</a>
            </div>
        </form>
    </div>
@endsection
</body>
</html>
