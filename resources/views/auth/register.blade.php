<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - K.House</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(rgba(45, 69, 56, 0.7), rgba(45, 69, 56, 0.7)), url('{{ asset("background-kost.jpg") }}');
            background-size: cover;
            background-position: center;
            padding: 20px;
        }

        .register-container {
            background: #f8f5f0;
            padding: 50px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            width: 400px;
            text-align: center;
        }

        .logo {
            width: 80px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2d4538;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3d5a4a;
            box-shadow: 0 0 0 3px rgba(61, 90, 74, 0.1);
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            background: #2d4538;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: #3d5a4a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(45, 69, 56, 0.4);
        }

        .login-link {
            margin-top: 25px;
            font-size: 14px;
            color: #666;
        }

        .login-link a {
            color: #3d5a4a;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
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