<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fff; color: #333; line-height: 1.6; } 
        .main-container { width: 90%; max-width: 1200px; margin: 0 auto; background-color: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); box-sizing: border-box; }
        .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px; }
        .header-section h1 { color: #001e74; font-size: 30px;  font-weight: 700; position: relative; padding-bottom: 12px; margin: 0; letter-spacing: 0.5px; }
        .header-section h1::after {
            content: ''; position: absolute; left: 50%;  transform: translateX(-50%);  bottom: 0; width: 80px; height: 5px;
            background: linear-gradient(to right, #facc15, #ff9a00); border-radius: 50px; box-shadow: 0 4px 10px rgba(250, 204, 21, 0.5); transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .header-section h1:hover::after { width: 100%;  left: 0;  transform: translateX(0);  box-shadow: 0 6px 20px rgba(250, 204, 21, 0.7); }
    
        .btn-edit-profile {
            background-color: #28a745; color: white; padding: 10px 18px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;
            font-weight: 600; font-size: 15px; transition: background-color 0.3s ease, transform 0.2s ease; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); white-space: nowrap; 
        }
        .btn-edit-profile i { margin-right: 8px; }
        .btn-edit-profile:hover { background-color: #218838; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); }

        .profile-image-wrapper { margin-top: 20px; margin-bottom: 30px; text-align: center; }
        .profile-image { max-width: 100%; height: auto; display: block; margin: 0 auto; border-radius: 12px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); border: 1px solid #e0e0e0; }
        .profile-section-title { font-size: 22px; font-weight: 600; color: #001e74; margin-top: 30px; margin-bottom: 15px; }
        .profile-description-content { font-size: 16px; line-height: 1.7; color: #444; word-wrap: break-word; }
        .profile-description-content img { max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin: 15px 0; display: block; }
        .profile-description-content p { margin-bottom: 1em; }

        .alert { padding: 18px 25px; margin-bottom: 25px; border-radius: 8px; font-size: 15px; font-weight: 500; display: flex; align-items: center; gap: 12px; line-height: 1.5; border: 1px solid; }
        .alert-success { background-color: #d1fae5; color: #065f46; border-color: #34d399; }
        .alert i { font-size: 20px; }

        @media (max-width: 768px) {
            .main-container { padding: 0 20px; margin: 30px auto; } 
            .header-section { flex-direction: row; justify-content: space-between; align-items: center; gap: 10px; }
            .header-section h1 { font-size: 24px; flex-basis: auto; white-space: nowrap; overflow: hidden;  text-overflow: ellipsis; }
            .header-section h1::after { left: 0;  transform: translateX(0%); }
            .btn-edit-profile { width: auto; flex-shrink: 0; padding: 8px 15px; font-size: 14px; }
            .profile-section-title { font-size: 20px; }
            .profile-description-content { font-size: 15px; }
            .alert { font-size: 14px; padding: 15px 20px; }
        }

        @media (max-width: 480px) {
            .main-container { padding: 20px; margin: 0 auto; } 
            .header-section { flex-direction: row; justify-content: space-between; align-items: center; gap: 8px; }
            .header-section h1 { font-size: 20px; }
            .header-section h1::after { width: 60px; }
            .btn-edit-profile { padding: 6px 10px; font-size: 13px; }
            .profile-section-title { font-size: 18px; margin-top: 20px; margin-bottom: 10px; }
        }
    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Manage Profile')
@section('content')

    <div class="main-container">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="header-section">
            <h1>Tentang SPBE</h1>
            <a href="{{ route('edit.profile') }}" class="btn-edit-profile">
                <i class="fas fa-pen"></i> Edit
            </a>
        </div>

        <div class="profile-image-wrapper">
            @if($profile && $profile->gambar)
                <img src="{{ asset('uploads/profiles/' . $profile->gambar) }}" alt="Gambar Tentang Kami" class="profile-image">
            @else
                <img src="{{ asset('image/tentang-saya.jpg') }}" alt="Default Image" class="profile-image">
            @endif
        </div>

        <h3 class="profile-section-title">Nama Instansi:</h3>
        <p class="profile-description-content">{{ $profile->nama_instansi ?? 'Belum ada nama instansi.' }}</p>

        <h3 class="profile-section-title">Deskripsi:</h3>
        <div class="profile-description-content">
            {!! $profile->deskripsi ?? 'Belum ada deskripsi.' !!}
        </div>
    </div>
@endsection
</body>
</html>
