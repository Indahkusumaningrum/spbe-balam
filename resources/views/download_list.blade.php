@section('navbar', true)
@extends('layouts.layout_user')
@section('title', 'Download')

<style>
    body { font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background-color: #fff; color: #333; }
    .main-container { width: 90%; max-width: 1200px; margin: 50px auto; background-color: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); }
    .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px; }
    .header-section h1 { color: #001e74; font-size: 32px; font-weight: 700; position: relative; padding-bottom: 12px; margin: 0; letter-spacing: 0.5px; }
    .header-section h1::after { content: ''; position: absolute; left: 50%; transform: translateX(-50%); bottom: 0; width: 60px; height: 5px; background: linear-gradient(to right, #facc15, #ff9a00); border-radius: 50px; box-shadow: 0 4px 10px rgba(250, 204, 21, 0.5); transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); }
    .header-section h1:hover::after { width: 100%; left: 0; transform: translateX(0); box-shadow: 0 6px 20px rgba(250, 204, 21, 0.7); }

    .data-table { width: 100%; border-collapse: separate; border-spacing: 0 10px; margin-top: 20px; }
    .data-table thead tr { background-color: #001e74; color: #ffffff; text-align: left; }
    .data-table th { padding: 15px 20px; font-weight: 600; font-size: 16px; text-transform: uppercase; letter-spacing: 0.5px; }
    .data-table thead tr th:first-child { border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
    .data-table thead tr th:last-child { border-top-right-radius: 8px; border-bottom-right-radius: 8px; }
    .data-table tbody tr { background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .data-table tbody tr:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); }
    .data-table td { padding: 15px 20px; border-bottom: none; vertical-align: middle; font-size: 15px; }
    .action-cell { display: flex; gap: 8px; justify-content: center; align-items: center; }
    .btn-view-doc { background-color: #3b82f6; display: inline-flex; align-items: center; gap: 8px; color: white; padding: 8px 12px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 12px; border: none; outline: none; transition: background-color 0.3s ease, transform 0.2s ease; }
    .btn-view-doc:hover { background-color: #2563eb; transform: translateY(-1px); }

    .filter-section { background-color: #fff; padding: 25px 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06); margin-bottom: 30px; display: flex; flex-wrap: wrap; gap: 20px; }
    .filter-section form { display: flex; flex-wrap: wrap; gap: 20px; width: 100%; align-items: flex-end; }
    .filter-group { flex: 1; width: 180px; display: flex; flex-direction: column; }
    .filter-group label { display: block; font-size: 14px; font-weight: 600; color: #555; margin-bottom: 8px; }
    .filter-section .form-control {
        width: 100%; padding: 10px 15px; border: 1px solid #d1d5db; border-radius: 8px; background-color: #f9fafb; font-size: 15px; color: #333;
        appearance: none; -webkit-appearance: none; -moz-appearance: none;
        background-repeat: no-repeat; background-position: right 12px top 50%; background-size: 12px auto; cursor: pointer; transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .filter-section .form-control:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25); outline: none; }
    .btn-filter-submit {
        background-color: #001e74; color: white; padding: 10px 25px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 15px;
        border: none; cursor: pointer; transition: background-color 0.3s ease, transform 0.2s ease; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); margin-top: 0;
    }
    .btn-filter-submit:hover { background-color: #00155a; transform: translateY(-1px); box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); }

    @media (max-width: 768px) {
        .main-container { width: 95%; padding: 25px; margin: 30px auto; }
        .header-section { flex-direction: row; justify-content: space-between; align-items: center; gap: 10px; }
        .header-section h1 { font-size: 24px; text-align: left; width: auto; }
        .header-section h1::after { left: 50%; transform: translateX(-50%); width: 60px; }
        .header-section h1:hover::after { width: 100%; left: 0; transform: translateX(0); }
        .data-table, .data-table thead, .data-table tbody, .data-table th, .data-table td, .data-table tr { display: block; }
        .data-table thead tr { position: absolute; top: -9999px; left: -9999px; }
        .data-table tbody tr { margin-bottom: 20px; border: 1px solid #e0e0e0; padding: 15px; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; }
        .data-table td { border: none; position: relative; padding-left: 50%; text-align: right; font-size: 14px; width: 100%; box-sizing: border-box; word-wrap: break-word; }
        .data-table td::before { content: attr(data-label); position: absolute; left: 10px; width: 45%; padding-right: 10px; white-space: nowrap; text-align: left; font-weight: 600; color: #4b5563; }
        .action-cell { width: 100%; justify-content: flex-end; margin-top: 10px; }

        .filter-section { padding: 20px; }
        .filter-section form { flex-direction: column; align-items: stretch; gap: 15px; }
        .filter-group { min-width: unset; width: 100%; }
        .btn-filter-submit { width: 100%; margin-top: 0; }
    }

    @media (max-width: 480px) {
        .main-container { padding: 20px 15px; margin: 20px auto; }
        .header-section { padding-left: 20px; padding-right: 20px;}
        .header-section h1 { font-size: 20px; padding-bottom: 8px; }
        .header-section h1::after { width: 50px; height: 4px; }
        .header-section h1:hover::after { width: 100%; }
        .data-table td { padding-left: 45%; font-size: 13px; }
        .data-table td::before { width: 40%; }
        .btn-view-doc { padding: 6px 10px; font-size: 11px; gap: 5px; }
    }
</style>

@section('content')

<div class="filter-section">
    <form method="GET" action="{{ route('admin.download') }}" class="flex flex-wrap gap-4 w-full items-end">

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

        <div class="filter-group" style="position: relative;">
            <label for="search-filter">Cari</label>
            <input
                type="text"
                name="search"
                id="search-filter"
                class="form-control"
                placeholder="Cari judul atau konten..."
                value="{{ request('search') }}" style="width: 95%">

            @if(request('search'))
            <span onclick="clearSearch()"
                style="position: absolute; right: 15px; top: 38px; cursor: pointer; font-size: 16px; color: #6b7280;">
                &times;
            </span>
            @endif
        </div>


        <button type="submit" class="btn-filter-submit"> <i class="fas fa-filter"></i> Filter </button>
    </form>
</div>


<div class="main-container">
    <div class="header-section">
        <h1>Download</h1>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 3%;">Tahun</th>
                <th style="width: 15%;">Kategori</th>
                <th style="width: 37%;">Judul</th>
                <th style="width: 23%;">Tentang</th>
                <th style="width: 12%;">File</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($downloads as $d)
                <tr>
                    <td data-label="Tahun">{{ $d->year }}</td>
                    <td data-label="Kategori">{{ $d->category }}</td>
                    <td data-label="Judul">{{ $d->content }}</td>
                    <td data-label="Tentang">{{ $d->title }}</td>
                    <td data-label="File">
                        <a href="{{ route('admin.download.file', $d->file_path) }}" target="_blank" class="btn-view-doc">
                            <i class="fas fa-file-alt"></i> Lihat Dokumen
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data unduhan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    function clearSearch() {
        const input = document.getElementById('search-filter');
        input.value = '';
        input.form.submit();
    }
</script>
@endsection
