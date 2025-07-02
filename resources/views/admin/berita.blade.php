<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Berita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .tambah {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .btn-add {
            background-color: #facc15;
            color: white;
            padding: 7px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-right: 7px;
        }

        .p {
            font-size: 18px;
            font-weight: bold;
            color: #001e74
        }

        .berita-container {
            padding: 40px 60px;
        }

        .berita-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn-tambah {
            background-color: #facc15;
            color: #001e74;
            font-weight: bold;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .berita-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 40px;
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
            margin-bottom: 20px;
        }

        .berita-img {
            height: 200px;
            background-color: #ccc;
            border-bottom: 1px solid #eee;
            border-top-left-radius: 14px;
            border-top-right-radius: 14px;
        }

        .berita-content {
            padding: 10px 20px 20px;
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
            font-size: 15px;
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

        .pagination {
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Manage Berita')
@section('content')

    <div class="berita-container">
        <div class="tambah">
            <a href="{{ route('admin.berita.create') }}" class="btn-add"><i class="fas fa-plus" style="font-size: 18px;"></i></a>
            <p class="p">Tambah Berita</p>
        </div>
        <div class="berita-grid">
            @foreach($beritas as $berita)
            <div class="berita-card">
                <div class="berita-img">
                    @if($berita->gambar)
                    <img src="{{ asset('uploads/beritas/' . $berita->gambar) }}" style="width:100%; height:200px; object-fit:cover;">
                    @endif
                </div>
                <div class="berita-content">
                    <h3>{{ $berita->judul }}</h3>
                    <div class="berita-info">
                        <span class="tanggal">{{ $berita->created_at->format('d-m-Y') }}</span>
                        <a href="{{ route('admin.berita.show', $berita->id_berita) }}" class="btn-detail">Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
</body>
</html>
