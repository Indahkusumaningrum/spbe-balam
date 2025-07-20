<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Baru - SPBE</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f8fafc;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            background: linear-gradient(135deg, #001e74, #1a3a8a);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #facc15, #ffd700, #facc15);
        }
        
        .header h1 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .header .icon {
            font-size: 3rem;
            margin-bottom: 15px;
            display: block;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .alert-box {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border: 2px solid #3b82f6;
            border-radius: 10px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        
        .alert-box h2 {
            color: #1e40af;
            margin: 0 0 10px 0;
            font-size: 1.4rem;
        }
        
        .message-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 25px;
            margin: 25px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #facc15;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 600;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .info-value {
            color: #6b7280;
            font-weight: 500;
        }
        
        .message-text {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin: 20px 0;
            font-style: italic;
            line-height: 1.7;
        }
        
        .message-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 10px;
            display: block;
        }
        
        .cta-section {
            text-align: center;
            margin: 30px 0;
            padding: 25px;
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-radius: 10px;
        }
        
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #facc15, #ffd700);
            color: #1f2937;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
        }
        
        .urgent-notice {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            border: 2px solid #ef4444;
            border-radius: 10px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        
        .urgent-notice h3 {
            color: #dc2626;
            margin: 0 0 10px 0;
            font-size: 1.2rem;
        }
        
        .urgent-notice p {
            color: #991b1b;
            margin: 0;
        }
        
        .footer {
            background: #f8fafc;
            padding: 30px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            border-top: 1px solid #e5e7eb;
        }
        
        .footer-logo {
            font-weight: 700;
            color: #001e74;
            margin-bottom: 10px;
        }
        
        .footer p {
            margin: 5px 0;
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
            margin: 30px 0;
        }
        
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            
            .email-container {
                border-radius: 8px;
            }
            
            .header {
                padding: 30px 20px;
            }
            
            .content {
                padding: 30px 20px;
            }
            
            .message-card {
                padding: 20px;
            }
            
            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
            
            .btn {
                padding: 12px 24px;
                display: block;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="icon">📧</div>
            <h1>Pesan Baru dari Website SPBE</h1>
        </div>
        
        <div class="content">
            <div class="alert-box">
                <h2>🔔 Notifikasi Pesan Baru</h2>
                <p>Ada pesan baru dari pengunjung website SPBE yang memerlukan perhatian Anda</p>
            </div>
            
            <div class="message-card">
                <div class="info-row">
                    <div class="info-label">
                        👤 Nama Pengirim
                    </div>
                    <div class="info-value">{{ $contact->name }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">
                        ✉️ Email
                    </div>
                    <div class="info-value">{{ $contact->email }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">
                        📅 Tanggal
                    </div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($contact->created_at)->setTimezone('Asia/Jakarta')->format('l, d F Y') }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">
                        🕐 Waktu
                    </div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($contact->created_at)->setTimezone('Asia/Jakarta')->format('H:i') }} WIB</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">
                        🆔 ID Pesan
                    </div>
                    <div class="info-value">#{{ $contact->id }}</div>
                </div>
                
                <div class="divider"></div>
                
                <label class="message-label">💬 Isi Pesan:</label>
                <div class="message-text">
                    "{{ $contact->message }}"
                </div>
            </div>
            
            <div class="cta-section">
                <h3 style="margin: 0 0 15px 0; color: #1f2937;">Tindak Lanjut Diperlukan</h3>
                <p style="margin: 0 0 20px 0; color: #6b7280;">Pilih tindakan yang ingin Anda lakukan:</p>
                
                <!-- Tombol untuk buka dashboard admin -->
                <a href="{{ url('/admin/contact') }}" class="btn btn-primary">
                    🖥️ Buka Dashboard Admin
                </a>
                
                <!-- Tombol untuk tandai sudah dibaca langsung -->
                <a href="{{ route('admin.contact.read', $contact->id) }}" class="btn">
                    ✅ Tandai Sudah Dibaca
                </a>
                
            </div>
        </div>
        
        <div class="footer">
            <div class="footer-logo">SPBE Pemerintah Kota Bandar Lampung</div>
            <p>Sistem Pemerintahan Berbasis Elektronik</p>
            <div class="divider" style="margin: 15px 0;"></div>
            <p>📍 Jl. Dr. Susilo No.2, Sumur Batu, Teluk Betung Utara</p>
            <p>Kota Bandar Lampung, Lampung 35212</p>
            <p style="margin-top: 15px; font-size: 12px; opacity: 0.7;">
                Email ini dikirim secara otomatis oleh sistem. Mohon tidak membalas email ini.
            </p>
        </div>
    </div>
</body>
</html>