<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('asset/img/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>SPBE - Pemerintah Kota Bandar Lampung</title>

    <style>
        /* Contact Section */
        .contact-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 80px 40px;
            min-height: 70vh;
            max-width: 100%;
            background-color: transparent;
        }

        .contact-container {
            width: 100%;
            margin: 0 auto;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .contact-header h1 {
            color: #001e74;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }

        .contact-header h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #facc15, #ffd700);
            border-radius: 2px;
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: start;
        }

        /* Contact Form */
        .contact-form {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 30, 116, 0.1);
            border: 1px solid #e2e8f0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .contact-form:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 30, 116, 0.15);
        }

        .contact-form h2 {
            color: #001e74;
            font-size: 1.8rem;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8fafc;
            font-family: 'Poppins', sans-serif;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #facc15;
            background: white;
            box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.1);
            transform: translateY(-2px);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #facc15 0%, #ffd700 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(250, 204, 21, 0.4);
        }

        /* Contact Info */
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .info-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 30, 116, 0.08);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #facc15, #ffd700);
        }

        .info-card:hover {
            transform: translateX(10px);
            box-shadow: 0 20px 40px rgba(0, 30, 116, 0.12);
        }

        .info-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .info-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #001e74, #1a3a8a);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            margin-right: 15px;
            transition: transform 0.3s ease;
        }

        .info-card:hover .info-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .info-title {
            color: #001e74;
            font-size: 1.3rem;
            font-weight: 600;
            margin: 0;
        }

        .info-details {
            color: #64748b;
            font-size: 16px;
            line-height: 1.6;
            margin-left: 65px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .footer-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .spbe-navbar {
                padding: 15px 20px;
            }

            .spbe-navbar .menu {
                font-size: 14px;
                gap: 15px;
            }

            .contact-section {
                padding: 60px 20px;
            }

            .contact-header h1 {
                font-size: 2rem;
            }
        }

        /* Animation for form validation */
        .form-group.error input,
        .form-group.error textarea {
            border-color: #ef4444;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .form-group.success input,
        .form-group.success textarea {
            border-color: #22c55e;
        }

        /* Loading state for submit button */
        .submit-btn.loading {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .submit-btn.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
                    <form id="contactForm" onsubmit="handleSubmit(event)">
                        <div class="form-group">
                            <input type="text" id="name" name="name" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="Email Address" required>
                        </div>
                        <div class="form-group">
                            <textarea id="message" name="message" placeholder="Tulis pesan Anda di sini..." required></textarea>
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
                            (0721) 123456<br>
                            (0721) 252041
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
                            spbe@pemkotbandarlamp.go.id<br>
                            spbe@bandarlampung.go.id
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


    <script>
        // Form validation and submission
        function handleSubmit(event) {
            event.preventDefault();

            const form = event.target;
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const message = document.getElementById('message');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');

            // Reset previous states
            clearValidationStates();

            // Validate form
            let isValid = true;

            if (!name.value.trim()) {
                showFieldError(name, 'Nama harus diisi');
                isValid = false;
            } else if (name.value.trim().length < 2) {
                showFieldError(name, 'Nama minimal 2 karakter');
                isValid = false;
            } else {
                showFieldSuccess(name);
            }

            if (!email.value.trim()) {
                showFieldError(email, 'Email harus diisi');
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                showFieldError(email, 'Format email tidak valid');
                isValid = false;
            } else {
                showFieldSuccess(email);
            }

            if (!message.value.trim()) {
                showFieldError(message, 'Pesan harus diisi');
                isValid = false;
            } else if (message.value.trim().length < 10) {
                showFieldError(message, 'Pesan minimal 10 karakter');
                isValid = false;
            } else {
                showFieldSuccess(message);
            }

            if (isValid) {
                // Show loading state
                submitBtn.classList.add('loading');
                btnText.textContent = 'Mengirim...';
                submitBtn.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    alert('Pesan berhasil dikirim! Terima kasih telah menghubungi kami.');
                    form.reset();
                    clearValidationStates();

                    // Reset button state
                    submitBtn.classList.remove('loading');
                    btnText.textContent = 'Kirim Pesan';
                    submitBtn.disabled = false;
                }, 2000);
            }
        }

        function showFieldError(field, message) {
            const formGroup = field.closest('.form-group');
            formGroup.classList.add('error');
            formGroup.classList.remove('success');

            // Remove existing error message
            const existingError = formGroup.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }

            // Add error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.style.color = '#ef4444';
            errorDiv.style.fontSize = '14px';
            errorDiv.style.marginTop = '5px';
            errorDiv.textContent = message;
            formGroup.appendChild(errorDiv);
        }

        function showFieldSuccess(field) {
            const formGroup = field.closest('.form-group');
            formGroup.classList.add('success');
            formGroup.classList.remove('error');

            // Remove error message
            const existingError = formGroup.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }
        }

        function clearValidationStates() {
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach(group => {
                group.classList.remove('error', 'success');
                const errorMessage = group.querySelector('.error-message');
                if (errorMessage) {
                    errorMessage.remove();
                }
            });
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function showAlert(page) {
            alert(`Navigasi ke halaman ${page} akan diimplementasikan`);
        }

        // Add smooth scrolling for better UX
        document.addEventListener('DOMContentLoaded', function() {
            // Add focus events for better form interaction
            const inputs = document.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.closest('.form-group').classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    this.closest('.form-group').classList.remove('focused');
                });
            });
        });
    </script>
</body>
</html>
