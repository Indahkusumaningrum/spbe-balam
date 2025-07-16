@extends('layouts.layout_admin')
@section('title', 'Edit Indikator')

@section('styles')
<style>
    body { font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background-color: #fff; color: #333; }
    .main-container {
        width: 90%; max-width: 900px; margin: 0 auto;
        background-color: #ffffff; padding: 40px; border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); box-sizing: border-box;
    }
    .main-container h1 { color: #001e74; font-size: 28px; font-weight: 700; margin-bottom: 30px; text-align: center; position: relative; padding-bottom: 10px; }
    .form-group { margin-bottom: 25px; }
    .form-label { font-weight: 600; display: block; margin-bottom: 10px; color: #333; font-size: 16px; }
    .form-control {
        width: 100%; padding: 12px 15px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 16px; box-sizing: border-box;
        transition: border-color 0.3s ease, box-shadow 0.3s ease; background-color: #fff; }
    .form-control:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25); outline: none; }
    textarea.form-control { resize: vertical; min-height: 120px; }
    .form-buttons { display: flex; justify-content: flex-end; gap: 15px; margin-top: 40px; }

    .btn-action {
        padding: 12px 25px; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease; text-decoration: none; display: inline-flex; align-items: center;
        justify-content: center; gap: 8px; color: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); flex-grow: 1; flex-basis: 0; max-width: 200px; 
    }
    .btn-action:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
    .btn-success { background-color: #22c55e; }
    .btn-success:hover { background-color: #16a34a; }
    .btn-secondary { background-color: #6b7280; }
    .btn-secondary:hover { background-color: #4b5563; }
    .text-danger { color: #dc2626; font-size: 14px; margin-top: 5px; display: block; }

    @media (max-width: 768px) {
        .main-container { width: 95%; padding: 25px; margin: 30px auto; }
        .main-container h1 { font-size: 24px; margin-bottom: 25px; }
        .form-buttons { flex-direction: row; justify-content: center; flex-wrap: wrap; gap: 10px; }
        .btn-action { width: auto; flex-grow: 1; flex-basis: auto; max-width: 160px; }
    }

    @media (max-width: 480px) {
        .main-container { width: 95%; padding: 20px; margin: 20px auto; }
        .main-container h1 { font-size: 22px; margin-bottom: 20px; }
        .form-label { font-size: 15px; }
        .form-control { padding: 10px 12px; font-size: 15px; }
        .form-buttons { gap: 8px; }
        .btn-action { padding: 10px 15px; font-size: 15px; max-width: 140px;  }
    }
</style>
@endsection

@section('content')
<div class="main-container">
    <h1>Edit Indikator SPBE</h1>

    <form id="editIndikatorForm" action="{{ route('admin.indikator.update', $indikator->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="tahun_id" value="{{ $indikator->aspect->tahun_id }}">

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

        <div class="form-group">
            <label for="nama" class="form-label">Nama Indikator</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $indikator->nama) }}" required>
            @error('nama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="penjelasan" class="form-label">Penjelasan</label>
            <textarea name="penjelasan" id="penjelasan" class="form-control" rows="5" required>{{ old('penjelasan', $indikator->penjelasan) }}</textarea>
            @error('penjelasan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

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
        const form = document.getElementById('editIndikatorForm');
        const domainSelect = document.getElementById('domain_id');
        const aspectSelect = document.getElementById('aspect_id');
        const allAspects = @json($aspects);

        form.addEventListener('submit', function(event) {
            console.log('Form is attempting to submit!');
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