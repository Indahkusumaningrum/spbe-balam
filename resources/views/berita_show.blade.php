<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    .berita-container {
        padding: 60px 40px;
        max-width: 85%;
        margin: 0 auto;
    }

    .berita-container h2 {
        color: #001e74;
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .berita-container p {
        font-size: 16px;
        line-height: 1.6;
    }

    .berita-container img {
        width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 20px 0;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .berita-container .berita-date {
        font-size: 16px;
        color: #f59e0b;
        font-weight: 600;
    }

    .berita-body {
        font-size: 18px;
        color: #333;
        line-height: 1.6;
    }

    .btn-kembali {
        display: inline-block;
        margin-top: 24px;
        margin-left: 110px;
        background-color: #001e74;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    .btn-kembali:hover {
        background-color: #007bff;
    }

    </style>
</head>
<body>
@extends('layouts.layout_user')
@section('content')

    <div class="berita-container">
        <h2>{{ $berita->judul }}</h2>
        <div class="berita-date">
            {{ $berita->created_at->format('d M Y') }} | {{ $berita->created_at->format('H:i') }}
        </div>
        <p>Penulis: {{ $berita->penulis }}</p>
        @if($berita->gambar)
            <img src="{{ asset('uploads/beritas/' . $berita->gambar) }}" width="300">
        @endif
        <p class="berita-body">{!! nl2br(e($berita->konten)) !!}</p>
    </div>

    <a href="{{ route('berita.index') }}" class="btn-kembali">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

@endsection
</body>
</html>
