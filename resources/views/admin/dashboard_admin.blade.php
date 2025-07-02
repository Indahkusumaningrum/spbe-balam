<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Download</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Manage Download')
@section('content')

    <div class="nav-bar">
        <a href="{{ route('dashboardadmin') }}">
            <img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE" style="cursor:pointer;">
        </a>
        <div class="nav-container">
            <div class="manage-label">Manage</div>
            <nav class="nav-menu">
                <li><a href="#">Indikator SPBE</a></li>
                <li><a href="{{ route('profile') }}">Profile</a></li>
                <li><a href="{{ route('admin.berita') }}">Berita</a></li>
                <li><a href="{{ route('admin.download') }}">Download</a></li>
                <li><a href="#">Galeri</a></li>
                <li><a href="#">Kontak</a></li>
            </nav>
        </div>
    </div>


@endsection
</body>
</html>
