<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>SPBE - Pemerintah Kota Bandar Lampung</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
        }

        .spbe-navbar {
            background: linear-gradient(135deg, #001e74 0%, #1a3a8a 100%);
            display: flex;
            align-items: center;
            padding: 15px 40px;
            color: white;
            justify-content: space-between;
            box-shadow: 0 4px 20px rgba(0, 30, 116, 0.3);
            position: relative;
            z-index: 1000;
        }

        .spbe-navbar .logo img {
            height: 80px;
            transition: transform 0.3s ease;
        }

        .spbe-navbar .logo img:hover {
            transform: scale(1.05);
        }

        .spbe-navbar .menu {
            display: flex;
            list-style: none;
            gap: 30px;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }

        .spbe-navbar .menu li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .spbe-navbar .menu li a::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -5px;
            height: 3px;
            width: 0%;
            background: linear-gradient(90deg, #facc15, #ffd700);
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .spbe-navbar .menu li a:hover {
            color: #facc15;
            background: rgba(250, 204, 21, 0.1);
        }

        .spbe-navbar .menu li a:hover::after {
            width: 80%;
        }

        /* Contact Section */
        .contact-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 80px 40px;
            min-height: 70vh;
        }

        .contact-container {
            max-width: 1200px;
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

        /* Footer */
        .spbe-footer {
            background: linear-gradient(135deg, #071735 0%, #0a1f3b 100%);
            color: white;
            padding: 60px 40px 30px;
            margin-top: 80px;
            position: relative;
        }

        .spbe-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #facc15, #ffd700);
        }

        .footer-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-logo {
            height: 100px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .footer-logo:hover {
            transform: scale(1.05);
        }

        .footer-column h4 {
            margin-bottom: 20px;
            color: #facc15;
            font-size: 18px;
            font-weight: 600;
            border-left: 4px solid #facc15;
            padding-left: 15px;
        }

        .footer-column p {
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 15px;
            color: #cbd5e1;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .contact-item:hover {
            transform: translateX(5px);
        }

        .icon-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #facc15, #ffd700);
            color: #001e74;
            margin-right: 15px;
            font-size: 16px;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }

        .contact-item:hover .icon-circle {
            transform: scale(1.1);
        }

        .footer-social {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .footer-social a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: rgba(250, 204, 21, 0.1);
            border: 2px solid #facc15;
            border-radius: 50%;
            color: #facc15;
            font-size: 18px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            background: #facc15;
            color: #001e74;
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            margin-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .footer-bottom p {
            color: #cbd5e1;
            font-size: 14px;
            margin: 0;
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
    <div class="spbe-navbar">
        <a >
            <img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE" style="cursor:pointer;">
        </a>

        <ul class="menu">
            <li><a href="#">Indikator SPBE</a></li>
            <li><a href="{{ route('profile.show') }}">Profile</a></li>
            <li><a href="{{ route('berita.index') }}">Berita</a></li>
            <li><a href="#">Download</a></li>
            <li><a href="#">Galeri</a></li>
            <li><a href="#">Kontak</a></li>
        </ul>
    </div>

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

    <footer class="spbe-footer">
        <div class="footer-container">

            <!-- Logo dan Deskripsi -->
            <div class="footer-column">
            <img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE" class="footer-logo">
            <p>Merupakan media atau wadah informasi sekaligus pengelolaan data indikator SPBE di lingkungan Pemerintah Kota Lampung</p>
            <div class="footer-social">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
            </div>

            <!-- Kontak -->
            <div class="footer-column">
                <h4>Contact</h4>
                <p><span class="icon-circle"><i class="fa-solid fa-phone"></i></span> (0721) 252041 </p>
                <p><span class="icon-circle"><i class="fa-solid fa-envelope"></i></span> spbe@bandarlampung.go.id</p>
                <p><span class="icon-circle"><i class="fa-solid fa-location-dot"></i></span> Jalan Dokter Susilo No.2, Sumur Batu, Teluk Betung Utara, Kota Bandar Lampung, Lampung 35212</p>
            </div>
        </div>
         <div class="footer-bottom">
            <p>© 2025. TIM KP Unila Diskominfo Kota Bandar Lampung. All Rights Reserved</p>
        </div>
    </footer>

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
    </style>
</body>
</html>