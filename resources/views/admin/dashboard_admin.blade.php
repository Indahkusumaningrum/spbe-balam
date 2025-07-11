<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage SPBE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10.3.1/swiper-bundle.min.css" />
    <style>
        body {
            background-color: white;
            font-family: 'Poppins', sans-serif; /* Pastikan font diterapkan ke body */
        }

        /* Container untuk Swiper */
        .mySwiper {
            max-width: 1200px; /* Lebar maksimum carousel */
            width: 100%;
            padding: 40px 0;
            margin: auto;
        }

        /* Wrapper untuk cards, diatur oleh Swiper */
        .swiper-wrapper {
            display: flex; /* Pastikan flexbox untuk Swiper */
        }

        /* Gaya untuk setiap slide/card dalam Swiper */
        .swiper-slide {
            width: 250px; /* Lebar default untuk setiap card, akan disesuaikan oleh Swiper responsive */
            display: flex; /* Memastikan konten di tengah slide */
            justify-content: center;
            align-items: center;
            height: auto; /* Biarkan tinggi menyesuaikan konten */
        }

        .spbe-info-section {
            /* Hapus properti display, justify-content, flex-wrap, gap karena Swiper akan mengaturnya */
            padding: 0 20px; /* Sesuaikan padding agar tidak terlalu mepet dengan tepi */
            background-color: #ffffff;
        }

        .btn-selengkapnya {
            display: inline-block;
            background-color: #ffae00;
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-selengkapnya:hover {
            transform: scale(1.05);
        }

        .info-card {
            width: 200px; /* Tetapkan lebar card */
            background-color: white;
            border: 1.5px solid #facc15;
            border-radius: 16px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1); /* Shadow yang lebih lembut */
            padding: 24px;
            text-align: center;
            transition: transform 0.3s ease; /* Transisi lebih halus */
            margin: auto; /* Untuk memusatkan card di dalam slide jika slide lebih lebar */
        }

        .info-card:hover {
            transform: translateY(-10px); /* Efek hover yang lebih subtle */
        }

        .info-card .info-icon {
            height: 90px;
            width: 90px;
            margin-bottom: 12px;
        }

        .info-card h3 {
            font-size: 18px;
            margin: 0 0 8px;
            color: #000;
        }

        .info-card p {
            font-size: 14px;
            color: #333;
            margin-bottom: 16px;
        }

        .info-card a {
            color: white;
            font-weight: 600;
        }

        /* Gaya Pagination Swiper */
        .swiper-pagination-bullet {
            background: #ccc; /* Warna default pagination */
            width: 10px;
            height: 10px;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .swiper-pagination-bullet-active {
            background: #ffae00; /* Warna aktif pagination */
            width: 25px; /* Efek memanjang saat aktif */
            border-radius: 5px;
            opacity: 1;
        }

        /* Gaya Navigation Swiper */
        .swiper-button-next,
        .swiper-button-prev {
            color: #ffae00; /* Warna panah navigasi */
            top: 50%; /* Posisikan di tengah vertikal */
            transform: translateY(-50%); /* Penyesuaian presisi */
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 25px; /* Ukuran icon panah */
        }

        /* Media queries untuk responsivitas */
        @media (max-width: 768px) {
            .swiper-slide {
                width: 100%; /* Pada layar kecil, setiap slide mengambil lebar penuh */
            }
            .info-card {
                width: 90%; /* Card mengambil 90% lebar pada layar kecil */
                margin: 0 auto;
            }
            .spbe-info-section {
                padding: 20px 10px;
            }
        }
    </style>
</head>
<body>

{{-- Karena Anda menggunakan @extends, asumsikan ini adalah bagian dari Blade layout --}}
@extends('layouts.layout_admin')
@section('title', 'Dashboard Admin')
@section('content')

    <div class="swiper mySwiper">
        <div class="spbe-info-section">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="info-card">
                        <img src="{{ asset('asset/icon/regulasi.png') }}" alt="Regulasi" class="info-icon">
                        <h3>Regulasi</h3>
                        <p>SPBE akan menjadi platform untuk seluruh regulasi yang ada. Platform ini bermakna pada integrasi. Integrasi ini pada proses bisnis, mulai dari level mikro hingga makro.</p>
                        <a href="{{ route('admin.regulasi') }}" class="btn-selengkapnya">Selengkapnya</a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="info-card">
                        <img src="{{ asset('asset/icon/tahapan.png') }}" alt="Tahapan SPBE" class="info-icon">
                        <h3>Tahapan SPBE</h3>
                        <p>Terbagi dalam Peta Rencana SPBE yaitu: Tahapan Rencana Strategis, Tahapan Pembangunan Fondasi SPBE, Tahapan Pengembangan SPBE, dan Inisiatif Strategis</p>
                        <a href="{{ route('tahapan_spbe') }}" class="btn-selengkapnya">Selengkapnya</a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="info-card">
                        <img src="{{ asset('asset/icon/kegiatan.png') }}" alt="Kegiatan" class="info-icon">
                        <h3>Kegiatan</h3>
                        <p>Maka inti dari kegiatan SPBE adalah membangun layanan publik yang berkualitas, dengan didukung kesiapan pada aplikasi, infrastruktur dan keamanan SPBE.</p>
                        <a href="#" class="btn-selengkapnya">Selengkapnya</a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="info-card">
                        <img src="{{ asset('asset/icon/evaluasi.png') }}" alt="Evaluasi" class="info-icon">
                        <h3>Evaluasi</h3>
                        <p>Hasil evaluasi untuk mengetahui Indeks SPBE sebagai acuan untuk tingkat kematangan penerapan SPBE baik dalam kapabilitas proses maupun kapabilitas fungsi teknis</p>
                        <a href="{{ route('admin.evaluasi') }}" class="btn-selengkapnya">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@10.3.1/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mySwiper = new Swiper('.mySwiper', {
            // Mode: loop agar swipe berjalan terus-menerus
            loop: true,
            // Auto-play slides
            autoplay: {
                delay: 4000, // 4 detik per slide
                disableOnInteraction: false, // Lanjutkan autoplay setelah interaksi user
            },
            // Jarak antar slide
            spaceBetween: 30,
            // Pagination (dots di bawah carousel)
            pagination: {
                el: '.swiper-pagination',
                clickable: true, // Memungkinkan klik pada dots untuk navigasi
            },
            // Navigation (tombol prev/next)
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            // Responsif breakpoint
            breakpoints: {
                // Ketika lebar layar kurang dari atau sama dengan 768px
                0: { // Ukuran default untuk semua layar, dimulai dari 0px
                    slidesPerView: 1, // Tampilkan 1 slide
                    centeredSlides: true, // Pusatkan slide aktif
                },
                // Ketika lebar layar 640px atau lebih besar
                640: {
                    slidesPerView: 2, // Tampilkan 2 slide
                    spaceBetween: 20,
                },
                // Ketika lebar layar 768px atau lebih besar
                768: {
                    slidesPerView: 3, // Tampilkan 3 slide
                    spaceBetween: 30,
                },
                // Ketika lebar layar 1024px atau lebih besar
                1024: {
                    slidesPerView: 4, // Tampilkan 4 slide
                    spaceBetween: 40,
                },
            },
        });
    });
</script>
@endpush

</body>
</html>
