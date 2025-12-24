<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/rental-template.css')}}" />
    <title>Ангилал нэмэх - Premium Car Rental</title>
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
            <a href="{{ route('categories.index') }}" class="btn"><i class="ri-arrow-left-line"></i> Буцах</a>
        </div>
    </nav>

    <section class="section__container" style="margin-top: 100px;">
        <h2 class="section__header" style="text-align: center; margin-bottom: 3rem;">ШИНЭ АНГИЛАЛ НЭМЭХ</h2>

        <div style="max-width: 600px; margin: 0 auto; background: white; padding: 2rem; border-radius: 1rem; box-shadow: 5px 5px 20px rgba(0,0,0,0.1);">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1.5rem;">
                    <label for="name" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--text-dark);">Ангиллын нэр</label>
                    <select name="name" id="name"
                           style="width: 100%; padding: 0.75rem; border: 2px solid var(--extra-light); border-radius: 0.5rem; font-size: 1rem; transition: all 0.3s;"
                           required
                           onfocus="this.style.borderColor='var(--primary-color)'"
                           onblur="this.style.borderColor='var(--extra-light)'"
                           onmouseover="this.style.backgroundColor='var(--extra-light)'"
                           onmouseout="this.style.backgroundColor='white'">
                        <option value="">Ангилал сонгох...</option>
                        <option value="Sedan">Sedan</option>
                        <option value="SUV">SUV</option>
                        <option value="Pickup">Pickup</option>
                        <option value="Coupe">Coupe</option>
                        <option value="Wagon">Wagon</option>
                        <option value="Offroad">Offroad</option>
                        <option value="Luxury">Luxury</option>
                        <option value="Van">Van</option>
                        <option value="Truck">Truck</option>
                        <option value="Sport">Sport</option>
                    </select>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="description" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--text-dark);">Тайлбар</label>
                    <textarea name="description" id="description" rows="4"
                              style="width: 100%; padding: 0.75rem; border: 2px solid var(--extra-light); border-radius: 0.5rem; font-size: 1rem; transition: all 0.3s;"
                              placeholder="Ангиллын тайлбар"
                              onfocus="this.style.borderColor='var(--primary-color)'"
                              onblur="this.style.borderColor='var(--extra-light)'"></textarea>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="daily_rate" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--text-dark);">Өдрийн үнэ (₮)</label>
                    <input type="number" name="daily_rate" id="daily_rate"
                           style="width: 100%; padding: 0.75rem; border: 2px solid var(--extra-light); border-radius: 0.5rem; font-size: 1rem; transition: all 0.3s;"
                           placeholder="Жишээ: 50000" required
                           onfocus="this.style.borderColor='var(--primary-color)'"
                           onblur="this.style.borderColor='var(--extra-light)'">
                </div>

                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <a href="{{ route('categories.index') }}" class="btn" style="background-color: var(--text-light);">
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
