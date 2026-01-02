<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Админ хяналтын самбар - Premium Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/rental-template.css')}}" />
    <style>
        .admin-header {
            background: var(--text-dark);
            padding: 1rem 0;
            margin-bottom: 3rem;
        }
        .admin-nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            font-size: 1.5rem;
            font-family: var(--header-font);
        }
        .admin-user {
            color: white;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .dashboard-grid {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        .dashboard-card {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        .dashboard-card i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        .dashboard-card h3 {
            font-family: var(--header-font);
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }
        .dashboard-card p {
            color: var(--text-light);
        }
        .logout-btn {
            background: #dc3545;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .logout-btn:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="admin-nav">
            <div class="admin-logo">
                <i class="ri-shield-star-line"></i>
                <span>Админ Самбар</span>
            </div>
            <div class="admin-user">
                <span><i class="ri-user-line"></i> {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="ri-logout-box-line"></i> Гарах
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="section__container">
        <h1 class="section__header" style="text-align: center; margin-bottom: 3rem;">УДИРДЛАГЫН САМБАР</h1>

        <div class="dashboard-grid">
            <a href="{{ route('admin.cars.index') }}" style="text-decoration: none; color: inherit;">
                <div class="dashboard-card">
                    <i class="ri-car-line"></i>
                    <h3>Машинууд</h3>
                    <p>Машинуудыг удирдах</p>
                </div>
            </a>

            <a href="{{ route('admin.categories.index') }}" style="text-decoration: none; color: inherit;">
                <div class="dashboard-card">
                    <i class="ri-list-check"></i>
                    <h3>Категориуд</h3>
                    <p>Машины ангилал</p>
                </div>
            </a>

            <a href="{{ route('admin.customers.index') }}" style="text-decoration: none; color: inherit;">
                <div class="dashboard-card">
                    <i class="ri-user-3-line"></i>
                    <h3>Үйлчлүүлэгчид</h3>
                    <p>Харилцагчдыг удирдах</p>
                </div>
            </a>

            <a href="{{ route('admin.drivers.index') }}" style="text-decoration: none; color: inherit;">
                <div class="dashboard-card">
                    <i class="ri-steering-2-line"></i>
                    <h3>Жолооч нар</h3>
                    <p>Жолооч удирдах</p>
                </div>
            </a>

            <a href="{{ route('admin.rentals.index') }}" style="text-decoration: none; color: inherit;">
                <div class="dashboard-card">
                    <i class="ri-file-list-3-line"></i>
                    <h3>Түрээс</h3>
                    <p>Түрээсийн бүртгэл</p>
                </div>
            </a>

            <a href="{{ route('admin.bookings.index') }}" style="text-decoration: none; color: inherit;">
                <div class="dashboard-card">
                    <i class="ri-calendar-check-line"></i>
                    <h3>Захиалга</h3>
                    <p>Захиалгууд удирдах</p>
                </div>
            </a>
        </div>
    </div>

    <footer style="margin-top: 5rem; background-color: var(--text-dark); padding: 2rem 0;">
        <div class="footer__bar">
            Copyright © 2024 Premium Car Rental. Бүх эрх хуулиар хамгаалагдсан.
        </div>
    </footer>
</body>
</html>
