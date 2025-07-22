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
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: #fff; }
        .berita-container { padding: 40px 60px; max-width: 1200px; margin: 0 auto; }
        .title { color: #001e74; text-align: left; font-size: 28px; font-weight: 700; margin-bottom: 30px; }
        .berita-grid { display: flex; gap: 24px; flex-wrap: wrap; justify-content: start; }
        .berita-card {
            width: calc((100% - 80px) / 3); background: white; border-radius: 14px; box-shadow: 5px 5px 20px rgba(0,0,0,0.2); overflow: hidden; display: flex; flex-direction: column;
            justify-content: space-between; cursor: pointer; text-decoration: none; margin-bottom: 20px; position: relative; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); transform-origin: center;
        }
        .berita-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(45deg, rgba(0, 30, 116, 0.05), rgba(250, 204, 21, 0.05));
            opacity: 0; transition: opacity 0.3s ease; border-radius: 14px; z-index: 1;
        }
        .berita-card:hover { transform: translateY(-10px) scale(1.03);box-shadow: 0 20px 40px rgba(0,0,0,0.3); }
        .berita-card:hover::before { opacity: 1; }
        .berita-img { height: 200px; background-color: #ccc; border-bottom: 1px solid #eee; border-top-left-radius: 14px; border-top-right-radius: 14px; overflow: hidden; position: relative; }
        .berita-img img { width: 100%; height: 200px; object-fit: cover; transition: transform 0.4s ease; }
        .berita-card:hover .berita-img img { transform: scale(1.08); }
        .berita-card:hover .berita-img::after { opacity: 1; }
        .berita-img::after {
            content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(0, 30, 116, 0.2), rgba(250, 204, 21, 0.2)); opacity: 0; transition: opacity 0.3s ease;
        }
        .berita-content { padding: 20px; display: flex; flex-direction: column; gap: 10px; position: relative; z-index: 2; }
        .berita-content h3 { font-size: 16px; color: #001e74; font-weight: 700; margin-bottom: 8px; transition: color 0.3s ease; }
        .berita-info { display: flex; justify-content: space-between; align-items: center; }
        .berita-info .tanggal { font-size: 14px; color: #facc15; font-weight: 600; }

        .btn-detail { background-color: #001e74; color: white; font-size: 14px; padding: 6px 12px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; position: relative; overflow: hidden; }
        .btn-detail::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); transition: left 0.5s ease; }
        .berita-card:hover .btn-detail::before { left: 100%; }
        .berita-card { animation: fadeInUp 0.6s ease forwards; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .berita-card:nth-child(1) { animation-delay: 0.1s; }
        .berita-card:nth-child(2) { animation-delay: 0.2s; }
        .berita-card:nth-child(3) { animation-delay: 0.3s; }
        .berita-card:nth-child(4) { animation-delay: 0.4s; }
        .berita-card:nth-child(5) { animation-delay: 0.5s; }
        .berita-card:nth-child(6) { animation-delay: 0.6s; }

        @media (max-width: 992px) {
            .berita-container { padding: 30px 40px; }
            .berita-card { width: calc((100% - 24px) / 2); margin-bottom: 20px; }
        }

        @media (max-width: 600px) {
            .berita-container { padding: 20px 20px; }
            .berita-card { width: 100%; margin-bottom: 20px; }
            h1 { font-size: 20px; }
            .berita-card:hover { transform: translateY(-5px) scale(1.01); }
        }
        @media (max-width: 768px) {
            .berita-grid { gap: 20px; }
            .berita-card { width: 100%; }
        }
</style>
</head>
<body>

@section('navbar', true)
@extends('layouts.layout_user')
@section('content')

    <div class="berita-container">
        <h1 class="title">Berita </h1>
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
