@extends('layouts.layout_admin')
@section('title', 'Admin - Manage Berita')

@section('styles')
    <style>
        .berita-container { width: 80%; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); }
        .berita-container h1 { color: #001e74; font-size: 28px; font-weight: 700; margin-bottom: 30px; text-align: center; }
        .btn {
            padding: 12px 25px; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
        .btn-red { background-color: red; color: #fff; }
        .btn-red:hover { background-color: darkred; }
        .btn-green { background-color: green; color: #fff; }
        .btn-green:hover { background-color: darkgreen; }
        label { font-weight: 600; display: block; margin-bottom: 8px; color: #333; }
        input[type="text"], textarea, input[type="file"] { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px; font-size: 16px; margin-bottom: 20px; box-sizing: border-box; }
        textarea { resize: vertical; }
        .form-buttons { display: flex; gap: 15px; margin-top: 20px; }
        .form-buttons .btn { flex-grow: 1; text-align: center; }
        .required-star {
            color: red;
            margin-left: 4px;
        }
        .alert { padding: 18px 25px; margin-bottom: 25px; border-radius: 8px; font-size: 15px; font-weight: 500; display: flex; align-items: center; gap: 12px; line-height: 1.5; }
        .alert-success { background-color: #d1fae5; color: #065f46; border: 1px solid #34d399; }
        .alert-danger { background-color: #fee2e2; color: #991b1b; border: 1px solid #ef4444; }
        .alert ul { margin: 0; padding-left: 20px; list-style-type: disc; }
        .alert i { font-size: 20px; }
        .text-danger { color: #dc2626; font-size: 14px; margin-top: 5px; display: block; }

    </style>
@endsection

@section('content')

    <div class="berita-container">
        <h1>Buat Berita Baru</h1>

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

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="judul">Judul:<span class="required-star">*</span> </label><br>
                <input type="text" name="judul" id="judul" style="width: 100%;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="konten">Konten:<span class="required-star">*</span> </label><br>
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

                if (xhr.status === 403) {
                    failure('HTTP Error: ' + xhr.statusText);
                    return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                    failure('HTTP Error: ' + xhr.statusText);
                    return;
                }

                json = JSON.parse(xhr.responseText);

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

        relative_urls: false,
        remove_script_host: false,
        document_base_url: "http://127.0.0.1:8000/",
    });
</script>
@endsection