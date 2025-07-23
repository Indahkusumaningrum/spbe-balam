<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .galeri-container { display: block; max-width: 1200px; width: 95%; margin: 40px auto; background-color: #fff; padding: 30px; border-radius: 12px; box-sizing: border-box; }        
        .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px; }
        .header-section h1 { color: #001e74; font-size: 32px;  font-weight: 700; position: relative; padding-bottom: 12px; margin: 0; letter-spacing: 0.5px; }
        .header-section h1::after {
            content: ''; position: absolute; left: 50%;  transform: translateX(-50%);  bottom: 0; width: 60px; height: 5px;
            background: linear-gradient(to right, #facc15, #ff9a00); border-radius: 50px; box-shadow: 0 4px 10px rgba(250, 204, 21, 0.5); transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .header-section h1:hover::after { width: 100%;  left: 0;  transform: translateX(0);  box-shadow: 0 6px 20px rgba(250, 204, 21, 0.7); }
        .add-button-group { display: flex; align-items: center; gap: 10px; }
        .btn-add-file { background-color: #28a745; color: white; padding: 10px 18px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 15px; transition: background-color 0.3s ease, transform 0.2s ease; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); }
        .btn-add-file i { margin-right: 8px; }
        .btn-add-file:hover { background-color: #218838; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); }
        .galeri-grid { display: flex; flex-wrap: wrap; gap: 20px; margin: 0 -10px; }
        .galeri-card { flex: 1 1 calc(25% - 20px); max-width: calc(25% - 20px); border: 1px solid #ccc; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); display: flex; flex-direction: column; background-color: #f9f9f9; }
        .galeri-card img { width: 100%; height: 100%; object-fit: cover; }
        .galeri-title { font-size: 16px; font-weight: 600; color: #001e74; padding: 10px; text-align: center; }
        .galeri-actions { display: flex; justify-content: center; gap: 10px; margin-bottom: 10px; }
        .galeri-actions .btn-edit,
        .galeri-actions .btn-delete {
            display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 8px; border: none; background-color: #e0e7ff;
            color: #001e74; font-size: 16px; transition: background-color 0.3s ease; text-decoration: none;
        }
        .galeri-actions .btn-edit:hover { background-color: #c7d2fe; text-decoration: none; }
        .galeri-actions .btn-delete { background-color: #fee2e2; color: #b91c1c; }
        .galeri-actions .btn-delete:hover { background-color: #fecaca; }
        .btn-edit, .btn-delete { background: none; border: none; cursor: pointer; font-size: 18px }
        .btn-edit i { color: #007bff; }
        .btn-delete i { color: #dc3545; }
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.4) }
        .modal-content { background: white; padding: 20px; max-width: 400px; margin: 100px auto; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); text-align: center; }
        .modal-content p { font-size: 18px; margin-bottom: 20px; }
        .modal-buttons {display: flex; justify-content: center; gap: 10px; }
        .btn-cancel, .btn-confirm, .btn-ok { padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 14px; }
        .btn-cancel { background-color: gray; color: white; }
        .btn-confirm { background-color: red; color: white; }
        .btn-ok { background-color: green; color: white; }
        @media (max-width: 1024px) {
            .galeri-container { padding: 0px 60px; }
            .galeri-card {flex: 1 1 calc(33.333% - 20px); max-width: calc(33.333% - 20px); }
            }
        @media (max-width: 768px) {
            .galeri-container { padding: 0px 60px; }
            .galeri-card { flex: 1 1 calc(50% - 20px); max-width: calc(50% - 20px); }
            }
        @media (max-width: 480px) {
            .galeri-container { padding: 0px 60px; }
            .galeri-card { flex: 1 1 100%; max-width: 100%; }
            }
    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('content')
<div class="galeri-container">
    <div class="header-section">
        <h1>Galeri</h1>
        <div class="add-button-group">
            <a href="{{ route('admin.galeri.create') }}" class="btn-add-file"><i class="fas fa-plus" style="font-size: 17px;"></i>Tambah Foto </a>
        </div>
    </div>

    <div class="galeri-grid">
        @foreach ($galleries as $gallery)
            <div class="galeri-card">
                <img src="{{ asset('uploads/gallery/' . $gallery->image_path) }}" alt="Foto">
                <div class="galeri-title">{{ $gallery->title }}</div>
                <div class="galeri-actions">
                    <a href="{{ route('admin.galeri.edit', $gallery->id) }}" class="btn-edit"><i class="fas fa-pen"></i></a>
                    <form id="delete-form-{{ $gallery->id }}" action="{{ route('admin.galeri.destroy', $gallery->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete" onclick="event.preventDefault(); showDeleteModal({{ $gallery->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>

                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<!-- Modal Konfirmasi -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <p>Apakah Anda yakin ingin menghapus foto ini?</p>
        <div class="modal-buttons">
            <button onclick="closeDeleteModal()" class="btn-cancel">Batal</button>
            <button onclick="submitDeleteForm()" class="btn-confirm">Ya, Hapus</button>
        </div>
    </div>
</div>

@if(session('success'))
    <div id="successModal" class="modal" style="display: block;">
        <div class="modal-content">
            <p>{{ session('success') }}</p>
            <div class="modal-buttons">
                <button onclick="closeSuccessModal()" class="btn-ok">OK</button>
            </div>
        </div>
    </div>
@endif


<script>
    let formToDelete = null;

    function showDeleteModal(formId) {
        formToDelete = document.getElementById(`delete-form-${formId}`);
        document.getElementById('deleteModal').style.display = 'block';
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

</body>
</html>


