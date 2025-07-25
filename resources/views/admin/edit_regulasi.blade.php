@extends('layouts.layout_admin')
@section('title', 'Manage Regulasi')
@section('styles')
<style>
        .form-container { max-width: 700px; margin: 0 auto; background: white; padding: 40px; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 10px; }
        h2 { text-align: center; color: #001e74; font-weight: bold; margin-bottom: 30px; }
        .form-control { width: 100%; margin-bottom: 20px; padding: 12px; border-radius: 8px; border: 1px solid #ccc; box-shadow: 2px 2px 5px rgba(0,0,0,0.1); font-size: 16px; }
        input[type="text"], input[type="file"], textarea { width: 98%; padding: 12px 15px; border: 1px solid #ccc; border-radius: 8px; font-size: 16px; margin-bottom: 20px; transition: all 0.3s ease; }
        .form-label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: darkgrey; text-align: left; }
        .form-buttons { display: flex; justify-content: flex-end; gap: 10px; }

        .btn { padding: 10px 25px; border-radius: 8px; font-weight: bold; border: none; cursor: pointer; font-size: 16px; transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;}
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
        .btn-green { background-color: green; color: white; }
        .btn-red { background-color: red; color: white; text-decoration: none; display: inline-block; }
        .btn-green:hover{ background-color: darkgreen; }
        .btn-red:hover{ background-color: darkred }

        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.4); }
        .modal-content { background: white; padding: 20px; max-width: 400px; margin: 100px auto; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); text-align: center; }
        .modal-content p { font-size: 18px; margin-bottom: 20px; }
        .modal-buttons { display: flex; justify-content: center; gap: 10px; }
        .btn-cancel, .btn-confirm { padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 14px; }
        .btn-cancel { background-color: gray; color: white; }
        .btn-confirm { background-color: green; color: white; }
    </style>
@endsection

@section('content')

    <div class="form-container">
        <h2>Form Mengedit Regulasi</h2>
        <form action="{{ route('admin.regulasi.update', $regulasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label class="form-label">Kategori:</label>
            <input type="text" name="category" value= "{{ $regulasi->category }}">
            
            <label class="form-label">Tahun:</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ old('year', $regulasi->year) }}" required min="1900" max="{{ date('Y') }}">

            <label class="form-label">Judul:</label>
            <textarea name="content"> {{ $regulasi->content }}</textarea>
            
            <label class="form-label">Tentang:</label>
            <input type="text" name="title" value= "{{ $regulasi->title }}">

            <label class="form-label">File Sebelumnya:</label>
            @if ($regulasi->file_path)
                <div style="margin-bottom: 10px;">
                    <a href="{{ route('admin.regulasi.file', $regulasi->file_path) }}" target="_blank" class="btn-download">Lihat File</a>
                    <p style="font-style: italic; font-size: 14px;">{{ $regulasi->file_path }}</p>
                </div>
            @endif

            <label class="form-label">Unggah File Baru (Opsional):</label>
            <input type="file" name="file" class="form-control">


            <div class="form-buttons">
                <button type="button" class="btn btn-green" onclick="showSaveModal()">Simpan</button>
                <a href="{{ route('admin.regulasi') }}" class="btn btn-red">Batal</a>
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
@endsection

@section('styles')
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

        window.onclick = function(event) {
            const modal = document.getElementById('saveModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection