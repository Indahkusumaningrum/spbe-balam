@extends('layouts.layout_user')
@section('navbar', true)

@section('content')
    <style>
        .filter-section {
            width: 95%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: end;
        }
        .filter-group {
            flex: 1;
            min-width: 180px;
        }
        .filter-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }
        .filter-section .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f9fafb;
            font-size: 15px;
            color: #333;
        }
        .filter-section .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
            outline: none;
        }
        .btn-filter-submit {
            background-color: #001e74;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-filter-submit:hover {
            background-color: #00155a;
            transform: translateY(-1px);
        }
        .table-container {
            padding: 24px;
        }
        .download-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        h1 {
            font-size: 20px;
            color: #001e74;
            margin: 30px 30px 10px;
            display: inline-block;
            padding-bottom: 4px;
        }
        table {
            width: 95%;
            border-collapse: collapse;
            background-color: white;
            margin: auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #001e74;
            color: white;
            font-size: 16px;
        }
        td {
            font-size: 15px;
        }
        tr:nth-child(even) {
            background-color: #eee;
        }
        .btn-download {
            background-color: #007bff;
            display: inline-block;
            color: white;
            padding: 6px 8px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            border: none;
            outline: none;
        }
        .btn-download:hover {
            transform: scale(1.03);
        }
    </style>

    <div class="filter-section">
        <form method="GET" action="{{ route('download') }}" class="flex flex-wrap w-full gap-4 items-end">
            <div class="filter-group">
                <label for="category-filter">Kategori</label>
                <select name="category" id="category-filter" class="form-control">
                    <option value="">-- Semua Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="year-filter">Tahun</label>
                <select name="year" id="year-filter" class="form-control">
                    <option value="">-- Semua Tahun --</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="search-filter">Cari</label>
                <input type="text" name="search" id="search-filter" class="form-control" placeholder="Cari judul atau konten..." value="{{ request('search') }}">
            </div>

            <div>
                <button type="submit" class="btn-filter-submit">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <div class="table-container">
        <div class="download-header">
            <h1>Daftar Dokumen yang dapat diunduh</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width: 8%;">Tahun</th>
                    <th style="width: 15%;">Kategori</th>
                    <th style="width: 42%;">Judul</th>
                    <th style="width: 23%;">Tentang</th>
                    <th style="width: 12%;">File</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($downloads as $d)
                    <tr>
                        <td>{{ $d->year }}</td>
                        <td>{{ $d->category }}</td>
                        <td>{{ $d->content }}</td>
                        <td>{{ $d->title }}</td>
                        <td>
                            <a href="{{ route('admin.download.file', $d->file_path) }}" class="btn-download">
                                Download
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
