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

        .spbe-banner {
            position: relative;
            width: 100%;
            height: 400px;
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
            background-color: #FFC31D;
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

    </style>
</head>
<body>
@extends('layouts.layout_user')
@section('content')
    <div class="spbe-banner">
        <img class="banner-slide active" src="/asset/img/BANNER-WEB-SPBE.png" alt="Slide 1">
        <img class="banner-slide" src="/asset/img/BANNER2.png" alt="Slide 2">
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

@endsection

@push('scripts')
<script>
  const slides = document.querySelectorAll('.banner-slide');
  let current = 0;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.remove('active');
      if (i === index) slide.classList.add('active');
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
  setInterval(nextSlide, 6000);
</script>
@endpush
</body>
</html>
