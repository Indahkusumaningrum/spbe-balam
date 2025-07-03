<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Galeri</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .galeri-container {
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .galeri-container h1 {
            color: #001e74;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: green;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #006400;
        }

        .btn-kembali {
            background-color: #ccc;
            color: #000;
            padding: 10px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .btn-kembali:hover {
            background-color: #bbb;
        }

        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
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
            .btn-confirm {
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
                background-color: green;
                color: white;
            }

    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Tambah Galeri')
@section('content')

<div class="galeri-container">
    <h1>Tambah Foto Galeri</h1>

    @if ($errors->any())
        <div style="background-color: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form id="galeriForm" action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
    @csrf


    <div>
        <label for="judul">Judul Foto:</label>
        <input type="text" name="title" id="judul" value="{{ old('title') }}">
    </div>

    <div>
        <label for="gambar">Pilih Gambar:</label>
        <input type="file" name="image" id="gambar" accept="image/*">
    </div>

    <!-- Tombol -->
    <div style="form-button;">
        <button type="submit" class="btn-confirm" onclick=>Simpan</button>
        <a href="{{ route('admin.galeri') }}" class="btn-kembali">Batal</a>
    </div>
</form>

</div>

@endsection

<!-- Modal Konfirmasi -->
<div id="saveModal" class="modal">
    <div class="modal-content">
        <p>Apakah Anda yakin ingin menambahkandata file ini?</p>
        <div class="modal-buttons">
            <button onclick="closeSaveModal()" class="btn-cancel">Batal</button>
            <button onclick="submitForm()" class="btn-confirm">Ya, Simpan</button>
        </div>
    </div>
</div>

<!-- Modal Berhasil -->
@if(session('success'))
<div id="successModal" class="modal" style="display: block;">
    <div class="modal-content">
        <p>{{ session('success') }}</p>
        <div class="modal-buttons">
            <button onclick="closeSuccessModal()" class="btn-confirm">OK</button>
        </div>
    </div>
</div>
@endif


<script>
        function showSaveModal() {
            document.getElementById('saveModal').style.display = 'block';
        }

        function closeSaveModal() {
            document.getElementById('saveModal').style.display = 'none';
        }

        function submitForm() {
        document.querySelector('form').submit();
        }

        function closeSuccessModal() {
        document.getElementById('successModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('saveModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


</body>
</html>
