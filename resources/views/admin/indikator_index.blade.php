@extends('layouts.layout_admin')
@section('title', 'Kelola Indikator')

@section('styles')
<style>
    /* General Body Styling (Consistent with your layout_admin) */
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f2f5; /* Light grey background for the whole page */
        color: #333;
    }

    /* Main Container Styling */
    .main-container {
        width: 90%;
        max-width: 1200px; /* Lebar maksimal untuk tabel */
        margin: 50px auto;
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    /* Page Title Styling */
    .main-container h1 {
        color: #001e74;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 30px;
        text-align: center;
        position: relative;
        padding-bottom: 10px;
    }

    .main-container h1::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        width: 100px; /* Lebar underline */
        height: 4px;
        background-color: #facc15;
        border-radius: 2px;
    }

    /* Alert Messages Styling */
    .alert {
        padding: 18px 25px;
        margin-bottom: 25px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 12px;
        line-height: 1.5;
        border: 1px solid; /* Add border for better separation */
    }

    .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border-color: #34d399;
    }

    .alert i {
        font-size: 20px;
    }

    /* Filter Form Styling */
    .filter-form {
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
        background-color: #f8f9fa; /* Light background for filter */
        padding: 15px 20px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
    }

    .filter-form label {
        font-weight: 600;
        color: #333;
        font-size: 16px;
    }

    .filter-form select {
        padding: 10px 15px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 16px;
        background-color: #fff;
        cursor: pointer;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .filter-form select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        outline: none;
    }

    /* Table Styling */
    .data-table {
        width: 100%;
        border-collapse: separate; /* Untuk border-radius di tbody */
        border-spacing: 0 10px; /* Spasi antar baris */
        margin-top: 20px;
    }

    .data-table thead tr {
        background-color: #001e74; /* Header biru gelap */
        color: #ffffff;
        text-align: left;
        border-radius: 8px; /* Sudut membulat pada header */
    }

    .data-table th {
        padding: 15px 20px;
        font-weight: 600;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .data-table tbody tr {
        background-color: #ffffff;
        border-radius: 8px; /* Sudut membulat pada baris */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); /* Shadow lembut pada baris */
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .data-table tbody tr:hover {
        transform: translateY(-3px); /* Efek 'angkat' saat hover */
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .data-table td {
        padding: 15px 20px;
        border-bottom: none; /* Hapus border default tabel */
        vertical-align: middle;
        font-size: 15px;
    }

    /* Specific border-radius for first and last cells of header */
    .data-table thead tr th:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }
    .data-table thead tr th:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    /* Center text for empty state */
    .data-table .text-center {
        text-align: center;
        padding: 30px !important; /* Penting untuk baris kosong */
        color: #6b7280;
        font-style: italic;
    }

    /* Action Button Styling */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 15px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        text-decoration: none;
        color: #fff; /* Default color for action buttons */
    }

    .btn-info {
        background-color: #3b82f6; /* Blue for 'Lihat Selengkapnya' */
    }

    .btn-info i{
        margin-right:10px;
    }

    .btn-info:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .main-container {
            width: 95%;
            padding: 25px;
            margin: 30px auto;
        }

        .main-container h1 {
            font-size: 24px;
            margin-bottom: 25px;
        }

        .filter-form {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .data-table, .data-table thead, .data-table tbody, .data-table th, .data-table td, .data-table tr {
            display: block; /* Membuat tabel stack di mobile */
        }

        .data-table thead tr {
            position: absolute;
            top: -9999px; /* Sembunyikan header asli */
            left: -9999px;
        }

        .data-table tbody tr {
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
            padding: 15px;
        }

        .data-table td {
            border: none;
            position: relative;
            padding-left: 50%; /* Ruang untuk label */
            text-align: right;
            font-size: 14px;
        }

        .data-table td::before {
            content: attr(data-label); /* Tampilkan label dari data-label */
            position: absolute;
            left: 10px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            text-align: left;
            font-weight: 600;
            color: #4b5563;
        }
    }
</style>
@endsection

@section('content')
<div class="main-container">
    <h1>Daftar Evaluasi SPBE Berdasarkan Tahun</h1>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('admin.indikator.index') }}" class="filter-form">
        <label for="tahun">Filter Tahun:</label>
        <select name="tahun" id="tahun" onchange="this.form.submit()">
            <option value="">-- Semua Tahun --</option>
            @foreach($tahunList as $t)
                <option value="{{ $t->tahun }}" {{ request('tahun') == $t->tahun ? 'selected' : '' }}>
                    {{ $t->tahun }}
                </option>
            @endforeach
        </select>
    </form>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Nama Form</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $filtered = $tahunTerpilih ? $tahunList->where('tahun', $tahunTerpilih) : $tahunList; @endphp

            @forelse($filtered as $i => $tahun)
            <tr>
                <td data-label="No">{{ $loop->iteration }}</td>
                <td data-label="Tahun">{{ $tahun->tahun }}</td>
                <td data-label="Nama Form">Evaluasi SPBE Tahun {{ $tahun->tahun }}</td>
                <td data-label="Aksi">
                    <a href="{{ route('admin.indikator.tahun', $tahun->id) }}" class="btn-action btn-info">
                        <i class="fas fa-eye"></i> Lihat Selengkapnya
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada data tahun.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection