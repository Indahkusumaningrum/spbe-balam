<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Download</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .table-container {
            padding: 24px;

        }

        .download-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 22px;
            color: #001e74;
            border-bottom: 3px solid #facc15;
            display: inline-block;
            padding-bottom: 4px;
            margin: 30px 30px 10px;
        }

        .tambah {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .btn-add {
            background-color: #facc15;
            color: white;
            padding: 7px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-right: 7px;
        }

        .p {
            font-size: 17px;
            font-weight: bold;
            color: #001e74
        }

        table {
            width: 95%;
            border-collapse: collapse;
            background-color: white;
            margin: auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #001e74;
            color: white;
            font-size: 16px;
        }

        td{
            font-size: 15px;
        }

        td.action-btn {
            vertical-align: middle;
        }

        tr:nth-child(even) {
            background-color: #eee;
        }

        .action-btn {
            gap: 8px;
            flex-direction: row; /* dari column jadi row */
            justify-content: center; /* agar rapi di tengah */
            align-items: center;     /* vertikal rata tengah */
        }

        .action-btn form {
            display: inline-block;
        }

        .btn-download {
            background-color: #007bff;
            display: inline-block;
            color: white;
            padding: 6px 8px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            border: none;
            outline: none;
        }

        .btn-download:hover {
            transform: scale(1.03);
        }

        .action-btn .btn-edit,
        .action-btn .btn-delete {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: none;
            background-color: #e0e7ff;
            color: #001e74;
            transition: background-color 0.3s ease;
            text-decoration: none;

        }

        .action-btn .btn-edit:hover {
            background-color: #c7d2fe;
        }

        .action-btn .btn-delete {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .action-btn .btn-delete:hover {
            background-color: #fecaca;
        }

        .btn-edit, .btn-delete {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px 7px;
            font-size: 16px;
        }

        .btn-edit i {
            color: #007bff;
            font-size: 18px;
        }

        .btn-delete i {
            color: #dc3545;
            font-size: 18px;
        }

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
@section('title', 'Manage Download')
@section('content')

    <div class="table-container">
        <div class="download-header">
            <h1>Download</h1>
            <div class="tambah">
                <a href="{{ route('download.create') }}" class="btn-add"><i class="fas fa-plus" style="font-size: 17px;"></i></a>
                <p class="p">Tambah File</p>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width: 15%;">Category</th>
                    <th style="width: 23%;">Title</th>
                    <th style="width: 40%;">Content</th>
                    <th style="width: 12%;">File</th>
                    <th style="width: 10%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($downloads as $d)
                    <tr>
                        <td>{{ $d->category }}</td>
                        <td>{{ $d->title }}</td>
                        <td>{{ $d->content }}</td>
                        <td>
                            <a href="{{ route('admin.download.file', $d->file_path) }}" class="btn-download">Download</a>
                        </td>
                        <td class="action-btn">
                            <a href="{{ route('download.edit', ['id' => $d->id]) }}" class="btn-edit" method="GET">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form id="delete-form-{{ $d->id }}" action="{{ route('admin.download.destroy', $d->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <button type="button" class="btn-delete" onclick="showDeleteModal({{ $d->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection

<!-- Modal Konfirmasi -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <p>Apakah Anda yakin ingin menghapus file ini?</p>
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



</body>
</html>
