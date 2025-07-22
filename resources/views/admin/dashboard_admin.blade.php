<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage SPBE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body{ background-color: white; }
        .btn-selengkapnya { display: inline-block; background-color: #ffae00; color: white; padding: 8px 20px; border-radius: 25px; text-decoration: none; font-weight: 600; font-size: 15px; transition: background-color 0.3s ease, transform 0.2s ease; }
        .btn-selengkapnya:hover { transform: scale(1.05); }
        .spbe-info-section { display: flex; justify-content: center; flex-wrap: wrap; gap: 50px; padding: 40px 20px; background-color: #ffffff; }
        .info-card { width: 250px; min-width: 250px; max-width: 100%; border: 1.5px solid #facc15; border-radius: 16px; box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5); padding: 24px; text-align: center; transition: transform 0.3s; }
        .info-card:hover { transform: translateY(-20px); }
        .info-card .info-icon { width: 90px; height: 90px; margin-bottom: 15px; }
        .info-card h3 { font-size: 18px; margin: 0 0 8px; color: #000; }
        .info-card p { font-size: 14px; color: #333; margin-bottom: 16px; }
        .info-card a { color: white; font-weight: 600; }
        .info-card .info-icon { height: 90px; width: 90px; }
    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Dashboard Admin')
@section('content')

    <div class="spbe-info-section">
        <div class="info-card">
            <img src="{{ asset('asset/icon/regulasi.png') }}" alt="Regulasi" class="info-icon">
            <h3>Regulasi</h3>
            <p>SPBE akan menjadi platform untuk seluruh regulasi yang ada. Platform ini bermakna pada integrasi. Integrasi ini pada proses bisnis, mulai dari level mikro hingga makro.</p>
            <a href="{{ route('admin.regulasi') }}" class="btn-selengkapnya">Manage</a>
        </div>
        <div class="info-card">
            <img src="{{ asset('asset/icon/tahapan.png') }}" alt="Tahapan SPBE" class="info-icon">
            <h3>Tahapan SPBE</h3>
            <p>Terbagi dalam Peta Rencana SPBE yaitu: Tahapan Rencana Strategis, Tahapan Pembangunan Fondasi SPBE, Tahapan Pengembangan SPBE, dan Inisiatif Strategis</p>
            <a href="{{ route('admin.tahapan_spbe') }}" class="btn-selengkapnya">Manage</a>
        </div>
        <div class="info-card">
            <img src="{{ asset('asset/icon/evaluasi.png') }}" alt="Evaluasi" class="info-icon">
            <h3>Evaluasi</h3>
            <p>Hasil evaluasi untuk mengetahui Indeks SPBE sebagai acuan untuk tingkat kematangan penerapan SPBE baik dalam kapabilitas proses maupun kapabilitas fungsi teknis</p>
            <a href="{{ route('admin.evaluasi') }}" class="btn-selengkapnya">Manage</a>
        </div>
    </div>
@endsection
</body>
</html>
