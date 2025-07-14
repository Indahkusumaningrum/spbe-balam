@extends('layouts.layout_admin')
@section('title', 'Edit Profil')

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

    /* Main Container Styling (Reusing .main-container for consistency) */
    .main-container {
        width: 90%;
        max-width: 900px; /* Batasi lebar maksimal form */
        margin: 50px auto; /* Tengahkan form */
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); /* Shadow yang lebih halus */
    }

    /* Page Title Styling */
    .main-container h2 { /* Menggunakan h2 karena di Blade Anda h2 */
        color: #001e74;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 30px;
        text-align: center;
        position: relative;
        padding-bottom: 10px;
    }

    .main-container h2::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        width: 80px; /* Lebar underline */
        height: 4px;
        background-color: #facc15;
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

    /* Input, Select, and Textarea Styling */
    .form-control,
    .form-control-file { /* Menambahkan form-control-file untuk input type file */
        width: 100%;
        padding: 12px 15px; /* Padding yang nyaman */
        border: 1px solid #d1d5db; /* Border abu-abu terang */
        border-radius: 8px; /* Sudut membulat */
        font-size: 16px;
        box-sizing: border-box; /* Penting untuk konsistensi lebar */
        transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Transisi halus */
        background-color: #fff; /* Pastikan background putih */
    }

    .form-control:focus,
    .form-control-file:focus {
        border-color: #3b82f6; /* Border biru saat fokus */
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25); /* Glow biru lembut */
        outline: none; /* Hapus outline default browser */
    }

    textarea.form-control {
        resize: vertical; /* Izinkan user mengubah tinggi secara vertikal */
        min-height: 150px; /* Tinggi minimum yang nyaman */
    }

    /* Image Preview Styling */
    .profile-image { /* Mengganti .gambar menjadi .profile-image */
        display: block;
        max-width: 250px; /* Lebar maksimum gambar pratinjau */
        height: auto;
        margin: 15px auto 20px auto; /* Tengahkan gambar dan spasi */
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .form-text {
        font-size: 14px;
        color: #6b7280;
        margin-top: 8px;
        display: block;
    }

    /* Button Group Styling */
    .form-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 40px;
    }

    /* Button Base Styling */
    .btn-action {
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Specific Button Colors (Consistent with other admin pages) */
    .btn-green { /* Mengganti btn-success menjadi btn-green */
        background-color: #22c55e;
    }
    .btn-green:hover {
        background-color: #16a34a;
    }

    .btn-red { /* Mengganti btn-secondary menjadi btn-red */
        background-color: #ef4444;
        color: #fff;
    }
    .btn-red:hover {
        background-color: #dc2626;
    }

    /* Alert Messages Styling (Consistent with other admin pages) */
    .alert {
        padding: 18px 25px;
        margin-bottom: 25px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 12px;
        line-height: 1.5;
        border: 1px solid;
    }

    .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border-color: #34d399;
    }

    .alert-danger {
        background-color: #fee2e2;
        color: #991b1b;
        border-color: #ef4444;
    }

    .alert i {
        font-size: 20px;
    }

    /* TinyMCE Editor Customization to blend with theme */
    .tox .tox-tinymce {
        border-radius: 8px;
        border: 1px solid #d1d5db;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        outline: none !important;
    }
    .tox .tox-toolbar-overlord, .tox .tox-menubar {
        border-radius: 8px 8px 0 0;
    }
    .tox:not([dir=rtl]) .tox-toolbar__group:not(:last-of-type) {
        border-right: 1px solid #e5e7eb;
    }
    .tox .tox-collection__item {
        color: #4b5563;
    }
    .tox .tox-collection__item:hover {
        background-color: #f3f4f6;
        color: #1f2937;
    }
    .tox .tox-tbtn svg {
        fill: #4b5563;
    }
    .tox .tox-tbtn--enabled svg {
        fill: #3b82f6;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .main-container {
            width: 95%;
            padding: 25px;
            margin: 30px auto;
        }
        .main-container h2 {
            font-size: 24px;
            margin-bottom: 25px;
        }
        .form-buttons {
            flex-direction: column;
            gap: 10px;
        }
        .btn-action {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="main-container">
    <h2>Form Mengedit Profil</h2>

    @if(session('success'))
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

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label">Gambar Profil Saat Ini:</label>
            @if($profile && $profile->gambar)
                <img src="{{ asset('uploads/profiles/' . $profile->gambar) }}" alt="Gambar Profil" class="profile-image">
            @else
                <p class="form-text">Tidak ada gambar profil saat ini.</p>
            @endif
        </div>

        <div class="form-group">
            <label for="nama_instansi" class="form-label">Nama Instansi:</label>
            <input type="text" name="nama_instansi" id="nama_instansi" class="form-control" placeholder="Nama Instansi" value="{{ old('nama_instansi', $profile->nama_instansi ?? '') }}" required>
            @error('nama_instansi')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi" class="form-label">Deskripsi:</label> {{-- Mengubah for dan name menjadi 'deskripsi' --}}
            <textarea name="deskripsi" id="deskripsi" placeholder="Deskripsi" class="form-control" rows="10" required>{{ old('deskripsi', $profile->deskripsi ?? '') }}</textarea>
            @error('deskripsi')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="gambar" class="form-label">Pilih gambar baru:</label> {{-- Mengubah for dan name menjadi 'gambar' --}}
            <input type="file" name="gambar" id="gambar" class="form-control-file">
            <small class="form-text">Biarkan kosong jika tidak ingin mengubah gambar.</small>
            @error('gambar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-action btn-green">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('profile') }}" class="btn-action btn-red">
                <i class="fas fa-times-circle"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
{{-- CDN TinyMCE --}}
<script src="https://cdn.tiny.cloud/1/d76o0fl5eus3mqblrpoqew4ucr8b7y6nahboxpuujphg15lj/tinymce/5.10.7/tinymce.min.js?v=profile" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#deskripsi', // Pastikan ID ini sesuai dengan ID textarea Anda
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
        images_upload_url: '{{ route('tinymce.upload.image') }}', // Pastikan route ini sudah benar dan dapat diakses
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