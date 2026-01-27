<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Buat Akun Baru</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 440px;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .logo-icon svg {
            width: 35px;
            height: 35px;
            fill: white;
        }

        h2 {
            color: #333;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .alert-danger {
            background: #fee;
            border-left: 4px solid #e74c3c;
            color: #c0392b;
        }

        .alert-danger ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .alert-danger li {
            padding: 4px 0;
        }

        .alert-danger li:before {
            content: "⚠ ";
            margin-right: 5px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            color: #444;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .password-strength {
            margin-top: 6px;
            display: none;
        }

        .strength-bar {
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 4px;
        }

        .strength-bar-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-text {
            font-size: 12px;
            color: #666;
        }

        .strength-weak .strength-bar-fill {
            width: 33%;
            background: #e74c3c;
        }

        .strength-medium .strength-bar-fill {
            width: 66%;
            background: #f39c12;
        }

        .strength-strong .strength-bar-fill {
            width: 100%;
            background: #27ae60;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }

        .divider:before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #e0e0e0;
        }

        .divider span {
            background: rgba(255, 255, 255, 0.95);
            padding: 0 15px;
            color: #999;
            font-size: 13px;
            position: relative;
        }

        .login-link {
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .password-requirements {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 12px;
            margin-top: 15px;
            font-size: 12px;
        }

        .requirement-title {
            color: #444;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .requirement-item {
            color: #666;
            padding: 3px 0;
            display: flex;
            align-items: center;
        }

        .requirement-item:before {
            content: "○";
            margin-right: 8px;
            color: #ccc;
            font-size: 16px;
        }

        .requirement-item.valid:before {
            content: "✓";
            color: #27ae60;
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 30px 25px;
            }

            h2 {
                font-size: 24px;
            }
        }

        /* Loading animation */
        .btn-register.loading {
            pointer-events: none;
            position: relative;
            color: transparent;
        }

        .btn-register.loading:after {
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

        .password-match-indicator {
            font-size: 12px;
            margin-top: 6px;
            display: none;
        }

        .password-match-indicator.show {
            display: block;
        }

        .password-match-indicator.match {
            color: #27ae60;
        }

        .password-match-indicator.no-match {
            color: #e74c3c;
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="logo-section">
        <div class="logo-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
            </svg>
        </div>
        <h2>Buat Akun Baru</h2>
        <p class="subtitle">Isi formulir di bawah untuk mendaftar</p>
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

    <form action="{{ route('register.post') }}" method="POST" id="registerForm">
        @csrf

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <div class="input-wrapper">
                <span class="input-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </span>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    placeholder="Masukkan nama lengkap"
                    required
                    autocomplete="name"
                >
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-wrapper">
                <span class="input-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </span>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    placeholder="nama@email.com"
                    required
                    autocomplete="email"
                >
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <span class="input-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </span>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Minimal 8 karakter"
                    required
                    autocomplete="new-password"
                >
            </div>
            <div class="password-strength" id="passwordStrength">
                <div class="strength-bar">
                    <div class="strength-bar-fill"></div>
                </div>
                <div class="strength-text"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="input-wrapper">
                <span class="input-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </span>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    placeholder="Ulangi password"
                    required
                    autocomplete="new-password"
                >
            </div>
            <div class="password-match-indicator" id="passwordMatch"></div>
        </div>

        <div class="password-requirements">
            <div class="requirement-title">Password harus memenuhi:</div>
            <div class="requirement-item" id="req-length">Minimal 8 karakter</div>
            <div class="requirement-item" id="req-uppercase">Mengandung huruf besar</div>
            <div class="requirement-item" id="req-lowercase">Mengandung huruf kecil</div>
            <div class="requirement-item" id="req-number">Mengandung angka</div>
        </div>

        <button type="submit" class="btn-register">Daftar Sekarang</button>
    </form>

    <div class="divider">
        <span>atau</span>
    </div>

    <p class="login-link">
        Sudah punya akun? <a href="{{ route('login') }}">Masuk di Sini</a>
    </p>
</div>

<script>
    // Password strength checker
    const passwordInput = document.getElementById('password');
    const passwordStrength = document.getElementById('passwordStrength');
    const strengthBar = passwordStrength.querySelector('.strength-bar-fill');
    const strengthText = passwordStrength.querySelector('.strength-text');

    // Password requirements elements
    const reqLength = document.getElementById('req-length');
    const reqUppercase = document.getElementById('req-uppercase');
    const reqLowercase = document.getElementById('req-lowercase');
    const reqNumber = document.getElementById('req-number');

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        
        if (password.length > 0) {
            passwordStrength.style.display = 'block';
            
            // Check requirements
            const hasLength = password.length >= 8;
            const hasUppercase = /[A-Z]/.test(password);
            const hasLowercase = /[a-z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            
            // Update requirement indicators
            reqLength.classList.toggle('valid', hasLength);
            reqUppercase.classList.toggle('valid', hasUppercase);
            reqLowercase.classList.toggle('valid', hasLowercase);
            reqNumber.classList.toggle('valid', hasNumber);
            
            // Calculate strength
            let strength = 0;
            if (hasLength) strength++;
            if (hasUppercase) strength++;
            if (hasLowercase) strength++;
            if (hasNumber) strength++;
            if (password.length >= 12) strength++;
            
            // Update strength bar
            passwordStrength.className = 'password-strength';
            if (strength <= 2) {
                passwordStrength.classList.add('strength-weak');
                strengthText.textContent = 'Password lemah';
            } else if (strength <= 4) {
                passwordStrength.classList.add('strength-medium');
                strengthText.textContent = 'Password sedang';
            } else {
                passwordStrength.classList.add('strength-strong');
                strengthText.textContent = 'Password kuat';
            }
        } else {
            passwordStrength.style.display = 'none';
            // Reset all requirements
            reqLength.classList.remove('valid');
            reqUppercase.classList.remove('valid');
            reqLowercase.classList.remove('valid');
            reqNumber.classList.remove('valid');
        }
        
        checkPasswordMatch();
    });

    // Password match checker
    const passwordConfirmation = document.getElementById('password_confirmation');
    const passwordMatch = document.getElementById('passwordMatch');

    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmation = passwordConfirmation.value;
        
        if (confirmation.length > 0) {
            passwordMatch.classList.add('show');
            if (password === confirmation) {
                passwordMatch.textContent = '✓ Password cocok';
                passwordMatch.className = 'password-match-indicator show match';
            } else {
                passwordMatch.textContent = '✗ Password tidak cocok';
                passwordMatch.className = 'password-match-indicator show no-match';
            }
        } else {
            passwordMatch.classList.remove('show');
        }
    }

    passwordConfirmation.addEventListener('input', checkPasswordMatch);

    // Add loading state to button on submit
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const password = passwordInput.value;
        const confirmation = passwordConfirmation.value;
        
        if (password !== confirmation) {
            e.preventDefault();
            alert('Password dan konfirmasi password tidak cocok!');
            return;
        }
        
        const btn = this.querySelector('.btn-register');
        btn.classList.add('loading');
    });

    // Add animation on input focus
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
</script>

</body>
</html>