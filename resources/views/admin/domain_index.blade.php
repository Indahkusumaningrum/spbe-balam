@extends('layouts.layout_admin')
@section('title', 'Manajemen Domain') 

@section('styles')
    <style>
        .content { background-color: #fff; padding: 40px 30px; min-height: 100vh; }
        h3 { color: #001e74; border-bottom: 3px solid #facc15; padding-bottom: 6px; display: inline-block; margin-left: 30px; font-size: 24px; }
        form { background-color: #fff; padding-left: 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); max-width: 40%;; }
        .form-inline { display: flex; align-items: center; gap: 10px; max-width: 90%; }
        .form-inline input[type="text"] { flex: 1; margin-bottom: 0; }
        .form-inline button { white-space: nowrap; }
        input[type="text"] { width: 100%; margin-top: 0; padding: 12px 16px; margin-bottom: 20px; border: 2px solid #d1d5db; border-radius: 8px; font-size: 16px; transition: border-color 0.3s; }
        input[type="text"]:focus { border-color: #facc15; outline: none; }
        button { background-color: #facc15; color: #fff; padding: 10px 22px; font-size: 15px; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; transition: background-color 0.3s; transition: all 0.3s ease;}
        button:hover { background-color: #eab308;     transform: translateY(-2px); }
        hr { border: 0; height: 2px; background-color: #e5e7eb; margin: 40px 0; }
        
        ul { list-style-type: none; padding-left: 30px; max-width: 500px; }
        ul li { background-color: #fff; padding: 12px 20px; margin-bottom: 10px; border-left: 6px solid #facc15; border-radius: 6px; box-shadow: 0 3px 8px rgba(0,0,0,0.03); }
        .btn-kembali { margin-left: 30px; display: inline-block; margin-top: 20px; text-decoration: none; color: #fff; background-color: #001e74; padding: 10px 18px; border-radius: 8px; font-weight: 500; transition: background-color 0.3s; transition: all 0.3s ease;}
        .btn-kembali:hover { background-color: #002f9f;    transform: translateY(-2px); }
    </style>
@endsection


@section('content')
<div class="content">
    <h3>Tambah Domain</h3>
    <form action="{{ route('admin.domain.store') }}" method="POST" class="form-inline">
        @csrf
        <input type="text" name="nama" placeholder="Nama Domain" required>
        <button type="submit">Simpan</button>
    </form>

    <hr>

    <h3>Daftar Domain</h3>
    <ul>
        @foreach($domains as $domain)
            <li>{{ $domain->nama }}</li>
        @endforeach
    </ul>

    <a href="{{ route('admin.indikator.index') }}" class="btn-kembali">Kembali</a>
</div>
@endsection
