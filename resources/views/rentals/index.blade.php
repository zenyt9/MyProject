<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/rental-template.css')}}" />
    <title>Түрээс - Premium Car Rental</title>
</head>
<body>
    <nav>
        <div class="nav__header">
            <div class="nav__logo">
                <a href="/">RENTAL</a>
            </div>
            <div class="nav__menu__btn" id="menu-btn">
                <i class="ri-menu-line"></i>
            </div>
        </div>
        <ul class="nav__links" id="nav-links">
            <li><a href="/">Нүүр</a></li>
            <li><a href="{{ route('cars.index') }}">Машинууд</a></li>
            <li><a href="{{ route('customers.index') }}">Үйлчлүүлэгчид</a></li>
            <li><a href="{{ route('drivers.index') }}">Жолооч</a></li>
            <li><a href="{{ route('rentals.index') }}">Түрээс</a></li>
            <li><a href="{{ route('bookings.index') }}">Захиалга</a></li>
        </ul>
        <div class="nav__btn">
            <a href="{{ route('rentals.create') }}" class="btn"><i class="ri-add-line"></i> Шинэ түрээс</a>
        </div>
    </nav>

    <section class="section__container" style="margin-top: 100px;">
        <h2 class="section__header" style="text-align: center; margin-bottom: 3rem;">ТҮРЭЭСИЙН ЖАГСААЛТ</h2>

        @if (session('success'))
            <div style="padding: 1rem; background: #d4edda; color: #155724; border-radius: 0.5rem; margin-bottom: 2rem; border-left: 4px solid #28a745;">
                <i class="ri-check-circle-line"></i> {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive" style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: 5px 5px 20px rgba(0,0,0,0.1);">
            <table class="table">
                <thead>
                    <tr style="border-bottom: 2px solid var(--primary-color);">
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">#</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Үйлчлүүлэгч</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Машин</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Эхлэх огноо</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Дуусах огноо</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Хоног</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Нийт үнэ</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Статус</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark); text-align: center;">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rentals as $rental)
                    <tr style="border-bottom: 1px solid var(--extra-light); transition: all 0.3s;" onmouseover="this.style.backgroundColor='var(--extra-light)'" onmouseout="this.style.backgroundColor='white'">
                        <td style="padding: 1rem; color: var(--text-dark);">{{ $rental->id }}</td>
                        <td style="padding: 1rem; font-weight: 600; color: var(--text-dark);">{{ $rental->customer->name ?? '-' }}</td>
                        <td style="padding: 1rem; color: var(--text-dark);">{{ $rental->car->brand ?? '-' }} {{ $rental->car->model ?? '' }}</td>
                        <td style="padding: 1rem; color: var(--text-light);">{{ optional($rental->start_date)->format('Y-m-d') }}</td>
                        <td style="padding: 1rem; color: var(--text-light);">{{ optional($rental->end_date)->format('Y-m-d') }}</td>
                        <td style="padding: 1rem; color: var(--text-dark);">{{ $rental->days }}</td>
                        <td style="padding: 1rem; color: var(--primary-color); font-weight: 600;">{{ number_format($rental->total_cost) }}₮</td>
                        <td style="padding: 1rem;">
                            @if($rental->status == 'active')
                                <span style="padding: 0.4rem 0.8rem; background: #28a745; color: white; border-radius: 5px; font-size: 0.85rem;">Идэвхтэй</span>
                            @elseif($rental->status == 'completed')
                                <span style="padding: 0.4rem 0.8rem; background: #007bff; color: white; border-radius: 5px; font-size: 0.85rem;">Дууссан</span>
                            @else
                                <span style="padding: 0.4rem 0.8rem; background: #dc3545; color: white; border-radius: 5px; font-size: 0.85rem;">Цуцлагдсан</span>
                            @endif
                        </td>
                        <td style="padding: 1rem; text-align: center;">
                            <a href="{{ route('rentals.edit', $rental) }}" class="btn" style="min-width: 80px; margin: 0 5px; font-size: 0.85rem; padding: 0.5rem 1rem; background-color: var(--primary-color);">
                                <i class="ri-edit-line"></i> Засах
                            </a>
                            <form action="{{ route('rentals.destroy', $rental) }}" method="POST" style="display:inline;" onsubmit="return confirm('Устгах уу?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="min-width: 80px; margin: 0 5px; font-size: 0.85rem; padding: 0.5rem 1rem; background-color: #dc3545; color: white;">
                                    <i class="ri-delete-bin-line"></i> Устгах
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 3rem; color: var(--text-light); font-size: 1.1rem;">Түрээс байхгүй байна.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <footer style="margin-top: 5rem; background-color: var(--text-dark); padding: 2rem 0;">
        <div class="footer__bar">
            Copyright © 2024 Premium Car Rental. Бүх эрх хуулиар хамгаалагдсан.
        </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="{{asset('assets/js/rental-template.js')}}"></script>
</body>
</html>
