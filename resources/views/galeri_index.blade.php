<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('asset/img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>SPBE - Pemerintah Kota Bandar Lampung</title>
    <style>
        .header-section { display: flex; justify-content: center; align-items: center; margin: 30px; flex-wrap: wrap; gap: 15px;}
        .header-section .title{ color: #001e74; font-size: 32px; font-weight: 700; position: relative;  margin: 30px; letter-spacing: 0.5px; text-align: center;}
        .header-section .title::after { content: ''; position: absolute; left: 50%; transform: translateX(-50%); bottom: 0;  margin-bottom: -10px; width: 50px; height: 5px; background: linear-gradient(to right, #facc15, #ff9a00); border-radius: 50px; box-shadow: 0 4px 10px rgba(250, 204, 21, 0.5); transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); }
        .header-section .title:hover::after { width: 100%; left: 0; transform: translateX(0); box-shadow: 0 6px 20px rgba(250, 204, 21, 0.7);}
        
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

            /* Modal Image Viewer */
            .modal {
                display: none;
                position: fixed;
                z-index: 1000;
                padding-top: 60px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.85);
            }

            .modal-content {
                margin: auto;
                display: block;
                max-width: 90%;
                max-height: 80vh;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0,0,0,0.5);
            }

            .modal-close {
                position: absolute;
                top: 20px;
                right: 40px;
                color: #fff;
                font-size: 40px;
                font-weight: bold;
                cursor: pointer;
                transition: 0.3s;
            }

            .modal-close:hover {
                color: #facc15;
            }

    </style>
</head>
<body>
@section('navbar', true)
@extends('layouts.layout_user')

@section('content')

<div class="galeri-container">
    <div class="header-section">
        <h1 class="title">Galeri </h1>
    </div>
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

<!-- Modal Popup -->
<div id="imageModal" class="modal">
    <span class="modal-close">&times;</span>
    <img class="modal-content" id="modalImg" alt="Preview">
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("imageModal");
        const modalImg = document.getElementById("modalImg");
        const closeBtn = document.querySelector(".modal-close");

        document.querySelectorAll('.galeri-card img').forEach(img => {
            img.addEventListener('click', function() {
                modal.style.display = "block";
                modalImg.src = this.src;
            });
        });

        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        // Klik di luar gambar untuk menutup modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });
</script>


</body>
</html>
