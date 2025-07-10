<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Berita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.tiny.cloud/1/d76o0fl5eus3mqblrpoqew4ucr8b7y6nahboxpuujphg15lj/tinymce/5.10.7/tinymce.min.js?v=123" referrerpolicy="origin"></script>
    <style>
       .berita-container {
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .berita-container h1 {
            color: #001e74;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease; /* Transisi untuk hover/active */
            text-decoration: none; /* Hapus underline untuk link */
            display: inline-flex; /* Agar ikon dan teks sejajar */
            align-items: center;
            justify-content: center;
            gap: 8px; /* Spasi antara ikon dan teks */
        }

        .btn:hover {
            transform: translateY(-2px); /* Efek 'angkat' saat hover */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Shadow saat hover */
        }

        .btn-red {
            background-color: #ef4444; /* Merah cerah */
            color: #fff;
        }

        .btn-red:hover {
            background-color: #dc2626; /* Merah lebih gelap */
        }

        .btn-green {
            background-color: #22c55e; /* Hijau cerah */
            color: #fff;
        }

        .btn-green:hover {
            background-color: #16a34a; /* Hijau lebih gelap */
        }


        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        button[type="submit"] {
            background-color: #001e74;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #3b82f6;
        }

    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Manage Berita')
@section('content')

    <div class="berita-container">
        <h1>Buat Berita Baru</h1>

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="judul">Judul:</label><br>
                <input type="text" name="judul" id="judul" style="width: 100%;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="konten">Konten:</label><br>
                <!-- {{-- Textarea ini akan diubah menjadi TinyMCE --}} -->
                <textarea name="konten" id="konten" rows="10" style="width: 100%;"></textarea>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="gambar">Gambar cover:</label><br>
                <input type="file" name="gambar" id="gambar">
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.berita') }}" class="btn btn-red">Batal</a>
                <button type="submit" class="btn btn-green">Simpan Perubahan</button>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
<script>
    tinymce.init({
        selector: '#konten',
        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image media | code | help',
        content_style: 'body { font-family: "Poppins", sans-serif; font-size: 16px; }',

        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.onchange = function () {
                var file = this.files[0];
                var reader = new FileReader();

                reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
            };

            input.click();
        },
        images_upload_url: '{{ route('tinymce.upload.image') }}',
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{ route('tinymce.upload.image') }}');

            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

            xhr.onload = function() {
                var json;

                if (xhr.status === 403) {
                    failure('HTTP Error: ' + xhr.statusText);
                    return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                    failure('HTTP Error: ' + xhr.statusText);
                    return;
                }

                json = JSON.parse(xhr.responseText); // Simplified, assume error handling is robust

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: location property missing or not a string.');
                    return;
                }

                let imageUrl = decodeURIComponent(json.location).trim();
                success(imageUrl);
            };

            xhr.onerror = function () {
                failure('Image upload failed due to a XHR Transport error.');
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        },

        // --- TAMBAHKAN ATAU MODIFIKASI OPSI INI ---
        relative_urls: false, // Penting: Jangan gunakan URL relatif
        remove_script_host: false, // Penting: Pertahankan host (http://127.0.0.1:8000)
        document_base_url: "http://127.0.0.1:8000/", // Opsional, tetapi membantu
        // --- AKHIR PENAMBAHAN ---

        // Catatan: Jika Anda kembali ke TinyMCE v6, pastikan URL CDN tetap di v6.
        // Script CDN Anda di berita_create.blade.php
        // <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/tinymce.min.js?v=..."
    });
</script>
@endsection

</body>
</html>
