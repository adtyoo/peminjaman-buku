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
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1f2a38, #2c3e50, #34495e);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(14px);
            border-radius: 20px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.3);
            padding: 45px;
            width: 100%;
            max-width: 420px;
            animation: slideUp 0.5s ease;
        }

        .login-container:hover {
            transform: translateY(-2px);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .library-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .library-logo {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg,#3498db,#1f3c88);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .library-logo i {
            color: white;
            font-size: 28px;
        }

        h1 {
            font-size: 24px;
            color: #1f2937;
        }

        .subtitle {
            color: #6b7280;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
            display: block;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        input {
            width: 100%;
            padding: 14px 14px 14px 45px;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            background: #f9fafb;
            font-size: 14px;
            transition: 0.25s;
        }

        input:focus {
            outline: none;
            border-color: #3498db;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(52,152,219,0.2);
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #9ca3af;
        }

        .remember-me {
            margin-top: 10px;
            font-size: 13px;
            color: #6b7280;
        }

        .btn-login {
            width: 100%;
            margin-top: 15px;
            padding: 15px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg,#3498db,#1f3c88);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.25s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(52,152,219,0.4);
        }

        .alert {
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .library-features {
            margin-top: 25px;
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 10px;
        }

        .feature-item {
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }

        .feature-item i {
            font-size: 18px;
            color: #3498db;
            margin-bottom: 5px;
        }

        @media(max-width:480px){
            .login-container{
                padding:30px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="library-header">
        <div class="library-logo">
            <i class="fas fa-book-open"></i>
        </div>
        <h1>Perpustakaan Digital</h1>
        <p class="subtitle">Login menggunakan Username / NISN</p>
    </div>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="form-group">
            <label>Username / NISN</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-user"></i></span>
                <input type="text" name="login" required placeholder="contoh: 1234567890">
            </div>
        </div>

        <div class="form-group">
            <label>Kata Sandi</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-lock"></i></span>
                <input type="password" id="password" name="password" required>
                <span class="password-toggle" onclick="togglePassword()">
                    <i class="fas fa-eye" id="eyeIcon"></i>
                </span>
            </div>

            <div class="remember-me">
                <input type="checkbox" name="remember"> Ingat saya
            </div>
        </div>

        <button class="btn-login">Masuk</button>
    </form>

    <div class="library-features">
        <div class="feature-item">
            <i class="fas fa-book"></i>
            <div>Banyak Buku</div>
        </div>
        <div class="feature-item">
            <i class="fas fa-download"></i>
            <div>Download</div>
        </div>
        <div class="feature-item">
            <i class="fas fa-sync"></i>
            <div>Update</div>
        </div>
    </div>

</div>

<script>
function togglePassword(){
    const input = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');

    if(input.type === "password"){
        input.type = "text";
        icon.classList.replace("fa-eye","fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.replace("fa-eye-slash","fa-eye");
    }
}
</script>

</body>
</html>