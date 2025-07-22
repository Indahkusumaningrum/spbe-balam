<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Regulasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .form-container { max-width: 700px; margin: 0 auto; background: white; padding: 40px; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 10px; }
        h2 { text-align: center; color: #001e74; font-weight: bold; margin-bottom: 30px; }
        label { display: block; margin-bottom: 8px; font-weight: 500; color: #333; }
        .required-star { color: red; margin-left: 4px; }
        .form-control { width: 100%; margin-bottom: 20px; padding: 12px; border-radius: 8px; border: 1px solid #ccc; box-shadow: 2px 2px 5px rgba(0,0,0,0.1); font-size: 16px; }
        .form-buttons { display: flex; justify-content: flex-end; gap: 10px; }
        
        .btn { padding: 10px 25px; border-radius: 8px; font-weight: bold; border: none; cursor: pointer; font-size: 16px; transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;}
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
        .btn-green { background-color: green; color: white; }
        .btn-red { background-color: red; color: white; text-decoration: none; display: inline-block; }
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.4); }
        .modal-content { background: white; padding: 20px; max-width: 400px; margin: 100px auto; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); text-align: center; }
        .modal-content p { font-size: 18px; margin-bottom: 20px; }
        .modal-buttons { display: flex; justify-content: center; gap: 10px; }
        .btn-cancel, .btn-confirm { padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 14px; }
        .btn-cancel { background-color: gray; color: white; }
        .btn-confirm { background-color: green; color: white; }
    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Manage Regulasi')
@section('content')

    <div class="form-container">
        <h2>Form Menambah File Regulasi Baru</h2>

        @if ($errors->any())
        <div style="background-color: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.regulasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="category">Kategori<span class="required-star">*</span></label>
            <input type="text" name="category" placeholder="Ex: Peraturan Walikota" class="form-control" required>
            
            <label for="year">Tahun<span class="required-star">*</span> </label>
            <input type="number" name="year" id="year" placeholder="Ex: 2025" class="form-control" value="{{ old('year') }}" required min="1900" max="{{ date('Y') }}">

            <label for="content">Judul<span class="required-star">*</span></label>
            <textarea name="content" placeholder="Ex: Peraturan Walikota PAN-RB RI Nomor 19 Tahun 2018" rows="5" class="form-control" required></textarea>
            
            <label for="title">Tentang<span class="required-star">*</span></label>
            <input type="text" name="title" placeholder="Ex: Penyusunan Peta Proses Bisnis Instansi Pemerintah" class="form-control" required>
            
            <label for="title">File<span class="required-star">*</span></label>
            <input type="file" name="file" accept=".pdf,.docx,.xlsx,.zip,.rar,.png,.jpg" class="form-control" required>

            <div class="form-buttons">
                <button type="button" class="btn btn-green" onclick="showSaveModal()">Simpan</button>
                <a href="{{ route('admin.regulasi') }}" class="btn btn-red">Batal</a>
            </div>
        </form>
    </div>
@endsection

<!-- Modal Konfirmasi -->
<div id="saveModal" class="modal">
    <div class="modal-content">
        <p>Apakah Anda yakin ingin menyimpan file ini?</p>
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
