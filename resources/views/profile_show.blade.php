<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>SPBE - Pemerintah Kota Bandar Lampung</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            color: #333;
        }

        .tentang-container {
            width: 1200px;
            margin: 60px auto;
            padding: 40px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .tentang-container h1 {
            font-size: 32px;
            color: #001e74;
            margin-bottom: 30px;
            border-bottom: 4px solid #facc15;
            display: inline-block;
            padding-bottom: 4px;
        }

        .tentang-container img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin-bottom: 20px;
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

@extends('layouts.layout_user')
@section('content')

    <div class="tentang-container">
        <h1>SPBE {{ $profile->nama_instansi }}</h1>

        @if($profile->gambar)
            <img src="{{ asset('uploads/profiles/' . $profile->gambar) }}" alt="Gambar Profil">
        @endif

        <p>{!! nl2br(e($profile->deskripsi)) !!}</p>
    </div>

@endsection

</body>
</html>
