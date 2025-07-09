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

        .spbe-navbar {
            background-color: #091e46;
            display: flex;
            align-items: center;
            padding: 10px 30px;
            color: white;
            justify-content: space-between;
        }

        .spbe-navbar img {
            height: 65px;
        }

        .spbe-navbar .menu {
            display: flex;
            list-style: none;
            gap: 40px;
            margin: 0;
            padding: 0;
            font-size: 17px;
            margin-right: 40px;
        }

        .spbe-navbar .menu li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding-bottom: 7px;
            transition: color 0.3s ease;
        }

        .spbe-navbar .menu li a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 2px;
            width: 0%;
            background-color: #facc15;
            transition: width 0.3s ease;
            margin-top: 40px;
        }

        .spbe-navbar .menu li a:hover {
            color: #facc15;
        }

        .spbe-navbar .menu li a:hover::after {
            width: 100%;
        }

        .spbe-navbar .menu li a.active {
            color: #facc15;
        }

        .spbe-navbar .menu li a.active::after {
            width: 100%;
        }

        .spbe-footer {
            background-color: #071735;
            color: white;
            padding: 40px 20px;
            font-family: 'Poppins', sans-serif;
            margin-top: 50px;
        }

        .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-column {
            flex: 1;
            min-width: 250px;
        }

        .footer-logo {
            height: 100px;
            margin-bottom: 10px;
        }

        .icon-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid white;
            color: white;
            background-color: transparent;
            margin-right: 0;
            font-size: 14px;
        }

        .footer-column p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .footer-column h4 {
            margin-bottom: 12px;
            color: #fff;
            font-size: 16px;
            border-left: 4px solid #facc15;
            padding-left: 10px;
        }

        .footer-social a {
            margin-right: 10px;
            color: white;
            font-size: 20px;
            text-decoration: none;
        }

        .footer-column i {
            color: white;
        }

        .icon-circle i {
            font-size: 17px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            margin-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.5);
        }

        .footer-bottom p {
            color: white;
            font-size: 16px;
            margin-top: 12px;
            font-weight: 500;
        }
    </style>
@stack('styles')
</head>
<body>
@hasSection('navbar')
    <div class="spbe-navbar">
        <a href="{{ route('dashboard_user') }}" class="logo-img">
            <img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE" style="cursor:pointer;">
        </a>
        <ul class="menu">
            <li><a href="{{ route('indikator.public') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Indikator SPBE</a></li>
            <li><a href="{{ route('profile.show') }}" class="{{ request()->routeIs('profile.show') ? 'active' : '' }}">Profile</a></li>
            <li><a href="{{ route('berita.index') }}" class="{{ request()->routeIs('berita.*') ? 'active' : '' }}">Berita</a></li>
            <li><a href="{{ route('download')}}" class="{{ request()->is('download') ? 'active' : '' }}">Download</a></li>
            <li><a href="{{ route('galeri.index') }}" class="{{ request()->is('galeri') ? 'active' : '' }}">Galeri</a></li>
            <li><a href="#" class="{{ request()->is('kontak') ? 'active' : '' }}">Kontak</a></li>
        </ul>
    </div>
@endif

    <div class="container">
        @yield('content')
    </div>

    <footer class="spbe-footer">
        <div class="footer-container">

            <!-- Logo dan Deskripsi -->
            <div class="footer-column">
            <img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE" class="footer-logo">
            <p>Merupakan media atau wadah informasi sekaligus pengelolaan data indikator SPBE di lingkungan Pemerintah Kota Lampung</p>
            <div class="footer-social">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
            </div>

            <!-- Kontak -->
            <div class="footer-column">
                <h4>Contact</h4>
                <p><span class="icon-circle"><i class="fa-solid fa-phone"></i></span> (0721) 252041 </p>
                <p><span class="icon-circle"><i class="fa-solid fa-envelope"></i></span> spbe@bandarlampung.go.id</p>
                <p><span class="icon-circle"><i class="fa-solid fa-location-dot"></i></span> Jalan Dokter Susilo No.2, Sumur Batu, Teluk Betung Utara, Kota Bandar Lampung, Lampung 35212</p>
            </div>
        </div>
         <div class="footer-bottom">
            <p>© 2025. TIM KP Unila Diskominfo Kota Bandar Lampung. All Rights Reserved</p>
        </div>
    </footer>

@stack('scripts')
</body>
</html>
