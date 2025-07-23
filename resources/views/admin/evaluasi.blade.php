@extends('layouts.layout_admin')
@section('title', 'Kelola Evaluasi SPBE')
@section('styles')
    <style>
        :root {
            --primary-blue: #001e74;
            --accent-yellow: #facc15;
            --light-gray: #f0f2f5;
            --text-dark: #333;
            --text-light: #6b7280;
            --card-bg: #ffffff;
            --border-radius: 12px;
            --box-shadow-light: 0 4px 15px rgba(0,0,0,0.1);
            --box-shadow-hover: 0 8px 25px rgba(0,0,0,0.15);
        }
        body { font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background-color:#fff; color: var(--text-dark); }
        .main-container { width: 90%; max-width: 1200px; margin: 50px auto; padding: 40px; box-sizing: border-box; }
        .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px; }
        .header-section h1 { color: #001e74; font-size: 32px; font-weight: 700; position: relative; padding-bottom: 12px; margin: 0; letter-spacing: 0.5px; }
        .header-section h1::after { content: ''; position: absolute; left: 50%; transform: translateX(-50%); bottom: 0; width: 60px; height: 5px; background: linear-gradient(to right, #facc15, #ff9a00); border-radius: 50px; box-shadow: 0 4px 10px rgba(250, 204, 21, 0.5); transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); }
        .header-section h1:hover::after { width: 100%; left: 0; transform: translateX(0); box-shadow: 0 6px 20px rgba(250, 204, 21, 0.7); }
        
        .add-button-group { display: flex; align-items: center; gap: 10px; }
        .btn-add-evaluasi { background-color: green; color: white; padding: 10px 18px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 15px; transition: background-color 0.3s ease, transform 0.2s ease; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); }
        .btn-add-evaluasi i { margin-right: 8px; }
        .btn-add-evaluasi:hover { background-color: darkgreen; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); }
        .add-button-group p { margin: 0; font-size: 15px; font-weight: 500; color: #555; }
        
        .evaluasi-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; }
        .evaluasi-card { background: var(--card-bg); border-radius: var(--border-radius); box-shadow: var(--box-shadow-light); overflow: hidden; display: flex; flex-direction: column; transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;}
        .evaluasi-card:hover { transform: translateY(-8px); box-shadow: var(--box-shadow-hover); }
        .evaluasi-img { position: relative; width: 100%; height: 200px; overflow: hidden; }
        .evaluasi-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease-in-out; }
        .evaluasi-card:hover .evaluasi-img img { transform: scale(1.05); }
        .evaluasi-content { padding: 18px; display: flex; flex-direction: column; flex-grow: 1; }
        .evaluasi-content h3 { font-size: 18px; margin-bottom: 12px; font-weight: 600; color: var(--primary-blue); line-height: 1.3; }
        .evaluasi-info-bottom { display: flex; justify-content: space-between; align-items: center; margin-top: auto; padding-top: 15px; border-top: 1px solid #eee; }
        .tanggal { font-size: 13px; color: var(--text-light); font-weight: 500; }
        .card-actions-group { display: flex; gap: 8px; } 
        
        .btn-card-icon {
            display: inline-flex; align-items: center; justify-content: center; padding: 6px; width: 36px; height: 36px; border-radius: 8px; border: 1px solid; cursor: pointer; font-size: 15px; color: white; 
            transition: background-color 0.3s ease, transform 0.2s ease, border-color 0.3s ease; box-sizing: border-box; text-decoration: none;
        }
        .btn-card-icon.view { background-color: #3b82f6; border-color: #3b82f6; }
        .btn-card-icon.view:hover { background-color: #2563eb; border-color: #2563eb; transform: scale(1.05); }
        .btn-card-icon.edit { background-color: var(--accent-yellow); color: #fff; border-color: var(--accent-yellow); }
        .btn-card-icon.edit:hover { background-color: #eab308; border-color: #eab308; transform: scale(1.05); }
        .btn-card-icon.delete { background-color: #ef4444; border-color: #ef4444; }
        .btn-card-icon.delete:hover { background-color: #dc2626; border-color: #dc2626; transform: scale(1.05); }
        
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; }
        .modal-content { background-color: #fff; margin: auto; padding: 30px; border-radius: 12px; width: 90%; max-width: 450px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.3); animation: fadeIn 0.3s ease-out; }
        .modal-content p { font-size: 18px; font-weight: 500; margin-bottom: 25px; color: #333; }
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
            .main-container { width: 95%; padding: 25px; margin: 30px auto; }
            .header-section { flex-direction: column; align-items: flex-start; margin-bottom: 20px; }
            .header-section h1 { font-size: 24px; text-align: left; width: 100%; padding-bottom: 8px; }
            .header-section h1::after { left: 0; transform: translateX(0); width: 60px; }
            .add-button-group { width: 100%; justify-content: flex-start; margin-top: 10px; }
            .add-button-group p { font-size: 15px; }
            .evaluasi-grid { grid-template-columns: 1fr; gap: 20px; }
            .evaluasi-card { margin-bottom: 0; }
            .evaluasi-img { height: 180px; }
            .evaluasi-content { padding: 15px; }
            .evaluasi-content h3 { font-size: 17px; margin-bottom: 10px; }
            .evaluasi-info-bottom { flex-direction: column; align-items: flex-start; gap: 10px;  padding-top: 10px; }
            .tanggal { font-size: 12px; }
            .card-actions-group { width: 100%; justify-content: flex-start; gap: 6px; }
            .btn-card-icon { width: 32px; height: 32px; font-size: 14px;  padding: 5px; }
            .modal-content { padding: 20px; max-width: 300px; }
            .modal-content p { font-size: 16px; margin-bottom: 20px; }
            .modal-btn { padding: 8px 15px; font-size: 14px; }
        }
        @media (max-width: 480px) {
            .main-container { padding: 20px; margin: 20px auto; }
            .header-section h1 { font-size: 22px; }
            .btn-add-evaluasi { padding: 7px 10px; font-size: 14px; }
            .add-button-group p { font-size: 14px; }
            .evaluasi-img { height: 160px;  }
            .evaluasi-content { padding: 12px; }
            .evaluasi-content h3 { font-size: 16px; }
        }
    </style>
@endsection

@section('content')

    <div class="main-container">
        <div class="header-section">
            <h1>Daftar Evaluasi SPBE</h1>
            <div class="add-button-group">
                <a href="{{ route('admin.evaluasi.create') }}" class="btn-add-evaluasi"> <i class="fas fa-plus"></i> Tambah</a>
            </div>
        </div>

        <div class="evaluasi-grid">
            @forelse($evaluations as $evaluation)
            <div class="evaluasi-card">
                <div class="evaluasi-img">
                    @if($evaluation->image)
                    <img src="{{ asset('uploads/evaluasi/' . $evaluation->image) }}" alt="Gambar Evaluasi">
                    @else
                    <img src="https://placehold.co/400x200/cccccc/333333?text=No+Image" alt="No Image Available">
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
