<form action="{{ route('send.otp') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Kirim OTP</button>
</form>
