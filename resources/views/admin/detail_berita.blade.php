<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Berita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .berita-container {
            padding: 40px 60px;
            font-family: 'Poppins', sans-serif;
        }

        .berita-img-container {
            position: relative;
        }

        .berita-img {
            width: 100%;
            height: auto;
            border-radius: 16px;
            margin-top: 70px;
        }

        .berita-actions {
            position: absolute;
            top: 10px;
            right: 20px;
            display: flex;
            gap: 12px;
        }

        .berita-actions a {
            background-color: #3b82f6;
            color: white;
            padding: 8px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
        }

        .berita-actions .btn-delete {
            background-color: #dc2626;
        }

        .berita-date {
            color: #facc15;
            font-weight: 600;
            font-size: 16px;
            margin-top: 24px;
        }

        .berita-title {
            font-size: 28px;
            color: #001e74;
            font-weight: 700;
            margin: 10px 0;
        }

        .berita-body {
            font-size: 18px;
            color: #333;
            line-height: 1.6;
        }

        .btn-edit{
            background-color: #3b82f6; /* Warna biru untuk edit */
            border: none;
            cursor: pointer;
            padding: 2px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
        }

        .btn-delete {
            background-color: #3b82f6; /* Warna biru untuk edit */
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
        }

        .btn-delete {
            background-color: #dc2626; /* Warna merah untuk delete */
        }

        .btn-edit i,
        .btn-delete i {
            color: white;
            font-size: 20px;
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
        <div class="berita-img-container">
            <div class="berita-actions">
                <a href="{{ route('admin.berita.edit', $berita->id_berita) }}" class="btn-edit"><i class="fas fa-pen"></i></a>
                <form action="{{ route('admin.berita.destroy', $berita->id_berita) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus berita ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete"><i class="fas fa-trash"></i></button>
                </form>
            </div>
            <img src="{{ asset('uploads/beritas/' . $berita->gambar) }}" alt="Gambar Berita" class="berita-img">
        </div>

        <div class="berita-date">
            {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }} |
            {{ \Carbon\Carbon::parse($berita->created_at)->format('H:i') }}
        </div>

        <h1 class="berita-title">{{ $berita->judul }}</h1>
        <div class="berita-body">{!! nl2br(e($berita->konten)) !!}</div>
    </div>

@endsection


<!-- <script>
        function showDeleteModal() {
            document.getElementById('logoutModal').style.display = 'block';
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('logoutModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script> -->


</body>
</html>
