<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage SPBE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    .evaluasi-container {
        padding: 2rem;
    }

    .evaluasi-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .evaluasi-header h1 {
        font-size: 1.8rem;
        font-weight: bold;
    }

    .tambah {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-add {
        background-color: #4f46e5;
        color: white;
        padding: 8px 12px;
        border-radius: 8px;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .p {
        margin: 0;
        font-size: 14px;
        font-weight: 500;
    }

    .evaluasi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .evaluasi-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s ease-in-out;
    }

    .evaluasi-card:hover {
        transform: translateY(-5px);
    }

    .evaluasi-img img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .evaluasi-content {
        padding: 1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .evaluasi-content h3 {
        font-size: 1.1rem;
        margin-bottom: 0.75rem;
        font-weight: 600;
    }

    .evaluasi-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .tanggal {
        font-size: 0.9rem;
        color: #6b7280;
    }

    .btn-detail {
        background-color: #001e74;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn-detail:hover {
        background-color: #0640e0;
    }
</style>

</head>

<body>




@extends('layouts.layout_admin')
@section('title', 'Manage Berita')
@section('content')

    <div class="evaluasi-container">
        <div class="evaluasi-header">
            <h1>Evaluasi</h1>
            <div class="tambah">
                <a href="{{ route('admin.evaluasi.create') }}" class="btn-add"><i class="fas fa-plus" style="font-size: 18px;"></i></a>
                <p class="p">Tambah Hasil Evaluasi</p>
            </div>
        </div>
        <div class="evaluasi-grid">
            @foreach($evaluations as $evaluation)
            <div class="evaluasi-card">
                <div class="evaluasi-img">
                    @if($evaluation->image)
                    <img src="{{ asset('uploads/evaluasi/' . $evaluation->image) }}" style="width:100%; height:200px; object-fit:cover;">
                    @endif
                </div>
                <div class="evaluasi-content">
                    <h3>{{ $evaluation->title }}</h3>
                    <div class="evaluasi-info">
                        <span class="tanggal">{{ $evaluation->created_at->format('d-m-Y') }}</span>
                        <a href="{{ route('admin.evaluasi.show', $evaluation->id) }}" class="btn-detail">Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
</body>
</html>
