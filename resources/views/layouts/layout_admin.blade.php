<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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

        .manage-label {
            font-size: 16px;
            font-weight: 600;
            color: #FFC31D;
            margin-bottom: 6px;
        }

        .nav-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            padding: 10px 30px;
            border-bottom: 1px solid #ccc;
            list-style: none;
        }

        .nav-bar img {
            height: 70px;
        }

        .nav-menu {
            display: flex;
            gap: 50px;
            font-size: 18px;
            text-decoration: none;
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
            <div class="manage-label">Manage</div>
            <nav class="nav-menu">
                <li><a href="{{ route('admin.indikator.index') }}" class="{{ request()->is('admin/indikator*') ? 'active' : '' }}">Indikator SPBE</a></li>
                <li><a href="{{ route('profile') }}" class="{{ request()->is('admin/profile*') ? 'active' : '' }}">Profile</a></li>
                <li><a href="{{ route('admin.berita') }}" class="{{ request()->is('admin/berita*') ? 'active' : '' }}">Berita</a></li>
                <li><a href="{{ route('admin.download') }}" class="{{ request()->is('admin/download*') ? 'active' : '' }}">Download</a></li>
                <li><a href="{{ route('admin.galeri') }}" class="{{ request()->is('admin/galeri') ? 'active' : '' }}">Galeri</a></li>
                <li><a href="#" class="{{ request()->is('/') ? 'active' : '' }}">Kontak</a></li>
            </nav>
        </div>
    </div>



    @php use Illuminate\Support\Facades\Auth; @endphp

    <div class="logout-container">
        @if(Route::currentRouteName() === 'dashboardadmin')
            <div class="logout-container">
                @if(Auth::check())
                    <h2>Selamat datang, {{ Auth::user()->name }}</h2>
                @else
                    <h2>Anda belum login.</h2>
                @endif
            </div>
        @endif
    </div>

    @yield('content')

    <!-- Logout Confirmation Modal -->
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

      <script>
        function showLogoutModal() {
            document.getElementById('logoutModal').style.display = 'block';
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('logoutModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
