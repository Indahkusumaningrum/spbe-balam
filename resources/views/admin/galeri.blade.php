<!-- GALERI UNTUK ADMIN -->
<!-- resources/views/admin/galeri/index.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .galeri-container {
            padding: 40px 60px;
        }

        h1 {
            font-size: 32px;
            color: #001e74;
            margin-bottom: 30px;
            border-bottom: 4px solid #facc15;
            display: inline-block;
            padding-bottom: 4px;
        }

        .btn-tambah {
            display: inline-block;
            background-color: #facc15;
            color: white;
            font-weight: 600;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 24px;
            
        }

        .galeri-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .galeri-card {
            width: calc((100% - 60px) / 4);
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .galeri-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .galeri-title {
            font-size: 16px;
            font-weight: 600;
            color: #001e74;
            padding: 10px;
            text-align: center;
        }

        .galeri-actions {
            display: flex;
            justify-content: center; /* posisikan tombol-tombol di tengah horizontal */
            gap: 10px;
            margin-bottom: 10px;
        }

        .galeri-actions .btn-edit,
        .galeri-actions .btn-delete {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: none;
            background-color: #e0e7ff; /* warna biru muda */
            color: #001e74;
            font-size: 16px;
            transition: background-color 0.3s ease;
            text-decoration: none; /* Hapus garis bawah */

        }

        .galeri-actions .btn-edit:hover {
            background-color: #c7d2fe;
            text-decoration: none; /* Hapus garis bawah */
        }

        .galeri-actions .btn-delete {
            background-color: #fee2e2; /* warna merah muda */
            color: #b91c1c;
        }

        .galeri-actions .btn-delete:hover {
            background-color: #fecaca;
        }


        .btn-edit, .btn-delete {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }

        .btn-edit i { color: #007bff; }
        .btn-delete i { color: #dc3545; }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

            .modal-content {
                background: white;
                padding: 20px;
                max-width: 400px;
                margin: 100px auto;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                text-align: center;
            }

            .modal-content p {
                font-size: 18px;
                margin-bottom: 20px;
            }

            .modal-buttons {
                display: flex;
                justify-content: center;
                gap: 10px;
            }

            .btn-cancel,
            .btn-confirm,
            .btn-ok {
                padding: 10px 20px;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                font-weight: bold;
                font-size: 14px;
            }

            .btn-cancel {
                background-color: gray;
                color: white;
            }

            .btn-confirm {
                background-color: red;
                color: white;
            }

            .btn-ok {
                background-color: green;
                color: white;
            }

    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('content')
<div class="galeri-container">
    <h1>Galeri</h1>
    <a href="{{ route('admin.galeri.create') }}" style="justify-content: flex-end;" class="btn-tambah"><i class="fas fa-plus"></i> Tambah Foto</a>

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


