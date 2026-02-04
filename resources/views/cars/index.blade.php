<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/rental-template.css')}}" />
    <title>Машинууд - Premium Car Rental</title>
    <style>
        .table-responsive {
            overflow-x: visible;
            border: 4px solid var(--primary-color);
            border-radius: 1rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .table th {
            padding: 1.25rem 0.75rem !important;
            font-size: 0.95rem;
            font-weight: 700;
            white-space: nowrap;
            border-bottom: 4px solid var(--primary-color) !important;
            background: linear-gradient(to bottom, var(--extra-light), #ffffff);
            text-align: center;
        }
        .table td {
            padding: 1.25rem 0.75rem !important;
            font-size: 0.9rem;
            vertical-align: middle;
            border-bottom: 2px solid #e8e8e8 !important;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .table tbody tr {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        .table tbody tr:hover {
            background-color: #fef3e7 !important;
            border-left: 4px solid var(--primary-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .table th:nth-child(1), .table td:nth-child(1) { width: 3%; }
        .table th:nth-child(2), .table td:nth-child(2) { width: 8%; }
        .table th:nth-child(3), .table td:nth-child(3) { width: 8%; }
        .table th:nth-child(4), .table td:nth-child(4) { width: 9%; }
        .table th:nth-child(5), .table td:nth-child(5) { width: 5%; }
        .table th:nth-child(6), .table td:nth-child(6) { width: 8%; }
        .table th:nth-child(7), .table td:nth-child(7) { width: 6%; }
        .table th:nth-child(8), .table td:nth-child(8) { width: 6%; }
        .table th:nth-child(9), .table td:nth-child(9) { width: 7%; }
        .table th:nth-child(10), .table td:nth-child(10) { width: 9%; }
        .table th:nth-child(11), .table td:nth-child(11) { width: 8%; }
        .table th:nth-child(12), .table td:nth-child(12) { width: 18%; }
    </style>
</head>
<body>
    <nav>
        <div class="nav__header">
            <div class="nav__logo">
                <a href="{{ route('home') }}" style="display: flex; align-items: center; gap: 0.5rem;">
                    <i class="ri-car-line" style="font-size: 1.8rem;"></i>
                    <span>Premium Rental</span>
                </a>
            </div>
            <div class="nav__menu__btn" id="menu-btn">
                <i class="ri-menu-line"></i>
            </div>
        </div>
        <ul class="nav__links" id="nav-links">
            <li><a href="{{ route('admin.dashboard') }}">Админ самбар</a></li>
            <li><a href="{{ route('admin.cars.index') }}">Машинууд</a></li>
            <li><a href="{{ route('admin.bookings.index') }}">Захиалга</a></li>
        </ul>
        <div class="nav__btn">
            <a href="{{ route('admin.cars.create') }}" class="btn"><i class="ri-add-line"></i> Машин нэмэх</a>
        </div>
    </nav>

    <section class="section__container" style="margin-top: 100px;">
        <!-- Tabs -->
        <div style="display: flex; justify-content: center; gap: 1rem; margin-bottom: 3rem;">
            <button onclick="showTab('categories')" id="tabCategories" class="btn" style="min-width: 150px; background-color: var(--text-light);">
                <i class="ri-list-check"></i> Ангилал
            </button>
            <button onclick="showTab('cars')" id="tabCars" class="btn" style="min-width: 150px; background-color: var(--primary-color);">
                <i class="ri-car-line"></i> Машинууд
            </button>
        </div>

        <!-- Categories Section -->
        <div id="categoriesSection" style="display: none;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h2 class="section__header" style="margin: 0;">МАШИНЫ АНГИЛАЛ</h2>
                <a href="{{ route('admin.categories.create') }}" class="btn" style="background-color: var(--primary-color);">
                    <i class="ri-add-line"></i> Ангилал нэмэх
                </a>
            </div>

            <div class="table-responsive" style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: 5px 5px 20px rgba(0,0,0,0.1);">
                <table class="table">
                    <thead>
                        <tr style="border-bottom: 2px solid var(--primary-color);">
                            <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">#</th>
                            <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Нэр</th>
                            <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Тайлбар</th>
                            <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Өдрийн үнэ</th>
                            <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark); text-align: center;">Үйлдэл</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\CarCategory::all() as $index => $category)
                        <tr style="border-bottom: 1px solid var(--extra-light); transition: all 0.3s;" onmouseover="this.style.backgroundColor='var(--extra-light)'" onmouseout="this.style.backgroundColor='white'">
                            <td style="padding: 1rem; color: var(--text-dark);">{{ $index + 1 }}</td>
                            <td style="padding: 1rem; font-weight: 600; color: var(--text-dark);">{{ $category->name }}</td>
                            <td style="padding: 1rem; color: var(--text-light);">{{ $category->description ?? '-' }}</td>
                            <td style="padding: 1rem; color: var(--primary-color); font-weight: 600;">{{ number_format($category->daily_rate) }}₮</td>
                            <td style="padding: 1rem; text-align: center;">
                                <div style="display: flex; gap: 0.5rem; justify-content: center; align-items: center;">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn" style="min-width: 80px; font-size: 0.85rem; padding: 0.5rem 1rem; background-color: var(--primary-color);">
                                        <i class="ri-edit-line"></i> Засах
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline; margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" style="min-width: 80px; font-size: 0.85rem; padding: 0.5rem 1rem; background-color: #dc3545; color: white;" onclick="return confirm('Устгах уу?')">
                                            <i class="ri-delete-bin-line"></i> Устгах
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 3rem; color: var(--text-light); font-size: 1.1rem;">Ангилал байхгүй байна.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Cars Section -->
        <div id="carsSection">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h2 class="section__header" style="margin: 0;">МАШИНУУД</h2>
                <a href="{{ route('admin.cars.create') }}" class="btn" style="background-color: var(--primary-color);">
                    <i class="ri-add-line"></i> Машин нэмэх
                </a>
            </div>

        <div class="table-responsive" style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: 5px 5px 20px rgba(0,0,0,0.1);">
            <table class="table">
                <thead>
                    <tr style="border-bottom: 2px solid var(--primary-color);">
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">#</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Зураг</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Брэнд</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Загвар</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Он</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Дугаар</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Ангилал</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Суудал</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Өнгө</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Өдрийн үнэ</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Статус</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark); text-align: center;">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cars as $index => $car)
                    <tr style="border-bottom: 1px solid var(--extra-light); transition: all 0.3s;" onmouseover="this.style.backgroundColor='var(--extra-light)'" onmouseout="this.style.backgroundColor='white'">
                        <td style="padding: 1rem; color: var(--text-dark);">{{ $index + 1 }}</td>
                        <td style="padding: 1rem;">
                            @if($car->image)
                                <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->brand }} {{ $car->model }}" style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                            @else
                                <div style="width: 80px; height: 60px; background: var(--extra-light); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="ri-car-line" style="font-size: 2rem; color: var(--text-light);"></i>
                                </div>
                            @endif
                        </td>
                        <td style="padding: 1rem; font-weight: 600; color: var(--text-dark);">{{ $car->brand }}</td>
                        <td style="padding: 1rem; color: var(--text-dark);">{{ $car->model }}</td>
                        <td style="padding: 1rem; color: var(--text-light);">{{ $car->year }}</td>
                        <td style="padding: 1rem; color: var(--text-dark);">{{ $car->plate_number }}</td>
                        <td style="padding: 1rem; color: var(--text-light);">{{ $car->category->name ?? '-' }}</td>
                        <td style="padding: 1rem; color: var(--text-dark); font-weight: 500;">
                            <i class="ri-group-line" style="color: var(--primary-color);"></i> {{ $car->seats ?? '-' }}
                        </td>
                        <td style="padding: 1rem; color: var(--text-light);">{{ $car->color ?? '-' }}</td>
                        <td style="padding: 1rem; color: var(--primary-color); font-weight: 600;">{{ number_format($car->daily_rate) }}₮</td>
                        <td style="padding: 1rem;">
                            @if($car->status == 'available')
                                <span style="padding: 0.4rem 0.8rem; background: #28a745; color: white; border-radius: 5px; font-size: 0.85rem;">Боломжтой</span>
                            @elseif($car->status == 'rented')
                                <span style="padding: 0.4rem 0.8rem; background: #ffc107; color: #333; border-radius: 5px; font-size: 0.85rem;">Түрээсэлсэн</span>
                            @else
                                <span style="padding: 0.4rem 0.8rem; background: #dc3545; color: white; border-radius: 5px; font-size: 0.85rem;">Засварт</span>
                            @endif
                        </td>
                        <td style="padding: 1rem; text-align: center;">
                            <div style="display: flex; gap: 0.5rem; justify-content: center; align-items: center;">
                                <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn" style="min-width: 80px; font-size: 0.85rem; padding: 0.5rem 1rem; background-color: var(--primary-color);">
                                    <i class="ri-edit-line"></i> Засах
                                </a>
                                <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" style="display:inline; margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="min-width: 80px; font-size: 0.85rem; padding: 0.5rem 1rem; background-color: #dc3545; color: white;" onclick="return confirm('Устгах уу?')">
                                        <i class="ri-delete-bin-line"></i> Устгах
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" style="text-align: center; padding: 3rem; color: var(--text-light); font-size: 1.1rem;">Машин байхгүй байна.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>
    </section>

    <footer style="margin-top: 5rem; background-color: var(--text-dark); padding: 2rem 0;">
        <div class="footer__bar">
            Copyright © 2024 Premium Car Rental. Бүх эрх хуулиар хамгаалагдсан.
        </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="{{asset('assets/js/rental-template.js')}}"></script>
    <script>
        function showTab(tab) {
            const categoriesSection = document.getElementById('categoriesSection');
            const carsSection = document.getElementById('carsSection');
            const tabCategories = document.getElementById('tabCategories');
            const tabCars = document.getElementById('tabCars');

            if (tab === 'categories') {
                categoriesSection.style.display = 'block';
                carsSection.style.display = 'none';
                tabCategories.style.backgroundColor = 'var(--primary-color)';
                tabCars.style.backgroundColor = 'var(--text-light)';
            } else {
                categoriesSection.style.display = 'none';
                carsSection.style.display = 'block';
                tabCategories.style.backgroundColor = 'var(--text-light)';
                tabCars.style.backgroundColor = 'var(--primary-color)';
            }
        }
    </script>
</body>
</html>
