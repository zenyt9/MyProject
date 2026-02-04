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
        .no-cars {
            grid-column: 1/-1;
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-light);
        }
        .no-cars i {
            font-size: 5rem;
            margin-bottom: 1rem;
            display: block;
            opacity: 0.3;
        }
        @keyframes slideInDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
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
                <a href="{{ route('user.profile') }}"><i class="ri-user-line"></i> Профайл</a>
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
        <h1 class="section__header" style="text-align: center; margin-bottom: 3rem;">БОЛОМЖТОЙ МАШИНУУД</h1>

        @if(session('success'))
            <div id="successNotification" style="padding: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 10px; margin-bottom: 2rem; box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3); animation: slideInDown 0.5s ease-out;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <i class="ri-checkbox-circle-fill" style="font-size: 2rem;"></i>
                    <div>
                        <div style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.25rem;">{{ session('success') }}</div>
                        <div style="font-size: 0.9rem; opacity: 0.9;">Админ тантай удахгүй холбогдох болно.</div>
                    </div>
                </div>
            </div>
        @endif

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

                        @if($car->features)
                            <div style="margin: 1rem 0; color: var(--text-light); font-size: 0.9rem;">
                                <i class="ri-star-line"></i> {{ $car->features }}
                            </div>
                        @endif

                        <div class="car-price">
                            {{ number_format($car->daily_rate) }}₮ / өдөр
                        </div>

                        <button onclick="openBookingModal({{ $car->id }}, '{{ $car->brand }} {{ $car->model }}', {{ $car->daily_rate }})"
                                class="btn" style="width: 100%; text-align: center; background: var(--primary-color); border: none; cursor: pointer;">
                            <i class="ri-calendar-check-line"></i> Захиалах
                        </button>
                    </div>
                </div>
            @empty
                <div class="no-cars">
                    <i class="ri-car-line"></i>
                    <p style="font-size: 1.2rem; font-weight: 500;">Одоогоор боломжтой машин байхгүй байна</p>
                </div>
            @endforelse
        </div>
    </div>

    <footer style="margin-top: 5rem; background-color: var(--text-dark); padding: 2rem 0;">
        <div class="footer__bar">
            Copyright © 2024 Premium Car Rental. Бүх эрх хуулиар хамгаалагдсан.
        </div>
    </footer>

    <!-- Booking Modal -->
    <div id="bookingModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; justify-content: center; align-items: center;">
        <div style="background: white; border-radius: 10px; padding: 2rem; width: 90%; max-width: 500px; position: relative;">
            <button onclick="closeBookingModal()" style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-light);">
                <i class="ri-close-line"></i>
            </button>

            <h2 style="margin-bottom: 1.5rem; color: var(--text-dark);">
                <i class="ri-calendar-check-line"></i> Машин захиалах
            </h2>

            <form action="{{ route('user.bookings.store') }}" method="POST" id="bookingForm">
                @csrf
                <input type="hidden" name="car_id" id="modal_car_id">

                <div style="margin-bottom: 1rem; padding: 1rem; background: var(--extra-light); border-radius: 5px;">
                    <div id="modal_car_name" style="font-size: 1.1rem; font-weight: 600; color: var(--text-dark);"></div>
                    <div id="modal_car_price" style="color: var(--primary-color); font-weight: 600; margin-top: 0.5rem;"></div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                        <i class="ri-phone-line"></i> Утасны дугаар
                    </label>
                    <input type="tel" name="phone" required
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;"
                           placeholder="99999999"
                           pattern="[0-9]{8}"
                           maxlength="8">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                        <i class="ri-mail-line"></i> Имэйл хаяг
                    </label>
                    <input type="email" name="email" required
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;"
                           placeholder="example@gmail.com">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                        <i class="ri-calendar-line"></i> Эхлэх огноо
                    </label>
                    <input type="date" name="start_date" required
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;"
                           min="{{ date('Y-m-d') }}">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                        <i class="ri-calendar-line"></i> Дуусах огноо
                    </label>
                    <input type="date" name="end_date" required
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;"
                           min="{{ date('Y-m-d') }}">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                        <i class="ri-message-3-line"></i> Нэмэлт мэдээлэл (заавал биш)
                    </label>
                    <textarea name="notes" rows="3"
                              style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem; resize: vertical;"
                              placeholder="Хэрэв та нэмэлт мэдээлэл өгөхийг хүсвэл энд бичнэ үү..."></textarea>
                </div>

                <button type="submit" class="btn" style="width: 100%; background: var(--primary-color); border: none; padding: 0.75rem; font-size: 1rem;">
                    <i class="ri-send-plane-fill"></i> Захиалга илгээх
                </button>
            </form>
        </div>
    </div>

    <script>
        function openBookingModal(carId, carName, dailyRate) {
            document.getElementById('modal_car_id').value = carId;
            document.getElementById('modal_car_name').textContent = carName;
            document.getElementById('modal_car_price').textContent = new Intl.NumberFormat('mn-MN').format(dailyRate) + '₮ / өдөр';
            document.getElementById('bookingModal').style.display = 'flex';
        }

        function closeBookingModal() {
            document.getElementById('bookingModal').style.display = 'none';
            document.getElementById('bookingForm').reset();
        }

        // Close modal on outside click
        document.getElementById('bookingModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookingModal();
            }
        });

        // Auto-hide success notification after 5 seconds
        const notification = document.getElementById('successNotification');
        if (notification) {
            setTimeout(() => {
                notification.style.animation = 'fadeOut 0.5s ease-out forwards';
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }, 5000);
        }
    </script>
</body>
</html>
