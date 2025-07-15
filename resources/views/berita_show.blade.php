<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }}</title> {{-- Judul halaman lebih spesifik --}}
    <link rel="icon" href="{{ asset('asset/img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet"> {{-- Tambah font untuk body --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #001e74; /* Biru Tua */
            --secondary-color: #facc15; /* Kuning Cerah */
            --accent-color: #f59e0b; /* Orange */
            --text-dark: #333;
            --text-light: #555;
            --bg-light: #f9f9f9;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            background-color: var(--bg-light);
            line-height: 1.6;
            margin: 0;
        }

        .berita-wrapper {
            background-color: #ffffff;
            padding: 40px 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .berita-container {
            max-width: 900px; /* Lebarkan sedikit untuk konten berita */
            margin: 0 auto;
            padding: 0 20px; /* Padding samping untuk responsivitas */
        }

        .berita-header {
            text-align: left;
            margin-bottom: 30px;
        }

        .berita-header h1 {
            color: var(--primary-color);
            font-size: 2.5em; /* Ukuran judul lebih besar */
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 10px;
        }

        .berita-meta {
            font-size: 0.95em;
            color: var(--text-light);
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap; /* Untuk responsivitas */
            align-items: center;
            gap: 10px 20px; /* Spasi antar info meta */
        }

        .berita-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .berita-meta span i {
            color: var(--accent-color);
        }

        .berita-thumbnail {
            width: 100%;
            max-height: 450px; /* Batasi tinggi gambar utama */
            object-fit: cover; /* Pastikan gambar mengisi area tanpa distorsi */
            border-radius: 12px;
            margin: 30px 0;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .berita-body {
            font-family: 'Merriweather', serif; /* Font untuk readability konten */
            font-size: 1.1em; /* Ukuran font sedikit lebih besar */
            color: var(--text-dark);
            line-height: 1.8; /* Tinggi baris untuk readability */
            margin-bottom: 40px;
        }

        /* Styling untuk elemen HTML di dalam konten TinyMCE */
        .berita-body p {
            margin-bottom: 1.5em; /* Spasi antar paragraf */
        }

        .berita-body img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 2em auto; /* Pusatkan gambar dengan spasi vertikal */
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .berita-body h1, .berita-body h2, .berita-body h3, .berita-body h4, .berita-body h5, .berita-body h6 {
            color: var(--primary-color);
            margin-top: 2em;
            margin-bottom: 0.8em;
            line-height: 1.4;
        }

        .berita-body h2 { font-size: 1.8em; }
        .berita-body h3 { font-size: 1.5em; }

        .berita-body ul, .berita-body ol {
            margin-bottom: 1.5em;
            padding-left: 25px;
        }

        .berita-body li {
            margin-bottom: 0.5em;
        }

        .berita-body table {
            width: 100%;
            border-collapse: collapse;
            margin: 2em 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .berita-body table th, .berita-body table td {
            border: 1px solid #eee;
            padding: 12px 15px;
            text-align: left;
        }

        .berita-body table th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }

        .berita-body table tr:nth-child(even) {
            background-color: #f6f6f6;
        }

        .berita-body blockquote {
            border-left: 5px solid var(--accent-color);
            padding: 15px 20px;
            margin: 2em 0;
            background-color: #fff8eb;
            color: var(--text-dark);
            font-style: italic;
        }

        .back-button-section {
            text-align: center;
            padding-bottom: 40px;
        }

        .btn-kembali {
            display: inline-flex; /* Icon dan teks sejajar */
            align-items: center;
            gap: 8px;
            background-color: var(--primary-color);
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1em;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-kembali:hover {
            background-color: #002c9a; /* Warna hover sedikit lebih gelap */
            transform: translateY(-2px); /* Efek hover kecil */
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .berita-wrapper {
                padding: 30px 0;
            }

            .berita-container {
                padding: 0 15px;
            }

            .berita-header h1 {
                font-size: 2em;
            }

            .berita-meta {
                flex-direction: column; /* Meta info jadi kolom */
                align-items: flex-start;
            }

            .berita-body {
                font-size: 1em;
            }

            .btn-kembali {
                width: calc(100% - 40px); /* Lebarkan tombol */
                max-width: 300px;
                justify-content: center;
                margin: 0 auto;
            }
        }

        @media (max-width: 480px) {
            .berita-header h1 {
                font-size: 1.6em;
            }

            .berita-meta {
                font-size: 0.85em;
            }
        }
    </style>
</head>
<body>
@extends('layouts.layout_user')
@section('navbar', true)
@section('content')

    <div class="berita-wrapper">
        <div class="berita-container">
            <div class="berita-header">
                <h1>{{ $berita->judul }}</h1>
                <div class="berita-meta">
                    <span><i class="fas fa-calendar-alt"></i> {{ $berita->created_at->format('d M Y') }}</span>
                    <span><i class="fas fa-clock"></i> {{ $berita->created_at->format('H:i') }} WIB</span>
                    <span><i class="fas fa-pen-nib"></i> Penulis: {{ $berita->penulis }}</span>
                    @if($berita->created_at != $berita->updated_at)
                        <span><i class="fas fa-edit"></i> Terakhir diedit: {{ $berita->updated_at->diffForHumans() }}</span>
                    @endif
                    <span><i class="fas fa-eye"></i> Dibaca: {{ number_format($berita->pengunjung) }}</span> {{-- Tambahkan ikon untuk pengunjung --}}
                </div>
            </div>

            @if($berita->gambar)
                <img src="{{ asset('uploads/beritas/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="berita-thumbnail">
            @endif

            <div class="berita-body">
                {!! $berita->konten !!}
            </div>
        </div>
    </div>
    <br>

    <div class="back-button-section">
        <a href="{{ route('berita.index') }}" class="btn-kembali">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Berita
        </a>
    </div>

@endsection
</body>
</html>