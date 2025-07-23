@extends('layouts.layout_admin')
@section('title', 'Kelola Indikator')

@section('styles')
<style>
    body { font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background-color: #fff; color: #333; }
    .main-container { width: 95%; max-width: 1200px; margin: 0px auto; background-color: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); box-sizing: border-box; }
    .main-container h1 { color: #001e74; font-size: 28px; font-weight: 700; margin-bottom: 30px; text-align: center; position: relative; padding-bottom: 10px; }

    .alert { padding: 18px 25px; margin-bottom: 25px; border-radius: 8px; font-size: 15px; font-weight: 500; display: flex; align-items: center; gap: 12px; line-height: 1.5; border: 1px solid; }
    .alert-success { background-color: #d1fae5; color: #065f46; border-color: #34d399; }
    .alert i { font-size: 20px; }

    .filter-form { margin-bottom: 30px; display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 15px; background-color: #f8f9fa; padding: 15px 20px; border-radius: 8px; border: 1px solid #e0e0e0; }
    .filter-form label { font-weight: 600; color: #333; font-size: 16px; }
    .filter-form select { width: auto; padding: 10px 15px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 16px; background-color: #fff; cursor: pointer; transition: border-color 0.3s ease, box-shadow 0.3s ease; }
    .filter-form select:focus { border-color: #facc15; outline: none; }

    .data-table { width: 100%; border-collapse: separate; border-spacing: 0 10px; margin-top: 20px; }
    .data-table thead tr { background-color: #001e74; color: #ffffff; text-align: left; border-radius: 8px; }
    .data-table th { padding: 15px 20px; font-weight: 600; font-size: 16px; text-transform: uppercase; letter-spacing: 0.5px; }
    .data-table tbody tr { background-color: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .data-table tbody tr:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); }
    .data-table td { padding: 15px 20px; border-bottom: none; vertical-align: middle; font-size: 15px; }
    .data-table thead tr th:first-child { border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
    .data-table thead tr th:last-child { border-top-right-radius: 8px; border-bottom-right-radius: 8px; }
    .data-table .text-center { text-align: center; padding: 30px !important; color: #6b7280; font-style: italic; }

    .btn-action {
        display: inline-flex; align-items: center; justify-content: center; padding: 8px 15px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600;
        cursor: pointer; transition: background-color 0.3s ease, transform 0.2s ease; text-decoration: none; color: #fff;
    }
    .btn-info { background-color: #3b82f6; }
    .btn-info i { margin-right: 10px; }
    .btn-info:hover { background-color: #2563eb; transform: translateY(-1px); }

    @media (max-width: 768px) {
        .main-container { width: 95%; padding: 25px; margin: 30px auto; }
        .main-container h1 { font-size: 24px; margin-bottom: 25px; }
        .filter-form { flex-direction: column; align-items: stretch; padding: 15px; }
        .filter-form select { width: 100%; }

        .data-table, .data-table thead, .data-table tbody, .data-table th, .data-table td, .data-table tr { display: block; }
        .data-table thead { border: none; clip: rect(0 0 0 0); height: 1px; margin: -1px; overflow: hidden; padding: 0; position: absolute; width: 1px; }
        .data-table tbody tr { margin-bottom: 15px; border: 1px solid #ddd; display: block; padding: 10px; }
        .data-table td { border-bottom: 1px solid #eee; display: block; text-align: right; font-size: 14px; padding-left: 50%; position: relative; }
        .data-table td::before { content: attr(data-label); position: absolute; left: 10px; width: 45%; padding-right: 10px; white-space: nowrap; text-align: left; font-weight: 600; color: #4b5563; }
        .data-table td:last-child { border-bottom: 0; } 
        .data-table .text-center { padding: 15px !important; } 
    }

    @media (max-width: 480px) {
        .main-container { width: 95%; padding: 20px; margin: 0px auto; }
        .main-container h1 { font-size: 22px; margin-bottom: 20px; }
        .filter-form { gap: 10px; padding: 10px; }
        .filter-form label { font-size: 15px; }
        .filter-form select { padding: 8px 12px; font-size: 15px; }
        .data-table td { font-size: 13px; padding-left: 40%; }
        .data-table td::before { width: 35%; font-size: 13px; }
        .btn-action { padding: 6px 12px; font-size: 13px; }
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