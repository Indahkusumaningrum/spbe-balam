<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Download</title>
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
            gap: 24px;
            flex-wrap: wrap;
            justify-content: start;
        }

        .berita-card {
            width: 300px;
            background: white;
            border-radius: 14px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .berita-img {
            height: 150px;
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

    <div class="nav-bar">
        <a href="{{ route('dashboardadmin') }}"><img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE"></a>        <div class="nav-container">
            <div class="manage-label">Manage</div>
            <nav class="nav-menu">
                <li><a href="#">Indikator SPBE</a></li>
                <li><a href="{{ route('profile') }}">Profile</a></li>
                <li><a href="#" class="active">Berita</a></li>
                <li><a href="{{ route('download') }}">Download</a></li>
                <li><a href="#">Galeri</a></li>
                <li><a href="#">Kontak</a></li>
            </nav>
        </div>
    </div>

    <div class="berita-container">
        <div class="tambah">
            <a href=# class="btn-add"><i class="fas fa-plus" style="font-size: 18px;"></i></a>
            <p class="p">Tambah Berita</p>
        </div>

        <div class="berita-grid">
            {{-- @foreach($beritas as $berita) --}}
            <div class="berita-card">
                <div class="berita-img"></div>
                <div class="berita-content">
                    {{-- <h3>{{ $berita->judul }}</h3> --}}
                    <h3>judul </h3>
                    <div class="berita-info">
                        <span class="tanggal">tanggal</span>
                        <a href=# class="btn-detail">Selengkapnya</a>
                    </div>
                </div>
            </div>
            {{-- @endforeach --}}
        </div>

        <div class="berita-grid">
            {{-- @foreach($beritas as $berita) --}}
            <div class="berita-card">
                <div class="berita-img"></div>
                <div class="berita-content">
                    {{-- <h3>{{ $berita->judul }}</h3> --}}
                    <h3>judul </h3>
                    <div class="berita-info">
                        <span class="tanggal">tanggal</span>
                        <a href=# class="btn-detail">Selengkapnya</a>
                    </div>
                </div>
            </div>
            {{-- @endforeach --}}
        </div>
    </div>

@endsection
</body>
</html>
