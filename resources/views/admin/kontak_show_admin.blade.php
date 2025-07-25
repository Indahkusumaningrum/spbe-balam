@extends('layouts.layout_admin')
@section('title', 'Kelola Pesan Kontak')
@section('content')

<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Poppins', sans-serif; background: #fff; color: #334155; }
    .dashboard-container { max-width: 1300px; margin: 0 auto; padding: 20px; }
    .page-header { background: white; padding: 0 30px; border-radius: 15px; margin-bottom: 30px; }
    .page-header h1 { color: #001e74; font-size: 32px; margin-bottom: 10px; display: inline-block; padding-bottom: 4px; position: relative; }
    .page-header h1::after { content: ''; position: absolute; left: 50%; transform: translateX(-50%); bottom: 0; width: 160px; height: 5px; background: linear-gradient(to right, #facc15, #ff9a00); border-radius: 50px; box-shadow: 0 4px 10px rgba(250, 204, 21, 0.5); transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); }
    .page-header h1:hover::after { width: 100%; left: 0; transform: translateX(0); box-shadow: 0 6px 20px rgba(250, 204, 21, 0.7); }
    .page-header p { color: #64748b; font-size: 1.1rem; margin-top: 15px; }

    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
    .stat-card { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 8px 10px rgba(0, 0, 0, 0.1); display: flex; align-items: center; transition: transform 0.3s ease; }
    .stat-card:hover { transform: translateY(-5px); }
    .stat-icon { width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-right: 20px; flex-shrink: 0;}
    .stat-icon.total { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; }
    .stat-icon.unread { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
    .stat-icon.read { background: linear-gradient(135deg, #22c55e, #16a34a); color: white; }
    .stat-content h3 { font-size: 2rem; font-weight: 700; color: #001e74; margin-bottom: 5px; line-height: 1.2; }
    .stat-content p { color: #64748b; font-size: 0.9rem; }

    .filters-section { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); margin-bottom: 30px; }
    .filters-grid { display: grid; grid-template-columns: 1fr 1fr auto; gap: 20px; align-items: end; }
    .filter-group label { display: block; margin-bottom: 8px; font-weight: 500; color: #374151; }
    .filter-group select, .filter-group input { width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px;transition: border-color 0.3s ease;}
    .filter-group select:focus, .filter-group input:focus { outline: none; border-color: #facc15; }
    .btn { padding: 12px 20px;border: none; border-radius: 8px; font-weight: 500; cursor: pointer; transition: all 0.3s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .btn-primary { background: linear-gradient(135deg, #facc15, #ffd700); color: white; }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(250, 204, 21, 0.4); }

    .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .messages-section { background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); overflow: hidden }
    .messages-table { width: 100%; border-collapse: collapse; } /* Ensure width 100% */
    .messages-table th, .messages-table td { padding: 15px 25px; text-align: left; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .messages-table th { background: #001e74; font-weight: 600; color: white; font-size: 16px; text-transform: uppercase; letter-spacing: 0.5px; }
    .messages-table thead tr th:first-child { border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
    .messages-table thead tr th:last-child { border-top-right-radius: 8px; border-bottom-right-radius: 8px; }
    .messages-table tbody tr:nth-child(odd) { background-color: #fcfcfc; }
    .messages-table tbody tr:nth-child(even) {background-color: #f9f9f9; }
    .messages-table tbody tr{ transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .messages-table tbody tr:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); }

    /* Remove or adjust fixed widths for larger screens to allow columns to expand */
    /* .messages-table thead tr th:nth-child(1) { width: 10%; } */
    /* .messages-table thead tr th:nth-child(2) { width: 15%; } */
    /* .messages-table thead tr th:nth-child(3) { width: 50%; } */
    /* .messages-table thead tr th:nth-child(4) { width: 10%; } */
    /* .messages-table thead tr th:nth-child(5) { width: 10%; } */
    /* .messages-table thead tr th:nth-child(6) { width: 5%; } */

    /* Flexible widths for larger screens using min-width or leaving it to content */
    .messages-table th:nth-child(1), .messages-table td:nth-child(1) { min-width: 120px; } /* Pengirim */
    .messages-table th:nth-child(2), .messages-table td:nth-child(2) { min-width: 150px; } /* Email */
    .messages-table th:nth-child(3), .messages-table td:nth-child(3) { min-width: 300px; } /* Pesan - allow more space */
    .messages-table th:nth-child(4), .messages-table td:nth-child(4) { min-width: 100px; } /* Status */
    .messages-table th:nth-child(5), .messages-table td:nth-child(5) { min-width: 150px; } /* Tanggal */
    .messages-table th:nth-child(6), .messages-table td:nth-child(6) { min-width: 80px; } /* Aksi */


    .status-badge { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; white-space: nowrap; display: inline-block; }
    .status-unread { background: #fee2e2; color: #991b1b; }
    .status-read { background: #dcfce7; color: #166534; }
    /* Modify message-preview for larger screens */
    .message-preview {
        max-width: 100%; /* Ensure it takes available space */
        overflow: hidden;
        text-overflow: ellipsis; /* Keep ellipsis for long lines */
        white-space: nowrap; /* Keep it on a single line by default */
        color: #64748b;
    }
    /* For larger screens, remove nowrap and ellipsis for message content to show fully */
    @media (min-width: 1025px) { /* Adjust breakpoint as needed for "laptop" */
        .message-preview {
            white-space: normal; /* Allow text to wrap */
            text-overflow: unset; /* Remove ellipsis */
            overflow: visible; /* Show full content */
        }
    }

    .actions { display: flex; gap: 5px; justify-content: center; align-items: center; flex-wrap: nowrap; }
    .btn-sm { padding: 6px 12px;font-size: 12px;border-radius: 6px; border: none; cursor: pointer; transition: all 0.3s ease;  flex-shrink: 0;}
    .btn-info { background: #3b82f6; color: white; }
    .btn-info:hover { background: #2563eb; }
    .btn-danger { background: red; color: white; }
    .btn-danger:hover { background: darkred; }

    nav[aria-label="pagination"] svg { width: 14px !important; height: 14px !important; }
    nav[aria-label="pagination"] a, nav[aria-label="pagination"] span { padding: 4px 8px !important; font-size: 13px !important; display: inline-flex !important; align-items: center !important; justify-content: center !important; }
    .empty-state { padding: 60px 20px; text-align: center; color: #64748b; }
    .empty-state i { font-size: 4rem; margin-bottom: 20px; opacity: 0.5; }
    .empty-state h3 { font-size: 1.5rem; margin-bottom: 10px; }

    @media (max-width: 1024px) {
        .page-header h1 { font-size: 28px; }
        .page-header p { font-size: 1rem; }
        .filters-grid { grid-template-columns: 1fr; }
        .filter-group button { width: 100%; }
        /* For screens up to 1024px, ensure table still scrolls if content is too wide */
        .messages-table {
            min-width: 800px; /* Adjust this value as needed to fit content */
        }
    }

    @media (max-width: 768px) {
        .dashboard-container { padding: 15px; }
        .page-header { padding: 15px 20px; }
        .page-header h1 { font-size: 24px; }
        .page-header h1::after { width: 100px; }
        .page-header p { font-size: 0.9rem; }
        .stats-grid { grid-template-columns: 1fr; }
        .stat-card { padding: 20px; }
        .stat-content h3 { font-size: 1.8rem; }
        .stat-content p { font-size: 0.85rem; }
        .filters-section { padding: 20px; }
        .messages-table { font-size: 14px; min-width: 600px; } /* Ensure min-width for small tablets */
        .messages-table th, .messages-table td { padding: 10px 15px; }
        .message-preview { max-width: 150px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden; } /* Reapply truncation for smaller screens */
        .status-badge { font-size: 11px; padding: 5px 10px; }
        .actions .btn-sm { padding: 5px 10px; font-size: 11px; }
        .pagination a, .pagination span { font-size: 13px;}
    }

    @media (max-width: 480px) {
        .page-header { padding: 10px 15px; text-align: center; }
        .page-header h1 { font-size: 20px; margin-bottom: 5px; }
        .page-header h1::after { width: 80px;  height: 4px; }
        .page-header p { font-size: 0.8rem; }
        .stat-content h3 { font-size: 1.5rem; }
        .stat-icon { width: 50px; height: 50px; font-size: 20px; margin-right: 15px; }
        .messages-table { font-size: 13px; min-width: 500px; } /* Ensure min-width for mobile */
        .messages-table th, .messages-table td { padding: 8px 10px; }
        .message-preview { max-width: 100px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden; } /* Reapply truncation for smallest screens */
        .status-badge { font-size: 10px; padding: 4px 8px; }
        .actions .btn-sm { padding: 4px 8px; font-size: 10px; }
        .pagination { padding: 15px; gap: 5px; }
        .pagination a, .pagination span { padding: 4px 8px; font-size: 12px; }
    }

    /* Modal styles (unchanged, but included for completeness) */
    .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; opacity: 0; transition: opacity 0.3s ease; }
    .modal.show { display: flex; align-items: center; justify-content: center; opacity: 1; }
    .modal-content { background: white; max-width: 700px; width: 90%; max-height: 90vh; border-radius: 15px; overflow: hidden; box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25); transform: scale(0.9); transition: transform 0.3s ease; }
    .modal.show .modal-content { transform: scale(1); }
    .modal-header { padding: 25px; background: linear-gradient(135deg, #001e74, #1a3a8a); color: white; display: flex; justify-content: space-between; align-items: center; }
    .modal-header h3 { font-size: 1.4rem; font-weight: 600; margin: 0; }
    .close-btn { background: none; border: none; color: white; font-size: 28px; cursor: pointer; padding: 5px; border-radius: 50%; transition: background 0.3s ease; }
    .close-btn:hover { background: rgba(255, 255, 255, 0.1); }
    .modal-body { padding: 30px; overflow-y: auto; max-height: 70vh; }
    .message-detail { line-height: 1.6; }
    .detail-header { background: #f8fafc; padding: 25px; border-radius: 12px; margin-bottom: 25px; border-left: 4px solid #facc15; }
    .detail-row { display: flex; margin-bottom: 15px; align-items: flex-start; }
    .detail-label { font-weight: 600; color: #374151; min-width: 100px; margin-right: 15px; }
    .detail-value { color: #64748b; flex: 1; word-break: break-word; }
    .message-content { background: white; padding: 25px; border-radius: 12px; border: 2px solid #e2e8f0; margin-top: 20px; }
    .message-content h4 { color: #001e74; margin-bottom: 15px; font-size: 1.1rem; }
    .message-text { color: #374151; line-height: 1.7; font-size: 15px; white-space: pre-wrap; word-wrap: break-word; }
    .status-indicator { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: 500; }
    .status-indicator.unread { background: #fee2e2; color: #991b1b; }
    .status-indicator.read { background: #dcfce7; color: #166534; }
    .modal-actions { padding: 20px 30px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 10px; }
    .btn-mark-read { background: #22c55e; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; transition: all 0.3s ease; }
    .btn-mark-read:hover { background: #16a34a; transform: translateY(-1px); }

</style>

<div class="dashboard-container">
    <div class="page-header">
        <h1><i class="fas fa-envelope-open-text"></i> Kelola Pesan Kontak</h1>
        <p>Kelola pesan dari pengunjung website SPBE</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon total">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['total'] ?? 0 }}</h3>
                <p>Total Pesan</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon unread">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['unread'] ?? 0 }}</h3>
                <p>Belum Dibaca</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon read">
                <i class="fas fa-envelope-open"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['read'] ?? 0 }}</h3>
                <p>Sudah Dibaca</p>
            </div>
        </div>
    </div>

    <div class="filters-section">
        <form method="GET" action="{{ route('admin.contact.index') }}">
            <div class="filters-grid">
                <div class="filter-group">
                    <label>Status</label>
                    <select name="status" onchange="this.form.submit()">
                        <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>Semua Status</option>
                        <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                        <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Pencarian</label>
                    <input type="text" name="search" placeholder="Cari nama, email, atau pesan..." value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="messages-section">
        {{-- @if(isset($messages) && $messages->count() > 0) --}}
        <div class="table-responsive">
            <table class="messages-table">
                <thead>
                    <tr>
                        <th>Pengirim</th>
                        <th>Email</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                    <tr>
                        <td>
                            <strong>{{ $message->name }}</strong>
                        </td>
                        <td>
                            <div class="message-preview">
                                {{ Str::limit($message->email, 20, '...') }}
                            </div>
                        </td>
                        <td>
                            <div class="message-preview">
                                {{ Str::limit($message->message, 140, '...') }}
                            </div>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $message->status ?? 'unread' }}">
                                @if(($message->status ?? 'unread') === 'unread')
                                Belum Dibaca
                                @else
                                Sudah Dibaca
                                @endif
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($message->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB</td>
                        <td>
                            <div class="actions">
                                <form method="POST" action="{{ route('admin.contact.destroy', $message->id) }}" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- <div class="pagination">
            {{ $messages->links() }}
        </div> --}}
        {{-- @else --}}

        {{-- Bagian tombol "Lebih Banyak" dan indikator loading dihapus karena tidak lagi diperlukan --}}
    {{-- <div class="load-more-container"> ... </div> --}}

        {{-- Empty state jika tidak ada pesan sama sekali (setelah filter juga) --}}
        @if($messages->isEmpty())
        <div class="empty-state" id="initial-empty-state">
            <i class="fas fa-inbox"></i>
            <h3>Belum ada pesan</h3>
            <p>Belum ada pesan kontak yang masuk</p>
        </div>
        @endif
    </div>
</div>


<script>

    async function markAsRead(id) {
        try {
            const response = await fetch(`/admin/contact/${id}/mark-read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            if (response.ok) {
                // Close modal and refresh page to update the table
                closeModal();
                location.reload();
            } else {
                alert('Gagal menandai pesan sebagai sudah dibaca');
            }
        } catch (error) {
            console.error('Error marking message as read:', error);
            alert('Terjadi kesalahan saat menandai pesan');
        }
    }

    function closeModal() {
        document.getElementById('messageModal').classList.remove('show');
        currentMessageId = null;
    }

    // Close modal when clicking outside
    document.getElementById('messageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('messageModal').classList.contains('show')) {
            closeModal();
        }
    });

    // Auto refresh untuk notifikasi real-time
    setInterval(() => {
        fetch('/admin/contact/count')
            .then(response => response.json())
            .then(data => {
                const unreadElement = document.querySelector('.stat-icon.unread + .stat-content h3');
                const totalElement = document.querySelector('.stat-icon.total + .stat-content h3');

                if (unreadElement && unreadElement.textContent != data.unread) {
                    unreadElement.textContent = data.unread;
                    // Add visual indicator for new messages
                    unreadElement.style.animation = 'pulse 2s';
                    setTimeout(() => {
                        unreadElement.style.animation = '';
                    }, 2000);
                }
                if (totalElement) totalElement.textContent = data.total;
            })
            .catch(error => console.log('Auto refresh error:', error));
    }, 30000);
</script>

<style>
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); color: #ef4444; }
    100% { transform: scale(1); }
}
</style>

@endsection