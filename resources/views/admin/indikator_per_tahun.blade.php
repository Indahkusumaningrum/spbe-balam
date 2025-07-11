@extends('layouts.layout_admin')
@section('title', "Indikator Tahun {{ $tahun->tahun }}")

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

    /* Action Buttons Group Styling */
    .action-buttons-group {
        display: flex;
        flex-wrap: wrap; /* Wrap buttons on smaller screens */
        gap: 15px; /* Spasi antar tombol */
        margin-bottom: 30px;
        justify-content: flex-start; /* Align buttons to the start */
    }

    /* Base Button Styling */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        text-decoration: none;
        color: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Subtle shadow for buttons */
    }

    .btn-action i {
        margin-right: 8px; /* Spasi antara ikon dan teks */
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    /* Specific Button Colors */
    .btn-success {
        background-color: #22c55e; /* Hijau */
    }
    .btn-success:hover {
        background-color: #16a34a;
    }

    .btn-primary {
        background-color: #3b82f6; /* Biru */
    }
    .btn-primary:hover {
        background-color: #2563eb;
    }

    .btn-secondary {
        background-color: #6b7280; /* Abu-abu */
    }
    .btn-secondary:hover {
        background-color: #4b5563;
    }

    .btn-info {
        background-color: #0ea5e9; /* Biru muda */
    }
    .btn-info:hover {
        background-color: #0284c7;
    }

    .btn-warning {
        background-color: #facc15; /* Kuning */
        color: #333; /* Teks gelap untuk kontras */
    }
    .btn-warning:hover {
        background-color: #eab308;
    }

    .btn-danger {
        background-color: #ef4444; /* Merah */
    }
    .btn-danger:hover {
        background-color: #dc2626;
    }

    /* Table Styling (Reusing .data-table from indikator_index) */
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
        margin-top: 20px;
    }

    .data-table thead tr {
        background-color: #001e74;
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

    /* Action buttons within table cells */
    .data-table .action-cell {
        display: flex;
        gap: 8px; /* Spasi antar tombol aksi */
        flex-wrap: wrap;
    }

    /* Text alignment for empty state */
    .data-table .text-center {
        text-align: center;
        padding: 30px !important;
        color: #6b7280;
        font-style: italic;
    }

    /* Modal Styling (Reusing from layout_admin, adjusted for this page) */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000; /* Pastikan di atas elemen lain */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5); /* Overlay gelap */
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fff;
        margin: auto; /* Untuk centering di browser lama */
        padding: 30px;
        border-radius: 12px;
        width: 90%;
        max-width: 450px; /* Batasi lebar modal */
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        animation: fadeIn 0.3s ease-out; /* Animasi muncul */
    }

    .modal-content p {
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 25px;
        color: #333;
    }

    .modal-actions {
        display: flex;
        justify-content: center; /* Tombol di tengah */
        gap: 15px; /* Spasi antar tombol */
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
        background-color: #dc3545; /* Merah untuk konfirmasi hapus */
        color: white;
    }

    .modal-btn.confirm-btn:hover {
        background-color: #c82333;
    }

    /* Animation for modal */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
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

        .action-buttons-group {
            flex-direction: column; /* Tombol menumpuk vertikal */
            gap: 10px;
        }

        .btn-action {
            width: 100%; /* Tombol memenuhi lebar */
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
        }

        .data-table td {
            border: none;
            position: relative;
            padding-left: 50%;
            text-align: right;
            font-size: 14px;
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

        .data-table .action-cell {
            justify-content: flex-end; /* Posisikan tombol aksi ke kanan di mobile */
            margin-top: 10px;
        }
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
        <a href="{{ route('admin.indikator.index') }}" class="btn-action btn-secondary" style="margin-left: auto;">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Tahun
        </a>
    </div>

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

<!-- Custom Delete Confirmation Modal -->
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
    // Fungsi untuk menampilkan modal konfirmasi hapus
    function showDeleteModal(deleteUrl) {
        document.getElementById('deleteForm').action = deleteUrl;
        document.getElementById('deleteConfirmationModal').style.display = 'flex'; // Menggunakan flex untuk centering
    }

    // Fungsi untuk menutup modal konfirmasi hapus
    function closeDeleteModal() {
        document.getElementById('deleteConfirmationModal').style.display = 'none';
    }

    // Tutup modal jika user mengklik di luar area modal content
    window.onclick = function(event) {
        const modal = document.getElementById('deleteConfirmationModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
@endsection
