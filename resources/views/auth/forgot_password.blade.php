<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - Perpustakaan Digital</title>
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
            overflow-x: hidden; /* Allow vertical scrolling */
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

        .forgot-container {
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
            max-height: calc(100vh - 40px); /* Prevent exceeding viewport height */
            overflow-y: auto; /* Allow scrolling within container if needed */
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
            font-size: 26px;
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

        input[type="email"] {
            width: 100%;
            padding: 15px 15px 15px 48px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: #f8f9fa;
            font-weight: 500;
        }

        input[type="email"]:focus {
            outline: none;
            border-color: #3498db;
            background: white;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.15);
            transform: translateY(-2px);
        }

        .btn-send {
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

        .btn-send:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(52, 152, 219, 0.5);
            background: linear-gradient(135deg, #2980b9 0%, #1a2530 100%);
        }

        .btn-send:active {
            transform: translateY(0);
        }

        .btn-send::before {
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

        .btn-send:hover::before {
            left: 120%;
        }

        .back-to-login {
            text-align: center;
            color: #7f8c8d;
            font-size: 15px;
            margin-top: 20px;
        }

        .back-to-login a {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            position: relative;
        }

        .back-to-login a:hover {
            color: #2c3e50;
            text-decoration: underline;
        }

        .back-to-login a::after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #3498db;
            transition: width 0.3s ease;
        }

        .back-to-login a:hover::after {
            width: 100%;
        }

        .info-text {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #7f8c8d;
            border-left: 4px solid #3498db;
        }

        .info-text i {
            color: #3498db;
            margin-right: 8px;
        }

        @media (max-width: 480px) {
            .forgot-container {
                padding: 30px 25px;
                margin: 15px;
                max-height: calc(100vh - 30px); /* Adjust for smaller margins */
                overflow-y: auto; /* Ensure scrolling works on mobile */
            }

            h1 {
                font-size: 22px;
            }

            .books {
                display: none;
            }

            body {
                padding: 10px; /* Reduce padding on small screens */
            }
        }

        /* Loading animation */
        .btn-send.loading {
            pointer-events: none;
            position: relative;
            color: transparent;
        }

        .btn-send.loading::after {
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

    <div class="forgot-container">
        <div class="library-header">
            <div class="library-logo">
                <i class="fas fa-key"></i>
            </div>
            <h1>Lupa Kata Sandi?</h1>
            <p class="subtitle">Kami akan membantu Anda mengatur ulang kata sandi</p>
        </div>

        <div class="info-text">
            <i class="fas fa-info-circle"></i>Masukkan alamat email yang terkait dengan akun Anda dan kami akan mengirimkan kode OTP untuk mengatur ulang kata sandi Anda.
        </div>

        {{-- ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- PESAN SUKSES --}}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('send.otp') }}" method="POST" id="forgotForm">
            @csrf

            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Alamat Email</label>
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

            <button type="submit" class="btn-send">Kirim Kode OTP <i class="fas fa-paper-plane"></i></button>
        </form>

        <p class="back-to-login">
            Ingat kata sandi Anda? <a href="{{ route('login') }}">Kembali ke Login</a>
        </p>
    </div>

    <script>
        // Add loading state to button on submit
        document.getElementById('forgotForm').addEventListener('submit', function() {
            const btn = this.querySelector('.btn-send');
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
