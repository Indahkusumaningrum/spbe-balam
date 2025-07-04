<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>SPBE - Pemerintah Kota Bandar Lampung</title>
    <style>
        .galeri-container {
            padding: 40px 60px;
        }

        .galeri-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 0 -10px;
        }

        .galeri-card {
            flex: 1 1 calc(25% - 20px); /* 4 kolom */
            max-width: calc(25% - 20px);
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            background-color: #f9f9f9;
            position: relative;
            cursor: pointer;
        }

        .galeri-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .galeri-title {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 12px 10px;
            background: rgba(0, 30, 116, 0.8); /* latar semi transparan */
            color: white;
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            opacity: 0;
            transform: translateY(100%);
            transition: all 0.3s ease-in-out;
        }

        .galeri-card:hover .galeri-title {
            opacity: 1;
            transform: translateY(0);
        }

            @media (max-width: 1024px) {
                .galeri-card {
                    flex: 1 1 calc(33.333% - 20px); /* 3 kolom */
                    max-width: calc(33.333% - 20px);
                }
            }

            @media (max-width: 768px) {
                .galeri-card {
                    flex: 1 1 calc(50% - 20px); /* 2 kolom */
                    max-width: calc(50% - 20px);
                }
            }

            @media (max-width: 480px) {
                .galeri-card {
                    flex: 1 1 100%; /* 1 kolom */
                    max-width: 100%;
                }
            }
    </style>
</head>
<body>
@section('navbar', true)
@extends('layouts.layout_user')

@section('content')

<div class="galeri-container">
    <div class="galeri-grid">
        @foreach ($galleries as $gallery)
            <div class="galeri-card">
                <img src="{{ asset('uploads/gallery/' . $gallery->image_path) }}" alt="Foto">
                <div class="galeri-title">{{ $gallery->title }}</div>
            </div>
        @endforeach
    </div>
</div>
@endsection

</body>
</html>
