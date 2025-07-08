@extends('layouts.layout_admin')
@section('title', 'Kelola Indikator')

@section('content')
<div class="container">
    <h2>Daftar Indikator SPBE</h2>

    <div style="display: flex; gap: 10px; margin-bottom: 20px;">
        <a href="{{ route('admin.indikator.create') }}" class="btn btn-success">+ Tambah Indikator</a>
        <a href="{{ route('admin.domain_index') }}" class="btn btn-primary">Kelola Domain</a>
        <a href="{{ route('admin.aspect.index') }}" class="btn btn-info">Kelola Aspek</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Domain</th>
                <th>Aspek</th>
                <th>Indikator</th>
                <th>Penjelasan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($indikators as $i => $indikator)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $indikator->aspect->domain->name }}</td>
                <td>{{ $indikator->aspect->name }}</td>
                <td>{{ $indikator->name }}</td>
                <td>{{ $indikator->description }}</td>
                <td>
                    <a href="{{ route('admin.indikator.edit', $indikator->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.indikator.destroy', $indikator->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
