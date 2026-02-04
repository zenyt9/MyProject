<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Миний захиалгууд - Premium Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/user-cars.css') }}">
    <style>
        .bookings-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .bookings-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .bookings-header h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .bookings-grid {
            display: grid;
            gap: 2rem;
        }

        .booking-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .booking-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0,0,0,0.15);
        }

        .booking-status {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-confirmed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .booking-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .detail-item i {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .detail-content h3 {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.25rem;
        }

        .detail-content p {
            font-size: 1.1rem;
            color: #333;
            font-weight: 500;
        }

        .no-bookings {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .no-bookings i {
            font-size: 5rem;
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .no-bookings h2 {
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .no-bookings p {
            color: #9ca3af;
            margin-bottom: 2rem;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--primary-color-dark);
        }

        .booking-notes {
            margin-top: 1.5rem;
            padding: 1rem;
            background: #f9fafb;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }

        .booking-notes h3 {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .booking-notes p {
            color: #333;
            line-height: 1.6;
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

    <div class="bookings-container">
        <div class="bookings-header">
            <h1>Миний захиалгууд</h1>
            <p>Таны хийсэн бүх захиалгын жагсаалт</p>
        </div>

        @if($bookings->isEmpty())
            <div class="no-bookings">
                <i class="ri-calendar-line"></i>
                <h2>Захиалга байхгүй байна</h2>
                <p>Та одоогоор ямар ч захиалга хийгээгүй байна.</p>
                <a href="{{ route('user.cars.index') }}" class="btn-primary">
                    <i class="ri-car-line"></i>
                    Машин түрээслэх
                </a>
            </div>
        @else
            <div class="bookings-grid">
                @foreach($bookings as $booking)
                    <div class="booking-card">
                        <span class="booking-status status-{{ $booking->status }}">
                            @if($booking->status === 'pending')
                                Хүлээгдэж буй
                            @elseif($booking->status === 'confirmed')
                                Баталгаажсан
                            @else
                                Цуцлагдсан
                            @endif
                        </span>

                        <div class="booking-details">
                            <div class="detail-item">
                                <i class="ri-car-line"></i>
                                <div class="detail-content">
                                    <h3>Машин</h3>
                                    <p>{{ $booking->car->brand }} {{ $booking->car->model }}</p>
                                </div>
                            </div>

                            <div class="detail-item">
                                <i class="ri-calendar-check-line"></i>
                                <div class="detail-content">
                                    <h3>Захиалгын огноо</h3>
                                    <p>{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') }}</p>
                                </div>
                            </div>

                            <div class="detail-item">
                                <i class="ri-calendar-event-line"></i>
                                <div class="detail-content">
                                    <h3>Эхлэх огноо</h3>
                                    <p>{{ \Carbon\Carbon::parse($booking->start_date)->format('Y-m-d') }}</p>
                                </div>
                            </div>

                            <div class="detail-item">
                                <i class="ri-calendar-close-line"></i>
                                <div class="detail-content">
                                    <h3>Дуусах огноо</h3>
                                    <p>{{ \Carbon\Carbon::parse($booking->end_date)->format('Y-m-d') }}</p>
                                </div>
                            </div>

                            @if($booking->customer)
                            <div class="detail-item">
                                <i class="ri-user-line"></i>
                                <div class="detail-content">
                                    <h3>Хэрэглэгч</h3>
                                    <p>{{ $booking->customer->name }}</p>
                                </div>
                            </div>
                            @endif

                            <div class="detail-item">
                                <i class="ri-phone-line"></i>
                                <div class="detail-content">
                                    <h3>Утас</h3>
                                    <p>{{ $booking->customer->phone ?? 'Мэдээлэл байхгүй' }}</p>
                                </div>
                            </div>
                        </div>

                        @if($booking->notes)
                            <div class="booking-notes">
                                <h3>Тэмдэглэл</h3>
                                <p>{{ $booking->notes }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
