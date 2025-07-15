<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Berita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .berita-container {
            padding: 40px 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .berita-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        h1 {
            font-size: 28px;
            color: #001e74;
            margin-bottom: 0;
            border-bottom: 4px solid #facc15;
            display: inline-block;
            padding-bottom: 4px;
        }

        .tambah {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-add {
            background-color: #facc15;
            color: #001e74;
            font-weight: bold;
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-add:hover {
            background-color: #e5b80b;
            transform: translateY(-1px);
        }

        .btn-add i {
            font-size: 18px;
            color: #001e74;
        }

        .p {
            font-size: 17px;
            font-weight: bold;
            color: #001e74;
            margin: 0;
        }

        .berita-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            justify-content: center;
        }

        .berita-card {
            background: white;
            border-radius: 14px;
            box-shadow: 5px 5px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .berita-card:hover {
            transform: translateY(-5px);
            box-shadow: 5px 5px 25px rgba(0,0,0,0.15);
        }

        .berita-img {
            height: 200px;
            overflow: hidden;
            border-top-left-radius: 14px;
            border-top-right-radius: 14px;
        }

        .berita-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .berita-content {
            padding: 15px 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .berita-content h3 {
            font-size: 18px;
            color: #001e74;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .berita-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .berita-info .tanggal {
            font-size: 14px;
            color: #6b7280;
            font-weight: 500;
        }

        .btn-action-group {
            display: flex;
            gap: 6px;
        }

        .btn-detail {
            background-color: #001e74;
            color: white;
            font-size: 14px;
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-detail i {
            pointer-events: none;
            font-size: 14px;
        }

        .btn-detail:hover {
            background-color: #00165a;
            transform: translateY(-1px);
        }

        .btn-edit {
            background-color: #f59e0b;
        }

        .btn-edit:hover {
            background-color: #d97706;
        }

        .btn-delete {
            background-color: #dc2626;
        }

        .btn-delete:hover {
            background-color: #b91c1c;
        }

        /* Load More Button Styling */
        .load-more-container {
            text-align: center;
            margin-top: 40px;
        }

        .btn-load-more {
            background-color: #001e74;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-load-more:hover {
            background-color: #00165a;
            transform: translateY(-2px);
        }

        /* --- Responsive Adjustments --- */

        /* Tablet (768px - 1024px) */
        @media (max-width: 1024px) {
            .berita-container {
                padding: 30px 40px;
            }

            .berita-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 25px;
            }

            h1 {
                font-size: 26px;
            }
        }

        /* Smartphone (di bawah 768px) */
        @media (max-width: 767px) {
            .berita-container {
                padding: 20px;
            }

            .berita-header {
                flex-direction: column;
                align-items: flex-start;
                margin-bottom: 20px;
            }

            h1 {
                font-size: 24px;
                margin-bottom: 15px;
            }

            .tambah {
                width: 100%;
                justify-content: flex-start;
            }

            .btn-add {
                padding: 10px 15px;
                font-size: 15px;
            }

            .p {
                font-size: 16px;
            }

            .berita-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .berita-card {
                width: 100%;
            }

            .berita-img {
                height: 180px;
            }

            .berita-content h3 {
                font-size: 17px;
            }
        }

        /* Very Small Smartphone (di bawah 480px) */
        @media (max-width: 480px) {
            .berita-container {
                padding: 15px;
            }
            h1 {
                font-size: 22px;
            }
            .btn-add {
                padding: 8px 12px;
                font-size: 14px;
            }
            .p {
                font-size: 15px;
            }
            .berita-img {
                height: 160px;
            }
            .berita-content h3 {
                font-size: 16px;
            }
            .btn-detail {
                width: 30px;
                height: 30px;
                font-size: 13px;
            }
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
                {{-- Menggabungkan teks ke dalam tombol --}}
                <a href="{{ route('admin.berita.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah Berita
                </a>
            </div>
        </div>
        <div class="berita-grid" id="beritaGrid">
            {{-- Berita awal akan dimuat di sini oleh PHP --}}
            @foreach($beritas as $berita)
            <div class="berita-card">
                <div class="berita-img">
                    @if($berita->gambar)
                    <img src="{{ asset('uploads/beritas/' . $berita->gambar) }}" alt="Gambar Berita">
                    @endif
                </div>
                <div class="berita-content">
                    <h3>{{ $berita->judul }}</h3>
                    <div class="berita-info">
                        <span class="tanggal">{{ $berita->updated_at->diffForHumans() }}</span>
                        <div class="btn-action-group">
                            <a href="{{ route('admin.berita.show', $berita->id_berita) }}" class="btn-detail" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.berita.edit', $berita->id_berita) }}" class="btn-detail btn-edit" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.berita.destroy', $berita->id_berita) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-detail btn-delete" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Load More Button --}}
        @if($totalBeritaCount > $initialLimit)
        <div class="load-more-container">
            <button id="loadMoreBtn" class="btn-load-more">Lihat Selengkapnya</button>
        </div>
        @endif
    </div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let offset = {{ $beritas->count() }}; // Mulai offset dari jumlah berita yang sudah dimuat
        const initialLimit = {{ $initialLimit }}; // Batas awal yang digunakan PHP
        const totalBeritaCount = {{ $totalBeritaCount }}; // Total semua berita

        $('#loadMoreBtn').on('click', function() {
            let limit = 6; // Jumlah berita yang dimuat setiap kali klik

            // Sesuaikan limit berdasarkan device jika diperlukan,
            // namun karena kita memuat 6 per klik, ini mungkin tidak perlu diubah per device
            // Kecuali Anda ingin memuat lebih sedikit/banyak per klik berdasarkan device
            // if ($(window).width() < 768) { // Contoh deteksi mobile
            //     limit = 4;
            // }

            $.ajax({
                url: '{{ route('admin.berita.load-more') }}',
                type: 'GET',
                data: {
                    offset: offset,
                    limit: limit // Kirim limit ke backend
                },
                beforeSend: function() {
                    $('#loadMoreBtn').text('Memuat...').prop('disabled', true);
                },
                success: function(response) {
                    $('#beritaGrid').append(response.html); // Tambahkan HTML baru ke grid
                    offset += limit; // Perbarui offset

                    if (!response.hasMore) {
                        $('#loadMoreBtn').hide(); // Sembunyikan tombol jika tidak ada lagi berita
                    } else {
                        $('#loadMoreBtn').text('Lihat Selengkapnya').prop('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error loading more berita:", error);
                    $('#loadMoreBtn').text('Gagal Memuat').prop('disabled', false);
                    // Opsional: tampilkan pesan error ke user
                }
            });
        });
    });
</script>
@endsection
</body>
</html>
