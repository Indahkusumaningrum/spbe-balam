<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Aspek</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .content {
            background-color: white;
            color: #1e293b;
            padding: 40px 60px;
        }

        h3 {
            font-size: 22px;
            color: #001e74;
            border-bottom: 3px solid #facc15;
            padding-bottom: 6px;
            display: inline-block;
            margin-bottom: 20px;
        }

        form {
            background-color: #ffffff;
            padding-left: 10px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            max-width: 60%;
            margin-bottom: 40px;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
            margin-top: 15px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        input:focus,
        select:focus {
            border-color: #001e74;
            outline: none;
        }

        button {
            background-color: #facc15;
            color: #1e293b;
            padding: 10px 22px;
            font-size: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #eab308;
        }

        ul {
            list-style-type: none;
            padding: 0;
            max-width: 60%;
        }

        ul li {
            background-color: #ffffff;
            padding: 12px 20px;
            margin-bottom: 10px;
            border-left: 6px solid #facc15;
            border-radius: 6px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.03);
        }

       .btn-kembali {
            margin-left: 30px;
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #ffffff;
            background-color: #001e74;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-kembali:hover {
            background-color: #002f9f;
        }
    </style>
</head>
<body>

@extends('layouts.layout_admin')
@section('title', 'Manajemen Aspek')

@section('content')
<div class="content">
    <h3>Tambah Aspek</h3>
    <form action="{{ route('admin.aspect.store') }}" method="POST">
        @csrf
        <label>Nama Aspek:</label>
        <input type="text" name="nama" required>

        <label>Pilih Domain:</label>
        <select name="domain_id" required>
            <option value="">-- Pilih Domain --</option>
            @foreach($domains as $domain)
                <option value="{{ $domain->id }}">{{ $domain->nama }}</option>
            @endforeach
        </select>

        <button type="submit">Simpan</button>
    </form>

    <hr>

    <h3>Daftar Aspek</h3>
    <ul>
        @foreach($aspects as $aspect)
            <li>{{ $aspect->nama }} (Domain: {{ $aspect->domain->nama }})</li>
        @endforeach
    </ul>

    <a href="{{ route('admin.indikator.index') }}" class="btn-kembali">Kembali</a>

</div>
@endsection

</body>
</html>
