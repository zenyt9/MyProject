<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/rental-template.css')}}" />
    <title>Машинууд - Premium Car Rental</title>
</head>
<body>
    <nav>
        <div class="nav__header">
            <div class="nav__logo">
                <a href="/" style="display: flex; align-items: center; gap: 0.5rem;">
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
            <li><a href="{{ route('admin.customers.index') }}">Үйлчлүүлэгчид</a></li>
            <li><a href="{{ route('admin.drivers.index') }}">Жолооч</a></li>
            <li><a href="{{ route('admin.rentals.index') }}">Түрээс</a></li>
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
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn" style="min-width: 80px; margin: 0 5px; font-size: 0.85rem; padding: 0.5rem 1rem; background-color: var(--primary-color);">
                                    <i class="ri-edit-line"></i> Засах
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="min-width: 80px; margin: 0 5px; font-size: 0.85rem; padding: 0.5rem 1rem; background-color: #dc3545; color: white;" onclick="return confirm('Устгах уу?')">
                                        <i class="ri-delete-bin-line"></i> Устгах
                                    </button>
                                </form>
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
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Брэнд</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Загвар</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Он</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Дугаар</th>
                        <th style="padding: 1rem; font-family: var(--header-font); color: var(--text-dark);">Ангилал</th>
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
                        <td style="padding: 1rem; font-weight: 600; color: var(--text-dark);">{{ $car->brand }}</td>
                        <td style="padding: 1rem; color: var(--text-dark);">{{ $car->model }}</td>
                        <td style="padding: 1rem; color: var(--text-light);">{{ $car->year }}</td>
                        <td style="padding: 1rem; color: var(--text-dark);">{{ $car->plate_number }}</td>
                        <td style="padding: 1rem; color: var(--text-light);">{{ $car->category->name ?? '-' }}</td>
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
                            <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn" style="min-width: 80px; margin: 0 5px; font-size: 0.85rem; padding: 0.5rem 1rem; background-color: var(--primary-color);">
                                <i class="ri-edit-line"></i> Засах
                            </a>
                            <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="min-width: 80px; margin: 0 5px; font-size: 0.85rem; padding: 0.5rem 1rem; background-color: #dc3545; color: white;" onclick="return confirm('Устгах уу?')">
                                    <i class="ri-delete-bin-line"></i> Устгах
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" style="text-align: center; padding: 3rem; color: var(--text-light); font-size: 1.1rem;">Машин байхгүй байна.</td>
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
