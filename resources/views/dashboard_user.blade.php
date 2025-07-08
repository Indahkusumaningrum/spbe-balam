<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @php use Illuminate\Support\Str; @endphp
    <title>SPBE - Pemerintah Kota Bandar Lampung</title>

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0);
            display: flex;
            align-items: center;
            padding: 10px 30px;
            color: white;
            justify-content: space-between;
            position: absolute;
            z-index: 10;
        }

        .navbar img {
            height: 75px;
        }

        .navbar .menu {
            display: flex;
            list-style: none;
            gap: 40px;
            margin: 0;
            padding: 0;
            font-size: 19px;
            margin-left: 40%;
            flex-shrink: 0;
        }

        .navbar .menu li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding-bottom: 7px;
            transition: color 0.3s ease;
        }

        .navbar .menu li a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 0%;
            background-color: #facc15;
            transition: width 0.3s ease;
            margin-top: 40px;
        }

        .navbar .menu li a:hover {
            color: #facc15;
        }

        .navbar .menu li a:hover::after {
            width: 100%;
        }

        .navbar .menu li a.active {
            color: #facc15;
        }

        .navbar .menu li a.active::after {
            width: 100%;
        }

        .spbe-banner {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .banner-wrapper {
            display: flex;
            transition: transform 0.8s ease-in-out;
            width: 100%; /* 2x jumlah slide */
            height: 100%;
        }

        .banner-slide {
            flex: 0 0 100%;
            height: 100vh;
            width: 1200px;
            object-fit: cover;
            object-position: top center;
            position: relative;

        }

        /* .banner-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            object-fit: cover;
            z-index: 0;
        } */

        /* .spbe-banner .banner-slide.active {
            opacity: 1;
            z-index: 1;
        } */

        .banner-text1 {
            position: absolute;
            top: 35%;
            right: 15%;
            transition: transform 0.8s ease-in-out;
            text-align: left;
            color: white;
            z-index: 2;
            display: none; /* hanya tampil saat slide ke-2 */
        }

        .banner-text1 h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .banner-text1 p {
            font-size: 20px;
            margin-bottom: 45px;
        }

        .banner-text {
            position: absolute;
            top: 35%;
            left: 8%;
            transition: transform 0.8s ease-in-out;
            text-align: left;
            color: white;
            z-index: 2;
            display: none; /* hanya tampil saat slide ke-2 */
        }

        .banner-text h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .banner-text p {
            font-size: 20px;
            margin-bottom: 35px;
        }

        .btn-banner {
            background-color: #facc15;
            display: inline-block;
            color: black;
            padding: 12px 24px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: transform 0.3s ease;
        }

        .btn-banner:hover {
            transform: scale(1.05);
        }

        .slide-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.4);
            border: none;
            color: white;
            font-size: 24px;
            padding: 12px 20px;
            cursor: pointer;
            z-index: 2;
            border-radius: 50%;
            transition: background-color 0.3s ease;
        }

        .slide-btn:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .slide-btn.prev {
            left: 20px;
        }

        .slide-btn.next {
            right: 20px;
        }

        .spbe-info-section {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 40px;
            padding: 40px 20px;
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
            width: 250px;
            background-color: white;
            border: 1.5px solid #facc15;
            border-radius: 16px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);
            padding: 24px;
            text-align: center;
            transition: transform 0.3s;
        }

        .info-card:hover {
            transform: translateY(-20px);
        }

        .info-card .info-icon {
            width: 48px;
            height: 48px;
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

        .info-card .info-icon {
            height: 90px;
            width: 90px;
        }

        .spbe-aspek-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 50px 30px;
            background-color: #fff;
            flex-wrap: wrap;
            gap: 40px;
            margin-left: 30px;
        }

        .spbe-aspek-section h2 {
            font-size: 28px;
            margin-bottom: 22px;
            color: #1e293b;
        }

        .aspek-left {
            flex: 1 1 550px;
        }

        .aspek-kategori {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .aspek-item {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .aspek-item i {
            font-size: 36px;
            color: #facc15;
            min-width: 40px;
        }

        .aspek-item strong {
            font-size: 18px;
            color: #1e293b;
        }

        .aspek-item p {
            margin: 5px 0 0;
            font-size: 16px;
            color: #334155;
        }

        .aspek-right img {
            width: 100%;
            max-width: 600px;
            height: auto;
            display: block;
            margin-top: 100px;
        }

        .spbe-tauval-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 60px 20px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .tauval-container {
            max-width: 900px;
            margin: 0 auto;
            background: rgba(71, 85, 105, 0.4);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            color: white;
            transition: transform 0.3s ease;
        }

        .tauval-content h2 {
            font-size: 30px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .tauval-content p {
            font-size: 16px;
            margin-bottom: 25px;
            color: #fff;
        }

        .btn-tauval {
            display: inline-block;
            background-color: #facc15;
            color: white;
            padding: 12px 28px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            position: relative;
            overflow: hidden;
            transition: background-color 0.3s ease;
        }

        .btn-tauval span {
            margin-top: -5px;
            margin-left: 8px;
            display: inline-block;
            transition: transform 0.3s ease;
            font-size: 20px;
        }

        .btn-tauval:hover {
            background-color: #ffae00;
        }

        .btn-tauval:hover span {
            transform: translateX(6px);
        }

        .judul-evaluasi{
            font-size: 20px;
            color: #1e293b;
            padding-left: 60px;
            display: inline-block;
        }

        .evaluasi-carousel-container {
            position: relative;
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            overflow: hidden;
        }

        .evaluasi-carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .evaluasi-card {
            min-width: 50%;
            box-sizing: border-box;
            padding: 10px;
        }

        .evaluasi-image {
            height: 230px;
            background-size: cover;
            background-position: center;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0,0,0,0.2);
        }

        .overlay {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px;
            background: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0));
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .tahun {
            color: white;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .btn-evaluasi-card {
            background-color: #facc15;
            color: white;
            padding: 8px 10px;
            border-radius: 5px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-evaluasi-card:hover {
            transform: scale(1.04);
        }

        .carousel-wrapper {
            position: relative;
            overflow: hidden;
            max-width: 100%;
            padding: 0 40px; /* beri ruang kiri kanan untuk tombol */
        }

        .carousel-track {
            display: flex;
            transition: transform 0.5s ease;
        }

        .carousel-prev, .carousel-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            background-color: #444; /* atau warna sesuai desain */
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 50%;
            font-size: 24px;
            cursor: pointer;
            opacity: 0.8;
        }

        .carousel-prev {
            left: 10px;
        }

        .carousel-next {
            right: 10px;
        }

        .carousel-prev:hover, .carousel-next:hover {
            opacity: 1;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            padding-top: 30px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.7);
        }

        .modal-content {
            margin: auto;
            display: block;
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255,255,255,0.2);
        }

        .custom-modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            overflow-y: auto;
            padding: 60px 0;
        }

        .custom-modal-content {
            background-color: #fff;
            margin: auto;
            border-radius: 10px;
            max-width: 100%;
            width: 800px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            overflow: hidden;
            animation: fadeIn 0.3s ease-in-out;
        }

        .custom-modal-header {
            background-color: #1e3a8a;
            color: white;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-modal-body {
            padding: 24px;
            text-align: center;
        }

        .custom-modal-image {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }


        .btn-close {
            background-color: #1e3a8a;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-close:hover {
            background-color: #3749b7;
        }

        .custom-close {
            font-size: 38px;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }


    </style>
</head>
<body>
@extends('layouts.layout_user')

    <div class="navbar">
        <a href="{{ route('dashboard_user') }}" class="logo-img">
            <img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE" style="cursor:pointer;">
        </a>
        <ul class="menu">
            <li><a href="#" class="{{ request()->routeIs('home') ? 'active' : '' }}">Indikator SPBE</a></li>
            <li><a href="{{ route('profile.show') }}" class="{{ request()->routeIs('profile.show') ? 'active' : '' }}">Profile</a></li>
            <li><a href="{{ route('berita.index') }}" class="{{ request()->routeIs('berita.*') ? 'active' : '' }}">Berita</a></li>
            <li><a href="#" class="{{ request()->is('download') ? 'active' : '' }}">Download</a></li>
            <li><a href="#" class="{{ request()->is('galeri') ? 'active' : '' }}">Galeri</a></li>
            <li><a href="#" class="{{ request()->is('kontak') ? 'active' : '' }}">Kontak</a></li>
        </ul>
    </div>

@section('content')
    <div class="spbe-banner">
         <div class="banner-wrapper">
            <img class="banner-slide" src="/asset/img/1.png" alt="Slide 1">
            <img class="banner-slide" src="/asset/img/2.png" alt="Slide 2">
        </div>
        {{-- <img class="banner-slide active" src="/asset/img/1.png" alt="Slide 1"> --}}
        <!-- Teks penjelasan untuk Banner 1 -->
        <div class="banner-text1" id="bannerText1">
            <h1>Selamat Datang</h1>
            <p>di Sistem Pemerintahan Berbasis Elektronik Kota Bandar Lampung</p>
        </div>

        {{-- <img class="banner-slide" src="/asset/img/2.png" alt="Slide 2"> --}}
        <!-- Teks penjelasan untuk Banner 2 -->
        <div class="banner-text" id="bannerText2">
            <h1>Regulasi</h1>
            <p>Pahami regulasi dalam penerapan Sistem Pemerintahan Berbasis Elektronik.</p>
            <a href="{{ route('regulasi_index') }}" class="btn-banner">Pelajari Selengkapnya</a>
        </div>

        <button class="slide-btn prev" onclick="prevSlide()">&#10094;</button>
        <button class="slide-btn next" onclick="nextSlide()">&#10095;</button>
    </div>

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

    {{-- Section Evaluasi --}}
    <div class="judul-evaluasi">
        <h2>Hasil Evaluasi</h2>
        <p style="border-bottom: 3px solid #facc15; margin-top: -20px;"></p>
    </div>
    <div class="evaluasi-carousel-container">
        <div class="carousel-wrapper">
            <button class="carousel-prev" onclick="moveSlide(-1)">&#10094;</button>
        <div class="evaluasi-carousel-track" id="carouselTrack">
            @foreach($evaluations as $evaluation)
                <div class="evaluasi-card">
                    <div class="evaluasi-image" style="background-image: url('{{ asset('uploads/evaluasi/' . $evaluation->image) }}')">
                        <div class="overlay">
                            <div class="tahun">
                                {{ Str::of($evaluation->title)->match('/Tahun \d{4}/') }}
                            </div>
                            <a href="javascript:void(0);" class="btn-evaluasi-card"
                                onclick="openModal('{{ asset('uploads/evaluasi/' . $evaluation->image) }}', '{{ $evaluation->title }}')">
                                SELENGKAPNYA
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-next" onclick="moveSlide(1)">&#10095;</button>
    </div>


    <!-- Modal Bootstrap-like -->
    <div class="custom-modal" id="popupModal">
        <div class="custom-modal-content">
            <div class="custom-modal-header">
                <h2 id="modalTitle">Hasil Evaluasi</h2>
                <span class="custom-close" onclick="closeModal()">&times;</span>
            </div>
            <div class="custom-modal-body">
                <img id="modalImage" src="" alt="Evaluasi SPBE" class="custom-modal-image">
            </div>
            <div class="custom-modal-footer">
                <button onclick="closeModal()" class="btn-close">Close</button>
            </div>
        </div>
    </div>


    <!-- Modal Image Preview -->
    <div id="imageModal" class="modal" onclick="closeModal()">
        <span class="modal-close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>


    <!-- Section Tauval SPBE -->
    <section class="spbe-tauval-section">
        <div class="tauval-container">
            <div class="tauval-content">
                <h2>Pemantauan dan Evaluasi SPBE</h2>
                <p>Kementerian Pendayagunaan Aparatur Negara dan Reformasi Birokrasi</p>
                <a href="https://tauval.spbe.go.id/" target="_blank" class="btn-tauval">
                    Selengkapnya <span>&rarr;</span>
                </a>
            </div>
        </div>
    </section>



@endsection

@push('scripts')
<script>
    const wrapper = document.querySelector('.banner-wrapper');
    const texts = [
        document.getElementById('bannerText1'),
        document.getElementById('bannerText2')
    ];
    let current = 0;
    const totalSlides = document.querySelectorAll('.banner-slide').length;

    function showSlide(index) {
        // Geser wrapper
        wrapper.style.transform = `translateX(-${index * 100}%)`;

        // Tampilkan teks
        texts.forEach((text, i) => {
            text.style.display = (i === index) ? 'block' : 'none';
        });
    }

    function nextSlide() {
        current = (current + 1) % totalSlides;
        showSlide(current);
    }

    function prevSlide() {
        current = (current + 1 + totalSlides) % totalSlides;
        showSlide(current);
    }

    showSlide(current);
    setInterval(() => { nextSlide(); }, 5000);


    let currentIndex = 0;

    function moveSlide(direction) {
        const track = document.getElementById("carouselTrack");
        const cards = document.querySelectorAll(".evaluasi-card");
        const cardWidth = cards[0].offsetWidth;
        const totalCards = cards.length;
        const visibleCards = 2;
        const maxIndex = totalCards - visibleCards;

        currentIndex += direction;

        // Kalau ke kanan dan sudah di akhir, kembali ke 0
        if (currentIndex > maxIndex) {
            currentIndex = 0;
        }

        // Kalau ke kiri, tetap dibatasi minimum 0
        if (currentIndex < 0) currentIndex = 0;

        track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
    }

    // Geser otomatis setiap 5 detik per 1 card ke kanan
    setInterval(() => {
        moveSlide(1);
    }, 5000);

    function openModal(imageSrc, title = "Hasil Evaluasi") {
        document.getElementById("modalImage").src = imageSrc;
        document.getElementById("modalTitle").innerText = title;
        document.getElementById("popupModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("popupModal").style.display = "none";
    }

    window.onclick = function(event) {
        const modal = document.getElementById("popupModal");
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }

</script>
@endpush
</body>
</html>
