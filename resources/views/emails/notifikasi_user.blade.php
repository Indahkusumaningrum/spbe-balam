<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - SPBE</title>
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
            background: linear-gradient(135deg, #059669, #10b981);
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
        
        .success-box {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            border: 2px solid #10b981;
            border-radius: 10px;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
        }
        
        .success-box h2 {
            color: #059669;
            margin: 0 0 15px 0;
            font-size: 1.4rem;
        }
        
        .success-box p {
            margin: 0;
            color: #065f46;
            font-size: 1.1rem;
        }
        
        .message-summary {
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
        
        .next-steps {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-radius: 12px;
            padding: 30px;
            margin: 30px 0;
            text-align: center;
        }
        
        .next-steps h3 {
            color: #92400e;
            margin: 0 0 15px 0;
            font-size: 1.3rem;
        }
        
        .next-steps p {
            color: #a16207;
            margin: 0 0 20px 0;
            font-size: 1.05rem;
        }
        
        .timeline {
            background: #f8fafc;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }
        
        .timeline-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin: 15px 0;
            padding: 15px;
            background: white;
            border-radius: 8px;
            border-left: 4px solid #10b981;
        }
        
        .timeline-icon {
            font-size: 1.5rem;
            margin-top: 3px;
        }
        
        .timeline-content h4 {
            margin: 0 0 8px 0;
            color: #1f2937;
            font-size: 1.1rem;
        }
        
        .timeline-content p {
            margin: 0;
            color: #6b7280;
            font-size: 0.95rem;
        }
        
        .contact-info {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
        }
        
        .contact-info h3 {
            color: #1e293b;
            margin: 0 0 20px 0;
            text-align: center;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 12px 0;
            color: #475569;
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
            font-size: 16px;
        }
        
        .footer p {
            margin: 5px 0;
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
            margin: 20px 0;
        }
        
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            
            .email-container {
                border-radius: 8px;
            }
            
            .header, .content {
                padding: 30px 20px;
            }
            
            .message-summary, .next-steps, .contact-info {
                padding: 20px;
            }
            
            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
            
            .timeline-item {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="icon">✅</div>
            <h1>Pesan Anda Telah Diterima!</h1>
        </div>
        
        <div class="content">
            <div class="success-box">
                <h2>Terima Kasih!</h2>
                <p>Pesan Anda telah berhasil dikirim dan akan segera kami proses.</p>
            </div>
            
            <div class="message-summary">
                <h3 style="margin: 0 0 20px 0; color: #1f2937; text-align: center;">📋 Ringkasan Pesan Anda</h3>
                
                <div class="info-row">
                    <div class="info-label">
                        👤 Nama
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
                        📅 Tanggal Kirim
                    </div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($contact->created_at)->setTimezone('Asia/Jakarta')->format('l, d F Y - H:i') }} WIB</div>
                </div>

                <div class="divider"></div>
                
                <label class="message-label">💬 Isi Pesan:</label>
                <div class="message-text">
                    "{{ $contact->message }}"
                </div>
            </div>
            
            <div class="next-steps">
                <h3>⏰ Apa yang Terjadi Selanjutnya?</h3>
                <p>Tim kami akan meninjau pesan Anda dan memberikan respons secepatnya.</p>
                
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-icon">📨</div>
                        <div class="timeline-content">
                            <h4>Pesan Diterima</h4>
                            <p>Pesan Anda telah masuk ke sistem kami dan mendapat nomor tiket otomatis.</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-icon">👥</div>
                        <div class="timeline-content">
                            <h4>Review Tim</h4>
                            <p>Tim yang tepat akan meninjau dan menganalisis pesan Anda.</p>
                        </div>
                    </div>
            
                </div>
            </div>
            
            <div class="contact-info">
                <h3>📞 Butuh Bantuan Lain?</h3>
                
                <div class="contact-item">
                    <span>🏢</span>
                    <span><strong>Kantor:</strong> Jl. Dr. Susilo No.2, Sumur Batu, Teluk Betung Utara</span>
                </div>
                
                <div class="contact-item">
                    <span>📍</span>
                    <span><strong>Alamat:</strong> Kota Bandar Lampung, Lampung 35212</span>
                </div>
                
                <div class="contact-item">
                    <span>🕐</span>
                    <span><strong>Jam Layanan:</strong> Senin - Jumat, 08:00 - 16:00 WIB</span>
                </div>
                
                <div class="contact-item">
                    <span>🌐</span>
                    <span><strong>Website:</strong> Portal SPBE Kota Bandar Lampung</span>
                </div>
            </div>
            
        </div>
        
        <div class="footer">
            <div class="footer-logo">SPBE Pemerintah Kota Bandar Lampung</div>
            <p>Sistem Pemerintahan Berbasis Elektronik</p>
            <div class="divider"></div>
            <p style="font-size: 12px; opacity: 0.7; margin-top: 15px;">
                Email konfirmasi ini dikirim secara otomatis. Simpan email ini sebagai bukti pengiriman pesan Anda.
            </p>
            <p style="font-size: 11px; opacity: 0.6;">
                Jika Anda tidak merasa mengirim pesan ini, silakan abaikan email ini.
            </p>
        </div>
    </div>
</body>
</html>