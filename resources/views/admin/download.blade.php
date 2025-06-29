<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Download</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .table-container {
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
@extends('layouts.layout_admin')
@section('title', 'Manage Download')
@section('content')

    <div class="nav-bar">
        <a href="{{ route('dashboardadmin') }}">
            <img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE" style="cursor:pointer;">
        </a>
        <div class="nav-container">
            <div class="manage-label">Manage</div>
            <nav class="nav-menu">
                <li><a href="#">Indikator SPBE</a></li>
                <li><a href="{{ route('profile') }}">Profile</a></li>
                <li><a href="{{ route('admin.berita') }}">Berita</a></li>
                <li><a href="{{ route('download') }}" class="active">Download</a></li>
                <li><a href="#">Galeri</a></li>
                <li><a href="#">Kontak</a></li>
            </nav>
        </div>
    </div>

    <div class="table-container">
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
                            <a href="{{ route('download.edit') }}" class="btn-edit">
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
                            <a href="{{ route('download.edit') }}" class="btn-edit">
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
                            <a href="{{ route('download.edit') }}" class="btn-edit">
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
                            <a href="{{ route('download.edit') }}" class="btn-edit">
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
@endsection
</body>
</html>
