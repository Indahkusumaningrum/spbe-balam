@extends('layouts.layout_admin')
@section('title', 'Halaman Unduhan') {{-- Judul halaman unduhan --}}

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
        max-width: 1200px;
        margin: 50px auto;
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    /* Header Section Styling */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .header-section h1 {
        color: #001e74;
        font-size: 28px; /* Ukuran judul lebih besar */
        font-weight: 700;
        position: relative;
        padding-bottom: 10px;
        margin: 0;
    }

    .header-section h1::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 80px;
        height: 4px;
        background-color: #facc15;
        border-radius: 2px;
    }

    .add-button-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-add-file {
        background-color: #22c55e; /* Hijau */
        color: white;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 15px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-add-file i {
        margin-right: 8px;
    }

    .btn-add-file:hover {
        background-color: #16a34a;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .add-button-group p {
        margin: 0;
        font-size: 15px;
        font-weight: 500;
        color: #555;
    }

    /* Table Styling */
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
        margin-top: 20px;
    }

    .data-table thead tr {
        background-color: #001e74; /* Header biru gelap */
        color: #ffffff;
        text-align: left;
        border-radius: 8px;
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
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .data-table tbody tr:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .data-table td {
        padding: 15px 20px;
        border-bottom: none;
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

    /* Action Buttons within Table Cells */
    .action-cell {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
    }

    .btn-view-doc {
        background-color: #3b82f6; /* Biru */
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: white;
        padding: 8px 12px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 12px;
        border: none;
        outline: none;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-view-doc:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
    }

    .btn-action-icon { /* Base style for icon buttons (edit/delete) */
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px; /* Ukuran tombol persegi */
        height: 36px; /* Ukuran tombol persegi */
        border-radius: 8px; /* Sudut membulat */
        border: 1px solid; /* Tambahkan border */
        cursor: pointer;
        font-size: 15px;
        transition: background-color 0.3s ease, transform 0.2s ease, border-color 0.3s ease;
        box-sizing: border-box; /* Memastikan padding dan border tidak menambah ukuran */
    }

    .btn-action-icon.edit {
        background-color: #facc15; /* Kuning */
        color: #333; /* Teks gelap untuk kontras */
        border-color: #facc15;
    }
    .btn-action-icon.edit:hover {
        background-color: #eab308;
        border-color: #eab308;
        transform: scale(1.05);
    }

    .btn-action-icon.delete {
        background-color: #ef4444; /* Merah */
        color: #fff;
        border-color: #ef4444;
    }
    .btn-action-icon.delete:hover {
        background-color: #dc2626;
        border-color: #dc2626;
        transform: scale(1.05);
    }

    /* Modal Styling */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fff;
        margin: auto;
        padding: 30px;
        border-radius: 12px;
        width: 90%;
        max-width: 450px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        animation: fadeIn 0.3s ease-out;
    }

    .modal-content p {
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 25px;
        color: #333;
    }

    .modal-actions {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .modal-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        font-size: 15px;
        transition: background-color 0.3s ease;
    }

    .modal-btn.cancel-btn {
        background-color: #ccc;
        color: #333;
    }

    .modal-btn.cancel-btn:hover {
        background-color: #bbb;
    }

    .modal-btn.confirm-btn {
        background-color: #dc3545;
        color: white;
    }

    .modal-btn.confirm-btn:hover {
        background-color: #c82333;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- Filter Section Styling --- */
    .filter-section {
        background-color: #ffffff;
        padding: 25px 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        margin-bottom: 30px;
        display: flex;
        flex-wrap: wrap; /* Allow items to wrap on smaller screens */
        gap: 20px; /* Spacing between filter elements */
        align-items: flex-end; /* Align items to the bottom */
    }

    .filter-group {
        flex: 1; /* Allow groups to grow */
        min-width: 180px; /* Minimum width before wrapping */
    }

    .filter-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #555;
        margin-bottom: 8px;
    }

    .filter-section .form-control { /* Targeting select elements within the filter */
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #d1d5db; /* Light grey border */
        border-radius: 8px;
        background-color: #f9fafb; /* Slightly off-white background */
        font-size: 15px;
        color: #333;
        appearance: none; /* Remove default select arrow */
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%236B7280%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13.6-6.4H18.6a17.6%2017.6%200%200%200-13.6%206.4%2017.6%2017.6%200%200%200%200%2025.3l128%20128a17.6%2017.6%200%200%200%2025.3%200l128-128a17.6%2017.6%200%200%200%200-25.3z%22%2F%3E%3C%2Fsvg%3E'); /* Custom arrow */
        background-repeat: no-repeat;
        background-position: right 12px top 50%;
        background-size: 12px auto;
        cursor: pointer;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .filter-section .form-control:focus {
        border-color: #3b82f6; /* Blue border on focus */
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25); /* Light blue shadow on focus */
        outline: none;
    }

    .btn-filter-submit { /* New style for the filter button */
        background-color: #001e74; /* Dark blue, matching header */
        color: white;
        padding: 10px 25px;
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
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-filter-submit:hover {
        background-color: #00155a; /* Darker blue on hover */
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .main-container {
            width: 95%;
            padding: 25px;
            margin: 30px auto;
        }
        .header-section {
            flex-direction: column;
            align-items: flex-start;
        }
        .header-section h1 {
            font-size: 24px;
            text-align: left;
            width: 100%;
        }
        .header-section h1::after {
            left: 0;
            transform: translateX(0);
        }
        .add-button-group {
            width: 100%;
            justify-content: center;
            margin-top: 15px;
        }
        /* Responsive table for mobile */
        .data-table, .data-table thead, .data-table tbody, .data-table th, .data-table td, .data-table tr {
            display: block;
        }
        .data-table thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }
        .data-table tbody tr {
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
            padding: 15px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
        .data-table td {
            border: none;
            position: relative;
            padding-left: 50%;
            text-align: right;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
        }
        .data-table td::before {
            content: attr(data-label);
            position: absolute;
            left: 10px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            text-align: left;
            font-weight: 600;
            color: #4b5563;
        }
        .action-cell {
            width: 100%;
            justify-content: flex-end;
            margin-top: 10px;
        }

        /* Responsive filter section */
        .filter-section {
            flex-direction: column; /* Stack filter elements vertically on small screens */
            align-items: stretch; /* Stretch items to full width */
            gap: 15px; /* Adjust gap for vertical stacking */
        }
        .filter-group {
            min-width: unset; /* Remove min-width constraint */
            width: 100%; /* Take full width */
        }
        .btn-filter-submit {
            width: 100%; /* Make button full width */
        }
    }
</style>
@endsection

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

        <div>
            <br>
            <button type="submit" class="btn-filter-submit">
                <i class="fas fa-filter"></i> Filter
            </button>
        </div>
    </form>
</div>


<div class="main-container">
    <div class="header-section">
        <h1>Download</h1>
        <div class="add-button-group">
            <a href="{{ route('download.create') }}" class="btn-add-file">
                <i class="fas fa-plus"></i> Tambah File
            </a>
        </div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 3%;">Tahun</th>
                <th style="width: 15%;">Kategori</th>
                <th style="width: 40%;">Judul</th>
                <th style="width: 20%;">Tentang</th>
                <th style="width: 12%;">File</th>
                <th style="width: 10%;">Aksi</th>
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
                    <td data-label="Aksi" class="action-cell">
                        <a href="{{ route('download.edit', ['id' => $d->id]) }}" class="btn-action-icon edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form id="delete-form-{{ $d->id }}" action="{{ route('admin.download.destroy', $d->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button" class="btn-action-icon delete" onclick="showDeleteModal({{ $d->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
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

<!-- Custom Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <p>Apakah Anda yakin ingin menghapus file ini?</p>
        <div class="modal-actions">
            <button onclick="closeDeleteModal()" class="modal-btn cancel-btn">Batal</button>
            <button onclick="submitDeleteForm()" class="modal-btn confirm-btn">Ya, Hapus</button>
        </div>
    </div>
</div>

@if(session('success'))
    <div id="successModal" class="modal" style="display: flex;">
        <div class="modal-content">
            <p>{{ session('success') }}</p>
            <div class="modal-actions">
                <button onclick="closeSuccessModal()" class="modal-btn confirm-btn">OK</button>
            </div>
        </div>
    </div>
@endif

@endsection

@section('scripts')
<script>
    let formToDelete = null;

    function showDeleteModal(formId) {
        formToDelete = document.getElementById(`delete-form-${formId}`);
        document.getElementById('deleteModal').style.display = 'flex';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    function submitDeleteForm() {
        if (formToDelete) {
            formToDelete.submit();
        }
    }

    function closeSuccessModal() {
        const modal = document.getElementById('successModal');
        if (modal) modal.style.display = 'none';
    }

    // Menutup modal jika klik di luar
    window.onclick = function(event) {
        const deleteModal = document.getElementById('deleteModal');
        const successModal = document.getElementById('successModal');

        if (event.target == deleteModal) {
            closeDeleteModal();
        }

        if (event.target == successModal) {
            closeSuccessModal();
        }
    }
</script>
@endsection
