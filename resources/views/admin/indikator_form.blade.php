@extends('layouts.layout_admin')
@section('title', isset($indikator) ? 'Edit Indikator' : 'Tambah Indikator')

@section('content')
<div class="form-container">
    <h2>{{ isset($indikator) ? 'Edit' : 'Tambah' }} Indikator</h2>

    <form action="{{ isset($indikator) ? route('admin.indikator.update', $indikator->id) : route('admin.indikator.store') }}" method="POST">
        @csrf
        @if(isset($indikator))
            @method('PUT')
        @endif

        <label>Domain:</label>
        <select name="domain_id" id="domainSelect" class="form-control" required>
            <option value="">-- Pilih Domain --</option>
            @foreach($domains as $domain)
                <option value="{{ $domain->id }}" {{ isset($indikator) && $indikator->aspect->domain_id == $domain->id ? 'selected' : '' }}>{{ $domain->name }}</option>
            @endforeach
        </select>

        <label>Aspek:</label>
        <select name="aspect_id" id="aspectSelect" class="form-control" required>
            <option value="">-- Pilih Aspek --</option>
            @foreach($aspects as $aspect)
                <option value="{{ $aspect->id }}" {{ isset($indikator) && $indikator->aspect_id == $aspect->id ? 'selected' : '' }} data-domain="{{ $aspect->domain_id }}">{{ $aspect->name }}</option>
            @endforeach
        </select>

        <label>Nama Indikator:</label>
        <input type="text" name="name" value="{{ $indikator->name ?? old('name') }}" required>

        <label>Penjelasan:</label>
        <textarea name="description" rows="4" required>{{ $indikator->description ?? old('description') }}</textarea>

        <button type="submit" class="btn btn-primary">{{ isset($indikator) ? 'Update' : 'Simpan' }}</button>
        <a href="{{ route('admin.indikator.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
    // Filter aspek berdasarkan domain
    const domainSelect = document.getElementById('domainSelect');
    const aspectSelect = document.getElementById('aspectSelect');

    domainSelect.addEventListener('change', () => {
        const domainId = domainSelect.value;

        for (const option of aspectSelect.options) {
            option.style.display = option.dataset.domain === domainId ? 'block' : 'none';
        }

        aspectSelect.value = "";
    });
</script>
@endsection
