@extends('layouts.layout_admin')
@section('title', 'Edit Indikator')

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

    /* Main Container Styling */
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
    .main-container h1 {
        color: #001e74; /* Warna biru gelap dari tema Anda */
        font-size: 28px; /* Ukuran judul yang dominan */
        font-weight: 700; /* Tebal */
        margin-bottom: 30px;
        text-align: center;
        position: relative; /* Untuk efek underline */
        padding-bottom: 10px;
    }

    .main-container h1::after {
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

    /* Input, Select, and Textarea Styling */
    .form-control {
        width: 100%;
        padding: 12px 15px; /* Padding yang nyaman */
        border: 1px solid #d1d5db; /* Border abu-abu terang */
        border-radius: 8px; /* Sudut membulat */
        font-size: 16px;
        box-sizing: border-box; /* Penting untuk konsistensi lebar */
        transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Transisi halus */
        background-color: #fff; /* Pastikan background putih */
    }

    .form-control:focus {
        border-color: #3b82f6; /* Border biru saat fokus */
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25); /* Glow biru lembut */
        outline: none; /* Hapus outline default browser */
    }

    textarea.form-control {
        resize: vertical; /* Izinkan user mengubah tinggi secara vertikal */
        min-height: 120px; /* Tinggi minimum yang nyaman */
    }

    /* Button Group Styling */
    .form-buttons {
        display: flex;
        justify-content: flex-end; /* Tombol rata kanan */
        gap: 15px; /* Spasi antar tombol */
        margin-top: 40px; /* Spasi dari elemen di atasnya */
    }

    /* Button Base Styling */
    .btn-action {
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
        color: #fff; /* Default color for buttons */
        box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Subtle shadow for buttons */
    }

    .btn-action:hover {
        transform: translateY(-2px); /* Efek 'angkat' saat hover */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Shadow saat hover */
    }

    /* Specific Button Colors */
    .btn-success {
        background-color: #22c55e; /* Hijau */
    }
    .btn-success:hover {
        background-color: #16a34a;
    }

    .btn-secondary {
        background-color: #6b7280; /* Abu-abu */
    }
    .btn-secondary:hover {
        background-color: #4b5563;
    }

    /* Error Messages Styling */
    .text-danger {
        color: #dc2626; /* Merah untuk error validasi */
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .main-container {
            width: 95%;
            padding: 25px;
            margin: 30px auto;
        }

        .main-container h1 {
            font-size: 24px;
            margin-bottom: 25px;
        }

        .form-buttons {
            flex-direction: column; /* Tombol menumpuk vertikal */
            gap: 10px;
        }

        .btn-action {
            width: 100%; /* Tombol memenuhi lebar */
        }
    }
</style>
@endsection

@section('content')
<div class="main-container">
    <h1>Edit Indikator SPBE</h1>

    <form id="editIndikatorForm" action="{{ route('admin.indikator.update', $indikator->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Tambahkan input hidden untuk tahun_id --}}
        <input type="hidden" name="tahun_id" value="{{ $indikator->aspect->tahun_id }}">

        <!-- Pilih Domain -->
        <div class="form-group">
            <label for="domain_id" class="form-label">Pilih Domain</label>
            <select name="domain_id" id="domain_id" class="form-control" required>
                <option value="">-- Pilih Domain --</option>
                @foreach($domains as $domain)
                    <option value="{{ $domain->id }}"
                        {{ $indikator->aspect->domain_id == $domain->id ? 'selected' : '' }}>
                        {{ $domain->nama }}
                    </option>
                @endforeach
            </select>
            @error('domain_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pilih Aspek -->
        <div class="form-group">
            <label for="aspect_id" class="form-label">Pilih Aspek</label>
            <select name="aspect_id" id="aspect_id" class="form-control" required>
                <option value="">-- Pilih Aspek --</option>
                {{-- Options will be populated by JavaScript --}}
            </select>
            @error('aspect_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nama Indikator -->
        <div class="form-group">
            <label for="nama" class="form-label">Nama Indikator</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $indikator->nama) }}" required>
            @error('nama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Penjelasan -->
        <div class="form-group">
            <label for="penjelasan" class="form-label">Penjelasan</label>
            <textarea name="penjelasan" id="penjelasan" class="form-control" rows="5" required>{{ old('penjelasan', $indikator->penjelasan) }}</textarea>
            @error('penjelasan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol Simpan -->
        <div class="form-buttons">
            <a href="{{ route('admin.indikator.tahun', $indikator->tahun_id) }}" class="btn-action btn-secondary">
                <i class="fas fa-times-circle"></i> Batal
            </a>
            <button type="submit" class="btn-action btn-success">
                <i class="fas fa-save"></i> Update Indikator
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('editIndikatorForm'); // Dapatkan form
        const domainSelect = document.getElementById('domain_id');
        const aspectSelect = document.getElementById('aspect_id');
        const allAspects = @json($aspects);

        // Tambahkan event listener untuk submit form
        form.addEventListener('submit', function(event) {
            console.log('Form is attempting to submit!'); // Log ini akan muncul di konsol
            // Anda bisa menambahkan event.preventDefault() di sini untuk menghentikan submit
            // jika Anda ingin melakukan validasi JavaScript tambahan, tetapi untuk saat ini
            // biarkan form submit secara normal.
        });

        function populateAspects(selectedDomainId, currentAspectId = null) {
            aspectSelect.innerHTML = '<option value="">-- Pilih Aspek --</option>';

            const filteredAspects = allAspects.filter(aspect => aspect.domain_id == selectedDomainId);

            filteredAspects.forEach(aspect => {
                const option = document.createElement('option');
                option.value = aspect.id;
                option.textContent = aspect.nama;
                if (aspect.id == currentAspectId) {
                    option.selected = true;
                }
                aspectSelect.appendChild(option);
            });
        }

        domainSelect.addEventListener('change', function () {
            const selectedDomainId = this.value;
            populateAspects(selectedDomainId);
        });

        const initialDomainId = domainSelect.value;
        const initialAspectId = "{{ $indikator->aspect_id }}";
        if (initialDomainId) {
            populateAspects(initialDomainId, initialAspectId);
        }
    });
</script>
@endsection
