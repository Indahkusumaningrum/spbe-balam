<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Download</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        .form-container {
            max-width: 700px;
            width: 90%; 
            margin: 20px auto; 
            background: white;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #001e74;
            font-weight: bold;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .required-star {
            color: red;
            margin-left: 4px;
        }

        .form-control {
            width: 100%;
            margin-bottom: 20px;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea.form-control {
            resize: vertical; /* Allow vertical resizing */
            min-height: 100px; /* Minimum height for textarea */
        }

        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px
        }

        .btn {
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-green {
            background-color: green;
            color: white;
        }

        .btn-green:hover {
            background-color: darkgreen; 
        }

        .btn-red {
            background-color: red;
            color: white;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-red:hover {
            background-color: #c82333; /* Darker red on hover */
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
            display: flex; /* Use flexbox for centering */
            justify-content: center;
            align-items: center;
        }

            .modal-content {
                background: white;
                padding: 30px; /* Increased padding */
                max-width: 400px;
                width: 90%; /* Responsive width */
                margin: auto; /* Center horizontally */
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                text-align: center;
                animation: fadeIn 0.3s ease-out; 
            }

            .modal-content p {
                font-size: 18px;
                margin-bottom: 25px;
                color: #333;
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
                transition: background-color 0.3s ease;
            }

            .btn-cancel {
                background-color: gray;
                color: white;
            }

            .btn-cancel:hover {
                background-color: #5a6268;
            }

            .btn-confirm {
                background-color: green;
                color: white;
            }

            .btn-confirm:hover {
                background-color: #218838;
            }

            /* Animation for modal */
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            /* Error message styling */
            .error-message {
                background-color: #fee2e2;
                color: #b91c1c;
                padding: 12px;
                border-radius: 8px;
                margin-bottom: 20px;
            }

            .error-message ul {
                margin: 0;
                padding-left: 20px;
                list-style-type: disc;
            }

            /* Responsive adjustments */
            @media (max-width: 600px) {
                .form-container {
                    padding: 20px;
                }

                .btn {
                    padding: 10px 15px;
                    font-size: 14px;
                }

                .form-buttons {
                    flex-direction: column;
                    align-items: stretch;
                }

                .btn-green, .btn-red {
                    width: 100%;
                    margin-bottom: 10px;
                }
            }

    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('content')

    <div class="form-container">
        <h2>Form Menambah File Baru</h2>

        <!-- Pesan Error kalau ada inputan kosong -->
        @if ($errors->any())
        <div style="background-color: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.download.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="category">Kategori<span class="required-star">*</span> </label>
            <input type="text" name="category" placeholder="Ex: Peraturan Walikota" class="form-control" required>
            
            <label for="year">Tahun<span class="required-star">*</span> </label>
            <input type="number" name="year" id="year" placeholder="Ex: 2025" class="form-control" value="{{ old('year') }}" required min="1900" max="{{ date('Y') }}">

            <label for="content">Judul<span class="required-star">*</span></label>
            <textarea name="content" placeholder="Ex: Peraturan Walikota PAN-RB RI Nomor 19 Tahun 2018" rows="5" class="form-control" required></textarea>
            
            <label for="title">Tentang<span class="required-star">*</span> </label>
            <input type="text" name="title" placeholder="Ex: Penyusunan Peta Proses Bisnis Instansi Pemerintah" class="form-control" required>
            
            <label for="file">File<span class="required-star">*</span> </label>
            <input type="file" name="file" accept=".pdf,.docx,.xlsx,.zip,.rar,.png,.jpg" class="form-control" required>

            <div class="form-buttons">
                <button type="button" class="btn btn-green" onclick="showSaveModal()">Simpan</button>
                <a href="{{ route('admin.download') }}" class="btn btn-red">Batal</a>
            </div>
        </form>
    </div>


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

@endsection


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