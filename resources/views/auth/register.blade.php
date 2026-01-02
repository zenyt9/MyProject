<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Бүртгүүлэх - Premium Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/rental-template.css')}}" />
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-color-dark) 100%);
            padding: 2rem;
        }
        .auth-box {
            background: white;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 450px;
            width: 100%;
        }
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .auth-header h1 {
            font-family: var(--header-font);
            color: var(--text-dark);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        .auth-header p {
            color: var(--text-light);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
            font-weight: 600;
        }
        .form-group input {
            width: 100%;
            padding: 0.875rem;
            border: 2px solid var(--extra-light);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-submit:hover {
            background: var(--primary-color-dark);
        }
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-light);
        }
        .auth-footer a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }
        .auth-footer a:hover {
            text-decoration: underline;
        }
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <div class="logo">
                <i class="ri-car-line" style="font-size: 2rem;"></i>
                <span style="font-family: var(--header-font); font-weight: 700;">Premium Rental</span>
            </div>

            <div class="auth-header">
                <h1>Бүртгүүлэх</h1>
                <p>Шинэ бүртгэл үүсгэх</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Нэр</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Имэйл</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Нууц үг</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Нууц үг давтах</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="ri-user-add-line"></i> Бүртгүүлэх
                </button>
            </form>

            <div class="auth-footer">
                Бүртгэлтэй юу? <a href="{{ route('login') }}">Нэвтрэх</a>
                <br><br>
                <a href="{{ route('welcome') }}">← Нүүр хуудас руу буцах</a>
            </div>
        </div>
    </div>
</body>
</html>
