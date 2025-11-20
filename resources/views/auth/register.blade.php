<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - K.House</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('background-kost.jpg');
            background-size: cover;
            background-position: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
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
            color: #333;
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

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .remember-forgot label {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }

        .remember-forgot a {
            color: #3d5a4a;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #1a1a1a;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: #333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .register-link {
            margin-top: 25px;
            font-size: 14px;
            color: #666;
        }

        .register-link a {
            color: #3d5a4a;
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="logo-khouse.png" alt="K.House Logo" class="logo">
        
        <form>
            <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" placeholder="Enter your password" required>
            </div>

            <div class="remember-forgot">
                <label>
                    <input type="checkbox"> Lupa password?
                </label>
                <a href="#">Forgot Password</a>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="register.html">Daftar disini</a>
        </div>
    </div>
</body>
</html>