@extends('layouts.layout_admin')
@section('title', "Detail Evaluasi SPBE - {{ $evaluation->title }}")

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
    .main-container { /* Mengganti .berita-container */
        width: 90%;
        max-width: 900px; /* Lebar maksimal untuk konten detail */
        margin: 50px auto;
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    /* Page Title Styling */
    .main-container .page-title { /* Mengganti .berita-title */
        color: #001e74;
        font-size: 32px; /* Ukuran judul lebih besar */
        font-weight: 700;
        margin-bottom: 20px; /* Spasi bawah judul */
        text-align: center;
        line-height: 1.3;
    }

    /* Image and Actions Container */
    .image-actions-wrapper { /* Mengganti .berita-img-container */
        position: relative;
        margin-bottom: 30px; /* Spasi bawah dari gambar */
        /* Tambahkan ini untuk memastikan kontainer gambar memiliki rasio aspek yang lebih fleksibel */
        display: flex;
        justify-content: center; /* Tengahkan gambar */
        align-items: center;
        overflow: hidden; /* Sembunyikan jika ada overflow */
        background-color: #f8f9fa; /* Latar belakang untuk area gambar */
        border-radius: 12px;
        min-height: 200px; /* Tinggi minimum untuk kontainer */
    }

    .evaluation-image { /* Mengganti .berita-img */
        width: 100%; /* Gambar mengisi lebar kontainer */
        height: auto; /* Tinggi disesuaikan secara proporsional */
        /* Hapus max-height dan object-fit: cover untuk mencegah pemotongan */
        /* max-height: 450px; */
        /* object-fit: cover; */
        object-fit: contain; /* Gambar akan diskalakan untuk muat tanpa terpotong, mungkin ada ruang kosong */
        border-radius: 12px; /* Sudut membulat */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); /* Shadow lebih lembut */
        border: 1px solid #e0e0e0; /* Border halus */
    }

    .actions-overlay { /* Mengganti .berita-actions */
        position: absolute;
        top: 15px;
        right: 15px;
        display: flex;
        gap: 10px;
        background-color: rgba(255, 255, 255, 0.8); /* Latar belakang semi-transparan */
        padding: 8px 12px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    /* Action Buttons */
    .btn-action-icon { /* Base style for icon buttons */
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px; /* Ukuran tombol bulat */
        height: 38px;
        border-radius: 50%; /* Bentuk bulat */
        border: none;
        cursor: pointer;
        font-size: 18px;
        color: #fff;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-action-icon.edit {
        background-color: #3b82f6; /* Biru */
    }
    .btn-action-icon.edit:hover {
        background-color: #2563eb;
        transform: scale(1.05);
    }

    .btn-action-icon.delete {
        background-color: #ef4444; /* Merah */
    }
    .btn-action-icon.delete:hover {
        background-color: #dc2626;
        transform: scale(1.05);
    }

    /* Metadata Styling */
    .metadata-info { /* Mengganti .berita-date */
        color: #6b7280; /* Abu-abu muted */
        font-weight: 500;
        font-size: 15px;
        margin-bottom: 30px;
        text-align: center;
    }

    /* Document Section */
    .document-section {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .document-section .section-label { /* Mengganti .form-label */
        font-weight: 600;
        font-size: 18px;
        color: #001e74;
        margin-bottom: 15px;
    }

    .document-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        background-color: #f8f9fa;
        padding: 15px 20px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .document-icon {
        font-size: 28px;
        color: #3b82f6; /* Ikon biru */
    }

    .document-details {
        flex-grow: 1;
    }

    .document-details .file-name {
        font-size: 16px;
        font-weight: 500;
        color: #333;
        margin-bottom: 5px;
    }

    .document-details .file-size {
        font-size: 13px;
        color: #6b7280;
    }

    .btn-download {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background-color: #22c55e; /* Hijau */
        color: #fff;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        font-size: 15px;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-download:hover {
        background-color: #16a34a;
        transform: translateY(-1px);
    }

    /* Back Button Styling */
    .back-button-container {
        text-align: center; /* Tengahkan tombol kembali */
        margin-top: 40px;
    }

    .btn-kembali { /* Reusing from your existing style, adjust for consistency */
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #001e74;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.2s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .btn-kembali:hover {
        background-color: #00155a; /* Darker blue */
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    /* Modal Styling (Reusing from indikator_per_tahun) */
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
        .main-container .page-title {
            font-size: 26px;
            margin-bottom: 15px;
        }
        .actions-overlay {
            position: static; /* Stack on smaller screens */
            justify-content: center;
            margin-bottom: 20px;
            background-color: transparent;
            box-shadow: none;
            padding: 0;
        }
        .btn-action-icon {
            width: 45px;
            height: 45px;
            font-size: 20px;
        }
        .document-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        .document-details {
            width: 100%;
        }
        .btn-download {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div class="main-container">
    <h1 class="page-title">{{ $evaluation->title }}</h1>

    <div class="image-actions-wrapper">

        {{-- Pastikan path gambar utama evaluasi ini benar --}}
        <img src="{{ asset('uploads/evaluasi/' . $evaluation->image) }}" alt="Gambar Evaluasi" class="evaluation-image">
    </div>

    <div class="metadata-info">
        Dibuat pada: {{ \Carbon\Carbon::parse($evaluation->created_at)->format('d M Y') }} |
        Pukul: {{ \Carbon\Carbon::parse($evaluation->created_at)->format('H:i') }}
    </div>

    <div class="document-section">
        <h3 class="section-label">Dokumen Pendukung:</h3>
        @if ($evaluation->document)
            <div class="document-item">
                <div class="document-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="document-details">
                    <p class="file-name">{{ $evaluation->document }}</p>
                </div>
                {{-- UBAH BARIS INI: Gunakan route yang sama dengan edit_evaluasi --}}
                <a href="{{ route('admin.evaluasi.file', $evaluation->document) }}" target="_blank" class="btn-download">
                    <i class="fas fa-download"></i> Lihat & Unduh File
                </a>
            </div>
        @else
            <p class="form-text">Tidak ada dokumen pendukung.</p>
        @endif
    </div>

    <div class="back-button-container">
        <a href="{{ route('admin.evaluasi') }}" class="btn-kembali">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Evaluasi
        </a>
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
@endsect