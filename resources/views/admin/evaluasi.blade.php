
@extends('layouts.layout_admin')
@section('title', 'Manage Berita')
@section('content')

    <div class="evaluasi-container">
        <div class="evaluasi-header">
            <h1>Evaluasi</h1>
            <div class="tambah">
                <a href="{{ route('admin.evaluasi.create') }}" class="btn-add"><i class="fas fa-plus" style="font-size: 18px;"></i></a>
                <p class="p">Tambah Berita</p>
            </div>
        </div>
        <div class="evaluasi-grid">
            @foreach($evaluations as $evaluation)
            <div class="evaluasi-card">
                <div class="evaluasi-img">
                    @if($evaluation->image)
                    <img src="{{ asset('uploads/evaluasi/' . $evaluation->image) }}" style="width:100%; height:200px; object-fit:cover;">
                    @endif
                </div>
                <div class="evaluasi-content">
                    <h3>{{ $evaluation->title }}</h3>
                    <div class="evaluasi-info">
                        <span class="tanggal">{{ $evaluation->created_at->format('d-m-Y') }}</span>
                        <a href="{{ route('admin.evaluasi.show', $evaluation->id) }}" class="btn-detail">Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

