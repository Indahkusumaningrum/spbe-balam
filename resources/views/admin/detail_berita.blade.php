<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Detail Berita: {{ $berita->judul }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #001e74; /* Biru Tua */
            --secondary-color: #facc15; /* Kuning Cerah */
            --accent-color: #f59e0b; /* Orange */
            --text-dark: #333;
            --text-light: #555;
            --bg-light: #f9f9f9;
            --blue-action: #3b82f6; /* Warna biru untuk aksi */
            --red-action: #dc2626; /* Warna merah untuk delete */
            --green-action: #22c55e; /* Contoh warna hijau */
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            background-color: var(--bg-light);
            line-height: 1.6;
            margin: 0;
        }

        #main-content-wrapper {
            padding: 20px 40px;
        }

        .berita-wrapper {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            max-width: 900px;
            margin: 0 auto 40px auto;
        }

        .berita-actions-top {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-bottom: 20px;
        }

        /* --- PERUBAHAN UTAMA DI SINI UNTUK MENYAMAKAN UKURAN --- */
        .berita-actions-top .btn-action,
        .berita-actions-top form .btn-action {
            /* Properti dasar yang harus sama */
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center; /* Untuk perataan vertikal konten */
            justify-content: center; /* Untuk perataan horizontal konten */
            gap: 6px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            border: none;
            white-space: nowrap;
            box-sizing: border-box;

            /* **Tambahan untuk menyamakan ukuran dan perataan:** */
            height: 40px; /* Atur tinggi eksplisit yang sama */
            line-height: 1; /* Reset line-height untuk konsistensi */
            vertical-align: middle; /* Pastikan elemen sejajar secara vertikal */
        }

        .berita-actions-top .btn-action {
            background-color: var(--blue-action);
            color: white;
        }

        .berita-actions-top .btn-delete {
            background-color: var(--red-action);
            color: white;
        }

        .berita-actions-top .btn-action:hover {
            opacity: 0.9;
        }
        /* --- AKHIR PERUBAHAN UTAMA --- */

        .berita-img-container {
            margin-bottom: 30px;
        }

        .berita-img {
            width: 100%;
            max-height: 450px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .berita-header {
            margin-bottom: 25px;
        }

        .berita-header h1 {
            color: var(--primary-color);
            font-size: 2.2em;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 10px;
        }

        .berita-meta {
            font-size: 0.9em;
            color: var(--text-light);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px 15px;
        }

        .berita-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .berita-meta span i {
            color: var(--accent-color);
        }

        .berita-body {
            font-family: 'Merriweather', serif;
            font-size: 1.05em;
            color: var(--text-dark);
            line-height: 1.7;
            margin-top: 30px;
        }

        .berita-body p {
            margin-bottom: 1.2em;
        }

        .berita-body img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 1.5em auto;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .berita-body h1, .berita-body h2, .berita-body h3, .berita-body h4, .berita-body h5, .berita-body h6 {
            color: var(--primary-color);
            margin-top: 1.8em;
            margin-bottom: 0.7em;
            line-height: 1.3;
        }

        .berita-body h2 { font-size: 1.6em; }
        .berita-body h3 { font-size: 1.4em; }

        .berita-body ul, .berita-body ol {
            margin-bottom: 1.2em;
            padding-left: 25px;
        }

        .berita-body li {
            margin-bottom: 0.4em;
        }

        .berita-body table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5em 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .berita-body table th, .berita-body table td {
            border: 1px solid #eee;
            padding: 10px 12px;
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
            margin: 1.8em 0;
            background-color: #fff8eb;
            color: var(--text-dark);
            font-style: italic;
        }

        .back-button-section {
            text-align: left;
            padding-left: 60px;
            padding-bottom: 40px;
        }

        .btn-kembali {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95em;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-kembali:hover {
            background-color: #002c9a;
            transform: translateY(-2px);
        }

        @media (max-width: 992px) {
            .berita-wrapper {
                margin: 0 20px 40px 20px;
                padding: 30px;
            }
            .back-button-section {
                padding-left: 20px;
            }
        }

        @media (max-width: 768px) {
            .berita-wrapper {
                padding: 20px;
            }
            .berita-header h1 {
                font-size: 1.8em;
            }
            .berita-meta {
                flex-direction: column;
                align-items: flex-start;
            }
            .berita-body {
                font-size: 1em;
            }
            .berita-actions-top {
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 20px;
            }
            .btn-kembali {
                width: calc(100% - 40px);
                justify-content: center;
                margin: 0 auto;
            }
            .back-button-section {
                padding-left: 0;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .berita-header h1 {
                font-size: 1.5em;
            }
            .berita-meta {
                font-size: 0.8em;
            }
            .berita-actions-top .btn-action {
                padding: 8px 12px;
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Detail Berita')
@section('content')

    <div class="berita-wrapper">
        <div class="berita-actions-top">
            <a href="{{ route('admin.berita.edit', $berita->id_berita) }}" class="btn-action">
                <i class="fas fa-edit"></i> Edit Berita
            </a>
            <form action="{{ route('admin.berita.destroy', $berita->id_berita) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-action btn-delete">
                    <i class="fas fa-trash-alt"></i> Hapus Berita
                </button>
            </form>
        </div>

        @if($berita->gambar)
            <div class="berita-img-container">
                <img src="{{ asset('uploads/beritas/' . $berita->gambar) }}" alt="Gambar Utama Berita" class="berita-img">
            </div>
        @endif

        <div class="berita-header">
            <h1>{{ $berita->judul }}</h1>
            <div class="berita-meta">
                <span><i class="fas fa-calendar-alt"></i> Dipublikasikan: {{ $berita->created_at->format('d M Y') }}</span>
                <span><i class="fas fa-clock"></i> Pukul: {{ $berita->created_at->format('H:i') }} WIB</span>
                <span><i class="fas fa-pen-nib"></i> Penulis: {{ $berita->penulis }}</span>
                @if($berita->created_at != $berita->updated_at)
                    <span><i class="fas fa-edit"></i> Terakhir diedit: {{ $berita->updated_at->diffForHumans() }}</span>
                @endif
                <span><i class="fas fa-eye"></i> Dibaca: {{ number_format($berita->pengunjung) }} kali</span>
            </div>
        </div>

        <div class="berita-body">
            {!! $berita->konten !!}
        </div>
    </div>

    <div class="back-button-section">
        <a href="{{ route('admin.berita') }}" class="btn-kembali">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Berita
        </a>
    </div>

@endsection

</body>
</html>