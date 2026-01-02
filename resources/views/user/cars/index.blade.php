<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Машинууд - Premium Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/rental-template.css')}}" />
    <style>
        .user-header {
            background: var(--text-dark);
            padding: 1rem 0;
            margin-bottom: 3rem;
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
        .user-menu a:hover {
            color: var(--primary-color);
        }
        .car-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        .car-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        .car-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .car-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: var(--extra-light);
        }
        .car-content {
            padding: 1.5rem;
        }
        .car-title {
            font-family: var(--header-font);
            font-size: 1.5rem;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }
        .car-details {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin: 1rem 0;
            color: var(--text-light);
        }
        .car-detail {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        .car-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 1rem 0;
        }
        .car-status {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 5px;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }
        .status-available {
            background: #28a745;
            color: white;
        }
        .filter-section {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
    </style>
</head>
<body>
    <div class="user-header">
        <div class="user-nav">
            <a href="/" class="user-logo">
                <i class="ri-car-line"></i>
                <span>Premium Rental</span>
            </a>
            <div class="user-menu">
                <a href="/"><i class="ri-home-line"></i> Нүүр</a>
                <a href="{{ route('user.cars.index') }}"><i class="ri-car-line"></i> Машинууд</a>
                <a href="{{ route('user.bookings') }}"><i class="ri-book-line"></i> Миний захиалга</a>
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

    <div class="section__container">
        <h1 class="section__header" style="text-align: center; margin-bottom: 2rem;">БОЛОМЖТОЙ МАШИНУУД</h1>

        <div class="filter-section">
            <h3 style="margin-bottom: 1rem; color: var(--text-dark);">Ангиллаар шүүх</h3>
            <div class="filter-grid">
                <a href="{{ route('user.cars.index') }}" class="btn" style="text-align: center;">
                    Бүгд
                </a>
                @foreach($categories as $category)
                    <a href="?category={{ $category->id }}" class="btn" style="text-align: center; background: var(--primary-color-light);">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="car-grid">
            @forelse($cars as $car)
                <div class="car-card">
                    @if($car->image)
                        <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->brand }} {{ $car->model }}" class="car-image">
                    @else
                        <div class="car-image" style="display: flex; align-items: center; justify-content: center; color: var(--text-light);">
                            <i class="ri-car-line" style="font-size: 4rem;"></i>
                        </div>
                    @endif

                    <div class="car-content">
                        <div class="car-title">{{ $car->brand }} {{ $car->model }}</div>

                        <span class="car-status status-available">
                            <i class="ri-checkbox-circle-line"></i> Боломжтой
                        </span>

                        <div class="car-details">
                            <div class="car-detail">
                                <i class="ri-calendar-line"></i>
                                <span>{{ $car->year }}</span>
                            </div>
                            @if($car->seats)
                                <div class="car-detail">
                                    <i class="ri-group-line"></i>
                                    <span>{{ $car->seats }} суудал</span>
                                </div>
                            @endif
                            @if($car->color)
                                <div class="car-detail">
                                    <i class="ri-palette-line"></i>
                                    <span>{{ $car->color }}</span>
                                </div>
                            @endif
                            @if($car->category)
                                <div class="car-detail">
                                    <i class="ri-price-tag-3-line"></i>
                                    <span>{{ $car->category->name }}</span>
                                </div>
                            @endif
                        </div>

                        @if($car->features)
                            <div style="margin: 1rem 0; color: var(--text-light); font-size: 0.9rem;">
                                <i class="ri-star-line"></i> {{ $car->features }}
                            </div>
                        @endif

                        <div class="car-price">
                            {{ number_format($car->daily_rate) }}₮ / өдөр
                        </div>

                        <a href="{{ route('login') }}" class="btn" style="width: 100%; text-align: center; background: var(--primary-color);">
                            <i class="ri-calendar-check-line"></i> Захиалах
                        </a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 3rem; color: var(--text-light);">
                    <i class="ri-car-line" style="font-size: 4rem; margin-bottom: 1rem; display: block;"></i>
                    <p style="font-size: 1.2rem;">Одоогоор боломжтой машин байхгүй байна</p>
                </div>
            @endforelse
        </div>
    </div>

    <footer style="margin-top: 5rem; background-color: var(--text-dark); padding: 2rem 0;">
        <div class="footer__bar">
            Copyright © 2024 Premium Car Rental. Бүх эрх хуулиар хамгаалагдсан.
        </div>
    </footer>
</body>
</html>
