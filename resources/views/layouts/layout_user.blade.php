<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('asset/img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>SPBE - Pemerintah Kota Bandar Lampung</title>
    @yield('style')
    <style>
        body { margin: 0; font-family: 'Poppins', sans-serif; line-height: 1.6; }
        .spbe-navbar { background: white; display: flex; align-items: center; padding: 10px 30px; justify-content: space-between; box-shadow: 0 3px 10px rgba(0, 30, 116, 0.1); }
        .spbe-navbar img { height: 65px; }
        .spbe-navbar .menu { display: flex; list-style: none; gap: 40px; margin: 0; padding: 0; font-size: 17px; margin-right: 40px; font-weight: bold;}
        .spbe-navbar .menu li a { color: #001e74; text-decoration: none; font-weight: bold; position: relative; padding-bottom: 7px; transition: color 0.3s ease; }
        .spbe-navbar .menu li a::after { content: ''; position: absolute; left: 0; bottom: 0; height: 3px; width: 0%; background-color: #facc15; transition: width 0.3s ease; margin-top: 40px; }
        .spbe-navbar .menu li a:hover { color: #facc15; }
        .spbe-navbar .menu li a:hover::after { width: 100%; }
        .spbe-navbar .menu li a.active { color: #facc15; }
        .spbe-navbar .menu li a.active::after { width: 100%; }

        @media (max-width: 991.98px) {
            .spbe-navbar .menu { flex-direction: column; align-items: flex-start; gap: 20px; padding: 15px 0; margin-right: 0; }
            .spbe-navbar .menu li { width: 100%; }
            .spbe-navbar .menu li a { display: inline-block; width: auto; padding-bottom: 5px; }
            .spbe-navbar .menu li a::after { left: 0; right: 0; margin: 0 auto; }
        }

        .spbe-footer { background: linear-gradient(135deg, #071735 0%, #0a1f3b 100%); color: white; padding: 60px 40px 30px; margin-top: 80px; position: relative; width: 100%; }
        .spbe-footer::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: linear-gradient(90deg, #facc15, #ffd700); }
        .footer-container { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; max-width: 1200px; margin: 0 auto; }
        .footer-logo { height: 95px; margin-bottom: 20px; transition: transform 0.3s ease; }
        .footer-logo:hover { transform: scale(1.05); }
        .footer-column h4 { margin-bottom: 20px; color: #facc15; font-size: 18px; font-weight: 600; border-left: 4px solid #facc15; padding-left: 15px; }
        .footer-column p { font-size: 15px; line-height: 1.8; margin-bottom: 15px; color: #cbd5e1; }
        .contact-item { display: flex; align-items: flex-start; margin-bottom: 20px; transition: transform 0.3s ease; }
        .contact-item:hover { transform: translateX(5px); }
        .icon-circle { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #facc15, #ffd700); color: #001e74; margin-right: 15px; font-size: 16px; flex-shrink: 0; transition: transform 0.3s ease; }
        .contact-item:hover .icon-circle { transform: scale(1.1); }
        .footer-social { display: flex; gap: 15px; margin-top: 20px; }
        .footer-social a { display: flex; align-items: center; justify-content: center; width: 45px; height: 45px; border: 2px solid #facc15; border-radius: 50%; color: #facc15; font-size: 18px; text-decoration: none; transition: all 0.3s ease; margin-bottom: 30px; }
        .footer-social a:hover { background: #facc15; color: #001e74; transform: translateY(-3px); }
        .footer-bottom { text-align: center; padding-top: 30px; margin-top: 40px; border-top: 1px solid rgba(255, 255, 255, 0.2); }
        .footer-bottom p { color: #cbd5e1; font-size: 14px; margin: 0; }

    </style>
    @yield('style')
@stack('styles')
</head>
<body>
@hasSection('navbar')
    <nav class="navbar navbar-expand-lg spbe-navbar">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('dashboard_user') }}">
                <img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE" height="60">
            </a>

            <!-- Hamburger button -->
            <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" data-bs-target="#spbeNavbar" aria-controls="spbeNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars" style="color:#001e74"></i>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse justify-content-end" id="spbeNavbar">
                <ul class="navbar-nav menu">
                    <li class="nav-item"><a href="{{ route('indikator.show')}}" class="nav-link {{ request()->routeIs('indikator.*') ? 'active' : '' }}">Indikator SPBE</a></li>
                    <li class="nav-item"><a href="{{ route('profile.show') }}" class="nav-link {{ request()->routeIs('profile.show') ? 'active' : '' }}">Profile</a></li>
                    <li class="nav-item"><a href="{{ route('berita.index') }}" class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}">Berita</a></li>
                    <li class="nav-item"><a href="{{ route('download') }}" class="nav-link {{ request()->is('download') ? 'active' : '' }}">Download</a></li>
                    <li class="nav-item"><a href="{{ route('galeri.index') }}" class="nav-link {{ request()->is('galeri') ? 'active' : '' }}">Galeri</a></li>
                    <li class="nav-item"><a href="{{ route('kontak.user') }}" class="nav-link {{ request()->is('kontak') ? 'active' : '' }}">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

@endif

    <div class="container">
        @yield('content')
    </div>

    <footer class="spbe-footer" style="width: 100%;">
        <div class="container">
            <div class="row">

                <!-- Logo dan Deskripsi -->
                <div class="col-md-6 footer-column">
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
                <div class="col-md-6 footer-column">
                    <h4>Contact</h4>
                    <p><span class="icon-circle"><i class="fa-solid fa-phone"></i></span> (0721) 252041 </p>
                    <p><span class="icon-circle"><i class="fa-solid fa-envelope"></i></span> spbe@bandarlampung.go.id</p>
                    <p><span class="icon-circle"><i class="fa-solid fa-location-dot"></i></span> Jalan Dokter Susilo No.2, Sumur Batu, Teluk Betung Utara, Kota Bandar Lampung, Lampung 35212</p>
                </div>

            </div>

            <div class="footer-bottom">
                <p>© 2025. TIM KP Unila Diskominfo Kota Bandar Lampung. All Rights Reserved</p>
            </div>
        </div>
    </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</body>
</html>
