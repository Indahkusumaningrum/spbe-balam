<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
            height: 80px;
        }

        .navbar .menu {
            display: flex;
            list-style: none;
            gap: 40px;
            margin: 0;
            padding: 0;
            font-size: 20px;
            margin-left: 50%;
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

        .banner-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            object-fit: cover;
            z-index: 0;
        }

        .spbe-banner .banner-slide.active {
            opacity: 1;
            z-index: 1;
        }

        .banner-text1 {
            position: absolute;
            top: 35%;
            right: 15%;
            /* transform: translate(-50%, -50%); */
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
            /* transform: translate(-50%, -50%); */
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
            padding: 12px 16px;
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
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-selengkapnya:hover {
            transform: scale(1.05);
        }

        .info-card {
            width: 230px;
            background-color: white;
            border: 1.5px solid #facc15;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
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
            height: 100px;
            width: 100px;
        }

        .spbe-aspek-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 50px 30px;
            background-color: #f9f9f9;
            flex-wrap: wrap;
            gap: 40px;
            margin-left: 30px;
        }

        .spbe-aspek-section h2 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #001e74;
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
            font-size: 40px;
            color: #facc15;
            min-width: 40px;
        }

        .aspek-item strong {
            font-size: 20px;
            color: #1e293b;
        }

        .aspek-item p {
            margin: 5px 0 0;
            font-size: 18px;
            color: #334155;
        }

        .aspek-right img {
            width: 100%;
            max-width: 700px;
            height: auto;
            display: block;
            margin-top: 100px;
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
            <li><a href="{{ route('kontak.user') }}" class="{{ request()->is('kontak') ? 'active' : '' }}">Kontak</a></li>
        </ul>
    </div>

@section('content')
    <div class="spbe-banner">
        <img class="banner-slide active" src="/asset/img/1.png" alt="Slide 1">
        <!-- Teks penjelasan untuk Banner 1 -->
        <div class="banner-text1" id="bannerText1">
            <h1>Selamat Datang</h1>
            <p>di Sistem Pemerintahan Berbasis Elektronik Kota Bandar Lampung</p>
        </div>

        <img class="banner-slide" src="/asset/img/2.png" alt="Slide 2">
        <!-- Teks penjelasan untuk Banner 2 -->
        <div class="banner-text" id="bannerText2">
            <h1>Regulasi</h1>
            <p>Pahami regulasi dalam penerapan Sistem Pemerintahan Berbasis Elektronik.</p>
            <a href="{{ route('tahapan_spbe') }}" class="btn-banner">Pelajari Selengkapnya</a>
        </div>

        <button class="slide-btn prev" onclick="prevSlide()">&#10094;</button>
        <button class="slide-btn next" onclick="nextSlide()">&#10095;</button>
    </div>

    <div class="spbe-info-section">
        <div class="info-card">
            <img src="{{ asset('asset/icon/regulasi.png') }}" alt="Regulasi" class="info-icon">
            <h3>Regulasi</h3>
            <p>SPBE akan menjadi platform untuk seluruh regulasi yang ada. Platform ini bermakna pada integrasi. Integrasi ini pada proses bisnis, mulai dari level mikro hingga makro.</p>
            <a href="#" class="btn-selengkapnya">Selengkapnya</a>
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
        <div class="info-card">
            <img src="{{ asset('asset/icon/evaluasi.png') }}" alt="Evaluasi" class="info-icon">
            <h3>Evaluasi</h3>
            <p>Hasil evaluasi untuk mengetahui Indeks SPBE sebagai acuan untuk tingkat kematangan penerapan SPBE baik dalam kapabilitas proses maupun kapabilitas fungsi teknis</p>
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


@endsection

@push('scripts')
<script>
  const slides = document.querySelectorAll('.banner-slide');
    const texts = [
        document.getElementById('bannerText1'),
        document.getElementById('bannerText2')
    ];
  let current = 0;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.remove('active');
      if (i === index) slide.classList.add('active');
    });


     texts.forEach((text, i) => {
        text.style.display = (i === index) ? 'block' : 'none';
    });
  }

  function nextSlide() {
    current = (current + 1) % slides.length;
    showSlide(current);
  }

  function prevSlide() {
    current = (current - 1 + slides.length) % slides.length;
    showSlide(current);
  }

// Tampilkan slide pertama
  showSlide(current);

  // Aktifkan autoplay jika diinginkan
  setInterval(nextSlide, 10000);
</script>
@endpush
</body>
</html>
