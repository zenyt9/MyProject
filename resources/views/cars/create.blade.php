<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/rental-template.css')}}" />
    <title>Машин нэмэх - Premium Car Rental</title>
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
            <a href="{{ route('admin.cars.index') }}" class="btn"><i class="ri-arrow-left-line"></i> Буцах</a>
        </div>
    </nav>

    <section class="section__container" style="margin-top: 100px;">
        <h2 class="section__header" style="text-align: center; margin-bottom: 3rem;">ШИНЭ МАШИН НЭМЭХ</h2>

        <div style="max-width: 700px; margin: 0 auto; background: white; padding: 2rem; border-radius: 1rem; box-shadow: 5px 5px 20px rgba(0,0,0,0.1);">
            <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label for="brand" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--text-dark);">Брэнд</label>
                        <input type="text" name="brand" id="brand"
                               style="width: 100%; padding: 0.75rem; border: 2px solid var(--extra-light); border-radius: 0.5rem; font-size: 1rem;"
                               placeholder="Жишээ: Toyota" required
                               onfocus="this.style.borderColor='var(--primary-color)'"
                               onblur="this.style.borderColor='var(--extra-light)'">
                    </div>

                    <div>
                        <label for="model" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--text-dark);">Загвар</label>
                        <input type="text" name="model" id="model"
                               style="width: 100%; padding: 0.75rem; border: 2px solid var(--extra-light); border-radius: 0.5rem; font-size: 1rem;"
                               placeholder="Жишээ: Camry" required
                               onfocus="this.style.borderColor='var(--primary-color)'"
                               onblur="this.style.borderColor='var(--extra-light)'">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label for="year" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--text-dark);">Он</label>
                        <input type="number" name="year" id="year"
                               style="width: 100%; padding: 0.75rem; border: 2px solid var(--extra-light); border-radius: 0.5rem; font-size: 1rem;"
                               placeholder="2024" required
                               onfocus="this.style.borderColor='var(--primary-color)'"
                               onblur="this.style.borderColor='var(--extra-light)'">
                    </div>

                    <div>
                        <label for="plate_number" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--text-dark);">Дугаар</label>
                        <input type="text" name="plate_number" id="plate_number"
                               style="width: 100%; padding: 0.75rem; border: 2px solid var(--extra-light); border-radius: 0.5rem; font-size: 1rem;"
                               placeholder="УБ 1234" required
                               onfocus="this.style.borderColor='var(--primary-color)'"
                               onblur="this.style.borderColor='var(--extra-light)'">
                    </div>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="category_id" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--text-dark);">Ангилал</label>
                    <select name="category_id" id="category_id"
                            style="width: 100%; padding: 0.75rem; border: 2px solid var(--extra-light); border-radius: 0.5rem; font-size: 1rem;" required>
                        <option value="">-- Сонгох --</option>
                        @foreach(\App\Models\CarCategory::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label for="color" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--text-dark);">Өнгө</label>
                        <input type="text" name="color" id="color"
                               style="width: 100%; padding: 0.75rem; border: 2px solid var(--extra-light); border-radius: 0.5rem; font-size: 1rem;"
                               placeholder="Цагаан"
                               onfocus="this.style.borderColor='var(--primary-color)'"
                               onblur="this.style.borderColor='var(--extra-light)'">
                    </div>

                    <div>
                        <label for="seats" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--text-dark);">Суудал</label>
                        <input type="number" name="seats" id="seats"
                               style="width: 100%; padding: 0.75rem; border: 2px solid var(--extra-light); border-radius: 0.5rem; font-size: 1rem;"
                               placeholder="5"
                               onfocus="this.style.borderColor='var(--primary-color)'"
                               onblur="this.style.borderColor='var(--extra-light)'">
                    </div>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="daily_rate" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--text-dark);">Өдрийн үнэ (₮)</label>
                    <input type="number" name="daily_rate" id="daily_rate"
                           style="width: 100%; padding: 0.75rem; border: 2px solid var(--extra-light); border-radius: 0.5rem; font-size: 1rem;"
                           placeholder="100000" required
                           onfocus="this.style.borderColor='var(--primary-color)'"
                           onblur="this.style.borderColor='var(--extra-light)'">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="status" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--text-dark);">Статус</label>
                    <select name="status" id="status"
                            style="width: 100%; padding: 0.75rem; border: 2px solid var(--extra-light); border-radius: 0.5rem; font-size: 1rem;" required>
                        <option value="available">Боломжтой</option>
                        <option value="rented">Түрээслэсэн</option>
                        <option value="maintenance">Засварт</option>
                    </select>
                </div>

                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <a href="{{ route('admin.cars.index') }}" class="btn" style="background-color: var(--text-light);">
                        <i class="ri-close-line"></i> Цуцлах
                    </a>
                    <button type="submit" class="btn" style="background-color: var(--primary-color);">
                        <i class="ri-save-line"></i> Хадгалах
                    </button>
                </div>
            </form>
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
