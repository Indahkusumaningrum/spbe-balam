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
            background-color: #fff; /* Warna latar lembut */
            color: #333;
        }
        .header-section { display: flex; justify-content: center; align-items: center; margin: 30px; flex-wrap: wrap; gap: 15px;}
        .header-section .title{ color: #001e74; font-size: 32px; font-weight: 700; position: relative;  margin: 30px; letter-spacing: 0.5px; text-align: center;}
        .header-section .title::after { content: ''; position: absolute; left: 50%; transform: translateX(-50%); bottom: 0; width: 160px; height: 5px; background: linear-gradient(to right, #facc15, #ff9a00); border-radius: 50px; box-shadow: 0 4px 10px rgba(250, 204, 21, 0.5); transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); }
        .header-section .title:hover::after { width: 100%; left: 0; transform: translateX(0); box-shadow: 0 6px 20px rgba(250, 204, 21, 0.7);}
        
/* 
        .header {
            padding: 60px 0 0;
            text-align: center;
            color: #001e74;
            font-size: 2rem;
            font-weight: 700;
            position: relative;
        } */

        /* .header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 20%;
            height: 4px;
            background: linear-gradient(90deg, #facc15, #ffd700);
            border-radius: 2px;
        } */

        .tentang-container {
            max-width: 100%;
            margin: 20px auto;
            padding: 40px 30px;
            border-radius: 12px;
            text-align: center;
        }

        .tentang-container img {
            max-width: 50%;
            height: auto;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            text-align: left;
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
    <div class="header-section">
        <p class="title">SPBE {{ $profile->nama_instansi }}</p>
    </div>
    <div class="tentang-container">
        @if($profile->gambar)
            <img src="{{ asset('uploads/profiles/' . $profile->gambar) }}" alt="Gambar Profil">
        @endif

        <p>{!! ($profile->deskripsi) !!}</p>
    </div>

@endsection

</body>
</html>
