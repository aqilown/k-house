<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - K.House</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="register-container">
        <img src="{{ asset('logo-khouse.png') }}" alt="K.House Logo" class="logo">
        
        <form>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" placeholder="" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" placeholder="" required>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" placeholder="" required>
            </div>

            <button type="submit" class="btn-register">Register</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login disini</a>
        </div>
    </div>
</body>
</html>