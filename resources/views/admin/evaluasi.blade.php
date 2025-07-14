<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Evaluasi SPBE</title> {{-- Perbarui judul halaman --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* General Body Styling (Consistent with your layout_admin) */
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f2f5; /* Light grey background for the whole page */
        color: #333;
    }

    /* Main Container Styling (Consistent with other admin pages) */
    .main-container { /* Mengganti .evaluasi-container */
        width: 90%;
        max-width: 1200px;
        margin: 50px auto;
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    /* Header Section Styling */
    .header-section { /* Mengganti .evaluasi-header */
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px; /* Spasi bawah yang lebih besar */
        flex-wrap: wrap; /* Agar responsif */
        gap: 15px; /* Spasi antar item header */
    }

    .header-section h1 {
        color: #001e74;
        font-size: 28px;
        font-weight: 700;
        position: relative;
        padding-bottom: 10px;
        margin: 0; /* Hapus margin default */
    }

    .header-section h1::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 80px; /* Lebar underline */
        height: 4px;
        background-color: #facc15;
        border-radius: 2px;
    }

    .add-button-group { /* Mengganti .tambah */
        display: flex;
        align-items: center;
        gap: 10px; /* Spasi antar tombol dan teks */
    }

    .btn-add-evaluasi { /* Mengganti .btn-add */
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
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .btn-add-evaluasi i {
        margin-right: 8px;
    }

    .btn-add-evaluasi:hover {
        background-color: #16a34a;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .add-button-group p { /* Mengganti .p */
        margin: 0;
        font-size: 15px;
        font-weight: 500;
        color: #555;
    }

    /* Grid for Evaluation Cards */
    .evaluasi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px; /* Spasi antar card yang lebih besar */
    }

    .evaluasi-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .evaluasi-card:hover {
        transform: translateY(-8px); /* Efek angkat yang lebih dramatis */
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .evaluasi-img { /* Mengganti .evaluasi-img */
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .evaluasi-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease-in-out; /* Animasi zoom pada gambar */
    }

    .evaluasi-card:hover .evaluasi-img img {
        transform: scale(1.05);
    }

    .evaluasi-content {
        padding: 18px; /* Padding yang lebih besar */
        display: flex;
        flex-direction: column;
        flex-grow: 1; /* Memastikan konten mengisi sisa ruang */
    }

    .evaluasi-content h3 {
        font-size: 18px; /* Ukuran judul card */
        margin-bottom: 12px;
        font-weight: 600;
        color: #001e74;
        line-height: 1.3;
    }

    .evaluasi-info-bottom { /* Mengganti .evaluasi-info */
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto; /* Dorong ke bawah */
        padding-top: 15px; /* Spasi dari judul */
        border-top: 1px solid #eee; /* Garis pemisah */
    }

    .tanggal {
        font-size: 13px;
        color: #6b7280;
        font-weight: 500;
    }

    /* Action Buttons within Card */
    .card-actions-group { /* Mengganti .btn-detail */
        display: flex;
        gap: 8px; /* Spasi antar tombol ikon */
    }

    .btn-card-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px; /* Mengurangi padding */
        width: 36px; /* Mengurangi ukuran tombol */
        height: 36px; /* Mengurangi ukuran tombol */
        border-radius: 8px; /* Sudut membulat seperti pada gambar berita */
        border: 1px solid; /* Tambahkan border */
        cursor: pointer;
        font-size: 15px; /* Sedikit mengurangi ukuran font ikon */
        color: white;
        transition: background-color 0.3s ease, transform 0.2s ease, border-color 0.3s ease;
        box-sizing: border-box; /* Memastikan padding dan border tidak menambah ukuran */
        text-decoration:none;
    }

    .btn-card-icon.view {
        background-color: #3b82f6; /* Biru */
        border-color: #3b82f6; /* Border biru */
    }
    .btn-card-icon.view:hover {
        background-color: #2563eb;
        border-color: #2563eb;
        transform: scale(1.05);
    }

    .btn-card-icon.edit {
        background-color: #facc15; /* Kuning */
        color: #333; /* Teks gelap untuk kontras */
        border-color: #facc15; /* Border kuning */
    }
    .btn-card-icon.edit:hover {
        background-color: #eab308;
        border-color: #eab308;
        transform: scale(1.05);
    }

    .btn-card-icon.delete {
        background-color: #ef4444; /* Merah */
        border-color: #ef4444; /* Border merah */
    }
    .btn-card-icon.delete:hover {
        background-color: #dc2626;
        border-color: #dc2626;
        transform: scale(1.05);
    }

    /* Modal Styling (Reusing from other admin pages) */
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
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
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
        .evaluasi-grid {
            grid-template-columns: 1fr; /* Satu kolom di mobile */
        }
        .evaluasi-card {
            margin-bottom: 15px;
        }
    }
</style>

</head>

<body>

@extends('layouts.layout_admin')
@section('title', 'Kelola Evaluasi SPBE') {{-- Perbarui judul section --}}
@section('content')

    <div class="main-container">
        <div class="header-section">
            <h1>Daftar Evaluasi SPBE</h1>
            <div class="add-button-group">
                <a href="{{ route('admin.evaluasi.create') }}" class="btn-add-evaluasi">
                    <i class="fas fa-plus"></i> Tambah Hasil Evaluasi
                </a>
            </div>
        </div>

        <div class="evaluasi-grid">
            @forelse($evaluations as $evaluation)
            <div class="evaluasi-card">
                <div class="evaluasi-img">
                    @if($evaluation->image)
                    <img src="{{ asset('uploads/evaluasi/' . $evaluation->image) }}" alt="Gambar Evaluasi">
                    @else
                    <img src="https://placehold.co/400x200/cccccc/333333?text=No+Image" alt="No Image Available"> {{-- Placeholder --}}
                    @endif
                </div>
                <div class="evaluasi-content">
                    <h3>{{ $evaluation->title }}</h3>
                    <div class="evaluasi-info-bottom">
                        <span class="tanggal">{{ $evaluation->created_at->format('d-m-Y') }}</span>
                        <div class="card-actions-group">
                            <a href="{{ route('admin.evaluasi.show', $evaluation->id) }}" class="btn-card-icon view">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.evaluasi.edit', $evaluation->id) }}" class="btn-card-icon edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <button class="btn-card-icon delete" onclick="showDeleteModal('{{ route('admin.evaluasi.destroy', $evaluation->id) }}')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p style="text-align: center; width: 100%; font-size: 1.1rem; color: #6b7280;">Tidak ada data evaluasi yang tersedia.</p>
            @endforelse
        </div>
    </div>

<!-- Custom Delete Confirmation Modal -->
<div id="deleteConfirmationModal" class="modal">
    <div class="modal-content">
        <p>Apakah Anda yakin ingin menghapus evaluasi ini?</p>
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
</body>
</html>
