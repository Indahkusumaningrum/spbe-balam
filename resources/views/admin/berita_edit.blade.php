@extends('layouts.layout_admin')
@section('title', 'Mengedit Berita')

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

    /* Container for the Form */
    .form-container {
        width: 90%; /* Lebar responsif */
        max-width: 900px; /* Batasi lebar maksimal form */
        margin: 50px auto; /* Tengahkan form dengan margin atas/bawah */
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); /* Shadow yang lebih halus */
    }

    .form-container h2 {
        color: #001e74; /* Warna biru gelap dari tema Anda */
        font-size: 28px; /* Ukuran judul yang dominan */
        font-weight: 700; /* Tebal */
        margin-bottom: 30px;
        text-align: center;
        position: relative; /* Untuk efek underline */
        padding-bottom: 10px;
    }

    .form-container h2::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        width: 80px; /* Lebar underline */
        height: 4px;
        background-color: #facc15; /* Warna aksen dari tema Anda */
        border-radius: 2px;
    }

    /* Form Group Styling */
    .form-group {
        margin-bottom: 25px; /* Spasi antar grup form yang cukup */
    }

    .form-label {
        font-weight: 600;
        display: block; /* Memastikan label berada di baris sendiri */
        margin-bottom: 10px; /* Spasi antara label dan input */
        color: #333;
        font-size: 16px;
    }

    /* Input and Textarea Styling */
    .form-control,
    .form-control-file {
        width: 100%;
        padding: 12px 15px; /* Padding yang nyaman */
        border: 1px solid #d1d5db; /* Border abu-abu terang */
        border-radius: 8px; /* Sudut membulat */
        font-size: 16px;
        box-sizing: border-box; /* Penting untuk konsistensi lebar */
        transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Transisi halus */
    }

    .form-control:focus,
    .form-control-file:focus {
        border-color: #3b82f6; /* Border biru saat fokus */
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25); /* Glow biru lembut */
        outline: none; /* Hapus outline default browser */
    }

    textarea.form-control {
        resize: vertical; /* Izinkan user mengubah tinggi secara vertikal */
        min-height: 200px; /* Tinggi minimum yang nyaman untuk editor */
    }

    /* Image Preview Styling */
    .gambar {
        display: block; /* Gambar di baris baru */
        max-width: 250px; /* Lebar maksimum gambar pratinjau */
        height: auto; /* Jaga rasio aspek */
        margin-top: 15px; /* Spasi dari input file */
        border-radius: 8px; /* Sudut membulat */
        border: 1px solid #e5e7eb; /* Border halus */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); /* Shadow lembut */
    }

    .form-text {
        font-size: 14px;
        color: #6b7280; /* Warna teks muted yang lebih gelap */
        margin-top: 8px;
        display: block;
    }

    /* Button Group Styling */
    .form-buttons {
        display: flex;
        justify-content: flex-end; /* Tombol rata kanan */
        gap: 15px; /* Spasi antar tombol */
        margin-top: 40px; /* Spasi dari elemen di atasnya */
    }

    /* Button Base Styling */
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

    /* Specific Button Colors */
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

    /* Alert Messages Styling */
    .alert {
        padding: 18px 25px;
        margin-bottom: 25px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 12px; /* Spasi antara ikon dan teks */
        line-height: 1.5;
    }

    .alert-success {
        background-color: #d1fae5; /* Light green */
        color: #065f46; /* Dark green text */
        border: 1px solid #34d399; /* Green border */
    }

    .alert-danger {
        background-color: #fee2e2; /* Light red */
        color: #991b1b; /* Dark red text */
        border: 1px solid #ef4444; /* Red border */
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
        list-style-type: disc; /* Untuk daftar error */
    }

    .alert i {
        font-size: 20px; /* Ukuran ikon */
    }

    .text-danger {
        color: #dc2626; /* Merah untuk error validasi */
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }

    /* TinyMCE Editor Customization to blend with theme */
    .tox .tox-tinymce {
        border-radius: 8px; /* Sudut membulat pada editor */
        border: 1px solid #d1d5db; /* Border serasi dengan input lain */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); /* Shadow lembut */
        /* Hapus outline/shadow default TinyMCE jika tidak diinginkan */
        outline: none !important;
    }

    .tox .tox-toolbar-overlord, .tox .tox-menubar {
        border-radius: 8px 8px 0 0; /* Sudut membulat hanya di bagian atas */
    }

    .tox:not([dir=rtl]) .tox-toolbar__group:not(:last-of-type) {
        border-right: 1px solid #e5e7eb; /* Border halus antar grup toolbar */
    }

    .tox .tox-collection__item {
        color: #4b5563; /* Warna ikon/teks toolbar */
    }

    .tox .tox-collection__item:hover {
        background-color: #f3f4f6; /* Warna latar belakang saat hover */
        color: #1f2937;
    }

    .tox .tox-tbtn svg {
        fill: #4b5563; /* Warna ikon SVG */
    }

    .tox .tox-tbtn--enabled svg {
        fill: #3b82f6; /* Warna ikon aktif */
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .form-container {
            width: 95%; /* Lebih lebar di layar kecil */
            padding: 25px;
            margin: 30px auto;
        }

        .form-container h2 {
            font-size: 24px;
            margin-bottom: 25px;
        }

        .form-buttons {
            flex-direction: column; /* Tombol menumpuk vertikal */
            gap: 10px;
        }

        .btn {
            width: 100%; /* Tombol memenuhi lebar */
        }
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <h2>Mengedit Berita</h2>
    {{-- Tampilkan pesan sukses atau error jika ada --}}
    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.berita.update', $berita->id_berita) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="judul" class="form-label">Judul:</label>
            <input type="text" id="judul" name="judul" class="form-control" value="{{ old('judul', $berita->judul) }}" required>
            @error('judul')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="konten" class="form-label">Konten:</label>
            <textarea name="konten" id="konten" class="form-control" rows="10" required>{{ old('konten', $berita->konten) }}</textarea>
            @error('konten')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="gambar" class="form-label">Gambar cover Saat Ini:</label>
            @if($berita->gambar)
                <img class="gambar" src="{{ asset('uploads/beritas/' . $berita->gambar) }}" alt="Gambar Berita">
            @else
                <small class="form-text text-muted">Belum ada gambar utama yang diunggah.</small>
            @endif
            <input type="file" id="gambar" name="gambar" class="form-control-file" style="margin-top: 15px;">
            <small class="form-text text-muted">Pilih file baru jika Anda ingin mengubah gambar utama.</small>
            @error('gambar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-buttons">
            <a href="{{ route('admin.berita') }}" class="btn btn-red">Batal</a>
            <button type="submit" class="btn btn-green">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
{{-- CDN TinyMCE --}}
<script src="https://cdn.tiny.cloud/1/d76o0fl5eus3mqblrpoqew4ucr8b7y6nahboxpuujphg15lj/tinymce/6/tinymce.min.js?v=edit" referrerpolicy="origin"></script>

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
                if (xhr.status === 403) { failure('HTTP Error: ' + xhr.statusText); return; }
                if (xhr.status < 200 || xhr.status >= 300) { failure('HTTP Error: ' + xhr.statusText); return; }
                try { json = JSON.parse(xhr.responseText); } catch (e) { failure('Failed to parse JSON response: ' + e.message); return; }
                if (!json || typeof json.location != 'string') { failure('Invalid JSON: location property missing or not a string.'); return; }
                let imageUrl = decodeURIComponent(json.location).trim();
                success(imageUrl);
            };

            xhr.onerror = function () { failure('Image upload failed due to a XHR Transport error.'); };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },
        relative_urls: false,
        remove_script_host: false,
        document_base_url: "http://127.0.0.1:8000/"
    });
</script>
@endsection