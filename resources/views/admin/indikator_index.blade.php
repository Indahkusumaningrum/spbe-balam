<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Indikator</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .container {
            padding: 40px 40px;
            border-radius: 12px;
            max-width: 95%;
        }

        h1 {
            font-size: 26px;
            color: #001e74;
            margin-bottom: 30px;
            border-bottom: 3px solid #facc15;
            display: inline-block;
            padding-bottom: 6px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-bottom: 25px;
        }

        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-decoration: none;
            color: white;
        }

        .btn-success { background-color: #16a34a; }
        .btn-primary { background-color: #2563eb; }
        .btn-info    { background-color: #0ea5e9; }
        .btn-warning { background-color: #f59e0b; }
        .btn-danger  { background-color: #dc2626; }

        .btn:hover {
            transform: scale(1.05);
            opacity: 0.9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        table thead {
            background-color: #001e74;
            color: #fff;
        }

        table th, table td {
            padding: 12px 14px;
            border: 1px solid #e2e8f0;
            text-align: left;
            vertical-align: top;
        }

        table tbody tr:hover {
            background-color: #f1f5f9;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
            margin-right: 4px;
        }
    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Kelola Indikator')

@section('content')
<div class="container">
    <h1>Daftar Indikator SPBE</h1>

    <div class="button-group">
        <a href="{{ route('admin.indikator.create') }}" class="btn btn-success"><i class="fas fa-plus" style="margin-right: 6px;"></i> Tambah Indikator</a>
        <a href="{{ route('admin.domain_index') }}" class="btn btn-primary">Kelola Domain</a>
        <a href="{{ route('admin.aspect.index') }}" class="btn btn-info">Kelola Aspek</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Domain</th>
                <th>Aspek</th>
                <th>Indikator</th>
                <th>Penjelasan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($indikators as $i => $indikator)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $indikator->aspect->domain->name }}</td>
                <td>{{ $indikator->aspect->name }}</td>
                <td>{{ $indikator->name }}</td>
                <td>{{ $indikator->description }}</td>
                <td>
                    <a href="{{ route('admin.indikator.edit', $indikator->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.indikator.destroy', $indikator->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

</body>
</html>
