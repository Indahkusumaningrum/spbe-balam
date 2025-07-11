<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('asset/img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>SPBE - Pemerintah Kota Bandar Lampung</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa; /* Warna latar lembut */
            color: #333;
        }

        .header {
            padding: 60px 0 0;
            text-align: center;
            color: #001e74;
            font-size: 2rem;
            font-weight: 700;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 20%;
            height: 4px;
            background: linear-gradient(90deg, #facc15, #ffd700);
            border-radius: 2px;
        }

        .tentang-container {
            max-width: 100%;
            margin: 20px auto;
            padding: 40px 30px;
            border-radius: 12px;
            text-align: center;
        }

        .tentang-container img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .tentang-container p {
            font-size: 18px;
            line-height: 1.8;
            color: #444;
            text-align: justify;
        }
    </style>
</head>
<body>
@section('navbar', true)
@extends('layouts.layout_user')

@section('content')
    <p class="header">SPBE {{ $profile->nama_instansi }}</p>
    <div class="tentang-container">
        @if($profile->gambar)
            <img src="{{ asset('uploads/profiles/' . $profile->gambar) }}" alt="Gambar Profil">
        @endif

        <p>{!! nl2br(e($profile->deskripsi)) !!}</p>
    </div>

@endsection

</body>
</html>
