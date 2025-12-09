<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - K.House</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="login-container">
        <img src="{{ asset('logo-khouse.png') }}" alt="K.House Logo" class="logo">
        <h2 style="color: #2d4538; margin-bottom: 10px;">Admin Login</h2>
        <p style="color: #666; font-size: 14px; margin-bottom: 30px;">Masuk ke panel admin K.House</p>
        
        @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="admin@gmail.com" value="{{ old('email') }}" required>
                @error('email')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
                @error('password')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="remember-forgot">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="register-link" style="margin-top: 20px;">
            <a href="{{ route('home') }}" style="color: #666;">← Kembali ke Home</a>
        </div>
    </div>
</body>
</html>