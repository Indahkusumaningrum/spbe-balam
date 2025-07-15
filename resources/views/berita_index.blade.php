<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berita</title>
    <link rel="icon" href="{{ asset('asset/img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .berita-container {
            padding: 40px 60px;
        }

        h1 {
            font-size: 22px;
            color: #001e74;
            margin-bottom: 30px;
            border-bottom: 3px solid #facc15;
            display: inline-block;
            padding-bottom: 4px;
        }

        .berita-grid {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            justify-content: start;
        }

        .berita-card {
            width: calc((100% - 80px) / 3);
            background: white;
            border-radius: 14px;
            box-shadow: 5px 5px 20px rgba(0,0,0,0.2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            cursor: pointer;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .berita-card:hover {
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        .berita-img {
            height: 200px;
            background-color: #ccc;
            border-bottom: 1px solid #eee;
            border-top-left-radius: 14px;
            border-top-right-radius: 14px;
        }

        .berita-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .berita-content h3 {
            font-size: 16px;
            color: #001e74;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .berita-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .berita-info .tanggal {
            font-size: 14px;
            color: #facc15;
            font-weight: 600;
        }

        .btn-detail {
            background-color: #001e74;
            color: white;
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-detail:hover{
            transform: scale(1.02);
        }
    </style>
</head>
<body>

@section('navbar', true)
@extends('layouts.layout_user')
@section('content')

    <div class="berita-container">
        <h1>Berita </h1>
        <div class="berita-grid">
            @foreach($beritas as $berita)
            <a href="{{ route('berita.show', $berita->id_berita) }}" class="berita-card">
                <div class="berita-img">
                    @if($berita->gambar)
                    <img src="{{ asset('uploads/beritas/' . $berita->gambar) }}" style="width:100%; height:200px; object-fit:cover;">
                    @endif
                </div>
                <div class="berita-content">
                    <h3>{{ $berita->judul }}</h3>
                    <div class="berita-info">
                        <span class="tanggal">{{ $berita->updated_at->diffForHumans() }}</span>
                        <span class="btn-detail">Selengkapnya</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection
</body>
</html>
