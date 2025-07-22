@extends('layouts.layout_admin')
@section('title', "Detail Evaluasi SPBE")

@section('styles')
<style>
    :root {
        --primary-blue: #001e74;
        --accent-yellow: #facc15;
        --light-gray: #f0f2f5;
        --text-dark: #333;
        --text-muted: #6b7280;
        --card-bg: #ffffff;
        --border-radius: 12px;
        --box-shadow-light: 0 4px 20px rgba(0, 0, 0, 0.08);
        --box-shadow-hover: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    body { font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background-color: #fff; color: var(--text-dark); }
    .main-container { width: 90%; max-width: 900px; margin: 50px auto; background-color: var(--card-bg); padding: 0px; }
    .main-container .page-title { color: var(--primary-blue); font-size: 32px; font-weight: 700; margin-bottom: 20px; text-align: center; line-height: 1.3; }
    .image-actions-wrapper { position: relative; margin-bottom: 30px; display: flex; justify-content: center; align-items: center; overflow: hidden; background-color: #f8f9fa; border-radius: var(--border-radius); min-height: 200px; padding: 15px; }
    .evaluation-image { width: 100%; height: auto; max-height: 400px; object-fit: contain;  border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); border: 1px solid #e0e0e0; }
    .actions-overlay { position: absolute; top: 15px; right: 15px; display: flex; gap: 10px; background-color: rgba(255, 255, 255, 0.8); padding: 8px 12px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); z-index: 10; }
    .btn-action-icon { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; font-size: 16px;  border-radius: 50%; border: none; cursor: pointer; color: #fff; transition: background-color 0.3s ease, transform 0.2s ease; }
    .btn-action-icon.edit { background-color: #3b82f6; }
    .btn-action-icon.edit:hover { background-color: #2563eb; transform: scale(1.05); }
    .btn-action-icon.delete { background-color: #ef4444; }
    .btn-action-icon.delete:hover { background-color: #dc2626; transform: scale(1.05); }
    .metadata-info { color: var(--text-muted); font-weight: 500; font-size: 15px; margin-bottom: 30px; text-align: center; }
    .document-section { margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; }
    .document-section .section-label { font-weight: 600; font-size: 18px; color: var(--primary-blue); margin-bottom: 15px; }
    .document-item { display: flex; align-items: center; gap: 15px; margin-bottom: 15px; background-color: #f8f9fa; padding: 15px 20px; border-radius: 8px; border: 1px solid #e0e0e0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
    .document-icon { font-size: 28px; color: #3b82f6; }
    .document-details { flex-grow: 1; }
    .document-details .file-name { font-size: 16px; font-weight: 500; color: var(--text-dark); margin-bottom: 5px; word-break: break-all; }
    .document-details .file-size { font-size: 13px; color: var(--text-muted); }
    .btn-download { display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; background-color: #22c55e; color: #fff; border: none; border-radius: 8px; text-decoration: none; font-size: 15px; font-weight: 600; transition: background-color 0.3s ease, transform 0.2s ease; }
    .btn-download:hover { background-color: #16a34a; transform: translateY(-1px); }
    .back-button-container { text-align: center; margin-top: 40px; }
    .btn-kembali { display: inline-flex; align-items: center; gap: 8px; background-color: var(--primary-blue); color: white; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: background-color 0.3s ease, transform 0.2s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    .btn-kembali:hover { background-color: #00155a; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.15); }
    .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; }
    .modal-content { background-color: #fff; margin: auto; padding: 30px; border-radius: 12px; width: 90%; max-width: 450px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.3); animation: fadeIn 0.3s ease-out; }
    .modal-content p { font-size: 18px; font-weight: 500; margin-bottom: 25px;  color: #333; }
    .modal-actions { display: flex; justify-content: center; gap: 15px; }
    .modal-btn { padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 15px; transition: background-color 0.3s ease; }
    .modal-btn.cancel-btn { background-color: #ccc; color: #333; }
    .modal-btn.cancel-btn:hover { background-color: #bbb; }
    .modal-btn.confirm-btn { background-color: #dc3545; color: white; }
    .modal-btn.confirm-btn:hover { background-color: #c82333; }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 768px) {
        .main-container { width: 95%; padding: 25px; margin: 20px auto; }
        .main-container .page-title { font-size: 24px; margin-bottom: 15px; }
        .image-actions-wrapper { flex-direction: column; padding: 10px; min-height: auto; margin-bottom: 20px; }
        .evaluation-image { max-height: 250px; margin-bottom: 15px; }
        .actions-overlay { position: static; top: auto; right: auto; display: flex; justify-content: center; background-color: transparent; box-shadow: none; padding: 0; width: 100%; gap: 15px; }
        .btn-action-icon { width: 38px; height: 38px; font-size: 17px; }
        .metadata-info { font-size: 14px; margin-bottom: 20px; }
        .document-section { margin-top: 20px; padding-top: 15px; }
        .document-section .section-label { font-size: 16px; margin-bottom: 10px; }
        .document-item { flex-direction: column; align-items: flex-start; gap: 10px; padding: 12px 15px; }
        .document-icon { font-size: 24px; }
        .document-details { width: 100%; text-align: left; }
        .document-details .file-name { font-size: 15px; }
        .document-details .file-size { font-size: 12px; }
        .btn-download { width: 98%; justify-content: center; font-size: 14px; padding: 10px 15px; }
        .back-button-container { margin-top: 30px; }
        .btn-kembali { padding: 10px 20px; font-size: 15px; }
    }
    @media (max-width: 480px) {
        .main-container { padding: 15px; margin: 15px auto; }
        .main-container .page-title { font-size: 20px; }
        .image-actions-wrapper { padding: 5px; }
        .evaluation-image { max-height: 200px; }
        .actions-overlay { gap: 8px; }
        .btn-action-icon { width: 32px; height: 32px; font-size: 15px; }
        .metadata-info { font-size: 13px; margin-bottom: 15px; }
        .document-item { padding: 10px 12px; }
        .document-icon { font-size: 20px; }
        .document-details .file-name { font-size: 14px; }
        .document-details .file-size { font-size: 11px; }
        .btn-download { font-size: 13px; padding: 8px 12px; width: 95%; }
        .btn-kembali { padding: 8px 18px; font-size: 14px; }
    }
</style>
@endsection

@section('content')
<div class="main-container">
    <h1 class="page-title">{{ $evaluation->title }}</h1>

    <div class="image-actions-wrapper">
        <img src="{{ asset('uploads/evaluasi/' . $evaluation->image) }}" alt="Gambar Evaluasi" class="evaluation-image">

        <div class="actions-overlay">
            <a href="{{ route('admin.evaluasi.edit', $evaluation->id) }}" class="btn-action-icon edit">
                <i class="fas fa-pen"></i>
            </a>
            <button class="btn-action-icon delete" onclick="showDeleteModal('{{ route('admin.evaluasi.destroy', $evaluation->id) }}')">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
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
                <a href="{{ route('admin.evaluasi.file', $evaluation->document) }}" target="_blank" class="btn-download">
                    <i class="fas fa-download"></i> Lihat File
                </a>
            </div>
        @else
            <p class="form-text" style="color: var(--text-muted);">Tidak ada dokumen pendukung.</p>
        @endif
    </div>

    <div class="back-button-container">
        <a href="{{ route('admin.evaluasi') }}" class="btn-kembali">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

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

<script>
    function showDeleteModal(deleteUrl) {
        document.getElementById('deleteForm').action = deleteUrl;
        document.getElementById('deleteConfirmationModal').style.display = 'flex';
    }

    function closeDeleteModal() {
        document.getElementById('deleteConfirmationModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('deleteConfirmationModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
@endsection
