@extends('layouts.layout_admin')
@section('title', 'Mengedit Berita')

@section('styles')
<style>
    body { font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background-color: #fff; color: #333; }
    .form-container { width: 90%; max-width: 900px; margin: 0px auto; background-color: #ffffff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); box-sizing: border-box; }
    .form-container h2 { color: #001e74; font-size: 28px; font-weight: 700; margin-bottom: 30px; text-align: center; position: relative; padding-bottom: 10px; }
    .form-container h2::after { content: ''; position: absolute; left: 50%; bottom: 0; transform: translateX(-50%); width: 80px; height: 4px; background-color: #facc15; border-radius: 2px; }
    .form-group { margin-bottom: 25px; }
    .form-label { font-weight: 600; display: block; margin-bottom: 10px; color: #333; font-size: 16px; }
    .form-control, .form-control-file { width: 100%; padding: 12px 15px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 16px; box-sizing: border-box; transition: border-color 0.3s ease, box-shadow 0.3s ease; }
    .form-control:focus,
    .form-control-file:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25); outline: none; }
    textarea.form-control { resize: vertical; min-height: 200px; }
    .gambar { display: block; max-width: 250px; height: auto; margin-top: 15px; border-radius: 8px; border: 1px solid #e5e7eb; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); }
    .form-text { font-size: 14px; color: #6b7280; margin-top: 8px; display: block; }
    .form-buttons { display: flex; gap: 15px; margin-top: 20px; flex-wrap: wrap; justify-content: flex-end; }
    .btn {
        padding: 12px 25px; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px; flex-grow: 1; min-width: 150px; max-width: 250px; }
    .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
    .btn-red { background-color: red; color: #fff; }
    .btn-red:hover { background-color: darkred; }
    .btn-green { background-color: green; color: #fff; }
    .btn-green:hover { background-color: darkgreen; }
    .alert { padding: 18px 25px; margin-bottom: 25px; border-radius: 8px; font-size: 15px; font-weight: 500; display: flex; align-items: center; gap: 12px; line-height: 1.5; }
    .alert-success { background-color: #d1fae5; color: #065f46; border: 1px solid #34d399; }
    .alert-danger { background-color: #fee2e2; color: #991b1b; border: 1px solid #ef4444; }
    .alert ul { margin: 0; padding-left: 20px; list-style-type: disc; }
    .alert i { font-size: 20px; }
    .text-danger { color: #dc2626; font-size: 14px; margin-top: 5px; display: block; }
    .tox .tox-tinymce { border-radius: 8px; border: 1px solid #d1d5db; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); outline: none !important; }
    .tox .tox-toolbar-overlord, .tox .tox-menubar { border-radius: 8px 8px 0 0; }
    .tox:not([dir=rtl]) .tox-toolbar__group:not(:last-of-type) { border-right: 1px solid #e5e7eb; }
    .tox .tox-collection__item { color: #4b5563; }
    .tox .tox-collection__item:hover { background-color: #f3f4f6; color: #1f2937; }
    .tox .tox-tbtn svg { fill: #4b5563; }
    .tox .tox-tbtn--enabled svg { fill: #3b82f6; }
    @media (max-width: 768px) {
        .form-container { width: 95%; padding: 25px; margin: 30px auto; }
        .form-container h2 { font-size: 24px; margin-bottom: 25px; }
        .form-buttons { flex-direction: column; gap: 10px; align-items: stretch; justify-content: flex-start; }
        .btn { width: auto; flex-grow: 0; max-width: none; }
    }
    @media (max-width: 480px) {
        .form-container { padding: 15px; margin: 15px auto; }
        .form-container h2 { font-size: 20px; }
        .btn { padding: 10px 15px; font-size: 14px; }
    }
    .required-star {
            color: red;
            margin-left: 4px;
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <h2>Mengedit Berita</h2>
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
            <label for="judul" class="form-label">Judul:<span class="required-star">*</span></label>
            <input type="text" id="judul" name="judul" class="form-control" value="{{ old('judul', $berita->judul) }}" required>
            @error('judul')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="konten" class="form-label">Konten:<span class="required-star">*</span></label>
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
