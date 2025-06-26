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
            margin-top: 16px;
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

        .profile-description-wrapper {
            position: relative;
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

        .btn-edit {
            background-color: #3b82f6;
            color: white;
            padding: 6px 9px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            justify-content: flex-end;
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

    <div class="profile-container">
        <div class="profile-header">
            <h2 class="profile-title">Tentang Kami</h2>
            <a href="{{ route('profile.edit') }}" class="btn-edit"><i class="fas fa-pen"></i></a>
        </div>

        <div class="profile-image-wrapper">
            <img src="{{ asset('image/tentang-saya.jpg') }}" alt="Gambar Tentang Saya" class="profile-image">
        </div>

        <div class="profile-description-wrapper">
            <textarea placeholder="Deskripsi" class="profile-textarea" rows="15"></textarea>
        </div>
    </div>
@endsection
</body>
</html>
