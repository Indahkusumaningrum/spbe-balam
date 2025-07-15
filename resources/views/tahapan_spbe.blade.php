<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('asset/img/logo.png') }}" type="image/png">
    <title>Tahapan SPBE</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        :root {
            --primary-blue: #2E5894;
            --accent-yellow: #FFC300;
            --light-gray: #F5F7FA;
            --text-dark: #333C4E;
            --text-light: #6A7C93;
            --card-bg: #FFFFFF;
            --border-radius: 12px;
            --box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            --line-color: #DDE5ED;
            --active-line-color: var(--accent-yellow);
        }
        body { margin: 0; font-family: 'Poppins', sans-serif; background-color: var(--light-gray); color: var(--text-dark); line-height: 1.6; overflow-x: hidden; }
        .progress-section { padding: 80px 40px; text-align: center; overflow: hidden; box-sizing: border-box; }
        .section-header { margin-bottom: 70px; opacity: 0; transform: translateY(30px); animation: fadeInSlideUp 0.8s ease-out forwards; animation-delay: 0.2s; }
        .section-header .title { font-size: clamp(2em, 5vw, 2.8em); font-weight: 700; color: var(--primary-blue); margin-bottom: 15px; position: relative; display: inline-block; }
        .section-header .title::after { content: ''; position: absolute; left: 50%; bottom: -10px; transform: translateX(-50%); width: 70px; height: 4px; background-color: var(--accent-yellow); border-radius: 2px; }
        .section-header .subtitle { font-size: clamp(0.9em, 2vw, 1.2em); color: var(--text-light); max-width: 700px; margin: 0 auto; }
        .timeline-container { position: relative; max-width: 1200px; margin: 0 auto; padding: 0 20px; box-sizing: border-box; }
        .timeline-line { position: absolute; width: 4px; background-color: var(--line-color); left: 50%; top: 0; bottom: 0; transform: translateX(-50%); border-radius: 2px; display: block; }
        .timeline-line.animated { animation: drawLine 2s ease-out forwards; background-color: var(--active-line-color)}
        @keyframes drawLine { from { height: 0; } to { height: 100%; } }
        .timeline-line-point { position: absolute; width: 18px; height: 18px; background-color: var(--accent-yellow); border-radius: 50%; left: 50%; transform: translateX(-50%); z-index: 2; box-shadow: 0 0 0 5px rgba(255, 195, 0, 0.3); display: block; }
        .timeline-line-point.point-1 { top: 0%; }
        .timeline-line-point.point-2 { top: calc(16.66% * 1); }
        .timeline-line-point.point-3 { top: calc(16.66% * 2); }
        .timeline-line-point.point-4 { top: calc(16.66% * 3); }
        .timeline-line-point.point-5 { top: calc(16.66% * 4); }
        .timeline-line-point.point-6 { top: calc(16.66% * 5); }
        .timeline-line-point.point-7 { top: 100%; }
        .timeline-grid { display: grid; grid-template-columns: 1fr 40px 1fr; gap: 40px 20px; align-items: start; }
        .timeline-item {
            background-color: var(--card-bg); border-radius: var(--border-radius); box-shadow: var(--box-shadow);
            padding: 30px; text-align: left; position: relative; transition: all 0.3s ease-in-out; cursor: pointer; z-index: 1; opacity: 0; transform: translateY(30px); animation: fadeInSlideUp 0.8s ease-out forwards;
        }
        .timeline-item:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12); }
        .timeline-item:nth-child(odd) { grid-column: 1 / 2; text-align: right; border-left: 5px solid var(--accent-yellow); border-right: none; animation-delay: 0.4s; }
        .timeline-item:nth-child(even) {
            grid-column: 3 / 4;
            text-align: left;
            border-right: 5px solid var(--accent-yellow);
            border-left: none;
            animation-delay: 0.6s;
        }

        /* Mengatur delay animasi untuk setiap item */
        .timeline-item:nth-child(1) { animation-delay: 0.4s; }
        .timeline-item:nth-child(2) { animation-delay: 0.6s; }
        .timeline-item:nth-child(3) { animation-delay: 0.8s; }
        .timeline-item:nth-child(4) { animation-delay: 1.0s; }
        .timeline-item:nth-child(5) { animation-delay: 1.2s; }
        .timeline-item:nth-child(6) { animation-delay: 1.4s; }
        .timeline-item-number { font-size: 1.8em; font-weight: 700; color: var(--primary-blue); margin-bottom: 10px; }
        .timeline-item-title { font-size: clamp(1.1em, 2.5vw, 1.4em); font-weight: 600; color: var(--text-dark); margin-bottom: 10px; }
        .timeline-item-description { font-size: clamp(0.85em, 1.8vw, 0.95em); color: var(--text-light); }
        .timeline-icon { font-size: clamp(1.8em, 4vw, 2.2em); color: var(--accent-yellow); margin-bottom: 15px; display: block; }
        .timeline-item:nth-child(odd) .timeline-icon { text-align: right; }
        .timeline-item:nth-child(even) .timeline-icon { text-align: left; }
        .timeline-final-item {
            grid-column: 1 / 4; 
            text-align: center;
            background-color: var(--accent-yellow);
            color: white;
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-top: 50px;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInSlideUp 0.8s ease-out forwards;
            animation-delay: 1.6s;
        }

        .timeline-final-item .timeline-icon {
            color: white;
            margin-bottom: 20px;
            font-size: clamp(2.5em, 5vw, 3em); /* Responsive font size */
        }

        .timeline-final-item .timeline-item-title {
            color: white;
            font-size: clamp(1.5em, 3.5vw, 2em); /* Responsive font size */
        }

        .timeline-final-item .timeline-item-description {
            color: rgba(255, 255, 255, 0.9);
            font-size: clamp(0.9em, 2vw, 1.1em); /* Responsive font size */
            max-width: 600px;
            margin: 0 auto;
        }

        @keyframes fadeInSlideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* --- MEDIA QUERIES FOR RESPONSIVENESS --- */

        /* Tablets and smaller laptops (e.g., 992px) */
        @media (max-width: 992px) {
            .progress-section {
                padding: 60px 30px;
            }

            .timeline-grid {
                /* Perlu disesuaikan jika ingin tetap 2 kolom, tapi diatur ulang */
                grid-template-columns: 1fr 40px 1fr; /* Tetap 2 kolom, tetapi mungkin jaraknya berubah */
                gap: 30px 15px; /* Kurangi jarak */
            }

            /* Pada ukuran ini, kita bisa pertimbangkan untuk tetap menjaga layout 2 sisi, tapi dengan penyesuaian */
            .timeline-item:nth-child(odd),
            .timeline-item:nth-child(even) {
                /* Jaga border yang sama dengan default, mungkin tanpa right/left none */
                border-left: 5px solid var(--accent-yellow);
                border-right: none; /* Pastikan hanya border kiri */
                text-align: left; /* Semua teks rata kiri */
                grid-column: 1 / 4; /* Merentang 3 kolom (karena garis tengah tetap ada secara virtual) */
            }

            .timeline-item:nth-child(odd) .timeline-icon,
            .timeline-item:nth-child(even) .timeline-icon {
                text-align: left; /* Semua ikon rata kiri */
            }

            /* Garis timeline dan titik tetap ada, tapi mungkin sedikit lebih sempit */
            .timeline-line,
            .timeline-line-point {
                left: 20px; /* Geser garis ke kiri */
                transform: translateX(0); /* Reset transform */
            }

            /* Sesuaikan posisi titik di mobile agar sejajar dengan item */
            .timeline-line-point.point-1 { top: 0%; } /* Atau sesuaikan dengan margin top item pertama */
            .timeline-line-point.point-2 { top: calc(var(--item-height-approx) * 1 + var(--gap-between-items-approx) * 1); }
            /* Ini akan lebih rumit, lebih baik pakai JS atau sembunyikan saja */
            /* Untuk sementara, kita akan sembunyikan titik dan garis di mobile, kecuali kalau ada kebutuhan khusus untuk mempertahankannya */
        }

        /* Mobile devices (e.g., 768px and below) */
        @media (max-width: 768px) {
            .progress-section {
                padding: 40px 20px;
            }

            .section-header {
                margin-bottom: 50px;
            }

            .timeline-container {
                padding: 0 10px; /* Kurangi padding horizontal */
            }

            .timeline-grid {
                grid-template-columns: 1fr; /* Stack into a single column */
                gap: 30px; /* Consistent vertical gap */
            }

            /* Hide the central line and points on small screens */
            .timeline-line,
            .timeline-line-point {
                display: none;
            }

            .timeline-item {
                grid-column: 1 / 1; /* Ensure it takes full width */
                text-align: left; /* All text aligns left */
                border-left: 5px solid var(--accent-yellow); /* Keep left border for all */
                border-right: none; /* No right border */
                padding: 25px; /* Slightly less padding */
            }

            .timeline-item:nth-child(odd),
            .timeline-item:nth-child(even) {
                text-align: left; /* Override previous alignment */
                border-left: 5px solid var(--accent-yellow);
                border-right: none;
            }

            .timeline-item .timeline-icon {
                text-align: left; /* Ensure icon is on the left */
            }

            .timeline-final-item {
                grid-column: 1 / 1; /* Full width for final item */
                margin-top: 30px;
                padding: 30px;
            }
        }

        /* Extra small devices (e.g., 480px and below) */
        @media (max-width: 480px) {
            .progress-section {
                padding: 30px 15px;
            }

            .section-header .title {
                font-size: 1.8em; /* Further reduce font size */
            }

            .section-header .subtitle {
                font-size: 0.9em;
            }

            .timeline-item {
                padding: 20px;
            }

            .timeline-item-number {
                font-size: 1.5em;
            }

            .timeline-item-title {
                font-size: 1.1em;
            }

            .timeline-item-description {
                font-size: 0.8em;
            }
        }
    </style>
</head>
<body>
@section('navbar', true)
@extends('layouts.layout_user')
@section('content')
<div class="progress-section">
    <header class="section-header">
        <h1 class="title">Alur Evaluasi SPBE</h1>
        <p class="subtitle">Pahami setiap langkah dalam proses evaluasi Sistem Pemerintahan Berbasis Elektronik (SPBE) kami, mulai dari penilaian mandiri hingga finalisasi hasil.</p>
    </header>

    <div class="timeline-container">
        <div class="timeline-line">
            <span class="timeline-line-point point-1"></span>
            <span class="timeline-line-point point-2"></span>
            <span class="timeline-line-point point-3"></span>
            <span class="timeline-line-point point-4"></span>
            <span class="timeline-line-point point-5"></span>
            <span class="timeline-line-point point-6"></span>
            <span class="timeline-line-point point-7"></span>
        </div>

        <div class="timeline-grid">
            <div class="timeline-item">
                <div class="timeline-icon"><i class="fas fa-edit"></i></div>
                <div class="timeline-item-number">01</div>
                <h3 class="timeline-item-title">Penilaian Mandiri</h3>
                <p class="timeline-item-description">Instansi melakukan evaluasi internal menyeluruh terhadap implementasi SPBE mereka.</p>
            </div>

            <div class="timeline-item">
                <div class="timeline-icon"><i class="fas fa-file-invoice"></i></div>
                <div class="timeline-item-number">02</div>
                <h3 class="timeline-item-title">Penilaian Dokumen</h3>
                <p class="timeline-item-description">Tim evaluator meninjau dan memverifikasi dokumen-dokumen SPBE yang telah diserahkan.</p>
            </div>

            <div class="timeline-item">
                <div class="timeline-icon"><i class="fas fa-comments"></i></div>
                <div class="timeline-item-number">03</div>
                <h3 class="timeline-item-title">Penilaian Interviu</h3>
                <p class="timeline-item-description">Diskusi dan wawancara dengan pemangku kepentingan untuk klarifikasi data dan informasi.</p>
            </div>

            <div class="timeline-item">
                <div class="timeline-icon"><i class="fas fa-building"></i></div>
                <div class="timeline-item-number">04</div>
                <h3 class="timeline-item-title">Penilaian Visitasi</h3>
                <p class="timeline-item-description">Kunjungan langsung ke lokasi untuk verifikasi fisik dan observasi praktik SPBE.</p>
            </div>

            <div class="timeline-item">
                <div class="timeline-icon"><i class="fas fa-handshake-alt-slash"></i></div>
                <div class="timeline-item-number">05</div>
                <h3 class="timeline-item-title">Harmonisasi</h3>
                <p class="timeline-item-description">Penyelarasan hasil penilaian dan pembahasan rekomendasi bersama instansi terkait.</p>
            </div>

            <div class="timeline-item">
                <div class="timeline-icon"><i class="fas fa-clipboard-check"></i></div>
                <div class="timeline-item-number">06</div>
                <h3 class="timeline-item-title">Finalisasi Hasil</h3>
                <p class="timeline-item-description">Penetapan skor akhir evaluasi dan penyusunan laporan resmi SPBE.</p>
            </div>
        </div>

        <div class="timeline-final-item">
            <div class="timeline-icon"><i class="fas fa-flag-checkered"></i></div>
            <h3 class="timeline-item-title">Selesai!</h3>
            <p class="timeline-item-description">Selamat, proses evaluasi SPBE Anda telah berhasil diselesaikan. Anda dapat melihat hasil akhir dan rekomendasi kami.</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const line = document.querySelector('.timeline-line');
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.classList.contains('section-header')) {
                        entry.target.style.animationPlayState = 'running';
                    } else if (entry.target.classList.contains('timeline-line')) {
                        entry.target.classList.add('animated');
                    } else if (entry.target.classList.contains('timeline-item') || entry.target.classList.contains('timeline-final-item')) {
                        entry.target.style.animationPlayState = 'running';
                    }
                }
            });
        }, observerOptions);

        observer.observe(document.querySelector('.section-header'));
        observer.observe(line);
        document.querySelectorAll('.timeline-item, .timeline-final-item').forEach(item => {
            observer.observe(item);
        });
    });
</script>

@endsection
</body>
</html>
