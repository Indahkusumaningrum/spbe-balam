<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Download</title>
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
            padding: 16px 24px;
            font-size: 20px;
            font-weight: bold;
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
            height: 80px;
        }

        .nav-menu {
            display: flex;
            gap: 50px;
            font-size: 20px;
            text-decoration: none;
        }

        .nav-menu a {
            text-decoration: none;
            color: #001e74;
            font-weight: bold;

        }

        .nav-menu a.active {
            border-bottom: 5px solid #FFC31D;
            padding-bottom: 20px;
            color: #FFC31D;
            transition: width 0.3s ease;
        }

        .nav-menu li a {
            position: relative;
            color: #001e74;
            text-decoration: none;
            font-weight: bold;
            padding-bottom: 24px;
        }

        .nav-menu li a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 5px;
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

        .container {
            padding: 24px;
        }

        .tambah {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .btn-add {
            background-color: #facc15;
            color: white;
            padding: 7px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-right: 7px;
        }

        .p {
            font-size: 18px;
            font-weight: bold;
            color: #001e74
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #001e74;
            color: white;
            font-size: 18px;
        }

        tr:nth-child(even) {
            background-color: #eee;
        }

        .action-btn {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .action-btn form {
            display: inline;
        }

        .btn-download {
            background-color: #007bff;
            display: inline-block;
            color: white;
            padding: 8px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            border: none;
            outline: none;
        }

        .btn-download:hover {
            transform: scale(1.05);
        }

        .btn-edit, .btn-delete {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px 7px;
        }

        .btn-edit i {
            color: #007bff;
            font-size: 20px;
        }

        .btn-delete i {
            color: #dc3545;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <header>Admin</header>

    <div class="nav-bar">
        <a href="{{ route('dashboard.admin') }}">
            <img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE" style="cursor:pointer;">
        </a>
        <div class="nav-container">
            <div class="manage-label">Manage</div>
            <nav class="nav-menu">
                <li><a href="#">Indikator SPBE</a></li>
                <li><a href="{{ route('admin.profile.edit') }}">Profile</a></li>
                <li><a href="#">Berita</a></li>
                <li><a href="{{ route('admin.download') }}">Download</a></li>
                <li><a href="#">Galeri</a></li>
                <li><a href="#">Kontak</a></li>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="tambah">
            <a href="{{ route('download.create') }}" class="btn-add"><i class="fas fa-plus" style="font-size: 18px;"></i></a>
            <p class="p">Tambah File</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width: 15%;">Category</th>
                    <th style="width: 23%;">Title</th>
                    <th style="width: 40%;">Content</th>
                    <th style="width: 12%;">File</th>
                    <th style="width: 10%;">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($downloads as $d) --}}
                    <tr>
                        {{-- <td>{{ $d->category }}</td>
                        <td>{{ $d->title }}</td>
                        <td>{{ $d->content }}</td> --}}
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button class="btn-download">Download</button></td>
                        <td class="action-btn">
                            <a href=# class="btn-edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action=# method="POST">
                                @csrf @method('DELETE')
                                <button class="btn-delete" onclick="return confirm('Hapus file ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        {{-- <td>{{ $d->category }}</td>
                        <td>{{ $d->title }}</td>
                        <td>{{ $d->content }}</td> --}}
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button class="btn-download">Download</button></td>
                        <td class="action-btn">
                            <a href=# class="btn-edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action=# method="POST">
                                @csrf @method('DELETE')
                                <button class="btn-delete" onclick="return confirm('Hapus file ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        {{-- <td>{{ $d->category }}</td>
                        <td>{{ $d->title }}</td>
                        <td>{{ $d->content }}</td> --}}
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button class="btn-download">Download</button></td>
                        <td class="action-btn">
                            <a href=# class="btn-edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action=# method="POST">
                                @csrf @method('DELETE')
                                <button class="btn-delete" onclick="return confirm('Hapus file ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        {{-- <td>{{ $d->category }}</td>
                        <td>{{ $d->title }}</td>
                        <td>{{ $d->content }}</td> --}}
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button class="btn-download">Download</button></td>
                        <td class="action-btn">
                            <a href=# class="btn-edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action=# method="POST">
                                @csrf @method('DELETE')
                                <button class="btn-delete" onclick="return confirm('Hapus file ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
</body>
</html>
