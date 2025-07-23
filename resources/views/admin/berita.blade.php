@extends('layouts.layout_admin')
@section('title', 'Admin - Manage Berita')

@section('styles')
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fff; color: #333; }
        .main-container { display: inline block; padding: 30px; max-width: 1200px; margin: 0 auto; }
        .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px; }
        .header-section h1 { color: #001e74; font-size: 32px;  font-weight: 700; position: relative; padding-bottom: 12px; margin: 0; letter-spacing: 0.5px; }
        .header-section h1::after {
            content: ''; position: absolute; left: 50%;  transform: translateX(-50%);  bottom: 0; width: 60px; height: 5px;
            background: linear-gradient(to right, #facc15, #ff9a00); border-radius: 50px; box-shadow: 0 4px 10px rgba(250, 204, 21, 0.5); transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .header-section h1:hover::after { width: 100%;  left: 0;  transform: translateX(0);  box-shadow: 0 6px 20px rgba(250, 204, 21, 0.7); }
    
        .add-button-group { display: flex; align-items: center; gap: 10px; }
        .btn-add-file { background-color: #28a745; color: white; padding: 10px 18px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 15px; transition: background-color 0.3s ease, transform 0.2s ease; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); }
        .btn-add-file i { margin-right: 8px; }
        .btn-add-file:hover { background-color: #218838; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); }
        
        .berita-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px; justify-content: center; }
        .berita-card { background: white; border-radius: 14px; box-shadow: 5px 5px 20px rgba(0,0,0,0.1); overflow: hidden; display: flex; flex-direction: column; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .berita-card:hover { transform: translateY(-5px); box-shadow: 5px 5px 25px rgba(0,0,0,0.15); }
        .berita-img { height: 200px; overflow: hidden; border-top-left-radius: 14px; border-top-right-radius: 14px; }
        .berita-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .berita-content { padding: 15px 20px; display: flex; flex-direction: column; flex-grow: 1; }
        .berita-content h3 { font-size: 18px; color: #001e74; font-weight: 700; margin-bottom: 10px; }
        .berita-info { display: flex; justify-content: space-between; align-items: center; margin-top: auto; }
        .berita-info .tanggal { font-size: 14px; color: #6b7280; font-weight: 500; }
        
        .btn-action-group { display: flex; gap: 6px; }
        .btn-detail {
            background-color: #001e74; color: white; font-size: 14px; width: 32px; height: 32px; display: inline-flex; align-items: center;
            justify-content: center; border-radius: 8px; text-decoration: none; transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-detail i { pointer-events: none; font-size: 14px; }
        .btn-detail:hover { background-color: #00165a; transform: translateY(-1px); }
        .btn-edit { background-color: #f59e0b; }
        .btn-edit:hover { background-color: #d97706; }
        .btn-delete { background-color: red; border: none; }
        .btn-delete:hover { background-color: darkred; }
        .load-more-container { text-align: center; margin-top: 40px; }
        .btn-load-more { background-color: #001e74; color: white; padding: 12px 25px; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease, transform 0.2s ease; }
        .btn-load-more:hover { background-color: #00165a; transform: translateY(-2px); }
        
        @media (max-width: 1024px) {
            .berita-container { padding: 0 40px; }
            .berita-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 25px; }
            h1 { font-size: 26px; }
        }
        @media (max-width: 767px) {
            .berita-container { padding: 0 20px;}
            .berita-header { flex-direction: column; align-items: flex-start; margin-bottom: 20px; }
            h1 { font-size: 24px; margin-bottom: 15px; }
            .tambah { width: 100%; justify-content: flex-start; }
            .btn-add { padding: 10px 15px; font-size: 15px; }
            .p { font-size: 16px; }
            .berita-grid { grid-template-columns: 1fr; gap: 20px; }
            .berita-card { width: 100%; }
            .berita-img { height: 180px; }
            .berita-content h3 { font-size: 17px; }
        }
        @media (max-width: 480px) {
            .berita-container { padding: 0 15px; }
            h1 { font-size: 22px; }
            .btn-add { padding: 8px 12px; font-size: 14px; }
            .p { font-size: 15px; }
            .berita-img { height: 160px; }
            .berita-content h3 { font-size: 16px; }
            .btn-detail { width: 30px; height: 30px; font-size: 13px; }
        }
    </style>
@endsection

@section('content')

    <div class="main-container">
        <div class="header-section">
            <h1>Berita</h1>
            <a href="{{ route('admin.berita.create') }}" class="btn-add-file">
                <i class="fas fa-plus"></i>Tambah Berita</a>
        </div>
        <div class="berita-grid" id="beritaGrid">
            @foreach($beritas as $berita)
            <div class="berita-card">
                <div class="berita-img">
                    @if($berita->gambar)
                    <img src="{{ asset('uploads/beritas/' . $berita->gambar) }}" alt="Gambar Berita">
                    @endif
                </div>
                <div class="berita-content">
                    <h3>{{ $berita->judul }}</h3>
                    <div class="berita-info">
                        <span class="tanggal">{{ $berita->updated_at->diffForHumans() }}</span>
                        <div class="btn-action-group">
                            <a href="{{ route('admin.berita.show', $berita->id_berita) }}" class="btn-detail" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.berita.edit', $berita->id_berita) }}" class="btn-detail btn-edit" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.berita.destroy', $berita->id_berita) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-detail btn-delete" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($totalBeritaCount > $initialLimit)
        <div class="load-more-container">
            <button id="loadMoreBtn" class="btn-load-more">Lihat Selengkapnya</button>
        </div>
        @endif
    </div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let offset = {{ $beritas->count() }};
        const initialLimit = {{ $initialLimit }};
        const totalBeritaCount = {{ $totalBeritaCount }};
        $('#loadMoreBtn').on('click', function() {
            let limit = 6;

            $.ajax({
                url: '{{ route('admin.berita.load-more') }}',
                type: 'GET',
                data: {
                    offset: offset,
                    limit: limit
                },
                beforeSend: function() {
                    $('#loadMoreBtn').text('Memuat...').prop('disabled', true);
                },
                success: function(response) {
                    $('#beritaGrid').append(response.html);
                    offset += limit;

                    if (!response.hasMore) {
                        $('#loadMoreBtn').hide();
                    } else {
                        $('#loadMoreBtn').text('Lihat Selengkapnya').prop('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error loading more berita:", error);
                    $('#loadMoreBtn').text('Gagal Memuat').prop('disabled', false);
                }
            });
        });
    });
</script>
@endsection
