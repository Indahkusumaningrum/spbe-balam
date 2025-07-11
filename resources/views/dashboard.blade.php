<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPBE</title>
    <link rel="icon" href="{{ asset('asset/img/logo.png') }}" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet" />
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box; list-style: none; text-decoration: none;
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            font-size: 16px; font-weight: normal; line-height: 1.5; color: #252a32; background: #ffffff;
        }
        .container {
            max-width: 1200px; width: 100%; padding: 50px 0; margin: 0 auto;
        }
        .main .swiper-container {
            position: relative; width: 100vw; left: 50%; transform: translateX(-50%); height: 500px; padding-bottom: 50px; overflow: hidden; perspective: 1200px; margin-bottom: 30px;
        }
        .main .swiper-container .swiper-wrapper {
            height: 100%;
        }
        .main .swiper-container .swiper-wrapper .swiper-slide {
            background: #f1f5f8;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 3px rgba(0, 0, 0, 0.24);
            border-radius: 8px;
            width: 70% !important;
            opacity: 0.8;
        }
        .main .swiper-container .swiper-wrapper .swiper-slide-active {
            opacity: 1;
        }
        .main .swiper-container .swiper-wrapper .swiper-slide .card-image {
            background: #ffffff;
            border: none; outline: none; border-radius: 2px; width: 100%; height: 100%; overflow: hidden;
        }
        .main .swiper-container .swiper-wrapper .swiper-slide .card-image img {
            display: block; width: 100%; height: 100%; object-fit: cover;
        }
        .main .swiper-container .swiper-button-next,
        .main .swiper-container .swiper-button-prev {
            background-image: none;
            background-size: 0;
            background-repeat: no-repeat;
            background-position: 0;
            margin-top: -16px;
            width: auto; height: auto; position: absolute; top: 50%; transform: translateY(-50%); z-index: 10; cursor: pointer;
        }
        .main .swiper-container .swiper-button-next::after,
        .main .swiper-container .swiper-button-prev::after {
            display: none;
        }
        .main .swiper-container .swiper-button-next .arrow-icon,
        .main .swiper-container .swiper-button-prev .arrow-icon {
            font-size: 32px; color: rgba(255,255,255,0.3);
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }
        .main .swiper-container .swiper-button-prev { left: 30px; }
        .main .swiper-container .swiper-button-next { right: 30px; }
        .card-link { display: block; width: 100%; height: 100%; text-decoration: none; color: inherit; }
        .spbe-info-section {
            display: flex; justify-content: center; flex-wrap: wrap; gap: 50px; padding: 40px 20px; background-color: #ffffff;
        }
        .info-card {
            width: 270px; min-width: 250px; max-width: 100%; border: 1.5px solid #facc15; border-radius: 16px; box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5); padding: 24px; text-align: center; transition: transform 0.3s;
        }
        .info-card:hover { transform: translateY(-20px); }
        .info-card .info-icon { width: 90px; height: 90px; margin-bottom: 15px; }
        .info-card h3 { font-size: 18px; margin: 0 0 8px; color: #000; }
        .info-card p { font-size: 14px; color: #333; margin-bottom: 16px; }
        .info-card a { color: white; font-weight: 600; }
        .btn-selengkapnya {
            display: inline-block; background-color: #ffae00; color: white; padding: 8px 20px; border-radius: 25px; text-decoration: none;
            font-weight: 600; font-size: 15px; transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-selengkapnya:hover { transform: scale(1.05); }
        .spbe-aspek-section {
            display: flex; width: 100%; justify-content: space-between; align-items: flex-start; padding-top: 40px; background-color: #fff; flex-wrap: wrap;
        }
        .spbe-aspek-section h2 { font-size: 26px; margin-bottom: 22px; color: #1e293b; font-weight: bold; }
        .aspek-left { flex: 1 1 500px; }
        .aspek-kategori { display: flex; flex-direction: column; gap: 20px; }
        .aspek-item { display: flex; gap: 15px; align-items: flex-start; }
        .aspek-item i { font-size: 36px; color: #facc15; min-width: 40px; }
        .aspek-item strong { font-size: 18px; color: #1e293b; }
        .aspek-item p { margin: 5px 0 0; font-size: 16px; color: #334155; }
        .aspek-right img { width: 100%; max-width: 570px; height: auto; display: block; margin-top: 50px;}
        .berita-section { padding: 60px 0px; background-color: #fff; text-align: center; }
        .berita-section h2 { font-size: 28px; color: #1e293b; margin-bottom: 40px; font-weight: bold; }
        .berita-swiper-container {  max-width: 100%; padding-bottom: 40px; overflow: hidden; margin: 0 auto; }
        .berita-swiper-wrapper { display: flex; }
        .berita-swiper-slide {
            background: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); text-align: left; display: flex; flex-direction: column; height: auto; width: 380px; overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.3s ease, width 0.3s ease; 
        }
        .berita-swiper-slide:not(.swiper-slide-active) { opacity: 0.7; transform: scale(0.9); }
        .berita-swiper-slide-active { opacity: 1; transform: scale(1); }
        .berita-swiper-slide:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); }
        .berita-card-link { display: flex; flex-direction: column; height: 100%; text-decoration: none; color: inherit; }
        .berita-image-wrapper { width: 100%; height: 240px;  overflow: hidden; border-top-left-radius: 8px; border-top-right-radius: 8px; }
        .berita-swiper-slide img { width: 100%; height: 240px; object-fit: cover; display: block; transition: transform 0.3s ease; }
        .berita-swiper-slide:hover img { transform: scale(1.05); }
        .berita-content-wrapper { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .berita-title { 
            font-size: 16px; font-weight: bold; color: #001e74; line-height: 1.3; overflow: hidden; text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .berita-date { font-size: 13px; color: #777; display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
        .berita-date i { margin-right: 5px; color: #facc15; }
        @media (max-width: 1024px) {
            .main .swiper-container { height: auto; padding-bottom: 30px; }
            .main .swiper-container .swiper-wrapper .swiper-slide { width: 80% !important; }
            .main .swiper-container .swiper-wrapper .swiper-slide .card-image img { height: auto;}
            .berita-section { padding: 40px 15px; }
            .berita-swiper-container { max-width: 960px; }
            .berita-swiper-slide { padding: 15px; }
            .berita-image-wrapper { height: 180px; }
            .berita-content-wrapper { padding: 15px; }
            .berita-title { font-size: 16px; -webkit-line-clamp: 3; }

        }
        @media (min-width: 768px) and (max-width: 1024px) {
            .main .swiper-container .swiper-wrapper .swiper-slide { width: 65% !important; }
        }
        @media (max-width: 767px) {
            .main .swiper-container { height: auto; padding-bottom: 30px; }
            .main .swiper-container .swiper-wrapper .swiper-slide { width: 90% !important;  }
            .main .swiper-container .swiper-wrapper .swiper-slide .card-image img { height: auto;}
            .berita-section { padding: 30px 10px; }
            .berita-swiper-container { max-width: 720px; }
            .berita-swiper-slide { padding: 12px; }
            .berita-image-wrapper { height: 160px; }
            .berita-content-wrapper { padding: 12px; }
            .berita-title { font-size: 15px; -webkit-line-clamp: 3; }
            .berita-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
                margin-bottom: 10px;
            }
        }
        @media (max-width: 480px) {
            .container { padding: 32px 16px; }
            .main .swiper-container .swiper-wrapper .swiper-slide { width: 95% !important; }
            .main .swiper-container .swiper-button-next,
            .main .swiper-container .swiper-button-prev { margin-top: -10px; }
            .main .swiper-container .swiper-button-next .arrow-icon,
            .main .swiper-container .swiper-container .swiper-button-prev .arrow-icon { font-size: 24px; }
            .berita-section { padding: 20px 10px; }
            .berita-swiper-container { max-width: 400px; }
            .berita-swiper-slide { padding: 10px; }
            .berita-image-wrapper { height: 120px; }
            .berita-content-wrapper { padding: 10px; }
            .berita-title { font-size: 14px; -webkit-line-clamp: 4; }
            .berita-meta { font-size: 12px; }
        }
    </style>
</head>
<body>
@section('navbar', true)
@extends('layouts.layout_user')
@section('content')
<main class="main">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            {{-- Main Banner Slides --}}
            <div class="swiper-slide">
                <a href="https://tauval.spbe.go.id/" target="_blank" class="card-link">
                    <div class="card-image"><img src="/asset/img/1.png" alt="Image Slider"></div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="https://example.com/page2" target="_blank" class="card-link">
                    <div class="card-image"><img src="/asset/img/2.png" alt="Image Slider"></div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="https://example.com/page3" target="_blank" class="card-link">
                    <div class="card-image"><img src="/asset/img/2.png" alt="Image Slider"></div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="https://example.com/page4" target="_blank" class="card-link">
                    <div class="card-image"><img src="/asset/img/1.png" alt="Image Slider"></div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="https://example.com/page5" target="_blank" class="card-link">
                    <div class="card-image"><img src="/asset/img/1.png" alt="Image Slider"></div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="https://example.com/page6" target="_blank" class="card-link">
                    <div class="card-image"><img src="/asset/img/2.png" alt="Image Slider"></div>
                </a>
            </div>
        </div>
        <div class="swiper-button-next"><i class="fas fa-chevron-circle-right arrow-icon"></i></div>
        <div class="swiper-button-prev"><i class="fas fa-chevron-circle-left arrow-icon"></i></div>
    </div>
</main>
    <div class="spbe-info-section">
        <div class="info-card">
            <img src="{{ asset('asset/icon/regulasi.png') }}" alt="Regulasi" class="info-icon">
            <h3>Regulasi</h3>
            <p>SPBE akan menjadi platform untuk seluruh regulasi yang ada. Platform ini bermakna pada integrasi. Integrasi ini pada proses bisnis, mulai dari level mikro hingga makro.</p>
            <a href="{{ route('regulasi_index') }}" class="btn-selengkapnya">Selengkapnya</a>
        </div>
        <div class="info-card">
            <img src="{{ asset('asset/icon/tahapan.png') }}" alt="Tahapan SPBE" class="info-icon">
            <h3>Tahapan SPBE</h3>
            <p>Terbagi dalam Peta Rencana SPBE yaitu: Tahapan Rencana Strategis, Tahapan Pembangunan Fondasi SPBE, Tahapan Pengembangan SPBE, dan Inisiatif Strategis</p>
            <a href="{{ route('tahapan_spbe') }}" class="btn-selengkapnya">Selengkapnya</a>
        </div>
        <div class="info-card">
            <img src="{{ asset('asset/icon/kegiatan.png') }}" alt="Kegiatan" class="info-icon">
            <h3>Kegiatan</h3>
            <p>Maka inti dari kegiatan SPBE adalah membangun layanan publik yang berkualitas, dengan didukung kesiapan pada aplikasi, infrastruktur dan keamanan SPBE.</p>
            <a href="#" class="btn-selengkapnya">Selengkapnya</a>
        </div>
    </div>

    <div class="spbe-aspek-section">
        <div class="aspek-left">
            <h2>Sistem Pemerintahan Berbasis Elektronik</h2>
            <div class="aspek-kategori">
                <div class="aspek-item">
                    <i class="far fa-handshake"></i>
                    <div>
                        <strong>Kebijakan SPBE</strong>
                        <p>Aspek 1 - Kebijakan Internal Tata Kelola SPBE</p>
                    </div>
                </div>
                <div class="aspek-item">
                    <i class="fas fa-network-wired"></i>
                    <div>
                        <strong>Tata Kelola SPBE</strong>
                        <p>Aspek 2 - Perencanaan Strategis SPBE<br>
                        Aspek 3 - Teknologi Informasi dan Komunikasi<br>
                        Aspek 4 - Penyelenggara SPBE</p>
                    </div>
                </div>
                <div class="aspek-item">
                    <i class="fas fa-clipboard-check"></i>
                    <div>
                        <strong>Manajemen SPBE</strong>
                        <p>Aspek 5 - Penerapan Manajemen SPBE<br>
                        Aspek 6 - Audit TIK</p>
                    </div>
                </div>
                <div class="aspek-item">
                    <i class="fas fa-headset"></i>
                    <div>
                        <strong>Layanan SPBE</strong>
                        <p>Aspek 7 - Layanan Pemerintah Berbasis Elektronik<br>
                        Aspek 8 - Layanan Publik Berbasis Elektronik</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="aspek-right">
            <img src="{{ asset('asset/img/walkot dan wakil walkot.png') }}" alt="Walikota dan Wakil Walikota">
        </div>
    </div>

{{-- Berita Carousel Section (Dynamic Content) --}}
<div class="berita-section">
    <h2>Berita Terbaru</h2>
    <div class="berita-swiper-container">
        <div class="swiper-wrapper berita-swiper-wrapper">
            @forelse($beritas as $berita)
                <div class="swiper-slide berita-swiper-slide">
                    <a href="{{ route('berita.show', $berita->id_berita) }}" class="berita-card-link">
                        <div class="berita-image-wrapper">
                            <img src="{{ asset('uploads/beritas/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
                        </div>
                        <div class="berita-content-wrapper">
                            <h3 class="berita-title">{{ $berita->judul }}</h3>
                                <span class="berita-date"><i class="far fa-calendar-alt"></i> {{ $berita->created_at->format('d M Y') }}</span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="berita swiper-slide berita-swiper-slide">
                    <p>Belum ada berita terbaru saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.esm.bundle.min.js"></script>
<script>
    var swiper = new Swiper(".swiper-container", {
        effect: 'coverflow', grabCursor: true, centeredSlides: true, slidesPerView: 'auto', loop: true, speed: 1000,
        coverflowEffect: { rotate: 30, stretch: 20, depth: 100, modifier: 1, slideShadows: true, },
        autoplay: { delay: 5000, disableOnInteraction: false },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        breakpoints: {
            640: { slidesPerView: 'auto', spaceBetween: 10, },
            768: { slidesPerView: 'auto', spaceBetween: 15,},
            1024: { slidesPerView: 'auto', spaceBetween: 20, },
        }
    });

    var swiperBerita = new Swiper(".berita-swiper-container", {
        effect: 'coverflow', grabCursor: true, centeredSlides: true, slidesPerView:'auto', loop: true, speed: 1000,
        coverflowEffect: { rotate: 0, stretch: -40, depth: 100, modifier: 1, slideShadows: true, },
        autoplay: { delay: 5000, disableOnInteraction: false },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        breakpoints: {
            640: { slidesPerView: 3, spaceBetween: 5, },
            768: { slidesPerView: 3, spaceBetween: 15,},
            1024: { slidesPerView: 5, spaceBetween: 20, },
        }
    });
    
</script>
@endpush
</body>
</html>
