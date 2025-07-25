<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage SPBE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body{ background-color: white; }
        .btn-selengkapnya { display: inline-block; background-color: #ffae00; color: white; padding: 8px 20px; border-radius: 25px; text-decoration: none; font-weight: 600; font-size: 15px; transition: background-color 0.3s ease, transform 0.2s ease; }
        .btn-selengkapnya:hover { transform: scale(1.05); }
        .spbe-info-section { display: flex; justify-content: center; flex-wrap: wrap; gap: 50px; padding: 10px 20px; background-color: #ffffff; margin-bottom: 100px;}
        .info-card { width: 250px; min-width: 250px; max-width: 100%; border: 1.5px solid #facc15; border-radius: 16px; box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5); padding: 24px; text-align: center; transition: transform 0.3s; margin-top: 50px;}
        .info-card:hover { transform: translateY(-20px); }
        .info-card .info-icon { width: 90px; height: 90px; margin-bottom: 15px; }
        .info-card h3 { font-size: 18px; margin: 0 0 8px; color: #000; }
        .info-card p { font-size: 14px; color: #333; margin-bottom: 16px; }
        .info-card a { color: white; font-weight: 600; }
        .info-card .info-icon { height: 90px; width: 90px; }

        .stats-grid { padding: 40px; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 8px 10px rgba(0, 0, 0, 0.1); display: flex; align-items: center; transition: transform 0.3s ease; }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-icon { width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-right: 20px; flex-shrink: 0;}
        .stat-icon.total { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; }
        .stat-icon.unread { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
        .stat-icon.read { background: linear-gradient(135deg, #22c55e, #16a34a); color: white; }
        .stat-content h3 { font-size: 2rem; font-weight: 700; color: #001e74; margin-bottom: 5px; line-height: 1.2; }
        .stat-content p { color: #64748b; font-size: 0.9rem; }

    </style>
</head>
<body>
@extends('layouts.layout_admin')
@section('title', 'Dashboard Admin')
@section('content')
    
    <div class="spbe-info-section">
        <div class="info-card">
            <img src="{{ asset('asset/icon/regulasi.png') }}" alt="Regulasi" class="info-icon">
            <h3>Regulasi</h3>
            <p>SPBE akan menjadi platform untuk seluruh regulasi yang ada. Platform ini bermakna pada integrasi. Integrasi ini pada proses bisnis, mulai dari level mikro hingga makro.</p>
            <a href="{{ route('admin.regulasi') }}" class="btn-selengkapnya">Manage</a>
        </div>
        <div class="info-card">
            <img src="{{ asset('asset/icon/tahapan.png') }}" alt="Tahapan SPBE" class="info-icon">
            <h3>Tahapan SPBE</h3>
            <p>Terbagi dalam Peta Rencana SPBE yaitu: Tahapan Rencana Strategis, Tahapan Pembangunan Fondasi SPBE, Tahapan Pengembangan SPBE, dan Inisiatif Strategis</p>
            <a href="{{ route('admin.tahapan_spbe') }}" class="btn-selengkapnya">Manage</a>
        </div>
    
    </div>
@endsection

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
</body>
</html>
