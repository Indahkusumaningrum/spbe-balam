<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Berita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
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

        .berita-container {
            padding: 40px 60px;
        }

        h1 {
            font-size: 24px;
            color: #001e74;
            margin-bottom: 30px;
            border-bottom: 4px solid #facc15;
            display: inline-block;
            padding-bottom: 4px;
        }

        .berita-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn-tambah {
            background-color: #facc15;
            color: #001e74;
            font-weight: bold;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-detail i {
            pointer-events: none;
        }

        .btn-detail:hover {
            opacity: 0.85;
        }

        .berita-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 40px;
        }

        .berita-card {
            width: calc((100% - 80px) / 3);
            background: white;
            border-radius: 14px;
            box-shadow: 5px 5px 20px rgba(0,0,0,0.2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .berita-img {
            height: 200px;
            background-color: #ccc;
            border-bottom: 1px solid #eee;
            border-top-left-radius: 14px;
            border-top-right-radius: 14px;
        }

        .berita-content {
            padding: 10px 20px 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .berita-content h3 {
            font-size: 16px;
            color: #001e74;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .berita-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .berita-info .tanggal {
            font-size: 15px;
            color: #facc15;
            font-weight: 600;
        }

        .btn-detail {
            background-color: #001e74;
            color: white;
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }

        .pagination {
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Manage Berita')
@section('content')

    <div class="berita-container">
        <div class="berita-header">
            <h1>Berita</h1>
            <div class="tambah">
                <a href="{{ route('admin.berita.create') }}" class="btn-add"><i class="fas fa-plus" style="font-size: 18px;"></i></a>
                <p class="p">Tambah Berita</p>
            </div>
        </div>
        <div class="berita-grid">
            @foreach($beritas as $berita)
            <div class="berita-card">
                <div class="berita-img">
                    @if($berita->gambar)
                    <img src="{{ asset('uploads/beritas/' . $berita->gambar) }}" style="width:100%; height:200px; object-fit:cover;">
                    @endif
                </div>
                <div class="berita-content">
                    <h3>{{ $berita->judul }}</h3>
                    <div class="berita-info">
                        <span class="tanggal">{{ $berita->updated_at->diffForHumans() }}</span>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.berita.show', $berita->id_berita) }}" class="btn-detail" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.berita.edit', $berita->id_berita) }}" class="btn-detail" style="background-color: #f59e0b;" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.berita.destroy', $berita->id_berita) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-detail" style="background-color: #dc2626;" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                                            </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
</body>
</html>
