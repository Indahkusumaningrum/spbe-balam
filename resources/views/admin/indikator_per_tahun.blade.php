@extends('layouts.layout_admin')
@section('title', "Indikator")

@section('styles')
<style>
    body { font-family: 'Poppins', sans-serif; background-color: #fff; color: #333; }
    .main-container { width: 100%; max-width: 1200px; margin: 0 auto; background-color: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); box-sizing: border-box; }
    .main-container h1 { color: #001e74; font-size: 28px; font-weight: 700; margin-bottom: 30px; text-align: center; position: relative; padding-bottom: 10px; }

    .action-buttons-group { display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 30px; justify-content: flex-start; }
    .btn-action {
        display: inline-flex; align-items: center; justify-content: center; padding: 10px 20px; border: none; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease; text-decoration: none; color: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .btn-action i { margin-right: 8px; }
    .btn-action:hover { transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.15); }
    .btn-success { background-color: #22c55e; }
    .btn-success:hover { background-color: #16a34a; }
    .btn-primary { background-color: #3b82f6; }
    .btn-primary:hover { background-color: #2563eb; }
    .btn-secondary { background-color: #6b7280; ; }
    .btn-secondary:hover { background-color: #4b5563; }
    .btn-info { background-color: #0ea5e9; }
    .btn-info:hover { background-color: #0284c7; }
    .btn-warning { background-color: #facc15; color: #fff;  width: 65px;}
    .btn-warning:hover { background-color: #eab308; }
    .btn-danger { background-color: red; }
    .btn-danger:hover { background-color: darkred; }

    .filter-form-group { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); align-items: flex-end; }
    .filter-item { flex: 1; min-width: 150px; }
    .filter-item label { font-weight: 600; display: block; margin-bottom: 8px; color: #333; font-size: 15px; }
    .filter-item select, .filter-item input[type="text"] { width: 100%; padding: 10px 15px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px; background-color: #fff; cursor: pointer; transition: border-color 0.3s ease, box-shadow 0.3s ease; }
    .filter-item select:focus, .filter-item input[type="text"]:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25); outline: none; }
    .filter-buttons { display: flex; gap: 10px; }

    .data-table { width: 100%; border-collapse: separate; border-spacing: 0 10px; margin-top: 20px; }
    .data-table thead tr { background-color: #001e74; color: #ffffff; text-align: left; border-radius: 8px; }
    .data-table th { padding: 15px 20px; font-weight: 600; font-size: 16px; text-transform: uppercase; letter-spacing: 0.5px; }
    .data-table tbody tr { background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .data-table tbody tr:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); }
    .data-table td { padding: 15px 20px; border-bottom: none; vertical-align: middle; font-size: 15px; }
    .data-table thead tr th:first-child { border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
    .data-table thead tr th:last-child { border-top-right-radius: 8px; border-bottom-right-radius: 8px; }

    .data-table .action-cell { display: flex; gap: 8px; flex-wrap: wrap; }
    .data-table .text-center { text-align: center; padding: 30px !important; color: #6b7280; font-style: italic; }

    .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; }
    .modal-content { background-color: #fff; margin: auto; padding: 30px; border-radius: 12px; width: 90%; max-width: 450px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.3); animation: fadeIn 0.3s ease-out; }
    .modal-content p { font-size: 18px; font-weight: 500; margin-bottom: 25px; color: #333; }
    .modal-actions { display: flex; justify-content: center; gap: 15px; }
    .modal-btn { padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 15px; transition: background-color 0.3s ease; }
    .modal-btn.cancel-btn { background-color: #ccc; color: #333; }
    .modal-btn.cancel-btn:hover { background-color: #bbb; }
    .modal-btn.confirm-btn { background-color: #dc3545; color: white; }
    .modal-btn.confirm-btn:hover { background-color: #c82333; }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }

    @media (max-width: 768px) {
        .main-container { width: 95%; padding: 25px; margin: 30px auto; }
        .main-container h1 { font-size: 24px; margin-bottom: 25px; }
        .action-buttons-group { flex-direction: column; gap: 10px; align-items: center; } 
        .btn-action { width: 100%; }

        .filter-form-group { flex-direction: column; align-items: stretch; } 
        .filter-item { min-width: unset; width: 100%; } 
        .filter-buttons { flex-direction: column; gap: 10px; width: 100%; } 
        .filter-buttons .btn-action { width: 100%; } 

        .data-table, .data-table thead, .data-table tbody, .data-table th, .data-table td, .data-table tr { display: block; }
        .data-table thead tr { position: absolute; top: -9999px; left: -9999px; }
        .data-table tbody tr { margin-bottom: 20px; border: 1px solid #e0e0e0; padding: 15px; }
        .data-table td { border: none; position: relative; padding-left: 50%; text-align: right; font-size: 14px; }
        .data-table td::before { content: attr(data-label); position: absolute; left: 10px; width: 45%; padding-right: 10px; white-space: nowrap; text-align: left; font-weight: 600; color: #4b5563; }
        .data-table .action-cell { justify-content: flex-end; margin-top: 10px; }
    }
    @media (max-width: 480px) {
        .main-container { width: 95%; padding: 25px; }
        .main-container h1 { font-size: 24px; margin-bottom: 25px; }
        .action-buttons-group { align-items: center; } 
        .btn-action { width: 90%; } 
        .data-table td { font-size: 13px; padding-left: 45%; } 
        .data-table td::before { width: 40%; }
        .btn-warning { width: 100px;}
    }
</style>
@endsection

@section('content')
<div class="main-container">
    <h1>Daftar Indikator SPBE Tahun {{ $tahun->tahun }}</h1>

    <div class="action-buttons-group">
        <a href="{{ route('admin.indikator.create', $tahun->id) }}" class="btn-action btn-success">
            <i class="fas fa-plus-circle"></i> Tambah Indikator
        </a>
        <a href="{{ route('admin.domain_index') }}" class="btn-action btn-primary">
            <i class="fas fa-sitemap"></i> Kelola Domain
        </a>
        <a href="{{ route('admin.aspect.index') }}" class="btn-action btn-info">
            <i class="fas fa-layer-group"></i> Kelola Aspek
        </a>
        <a href="{{ route('admin.indikator.index') }}" class="btn-action btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Tahun
        </a>
    </div>

    <form method="GET" action="{{ route('admin.indikator.tahun', $tahun->id) }}" class="filter-form-group">
        <div class="filter-item">
            <label for="filter_domain">Filter Domain:</label>
            <select name="filter_domain" id="filter_domain" class="form-control">
                <option value="">-- Semua Domain --</option>
                @foreach($domains as $domain)
                    <option value="{{ $domain->id }}" {{ request('filter_domain') == $domain->id ? 'selected' : '' }}>
                        {{ $domain->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-item">
            <label for="filter_aspect">Filter Aspek:</label>
            <select name="filter_aspect" id="filter_aspect" class="form-control">
                <option value="">-- Semua Aspek --</option>
            </select>
        </div>

        <div class="filter-item">
            <label for="search_indikator">Cari Indikator:</label>
            <input type="text" name="search_indikator" id="search_indikator" class="form-control" placeholder="Nama Indikator..." value="{{ request('search_indikator') }}" style="width: 85%">
        </div>

        <div class="filter-buttons">
            <button type="submit" class="btn-action btn-primary">
                <i class="fas fa-filter"></i> Terapkan Filter
            </button>
            <a href="{{ route('admin.indikator.tahun', $tahun->id) }}" class="btn-action btn-secondary">
                <i class="fas fa-sync-alt"></i> Reset Filter
            </a>
        </div>
    </form>

    <table class="data-table">
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
            @forelse($indikators as $i => $indikator)
            <tr>
                <td data-label="No">{{ $loop->iteration }}</td>
                <td data-label="Domain">{{ $indikator->aspect->domain->nama }}</td>
                <td data-label="Aspek">{{ $indikator->aspect->nama }}</td>
                <td data-label="Indikator">{{ $indikator->nama }}</td>
                <td data-label="Penjelasan">{{ $indikator->penjelasan }}</td>
                <td data-label="Aksi" class="action-cell">
                    <a href="{{ route('admin.indikator.edit', $indikator->id) }}" class="btn-action btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button class="btn-action btn-danger btn-sm" onclick="showDeleteModal('{{ route('admin.indikator.destroy', $indikator->id) }}')">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data indikator untuk tahun ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="deleteConfirmationModal" class="modal">
    <div class="modal-content">
        <p>Apakah Anda yakin ingin menghapus indikator ini?</p>
        <div class="modal-actions">
            <button class="modal-btn cancel-btn" onclick="closeDeleteModal()">Batal</button>
            <form id="deleteForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="modal-btn confirm-btn">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const allAspectsData = @json($allAspects);

    document.addEventListener('DOMContentLoaded', function() {
        const filterDomainSelect = document.getElementById('filter_domain');
        const filterAspectSelect = document.getElementById('filter_aspect');
        const searchIndikatorInput = document.getElementById('search_indikator');
        const filterForm = document.querySelector('.filter-form-group');

        function populateFilterAspects(selectedDomainId, currentAspectId = null) {
            filterAspectSelect.innerHTML = '<option value="">-- Semua Aspek --</option>';
            const filteredAspects = allAspectsData.filter(aspect => aspect.domain_id == selectedDomainId);
            filteredAspects.forEach(aspect => {
                const option = document.createElement('option');
                option.value = aspect.id;
                option.textContent = aspect.nama;
                if (aspect.id == currentAspectId) { option.selected = true; }
                filterAspectSelect.appendChild(option);
            });
        }

        filterDomainSelect.addEventListener('change', function() {
            const selectedDomainId = this.value;
            populateFilterAspects(selectedDomainId);
            filterForm.submit();
        });

        filterAspectSelect.addEventListener('change', function() { filterForm.submit(); });

        searchIndikatorInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') { event.preventDefault(); filterForm.submit(); }
        });

        const initialFilterDomainId = filterDomainSelect.value;
        const initialFilterAspectId = "{{ request('filter_aspect') }}";
        if (initialFilterDomainId) { populateFilterAspects(initialFilterDomainId, initialFilterAspectId); }

        window.showDeleteModal = function(deleteUrl) {
            document.getElementById('deleteForm').action = deleteUrl;
            document.getElementById('deleteConfirmationModal').style.display = 'flex';
        }

        window.closeDeleteModal = function() { document.getElementById('deleteConfirmationModal').style.display = 'none'; }

        window.onclick = function(event) {
            const modal = document.getElementById('deleteConfirmationModal');
            if (event.target == modal) { modal.style.display = "none"; }
        }
    });
</script>
@endsection