<?php
include_once '../lib/setting.php';

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Halaman login GEMILANG Body Repair">
    <title>Login - <?php echo htmlspecialchars($title); ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #d64b3b;
            --secondary-color: #2c3e50;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
            --light-gray: #ecf0f1;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            position: relative;
            animation: slideInUp 0.5s ease-out;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-color), #c0392b);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .login-header h2 {
            margin: 0;
            font-size: 2rem;
            font-weight: 600;
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .login-body {
            padding: 40px 30px;
            position: relative;
            z-index: 1;
        }

        .form-group {
            margin-bottom: 30px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--secondary-color);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: var(--transition);
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-control {
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            padding: 16px 50px 16px 20px;
            font-size: 1rem;
            transition: var(--transition);
            background: white;
            height: 56px;
            width: 100%;
            outline: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .form-control::placeholder {
            color: #a0aec0;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(214, 75, 59, 0.1), 0 4px 12px rgba(0, 0, 0, 0.08);
            background: white;
            transform: translateY(-1px);
        }

        .form-control:focus::placeholder {
            opacity: 0;
            transform: translateX(-10px);
        }

        .input-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #cbd5e0;
            z-index: 10;
            font-size: 1.2rem;
            transition: var(--transition);
            pointer-events: none;
            background: white;
            padding: 4px;
            border-radius: 50%;
        }

        .form-control:focus ~ .input-icon {
            color: var(--primary-color);
            transform: translateY(-50%) scale(1.1);
        }

        .form-control:not(:placeholder-shown) ~ .input-icon {
            opacity: 0.3;
            transform: translateY(-50%) scale(0.9);
        }

        .form-control:focus:not(:placeholder-shown) ~ .input-icon {
            opacity: 1;
        }

        .form-check {
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            border: 2px solid #e1e8ed;
            border-radius: 6px;
            transition: var(--transition);
            cursor: pointer;
            position: relative;
            margin-right: 10px;
            background-color: white;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(214, 75, 59, 0.1);
        }

        .form-check-input:hover {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(214, 75, 59, 0.05);
        }

        .form-check-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(214, 75, 59, 0.15);
        }

        .form-check-label {
            color: #4a5568;
            font-size: 0.95rem;
            cursor: pointer;
            user-select: none;
            transition: var(--transition);
        }

        .form-check-input:checked + .form-check-label {
            color: var(--primary-color);
            font-weight: 500;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), #c0392b);
            color: white;
            border: none;
            padding: 12px 0;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 500;
            width: 100%;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(214, 75, 59, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(214, 75, 59, 0.4);
            background: linear-gradient(135deg, #c0392b, var(--primary-color));
            color: white;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .login-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            font-style: italic;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .alert {
            border-radius: 8px;
            border: none;
            padding: 15px;
            margin-bottom: 25px;
            animation: slideInDown 0.3s ease-out;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
            border-left: 4px solid var(--danger-color);
        }

        .alert-success {
            background: rgba(39, 174, 96, 0.1);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }

        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            body {
                padding: 10px;
            }

            .login-container {
                max-width: 100%;
                border-radius: 8px;
            }

            .login-header {
                padding: 20px;
            }

            .login-header h2 {
                font-size: 1.5rem;
            }

            .login-body {
                padding: 30px 20px;
            }

            .form-control {
                padding: 14px 45px 14px 18px;
                height: 50px;
                font-size: 0.95rem;
            }

            .input-icon {
                right: 15px;
                font-size: 1.1rem;
                padding: 3px;
            }

            .form-label {
                font-size: 0.85rem;
                margin-bottom: 6px;
            }

            .form-group {
                margin-bottom: 25px;
            }
        }

        @media (max-width: 400px) {
            .login-header h2 {
                font-size: 1.3rem;
            }

            .btn-login {
                font-size: 1rem;
                padding: 10px 0;
            }

            .form-control {
                padding: 12px 40px 12px 16px;
                height: 48px;
            }

            .input-icon {
                right: 12px;
                font-size: 1rem;
            }
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .login-container {
                border: 2px solid #000;
            }

            .form-control {
                border: 2px solid #000;
            }
        }

        /* Modern animations */
        .input-wrapper.focused {
            transform: translateY(-2px);
        }

        .form-label.focused {
            color: var(--primary-color);
            font-weight: 600;
        }

        .input-icon.pulse {
            animation: iconPulse 0.5s ease-in-out infinite alternate;
        }

        @keyframes iconPulse {
            from {
                transform: translateY(-50%) scale(1);
                opacity: 1;
            }
            to {
                transform: translateY(-50%) scale(1.15);
                opacity: 0.8;
            }
        }

        .input-wrapper.has-value {
            /* Visual feedback when input has value */
        }

        .checked-animation {
            animation: checkBounce 0.3s ease-in-out;
        }

        @keyframes checkBounce {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: translate(-50%, -50%);
            pointer-events: none;
            width: 0;
            height: 0;
            animation: rippleEffect 0.6s ease-out;
        }

        @keyframes rippleEffect {
            to {
                width: 300px;
                height: 300px;
                opacity: 0;
            }
        }

        /* Enhanced button hover effect */
        .btn-login {
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        /* Form field hover effects */
        .form-control:hover {
            border-color: #cbd5e0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Loading animation improvements */
        .btn-login:disabled {
            position: relative;
        }

        .btn-login:disabled::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition: none !important;
            }

            .btn-login::before {
                display: none;
            }

            .btn-login:disabled::after {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2><i class="fas fa-sign-in-alt me-2"></i>Login</h2>
        </div>

        <div class="login-body">
            <div id="login-alert" class="alert" style="display: none;"></div>

            <form id="loginForm" novalidate>
                <div class="form-group">
                    <label for="txt_username" class="form-label">Username</label>
                    <div class="input-wrapper">
                        <input
                            type="text"
                            class="form-control"
                            id="txt_username"
                            name="txt_username"
                            placeholder="Masukkan username Anda"
                            required
                            autocomplete="username"
                            aria-label="Username"
                        >
                        <i class="fas fa-user input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txt_password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            class="form-control"
                            id="txt_password"
                            name="txt_password"
                            placeholder="Masukkan password Anda"
                            required
                            autocomplete="current-password"
                            aria-label="Password"
                        >
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>

                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="login-remember"
                        name="remember"
                        value="1"
                    >
                    <label class="form-check-label" for="login-remember">
                        Ingat saya
                    </label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-login" id="loginBtn">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        <span id="btnText">MASUK</span>
                        <div class="loading-spinner" id="loadingSpinner"></div>
                    </button>
                </div>
            </form>

            <div class="login-footer">
                GEMILANG Body Repair - Semarang
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (for existing AJAX compatibility) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            const loginForm = $('#loginForm');
            const loginAlert = $('#login-alert');
            const loginBtn = $('#loginBtn');
            const btnText = $('#btnText');
            const loadingSpinner = $('#loadingSpinner');

            // Form validation
            function validateForm() {
                const username = $('#txt_username').val().trim();
                const password = $('#txt_password').val().trim();

                if (!username) {
                    showAlert('Silakan masukkan username', 'danger');
                    $('#txt_username').focus();
                    return false;
                }

                if (!password) {
                    showAlert('Silakan masukkan password', 'danger');
                    $('#txt_password').focus();
                    return false;
                }

                if (username.length < 3) {
                    showAlert('Username minimal 3 karakter', 'danger');
                    $('#txt_username').focus();
                    return false;
                }

                if (password.length < 4) {
                    showAlert('Password minimal 4 karakter', 'danger');
                    $('#txt_password').focus();
                    return false;
                }

                return true;
            }

            // Show alert message
            function showAlert(message, type) {
                loginAlert.removeClass('alert-danger alert-success')
                          .addClass(`alert-${type}`)
                          .html(`<i class="fas fa-${type === 'danger' ? 'exclamation-circle' : 'check-circle'} me-2"></i>${message}`)
                          .fadeIn();

                // Auto hide after 5 seconds
                setTimeout(() => {
                    loginAlert.fadeOut();
                }, 5000);
            }

            // Set loading state
            function setLoading(loading) {
                if (loading) {
                    loginBtn.prop('disabled', true);
                    btnText.text('MEMPROSES...');
                    loadingSpinner.show();
                } else {
                    loginBtn.prop('disabled', false);
                    btnText.text('MASUK');
                    loadingSpinner.hide();
                }
            }

            // Handle form submission
            loginForm.on('submit', function(e) {
                e.preventDefault();

                if (!validateForm()) {
                    return false;
                }

                setLoading(true);
                loginAlert.hide();

                $.ajax({
                    type: 'POST',
                    url: 'login/ceklogin.php',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    timeout: 15000, // 15 second timeout
                    success: function(response) {
                        const result = response.trim();

                        if (result === 'y') {
                            showAlert('Login gagal! Username atau password salah.', 'danger');
                            $('#txt_password').val('').focus();
                        } else {
                            showAlert('Login berhasil! Mengalihkan...', 'success');
                            setTimeout(() => {
                                window.location.href = "../index.php";
                            }, 1500);
                        }
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';

                        if (status === 'timeout') {
                            errorMessage = 'Koneksi timeout. Silakan periksa koneksi internet Anda.';
                        } else if (xhr.status === 404) {
                            errorMessage = 'Halaman login tidak ditemukan.';
                        } else if (xhr.status >= 500) {
                            errorMessage = 'Server error. Silakan coba lagi nanti.';
                        }

                        showAlert(errorMessage, 'danger');
                    },
                    complete: function() {
                        setLoading(false);
                    }
                });
            });

            // Add modern input animations and interactions
            $('.form-control').on('focus', function() {
                const wrapper = $(this).closest('.input-wrapper');
                const formGroup = $(this).closest('.form-group');

                wrapper.addClass('focused');
                formGroup.find('.form-label').addClass('focused');

                // Add pulse animation to icon
                wrapper.find('.input-icon').addClass('pulse');
            }).on('blur', function() {
                const wrapper = $(this).closest('.input-wrapper');
                const formGroup = $(this).closest('.form-group');

                if (!$(this).val()) {
                    wrapper.removeClass('focused');
                    formGroup.find('.form-label').removeClass('focused');
                }

                wrapper.find('.input-icon').removeClass('pulse');
            }).on('input', function() {
                const wrapper = $(this).closest('.input-wrapper');
                const hasValue = $(this).val().length > 0;

                if (hasValue) {
                    wrapper.addClass('has-value');
                } else {
                    wrapper.removeClass('has-value');
                }
            });

            // Add checkbox animation
            $('.form-check-input').on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).addClass('checked-animation');
                    setTimeout(() => {
                        $(this).removeClass('checked-animation');
                    }, 300);
                }
            });

            // Add ripple effect to button
            $('.btn-login').on('click', function(e) {
                const button = $(this);
                const ripple = $('<span class="ripple"></span>');

                button.append(ripple);

                const x = e.pageX - button.offset().left;
                const y = e.pageY - button.offset().top;

                ripple.css({
                    left: x + 'px',
                    top: y + 'px'
                });

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });

            // Prevent form resubmission on page refresh
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        });
    </script>
</body>
</html>