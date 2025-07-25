<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('asset/img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>SPBE - Pemerintah Kota Bandar Lampung</title>

    <style>
        .contact-section { background: fff; padding: 80px 40px; min-height: 70vh; max-width: 100%; background-color: transparent; }
        .contact-container { width: 100%; margin: 0 auto; }
        .contact-header { text-align: center; margin-bottom: 60px; }
        .contact-header h1 { color: #001e74; font-size: 2.5rem; font-weight: 700; margin-bottom: 10px; position: relative; display: inline-block; }
        .contact-header h1::after {
            content: ''; position: absolute; left: 50%;  transform: translateX(-50%);  bottom: -10px; width: 100px; height: 5px;
            background: linear-gradient(to right, #facc15, #ff9a00); border-radius: 50px; box-shadow: 0 4px 10px rgba(250, 204, 21, 0.5); transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .contact-header h1:hover::after { width: 100%;  left: 0;  transform: translateX(0);  box-shadow: 0 6px 20px rgba(250, 204, 21, 0.7); }
        .contact-content { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: start; }
        .alert { padding: 15px 20px; margin-bottom: 20px; border-radius: 8px; display: none; }
        .alert.show { display: block; animation: slideDown 0.3s ease-out; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .contact-form { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 20px 40px rgba(0, 30, 116, 0.1); border: 1px solid #e2e8f0; transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .contact-form:hover { transform: translateY(-5px); box-shadow: 0 25px 50px rgba(0, 30, 116, 0.15); }
        .contact-form h2 { color: #001e74; font-size: 1.8rem; margin-bottom: 30px; font-weight: 600; }
        .form-group { margin-bottom: 25px; position: relative; }
        .form-group input, .form-group textarea { width: 100%; padding: 15px 20px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 16px; transition: all 0.3s ease; background: #f8fafc; font-family: 'Poppins', sans-serif; }
        .form-group input:focus, .form-group textarea:focus { outline: none; border-color: #facc15; background: white; box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.1); transform: translateY(-2px);}
        .form-group textarea { resize: vertical; min-height: 120px; }
        .submit-btn {
            background: linear-gradient(135deg, #facc15 0%, #ffd700 100%); color: white; padding: 15px 40px; border: none;
            border-radius: 12px; font-weight: 600; font-size: 16px; cursor: pointer; transition: all 0.3s ease; width: 100%; position: relative; overflow: hidden;
        }
        .submit-btn::before {
            content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent); transition: left 0.5s ease;
        }
        .submit-btn:hover::before { left: 100%; }
        .submit-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(250, 204, 21, 0.4); }
        .submit-btn:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

        .contact-info { display: flex; flex-direction: column; gap: 30px; }
        .info-card { background: white; padding: 30px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0, 30, 116, 0.08); border: 1px solid #e2e8f0; transition: all 0.3s ease; position: relative; overflow: hidden; }
        .info-card::before { content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: linear-gradient(180deg, #facc15, #ffd700); }
        .info-card:hover { transform: translateX(10px); box-shadow: 0 20px 40px rgba(0, 30, 116, 0.12); }
        .info-header { display: flex; align-items: center; margin-bottom: 15px; }
        .info-icon {
            width: 50px; height: 50px; background: linear-gradient(135deg, #001e74, #1a3a8a); border-radius: 12px; display: flex;
            align-items: center; justify-content: center; color: white; font-size: 20px; margin-right: 15px; transition: transform 0.3s ease; 
        }
        .info-card:hover .info-icon { transform: scale(1.1) rotate(5deg); }
        .info-title { color: #001e74; font-size: 1.3rem; font-weight: 600; margin: 0; }
        .info-details { color: #64748b; font-size: 16px; line-height: 1.6; margin-left: 65px; }
        .info-details a { color: #001e74; text-decoration: none; transition: color 0.3s ease; }
        .info-details a:hover { color: #facc15; }

        /* Error Messages */
        .error-message { color: #ef4444; font-size: 14px; margin-top: 5px; display: block; }
        .form-group.error input, .form-group.error textarea { border-color: #ef4444; animation: shake 0.5s ease-in-out; }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .form-group.success input, .form-group.success textarea { border-color: #22c55e; }

        /* Loading Animation */
        .loading-spinner { 
            display: inline-block; width: 20px; height: 20px; border: 2px solid #fff; border-radius: 50%; 
            border-top-color: transparent; animation: spin 1s ease-in-out infinite; margin-right: 10px; 
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Captcha styling */
        .captcha-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .captcha-reload-btn {
            background-color: #facc15;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .captcha-reload-btn:hover {
            background-color: #f59e0b;
        }

        @media (max-width: 1024px) {
            .contact-content { grid-template-columns: 1fr; gap: 40px; }
            .contact-section { padding: 60px 20px; }
            .contact-header h1 { font-size: 2rem; }
            .contact-form { padding: 30px 20px; }
            .info-card { padding: 20px; }
        }
        
        @media (max-width: 768px) {
            .contact-content { grid-template-columns: 1fr; gap: 40px; }
            .contact-section { padding: 60px 20px; }
            .contact-header h1 { font-size: 2rem; }
            .contact-form { padding: 30px 20px; }
            .info-card { padding: 20px; }
        }
        
        @media (max-width: 480px) {
            .contact-section {margin: 0px}
            .contact-content { grid-template-columns: 1fr; gap: 40px; }
            .contact-section { padding: 60px 0px; }
            .contact-header h1 { font-size: 2rem; }
            .contact-form { padding: 30px 20px; }
            .info-card { padding: 20px; }
        }
    </style>
</head>
<body>

@section('navbar', true)
@extends('layouts.layout_user')
@section('content')

<section class="contact-section">
    <div class="contact-container">
        <div class="contact-header">
            <h1>Hubungi Kami</h1>
            <p style="color: #64748b; font-size: 1.1rem; margin-top: 15px;">
                Kami siap membantu Anda dengan segala pertanyaan dan kebutuhan informasi SPBE
            </p>
        </div>

        <div class="contact-content">
            <!-- Contact Form -->
            <div class="contact-form">
                <h2>Kirim Pesan</h2>
                
                <div id="alert" class="alert"></div>
                
                <form id="contactForm">
                    @csrf
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Nama Lengkap" required>
                        <span class="error-message" id="name-error"></span>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email Address" required>
                        <span class="error-message" id="email-error"></span>
                    </div>
                    <div class="form-group">
                        <textarea id="message" name="message" placeholder="Tulis pesan Anda di sini..." required></textarea>
                        <span class="error-message" id="message-error"></span>
                    </div>
                    <div class="form-group">
                        <div class="captcha-container" id="captcha-container">
                            {!! captcha_img('flat') !!}
                            <button type="button" class="captcha-reload-btn" id="reload">&#x21bb;</button>
                        </div>
                        <input id="captcha" type="text" name="captcha" required placeholder="Masukkan captcha" style="margin-top: 10px;">
                        <span class="error-message" id="captcha-error"></span>
                    </div>
                    
                    <button type="submit" class="submit-btn" id="submitBtn">
                        <span id="btnText">Kirim Pesan</span>
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="contact-info">
                <div class="info-card">
                    <div class="info-header">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="info-title">Alamat</h3>
                    </div>
                    <div class="info-details">
                        Jl. Dr. Susilo No.2, Sumur Batu, Teluk Betung Utara, Kota Bandar Lampung, Lampung 35212
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-header">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3 class="info-title">Telepon</h3>
                    </div>
                    <div class="info-details">
                        <a href="tel:0721123456">(0721) 123456</a><br>
                        <a href="tel:0721252041">(0721) 252041</a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-header">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="info-title">Email</h3>
                    </div>
                    <div class="info-details">
                        <a href="mailto:spbe@pemkotbandarlampung.go.id">spbe@pemkotbandarlampung.go.id</a><br>
                        <a href="mailto:spbe@bandarlampung.go.id">spbe@bandarlampung.go.id</a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-header">
                        <div class="info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="info-title">Jam Operasional</h3>
                    </div>
                    <div class="info-details">
                        Senin - Jumat: 08:00 - 16:00 WIB<br>
                        Sabtu - Minggu: Tutup
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const alert = document.getElementById('alert');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');

    // Setup CSRF token for AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Function to setup captcha reload
    function setupCaptchaReload() {
        const reloadBtn = document.getElementById('reload');
        if (reloadBtn) {
            // Remove any existing event listeners
            reloadBtn.replaceWith(reloadBtn.cloneNode(true));
            const newReloadBtn = document.getElementById('reload');
            
            newReloadBtn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Captcha reload clicked');
                
                fetch('/reload-captcha')
                    .then(res => {
                        if (!res.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return res.json();
                    })
                    .then(data => {
                        console.log('Captcha reloaded:', data);
                        const captchaContainer = document.getElementById('captcha-container');
                        if (captchaContainer && data.captcha) {
                            captchaContainer.innerHTML = data.captcha + '<button type="button" class="captcha-reload-btn" id="reload">&#x21bb;</button>';
                            // Re-setup event listener for new button
                            setupCaptchaReload();
                        }
                    })
                    .catch(error => {
                        console.error('Error reloading captcha:', error);
                        showAlert('error', 'Gagal memuat ulang captcha. Silakan coba lagi.');
                    });
            });
        }
    }

    // Initialize captcha reload
    setupCaptchaReload();

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        console.log('Form submitted');
        
        // Reset previous states
        clearErrors();
        hideAlert();
        
        // Get form data
        const formData = new FormData(form);
        
        // Log form data for debugging
        for (let [key, value] of formData.entries()) {
            console.log(key + ': ' + value);
        }
        
        // Show loading state
        showLoading();
        
        try {
            const response = await fetch('/contact', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData
            });

            console.log('Response status:', response.status);
            const result = await response.json();
            console.log('Response data:', result);

            if (result.success) {
                showAlert('success', result.message);
                form.reset();
                clearErrors();
                // Reload captcha after successful submission
                document.getElementById('reload').click();
            } else {
                if (result.errors) {
                    showValidationErrors(result.errors);
                } else {
                    showAlert('error', result.message || 'Terjadi kesalahan saat mengirim pesan');
                }
            }
        } catch (error) {
            console.error('Fetch error:', error);
            showAlert('error', 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.');
        } finally {
            hideLoading();
        }
    });

    function showLoading() {
        submitBtn.disabled = true;
        btnText.innerHTML = '<span class="loading-spinner"></span>Mengirim...';
    }

    function hideLoading() {
        submitBtn.disabled = false;
        btnText.textContent = 'Kirim Pesan';
    }

    function showAlert(type, message) {
        alert.className = `alert alert-${type} show`;
        alert.textContent = message;
        
        // Scroll to alert
        alert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            hideAlert();
        }, 5000);
    }

    function hideAlert() {
        alert.classList.remove('show');
    }

    function showValidationErrors(errors) {
        Object.keys(errors).forEach(field => {
            const errorElement = document.getElementById(`${field}-error`);
            const inputElement = document.getElementById(field);
            
            if (errorElement && inputElement) {
                errorElement.textContent = errors[field][0];
                inputElement.closest('.form-group').classList.add('error');
            }
        });
        
        // Show general error alert
        showAlert('error', 'Mohon perbaiki kesalahan pada form.');
    }

    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(element => {
            element.textContent = '';
        });
        
        document.querySelectorAll('.form-group').forEach(group => {
            group.classList.remove('error', 'success');
        });
    }

    // Real-time validation
    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const formGroup = this.closest('.form-group');
            const errorElement = document.getElementById(`${this.name}-error`);
            
            if (this.value.trim() !== '') {
                formGroup.classList.remove('error');
                formGroup.classList.add('success');
                if (errorElement) {
                    errorElement.textContent = '';
                }
            }
        });

        input.addEventListener('focus', function() {
            this.closest('.form-group').classList.add('focused');
        });

        input.addEventListener('blur', function() {
            this.closest('.form-group').classList.remove('focused');
        });
    });

    // Debug: Check if elements exist
    console.log('Form element:', form);
    console.log('Submit button:', submitBtn);
    console.log('CSRF token:', csrfToken);
});
</script>

</body>
</html>