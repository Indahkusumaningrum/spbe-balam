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
            font-size: 24px;
            color: #001e74;
            margin-bottom: 30px;
            border-bottom: 4px solid #facc15;
            display: inline-block;
            padding-bottom: 4px;
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
            border-radius: 10px;
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

        .btn-edit {
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .btn-edit:hover {
            background-color: #001e74;
            color: white;
            transform: scale(1.05);
        }

    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Manage Profile')
@section('content')

    @if(session('success'))
        <div style="color: green; font-weight: bold; text-align:center;">
            {{ session('success') }}
        </div>
    @endif


    <div class="profile-container">
        <div class="profile-header">
            <h2 class="profile-title">Tentang Kami</h2>
            <a href="{{ route('edit.profile') }}" class="btn-edit"><i class="fas fa-pen"></i>
                Edit Tentang Kami
            </a>
        </div>

        <div class="profile-image-wrapper">
            @if($profile && $profile->gambar)
                <img src="{{ asset('uploads/profiles/' . $profile->gambar) }}" alt="Gambar Tentang Kami" class="profile-image">
            @else
                <img src="{{ asset('image/tentang-saya.jpg') }}" alt="Default Image" class="profile-image">
            @endif
        </div>

        <div class="profile-description-wrapper">
             <textarea placeholder="Deskripsi" class="profile-textarea" rows="15" readonly>{{ $profile->deskripsi ?? '' }}</textarea>
        </div>
    </div>
@endsection
</body>
</html>
