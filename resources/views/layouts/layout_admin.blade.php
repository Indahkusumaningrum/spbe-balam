<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @yield('styles')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff
        }

        header {
            background-color: #001e74;
            color: white;
            padding: 16px 30px;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-logout {
            background-color: #facc15;
            color: #001e74;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-logout:hover {
            background-color: #e0b814;
        }

        .nav-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            padding: 10px 30px;
            border-bottom: 1px solid #ccc;
            flex-wrap: wrap;
            position: relative;
        }

        .nav-menu-wrapper {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-left: 50px;
        }

        .nav-bar img {
            height: 70px;
        }

        .nav-toggle-container {
            justify-content: flex-end;
            margin-left: auto;
        }

        .nav-toggle {
            display: none;
            font-size: 28px;
            cursor: pointer;
            color: #001e74;
            background: none;
            border: none;
            margin-left: auto;
        }

        .nav-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex: 1;
            width: 100%;
        }

        .manage-label {
            font-size: 16px;
            font-weight: 600;
            color: #FFC31D;
            margin-bottom: 6px;
            padding-left: 10px;
        }

        .nav-menu {
            display: flex;
            gap: 50px;
            font-size: 18px;
            list-style: none;
            margin: 0;
            padding: 0;
            margin-right: 40px;
        }

        .nav-menu a {
            text-decoration: none;
            color: #001e74;
            font-weight: bold;
        }

        .nav-menu a.active {
            border-bottom: 4px solid #FFC31D;
            padding-bottom: 18px;
            color: #FFC31D;
            transition: width 0.3s ease;
        }

        .nav-menu li a {
            position: relative;
            color: #001e74;
            text-decoration: none;
            font-weight: bold;
            padding-bottom: 23px;
        }

        .nav-menu li a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 4px;
            width: 0;
            background-color: #FFC31D;
            transition: width 0.3s ease;
        }

        .nav-menu li a:hover::after {
            width: 100%;
        }

        .nav-menu li a:hover {
            color: #facc15;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 30px;
            border-radius: 12px;
            width: 400px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .modal-content p {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 20px;
            color: #333;
        }

        .modal-actions {
            display: flex;
            justify-content: space-around;
            gap: 10px;
        }

        .cancel-btn,
        .confirm-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 15px;
        }

        .cancel-btn {
            background-color: #ccc;
            color: #333;
        }

        .cancel-btn:hover {
            background-color: #bbb;
        }

        .confirm-btn {
            background-color: #dc3545;
            color: white;
        }

        .confirm-btn:hover {
            background-color: #c82333;
        }

        .nav-menu-wrapper {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            position: static;
        }

        .nav-close {
            display: none;
        }

        .logout-container{
            background-color: white;
            margin-left: 30px;
            padding: 30px 30px 0;
        }
        .welcome-message-wrapper {
            padding: 30px 20px;
            background-color: #f8f9fa;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
        }
        .welcome-heading {
            font-size: 32px;
            font-weight: 600;
            color: #001e74;
            margin: 0;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }

        .welcome-admin-name {
            color: #facc15;
            font-weight: 700; 
        }
        @media (max-width: 991px) {

            .nav-bar {
                justify-content: space-between;
                position: relative;
            }
            .nav-toggle {
                display: block;
                margin-left: auto;
                margin-right: 0;
            }

            .nav-menu-wrapper {
                display: none;
                flex-direction: column;
                position: fixed;
                top: 0;
                right: 0;
                width: 80%;
                max-width: 300px;
                height: 100%;
                background-color: #ffffff;
                box-shadow: -2px 0 8px rgba(0, 0, 0, 0.2);
                padding: 20px;
                z-index: 999;
                animation: slideIn 0.3s ease forwards;
            }

            .nav-menu-wrapper.active {
                display: flex;
            }

            .nav-menu {
                flex-direction: column;
                gap: 25px;
                margin-right: 0;
                padding-left: 0;
                margin: 0;
            }

            .nav-menu a.active {
                border-bottom: 4px solid #FFC31D;
                padding-bottom: 7px;
                color: #FFC31D;
                transition: width 0.3s ease;
            }

            .nav-menu li a {
                position: relative;
                color: #001e74;
                text-decoration: none;
                font-weight: bold;
                padding-bottom: 8px;
            }

            .manage-label {
                margin-bottom: 30px;
                font-size: 18px;
                font-weight: 600;
                color: #facc15;
            }

            .nav-close {
                display: block;
                align-self: flex-end;
                font-size: 24px;
                cursor: pointer;
                color: #001e74;
                margin-bottom: 20px;
                border: none;
                background: none;
                font-weight: bold;
            }

            @keyframes slideIn {
                from {
                    right: -100%;
                    opacity: 0;
                }
                to {
                    right: 0;
                    opacity: 1;
                }
            }
        }
        @media (max-width: 768px) {
            .welcome-heading {
                font-size: 26px; /* Reduce font size on medium-sized screens */
            }
        }

        @media (max-width: 480px) {
            .welcome-heading {
                font-size: 22px; /* Further reduce font size on small mobile screens */
            }
        }
    </style>
</head>
<body>

    <header>
        <div>Admin Dashboard</div>
        <button class="btn-logout" onclick="showLogoutModal()">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </header>

    <div class="nav-bar">
        <a href="{{ route('dashboardadmin') }}">
            <img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE" style="cursor:pointer;">
        </a>

        <div class="nav-container">
            <div class="nav-menu-wrapper" id="navMenu">
                <button class="nav-close" onclick="toggleNav()">✕</button>
                <div class="manage-label">Manage</div>
                <nav class="nav-menu">
                    <li><a href="{{ route('admin.indikator.index') }}" class="{{ request()->is('admin/indikator*') ? 'active' : '' }}">Indikator SPBE</a></li>
                    <li><a href="{{ route('profile') }}" class="{{ request()->is('admin/profile*') ? 'active' : '' }}">Profile</a></li>
                    <li><a href="{{ route('admin.berita') }}" class="{{ request()->is('admin/berita*') ? 'active' : '' }}">Berita</a></li>
                    <li><a href="{{ route('admin.download') }}" class="{{ request()->is('admin/download*') ? 'active' : '' }}">Download</a></li>
                    <li><a href="{{ route('admin.galeri') }}" class="{{ request()->is('admin/galeri') ? 'active' : '' }}">Galeri</a></li>
                    <li><a href="{{ route('admin.contact.index') }}" class="{{ request()->is('admin/kontak') ? 'active' : '' }}">Kontak</a></li>
                </nav>
            </div>
        </div>

        <button class="nav-toggle" onclick="toggleNav()">☰</button>

    </div>

    @php use Illuminate\Support\Facades\Auth; @endphp

    <div class="logout-container">
        @if(Route::currentRouteName() === 'dashboardadmin')
            <div class="welcome-massage">
                @if(Auth::check())
                    <h2 class="welcome-heading">Selamat datang, <span class="welcome-admin-name">{{ Auth::user()->name }}</span></h2>
                @else
                    <h2 class="welcome-heading">Anda belum login.</h2>
                @endif
            </div>
        @endif
    </div>

    @yield('content')

    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <p>Apakah Anda yakin ingin logout?</p>
            <div class="modal-actions">
                <button class="cancel-btn" onclick="closeLogoutModal()">Batal</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="confirm-btn">Ya, Logout</button>
                </form>
            </div>
        </div>
    </div>

    @yield('styles')

    <script>
        function toggleNav() {
            document.getElementById('navMenu').classList.toggle('active');
        }

        function showLogoutModal() {
            document.getElementById('logoutModal').style.display = 'block';
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }

        window.addEventListener('resize', function () {
            if (window.innerWidth > 991) {
                document.getElementById('navMenu').classList.remove('active');
            }
        });

        window.onclick = function(event) {
            const modal = document.getElementById('logoutModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

@yield('scripts')

</body>
</html>
