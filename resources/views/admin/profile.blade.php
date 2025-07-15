<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* Reusing styles from edit_profile for consistency */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
        }

        .main-container { /* Mengganti profile-container menjadi main-container */
            width: 90%;
            max-width: 900px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .profile-header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px; /* Spasi bawah */
            margin-bottom: 20px;
            border-bottom: 1px solid #eee; /* Garis pemisah */
        }

        .profile-title {
            font-size: 28px; /* Ukuran judul lebih besar */
            font-weight: 700;
            color: #001e74;
            position: relative;
            padding-bottom: 10px;
        }
        .profile-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 80px;
            height: 4px;
            background-color: #facc15;
            border-radius: 2px;
        }

        .profile-image-wrapper {
            margin-top: 20px;
            margin-bottom: 30px;
            text-align: center;
        }

        .profile-image {
            max-width: 100%;
            height: auto;
            border-radius: 12px; /* Sudut membulat */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Shadow gambar */
            border: 1px solid #e0e0e0;
        }

        .profile-section-title { /* Untuk Nama Instansi */
            font-size: 22px;
            font-weight: 600;
            color: #001e74;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        .profile-description-content { /* Untuk konten deskripsi dari TinyMCE */
            font-size: 16px;
            line-height: 1.7;
            color: #444;
            /* Pastikan gambar di dalam konten responsif */
            max-width: 100%;
            height: auto;
        }
        .profile-description-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin: 15px 0; /* Spasi vertikal untuk gambar */
        }

        .btn-edit-profile { /* Mengganti btn-edit */
            background-color: #3b82f6;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-edit-profile:hover {
            background-color: #001e74;
            transform: translateY(-2px);
        }

        /* Alert Messages (Consistent with other admin pages) */
        .alert {
            padding: 18px 25px;
            margin-bottom: 25px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            line-height: 1.5;
            border: 1px solid;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border-color: #34d399;
        }

        .alert i {
            font-size: 20px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .main-container {
                width: 95%;
                padding: 25px;
                margin: 30px auto;
            }
            .profile-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            .profile-title {
                margin-bottom: 0;
            }
            .btn-edit-profile {
                width: 100%;
                justify-content: center;
            }
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

        <div class="profile-header">
            <h2 class="profile-title">Tentang SPBE</h2>
            <a href="{{ route('edit.profile') }}" class="btn-edit-profile">
                <i class="fas fa-pen"></i> Edit Tentang SPBE
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