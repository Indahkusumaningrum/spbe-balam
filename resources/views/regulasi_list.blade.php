<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regulasi Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .regulasi-container {
            max-width: 95%;
            margin: 40px auto;
            font-family: 'Poppins', sans-serif;
            padding: 0 20px;
        }

        .regulasi-container h1 {
            font-size: 28px;
            color: #001e74;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .regulasi-kategori {
            margin-bottom: 30px;
        }

        .regulasi-kategori h3 {
            font-size: 16px;
            font-weight: 700;
            color: #001e74;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .regulasi-kategori ul {
            list-style: none;
            padding-left: 0;
        }

        .regulasi-kategori li {
            font-size: 15px;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .download-link {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
            margin-left: 8px;
        }

        .download-link:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
@extends('layouts.layout_user')
@section('navbar', true)
@section('content')

<div class="regulasi-container">
    <h1>Regulasi SPBE</h1>

    @foreach ($regulations as $kategori => $items)
        <div class="regulasi-kategori">
            <h3>{{ strtoupper($kategori) }}</h3>
            <ul>
                @foreach ($items as $item)
                    <li>
                        {{ $item->judul }}
                        <a href="{{ route('admin.regulasi.file', $item->file_path) }}" class="download-link">[DOWNLOAD]</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach

@endsection

</body>
</html>


