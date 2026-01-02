<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{asset('assets/css/rental-template.css')}}" />
    <title>Premium Car Rental</title>
</head>
<body>
    <header>
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
          <li><a href="#home">Нүүр</a></li>
          <li><a href="#range">Машинууд</a></li>
          <li><a href="#choose">Онцлог</a></li>
          <li><a href="#download">Холбоо барих</a></li>
        </ul>
        <div class="nav__btn">
          @auth
            @if(auth()->user()->role === 'admin')
              <a href="{{ route('admin.dashboard') }}" class="btn"><i class="ri-dashboard-line"></i> Админ самбар</a>
            @else
              <a href="{{ route('user.cars.index') }}" class="btn"><i class="ri-car-line"></i> Машин түрээслэх</a>
            @endif
            <form action="{{ route('logout') }}" method="POST" style="display: inline; margin-left: 1rem;">
              @csrf
              <button type="submit" class="btn" style="background: #dc3545;"><i class="ri-logout-box-line"></i> Гарах</button>
            </form>
          @else
            <a href="{{ route('login') }}" class="btn"><i class="ri-login-box-line"></i> Нэвтрэх</a>
            <a href="{{ route('register') }}" class="btn" style="margin-left: 1rem; background: var(--primary-color-dark);"><i class="ri-user-add-line"></i> Бүртгүүлэх</a>
          @endauth
        </div>
      </nav>
      <div class="header__container" id="home">
        <h1>PREMIUM CAR RENTAL</h1>
        <form action="/">
          <div class="input__group">
            <label for="location">Авах & Буцаах байршил</label>
            <input type="text" name="location" id="location" placeholder="Улаанбаатар, Монгол" />
          </div>
          <div class="input__group">
            <label for="start">Эхлэх</label>
            <input type="text" name="start" id="start" placeholder="2024/01/01, 10:00" />
          </div>
          <div class="input__group">
            <label for="stop">Дуусах</label>
            <input type="text" name="stop" id="stop" placeholder="2024/01/05, 18:00" />
          </div>
          <button class="btn">
            <i class="ri-search-line"></i>
          </button>
        </form>
      </div>
      <a href="#about" class="scroll__down">
        <i class="ri-arrow-down-line"></i>
      </a>
    </header>

    <section class="section__container range__container" id="about">
      <h2 class="section__header">ӨРГӨН СОНГОЛТ</h2>
      <div class="range__grid">
        <div class="range__card">
          <img src="{{ asset('assets/img/gr86.jpg') }}" alt="sedan" />
          <div class="range__details">
            <h4>SPORT</h4>
            <a href="{{ auth()->check() ? route('user.cars.index') : route('login') }}"><i class="ri-arrow-right-line"></i></a>
          </div>
        </div>
        <div class="range__card">
          <img src="{{ asset('assets/img/suv_jeep.jpg') }}" alt="suv" />
          <div class="range__details">
            <h4>SUV</h4>
            <a href="{{ auth()->check() ? route('user.cars.index') : route('login') }}"><i class="ri-arrow-right-line"></i></a>
          </div>
        </div>
        <div class="range__card">
          <img src="{{ asset('assets/img/offroad.webp') }}" alt="offroad" />
          <div class="range__details">
            <h4>OFFROAD</h4>
            <a href="{{ auth()->check() ? route('user.cars.index') : route('login') }}"><i class="ri-arrow-right-line"></i></a>
          </div>
        </div>
        <div class="range__card">
          <img src="{{ asset('assets/img/electric.jpg') }}" alt="electric" />
          <div class="range__details">
            <h4>ELECTRIC</h4>
            <a href="{{ auth()->check() ? route('user.cars.index') : route('login') }}"><i class="ri-arrow-right-line"></i></a>
          </div>
        </div>
      </div>
    </section>



    <section class="select__container" id="ride">
      <h2 class="section__header">МӨРӨӨДЛИЙН МАШИНАА СОНГО</h2>
      <!-- Slider main container -->
      <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          @foreach(\App\Models\Car::with('category')->limit(5)->get() as $car)
          <!-- Slides -->
          <div class="swiper-slide">
            <div class="select__card">
              <img src="{{ $car->image ? asset('storage/'.$car->image) : asset('assets/img/select-1.png') }}" alt="select" />
              <div class="select__info">
                <div class="select__info__card">
                  <span><i class="ri-speed-up-line"></i></span>
                  <h4>{{ $car->brand }} <span>{{ $car->model }}</span></h4>
                </div>
                <div class="select__info__card">
                  <span><i class="ri-settings-5-line"></i></span>
                  <h4>{{ $car->year }} <span>оны</span></h4>
                </div>
                <div class="select__info__card">
                  <span><i class="ri-roadster-line"></i></span>
                  <h4>{{ $car->seats }} <span>суудал</span></h4>
                </div>
                <div class="select__info__card">
                  <span><i class="ri-car-line"></i></span>
                  <h4>{{ $car->status }} <span>төлөв</span></h4>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <form action="/" class="select__form">
        <div class="select__price">
          <span><i class="ri-price-tag-3-line"></i></span>
          <div><span id="select-price">{{ \App\Models\Car::first()->daily_rate ?? '0' }}</span> ₮/өдөр</div>
        </div>
        <div class="select__btns">
          <a href="{{ auth()->check() ? route('user.cars.index') : route('login') }}" class="btn">Дэлгэрэнгүй</a>
          @auth
            <a href="{{ route('login') }}" class="btn">Түрээслэх</a>
          @else
            <a href="{{ route('login') }}" class="btn">Нэвтрэх</a>
          @endauth
        </div>
      </form>
    </section>

    <section class="section__container story__container">
      <h2 class="section__header">МАНАЙ ҮЙЛЧИЛГЭЭ</h2>
      <div class="story__grid">
        <div class="story__card">
          <div class="story__date">
            <span>24</span>
            <div>
              <p>Цаг</p>
              <p>Үйлчилгээ</p>
            </div>
          </div>
          <h4>Аялал дээр найдвартай туслагч</h4>
          <p>
            Бид танд дурсамжтай аялал хийхэд туслах онцгой
            автомашинуудаар үйлчилж байна.
          </p>
        </div>
        <div class="story__card">
          <div class="story__date">
            <span>100</span>
            <div>
              <p>Гаруй</p>
              <p>Машин</p>
            </div>
          </div>
          <h4>Тансаг болон тав тухтай туршлага</h4>
          <p>
            Энэ цувралд бид тансаг дэлгэрэнгүй, дутагдашгүй тав тухыг
            онцлон харуулж байна.
          </p>
        </div>
        <div class="story__card">
          <div class="story__date">
            <span>5★</span>
            <div>
              <p>Үнэлгээ</p>
              <p>Чанар</p>
            </div>
          </div>
          <h4>Таны амьдралд тохирсон машинууд</h4>
          <p>
            Манай олон талт тээврийн хэрэгсэл мэргэжлийн хүмүүс болон
            гэр бүлд хэрхэн тохирч байгааг уншаарай.
          </p>
        </div>
      </div>
    </section>

    <section class="news" id="contact">
      <div class="section__container news__container">
        <h2 class="section__header">Бүх мэдээллийг цаг алдалгүй аваарай</h2>
        <form action="/">
          <input type="text" placeholder="Таны имэйл" />
          <button class="btn">
            <i class="ri-send-plane-fill"></i>
          </button>
        </form>
      </div>
    </section>

    <!-- Brands/Partners Section -->
    <section class="section__container brands__container">
      <h2 class="section__header">Бидний Партнерууд</h2>
      <div class="brands__grid" aria-label="Partner logos">
        <div class="brands__track">
          <div class="brands__set">
            <img src="{{ asset('assets/img/banner-1.png') }}" alt="brand-1" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-2.png') }}" alt="brand-2" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-3.png') }}" alt="brand-3" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-4.png') }}" alt="brand-4" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-5.png') }}" alt="brand-5" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-6.png') }}" alt="brand-6" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-7.png') }}" alt="brand-7" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-8.png') }}" alt="brand-8" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-9.png') }}" alt="brand-9" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-10.png') }}" alt="brand-10" class="brand__logo" />
          </div>
          <div class="brands__set" aria-hidden="true">
            <img src="{{ asset('assets/img/banner-1.png') }}" alt="" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-2.png') }}" alt="" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-3.png') }}" alt="" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-4.png') }}" alt="" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-5.png') }}" alt="" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-6.png') }}" alt="" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-7.png') }}" alt="" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-8.png') }}" alt="" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-9.png') }}" alt="" class="brand__logo" />
            <img src="{{ asset('assets/img/banner-10.png') }}" alt="" class="brand__logo" />
          </div>
        </div>
      </div>
    </section>

    <footer>
      <div class="section__container footer__container">
        <div class="footer__col">
          <h4>Холбоо барих</h4>
          <ul class="footer__links">
            <li><a href="tel:+97699123456">+976 9912-3456</a></li>
            <li><a href="mailto:info@rental.mn">info@rental.mn</a></li>
            <li><a href="#">Улаанбаатар, Монгол</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Компани</h4>
          <ul class="footer__links">
            <li><a href="#">Бидний тухай</a></li>
            <li><a href="#">Ажлын байр</a></li>
            <li><a href="#">Мэдээ</a></li>
            <li><a href="#">Дэмжлэг</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Үйлчилгээ</h4>
          <ul class="footer__links">
            <li><a href="#home">Нүүр</a></li>
            <li><a href="#range">Машинууд</a></li>
            <li><a href="#choose">Онцлог</a></li>
            <li><a href="{{ route('login') }}">Нэвтрэх</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Биднийг дагаарай</h4>
          <ul class="footer__socials">
            <li>
              <a href="#"><i class="ri-facebook-fill"></i></a>
            </li>
            <li>
              <a href="#"><i class="ri-twitter-fill"></i></a>
            </li>
            <li>
              <a href="#"><i class="ri-instagram-line"></i></a>
            </li>
            <li>
              <a href="#"><i class="ri-linkedin-fill"></i></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="footer__bar">
        Copyright © 2024 Premium Car Rental. Бүх эрх хуулиар хамгаалагдсан.
      </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{asset('assets/js/rental-template.js')}}"></script>
  </body>
</html>
