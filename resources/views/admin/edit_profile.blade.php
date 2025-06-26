<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .profile-container {
            padding: 20px 50px;
        }

        .profile-header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
            box-sizing: border-box;
        }

        .profile-title {
            font-size: 28px;
            font-weight: bold;
            color: #001e74;
        }

        .profile-image-wrapper {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }

        .profile-image-label {
            font-weight: bold;
            color: #001e74;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .profile-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #001e74;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .form-container {
            max-width: 1300px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
        }

        .profile-textarea {
            width: 97%;
            padding: 16px;
            border-radius: 10px;
            border: 2px solid #c3bff1;
            background-color: #ffffff;
            font-size: 16px;
            resize: none;
            outline: none;
            color: #333;
        }

        .form-control {
            width: 100%;
            margin-top: 10px;
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
@section('title', 'Manage Profile')
@section('content')

    <div class="nav-bar">
        <a href="{{ route('dashboardadmin') }}"><img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE"></a> <div class="nav-container">
        <div class="manage-label">Manage</div>
            <nav class="nav-menu">
                <li><a href="#">Indikator SPBE</a></li>
                <li><a href="#" class="active">Profile</a></li>
                <li><a href="{{ route('berita') }}">Berita</a></li>
                <li><a href="{{ route('download') }}">Download</a></li>
                <li><a href="#">Galeri</a></li>
                <li><a href="#">Kontak</a></li>
            </nav>
        </div>
    </div>

     <div class="form-container">
        <h2>Form Mengedit Profile</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="profile-image-wrapper">
                <img src="{{ asset('image/tentang-saya.jpg') }}" alt="Gambar Tentang Saya" class="profile-image">
            </div>
            <textarea name="deskripsi" placeholder="Deskripsi" rows="5" class="profile-textarea" row="15" required></textarea>
            <input type="file" name="file" class="form-control" required>

            <div class="form-buttons">
                <button type="submit" class="btn btn-green">Simpan</button>
                <a href="{{ route('profile') }}" class="btn btn-red">Batal</a>
            </div>
        </form>
    </div>
@endsection
</body>
</html>
