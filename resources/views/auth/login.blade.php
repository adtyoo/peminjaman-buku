<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan Digital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Background decorative elements */
        .book-shelf {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(to right, #8B4513 0%, #A0522D 15%, #8B4513 30%, #A0522D 45%, #8B4513 60%, #A0522D 75%, #8B4513 100%);
            z-index: 0;
        }

        .book-shelf::before {
            content: "";
            position: absolute;
            top: -20px;
            left: 0;
            width: 100%;
            height: 20px;
            background: #5D4037;
        }

        .books {
            position: absolute;
            bottom: 100px;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-around;
            padding: 0 20px;
            z-index: 0;
        }

        .book {
            width: 15px;
            height: 80px;
            background: linear-gradient(to right, #3498db, #2980b9);
            border-radius: 3px;
            margin: 0 2px;
            position: relative;
            animation: bookFloat 6s ease-in-out infinite;
        }

        .book:nth-child(2n) {
            background: linear-gradient(to right, #e74c3c, #c0392b);
            animation-delay: 1s;
        }

        .book:nth-child(3n) {
            background: linear-gradient(to right, #2ecc71, #27ae60);
            animation-delay: 2s;
        }

        .book:nth-child(4n) {
            background: linear-gradient(to right, #f39c12, #d35400);
            animation-delay: 3s;
        }

        .book:nth-child(5n) {
            background: linear-gradient(to right, #9b59b6, #8e44ad);
            animation-delay: 4s;
        }

        @keyframes bookFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            animation: slideUp 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            z-index: 10;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .library-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .library-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
            position: relative;
            overflow: hidden;
        }

        .library-logo::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent,
                rgba(255, 255, 255, 0.3),
                transparent
            );
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: rotate(45deg) translateX(-100%); }
            100% { transform: rotate(45deg) translateX(100%); }
        }

        .library-logo i {
            font-size: 32px;
            color: white;
            z-index: 1;
        }

        h1 {
            color: #2c3e50;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: #7f8c8d;
            font-size: 15px;
            margin-bottom: 25px;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            animation: fadeIn 0.4s ease-out;
            border-left: 4px solid;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-danger {
            background: #ffeaea;
            border-left-color: #e74c3c;
            color: #c0392b;
        }

        .alert-danger ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .alert-danger li {
            padding: 4px 0;
            display: flex;
            align-items: center;
        }

        .alert-danger li:before {
            content: "⚠ ";
            margin-right: 8px;
            font-weight: bold;
        }

        .alert-success {
            background: #e8f5e9;
            border-left-color: #27ae60;
            color: #27ae60;
        }

        .alert-success:before {
            content: "✓ ";
            margin-right: 8px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 22px;
            position: relative;
        }

        label {
            display: block;
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        label i {
            margin-right: 8px;
            color: #3498db;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
            font-size: 16px;
            z-index: 1;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px 15px 15px 48px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: #f8f9fa;
            font-weight: 500;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #3498db;
            background: white;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.15);
            transform: translateY(-2px);
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #7f8c8d;
            font-size: 16px;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            margin-top: 5px;
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(52, 152, 219, 0.5);
            background: linear-gradient(135deg, #2980b9 0%, #1a2530 100%);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -60%;
            width: 20%;
            height: 200%;
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(25deg);
            transition: all 0.8s;
        }

        .btn-login:hover::before {
            left: 120%;
        }

        .divider {
            text-align: center;
            margin: 28px 0;
            position: relative;
            color: #95a5a6;
            font-size: 14px;
        }

        .divider-line {
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #ecf0f1;
        }

        .divider span {
            background: rgba(255, 255, 255, 0.97);
            padding: 0 15px;
            color: #95a5a6;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        .register-link {
            text-align: center;
            color: #7f8c8d;
            font-size: 15px;
            margin-top: 10px;
        }

        .register-link a {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            position: relative;
        }

        .register-link a:hover {
            color: #2c3e50;
            text-decoration: underline;
        }

        .register-link a::after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #3498db;
            transition: width 0.3s ease;
        }

        .register-link a:hover::after {
            width: 100%;
        }

        .library-features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #ecf0f1;
        }

        .feature-item {
            text-align: center;
            padding: 12px 5px;
        }

        .feature-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #3498db15 0%, #2c3e5015 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            transition: transform 0.3s ease;
        }

        .feature-item:hover .feature-icon {
            transform: scale(1.1);
            background: linear-gradient(135deg, #3498db25 0%, #2c3e5025 100%);
        }

        .feature-icon i {
            font-size: 20px;
            color: #3498db;
        }

        .feature-text {
            font-size: 12px;
            color: #7f8c8d;
            font-weight: 500;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 25px;
                margin: 15px;
            }

            h1 {
                font-size: 24px;
            }

            .library-features {
                grid-template-columns: repeat(2, 1fr);
            }

            .books {
                display: none;
            }
        }

        /* Loading animation */
        .btn-login.loading {
            pointer-events: none;
            position: relative;
            color: transparent;
        }

        .btn-login.loading::after {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Remember me checkbox */
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 14px;
            color: #7f8c8d;
        }

        .remember-me input {
            margin-right: 8px;
            accent-color: #3498db;
        }

        .forgot-password {
            display: block;
            text-align: right;
            font-size: 14px;
            margin-top: 5px;
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #2c3e50;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Decorative bookshelf background -->
    <div class="books">
        <div class="book"></div>
        <div class="book"></div>
        <div class="book"></div>
        <div class="book"></div>
        <div class="book"></div>
        <div class="book"></div>
        <div class="book"></div>
        <div class="book"></div>
        <div class="book"></div>
        <div class="book"></div>
    </div>
    <div class="book-shelf"></div>

    <div class="login-container">
        <div class="library-header">
            <div class="library-logo">
                <i class="fas fa-book-open"></i>
            </div>
            <h1>Perpustakaan Digital</h1>
            <p class="subtitle">Akses koleksi buku digital Anda</p>
        </div>

        {{-- ERROR VALIDASI / LOGIN --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- PESAN SUKSES (dari register) --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" id="loginForm">
            @csrf

            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <i class="fas fa-user"></i>
                    </span>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="masukkan email Anda"
                        required
                        autocomplete="email"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Kata Sandi</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <i class="fas fa-key"></i>
                    </span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="masukkan kata sandi"
                        required
                        autocomplete="current-password"
                    >
                    <span class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </span>
                </div>

                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Ingat saya</label>
                </div>

                <a href="{{ route('forgot.password') }}" class="forgot-password">
                    Lupa Kata Sandi?
                </a>
            </div>

            <button type="submit" class="btn-login">Masuk ke Akun <i class="fas fa-sign-in-alt"></i></button>
        </form>

        <div class="library-features">
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="feature-text">Ratusan Buku</div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-download"></i>
                </div>
                <div class="feature-text">Download Mudah</div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-sync-alt"></i>
                </div>
                <div class="feature-text">Update Terbaru</div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        // Add loading state to button on submit
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = this.querySelector('.btn-login');
            btn.classList.add('loading');
            btn.disabled = true;
        });

        // Add animation on input focus
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.01)';
            });
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>