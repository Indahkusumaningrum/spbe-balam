@extends('layouts.layout_admin')
@section('title', 'Admin - Manage Aspek')

@section('styles')
    <style>
        .content { background-color: white; color: #1e293b; padding: 0 60px; }
        h3 { font-size: 22px; color: #001e74; border-bottom: 3px solid #facc15; padding-bottom: 6px; display: inline-block; margin-bottom: 20px; }
       
        .form-create { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 30px; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); align-items: flex-end; }
        .form-group { flex: 1; min-width: 150px; }
        .form-row label { font-weight: 600; display: block; margin-bottom: 8px; color: #333; font-size: 15px; }
        .form-row select, .form-row input[type="text"] { width: 100%; padding: 10px 15px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px; background-color: #fff; cursor: pointer; transition: border-color 0.3s ease, box-shadow 0.3s ease; }
        .form-row select:focus, .form-wor input[type="text"]:focus { border-color: #facc15; outline: none; }
        .filter-buttons { display: flex; gap: 10px; }

        .btn-submit {
            background-color: #facc15; color: #fff; padding: 10px 22px; font-size: 15px; border: none; border-radius: 8px; 
            cursor: pointer; font-weight: 600; margin-top: 20px; transition: background-color 0.3s;  transition: all 0.3s ease;
        }
        .btn-submit:hover { background-color: #eab308; transform: translateY(-2px);}
        ul { list-style-type: none; padding: 0; max-width: 60%; }
        ul li { background-color: #fff; padding: 12px 20px; margin-bottom: 10px; border-left: 6px solid #facc15; border-radius: 6px; box-shadow: 0 3px 8px rgba(0,0,0,0.03); }

        .btn-kembali { margin-left: 30px; display: inline-block; margin-top: 20px; text-decoration: none; color: #fff; background-color: #001e74; padding: 10px 18px; border-radius: 8px; font-weight: 500; transition: background-color 0.3s;  transition: all 0.3s ease;}
        .btn-kembali:hover { background-color: #002f9f; transform: translateY(-2px);}

        @media (max-width: 1024px) {
            .content { padding: 0 40px;  }
            form, ul { max-width: 80%;  }
            h3 { font-size: 20px;  }
            .form-row { gap: 15px; }
            label { min-width: 100px; }
            input[type="text"], select { font-size: 15px;  padding: 10px 14px; }
            .btn-submit { padding: 9px 20px; font-size: 14px; }
            ul li { padding: 10px 15px; font-size: 15px; }
            .btn-kembali { padding: 9px 16px; font-size: 14px; }
        }

        @media (max-width: 768px) {
            .content { padding: 0 20px;  }
            h3 { font-size: 18px;  margin-bottom: 15px; display: block; text-align: center;  border-bottom: none;  }
            h3::after { display: block; position: static;  transform: none;  margin: 10px auto 0;  width: 80px;  }
            .form-create { flex-direction: column; align-items: stretch; } 
            .form-group { min-width: unset; width: 100%; }  }
            .btn-submit { width: 100%;  padding: 12px; font-size: 15px; }
            ul li { padding: 8px 12px; font-size: 14px; }
            .btn-kembali { width: 20%; text-align: center; padding: 12px; font-size: 15px; }        

        @media (max-width: 480px) {
            .content { padding: 0 10px;  }
            form { padding: 10px; }
            h3 { font-size: 16px; margin-bottom: 10px; }
            h3::after { width: 60px;  height: 2px; }
            .form-row { gap: 8px; }
            label { font-size: 13px; margin-bottom: 4px; }
            input[type="text"], select { font-size: 13px; padding: 6px 8px; }
            .btn-submit { padding: 10px; font-size: 14px; }
            ul li { padding: 6px 10px; font-size: 13px; border-left-width: 4px;  }
            .btn-kembali { padding: 10px; font-size: 14px; width: 20%; }
            hr { margin: 20px 0; }
        }
    </style>
@endsection

@section('content')
<div class="content">
    <h3>Tambah Aspek</h3>
    <form action="{{ route('admin.aspect.store') }}" method="POST" class="form-create">
        @csrf
        <div class="form-group">
            <div class="form-row"> <label for="nama_aspek">Nama Aspek:</label>
                <input type="text" id="nama_aspek" name="nama" required style="width: 92%;">
            </div> </div>

        <div class="form-group">
            <div class="form-row"> <label for="pilih_domain">Pilih Domain:</label>
                <select id="pilih_domain" name="domain_id" required>
                    <option value="">-- Pilih Domain --</option>
                    @foreach($domains as $domain)
                        <option value="{{ $domain->id }}">{{ $domain->nama }}</option>
                    @endforeach
                </select>
            </div> </div>

        <button type="submit" class="btn-submit">Simpan</button>
    </form>

    <hr>

    <h3>Daftar Aspek</h3>
    <ul>
        @foreach($aspects as $aspect)
            <li>{{ $aspect->nama }} (Domain: {{ $aspect->domain->nama }})</li>
        @endforeach
    </ul>

    <a href="{{ route('admin.indikator.index') }}" class="btn-kembali">Kembali</a>

</div>
@endsection
