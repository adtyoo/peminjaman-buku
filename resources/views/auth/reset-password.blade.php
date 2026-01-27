<form action="{{ route('reset.password') }}" method="POST">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="text" name="otp" placeholder="Kode OTP" required>
    <input type="password" name="password" placeholder="Password Baru" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
    <button type="submit">Reset Password</button>
</form>
