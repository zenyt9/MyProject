<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/rental-template.css')}}" />
    <title>Миний профайл - Premium Car Rental</title>
    <style>
        .user-header {
            background: var(--text-dark);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
        }
        .user-nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .user-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            font-size: 1.5rem;
            font-family: var(--header-font);
            text-decoration: none;
        }
        .user-menu {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        .user-menu a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }
        .user-menu a:hover, .user-menu a.active {
            color: var(--primary-color);
        }
        .profile-container {
            max-width: 800px;
            margin: 120px auto 50px;
            padding: 2rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 5px 5px 20px rgba(0,0,0,0.1);
        }
        .profile-header {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid var(--extra-light);
        }
        .profile-avatar {
            width: 100px;
            height: 100px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }
        .profile-info h2 {
            margin: 0 0 0.5rem 0;
            color: var(--text-dark);
        }
        .profile-info p {
            margin: 0;
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
            padding: 0.75rem;
            border: 2px solid var(--extra-light);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .section-title {
            font-size: 1.5rem;
            margin: 2rem 0 1rem 0;
            padding-top: 2rem;
            border-top: 2px solid var(--extra-light);
            color: var(--text-dark);
        }
        .section-title:first-of-type {
            margin-top: 0;
            padding-top: 0;
            border-top: none;
        }
    </style>
</head>
<body>
    <div class="user-header">
        <div class="user-nav">
            <a href="{{ route('home') }}" class="user-logo">
                <i class="ri-car-line"></i>
                <span>Premium Rental</span>
            </a>
            <div class="user-menu">
                <a href="{{ route('home') }}"><i class="ri-home-line"></i> Нүүр</a>
                <a href="{{ route('user.cars.index') }}"><i class="ri-car-line"></i> Машинууд</a>
                <a href="{{ route('user.profile') }}" class="active"><i class="ri-user-line"></i> Профайл</a>
                <span style="color: white;"><i class="ri-user-line"></i> {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn" style="background: #dc3545; padding: 0.5rem 1rem;">
                        <i class="ri-logout-box-line"></i> Гарах
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="ri-user-line"></i>
            </div>
            <div class="profile-info">
                <h2>{{ $user->name }}</h2>
                <p><i class="ri-mail-line"></i> {{ $user->email }}</p>
                <p><i class="ri-shield-user-line"></i> {{ $user->role === 'admin' ? 'Админ' : 'Хэрэглэгч' }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="ri-checkbox-circle-line"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <strong>Алдаа:</strong>
                <ul style="margin: 0.5rem 0 0 1.5rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <h3 class="section-title"><i class="ri-information-line"></i> Үндсэн мэдээлэл</h3>

            <div class="form-group">
                <label for="name"><i class="ri-user-line"></i> Нэр</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email"><i class="ri-mail-line"></i> Имэйл</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <h3 class="section-title"><i class="ri-lock-line"></i> Нууц үг солих</h3>

            <div class="form-group">
                <label for="current_password"><i class="ri-lock-password-line"></i> Одоогийн нууц үг</label>
                <input type="password" name="current_password" id="current_password">
                <small style="color: var(--text-light); display: block; margin-top: 0.25rem;">
                    Нууц үг солихыг хүсвэл одоогийн нууц үгээ оруулна уу
                </small>
            </div>

            <div class="form-group">
                <label for="password"><i class="ri-lock-line"></i> Шинэ нууц үг</label>
                <input type="password" name="password" id="password">
                <small style="color: var(--text-light); display: block; margin-top: 0.25rem;">
                    Хамгийн багадаа 8 тэмдэгт
                </small>
            </div>

            <div class="form-group">
                <label for="password_confirmation"><i class="ri-lock-line"></i> Нууц үг баталгаажуулах</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn" style="flex: 1; background: var(--primary-color);">
                    <i class="ri-save-line"></i> Хадгалах
                </button>
                <a href="{{ route('user.cars.index') }}" class="btn" style="flex: 1; background: var(--text-light); color: var(--text-dark); text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center;">
                    <i class="ri-close-line"></i> Болих
                </a>
            </div>
        </form>
    </div>

    <footer style="margin-top: 3rem; background-color: var(--text-dark); padding: 2rem 0;">
        <div class="footer__bar">
            Copyright © 2024 Premium Car Rental. Бүх эрх хуулиар хамгаалагдсан.
        </div>
    </footer>
</body>
</html>
