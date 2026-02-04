<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/rental-template.css')}}" />
    <title>Машин засах - Premium Car Rental</title>
    <style>
        .form-container {
            max-width: 800px;
            margin: 120px auto 50px;
            padding: 2rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 5px 5px 20px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
            font-weight: 600;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--extra-light);
            border-radius: 5px;
            font-size: 1rem;
            transition: border 0.3s;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        .form-group small {
            display: block;
            margin-top: 0.25rem;
            color: var(--text-light);
            font-size: 0.875rem;
        }
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        .current-image {
            max-width: 300px;
            border-radius: 8px;
            margin-top: 0.5rem;
        }
        .error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
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
        </div>
        <ul class="nav__links">
            <li><a href="{{ route('admin.dashboard') }}">Админ самбар</a></li>
            <li><a href="{{ route('admin.cars.index') }}">Машинууд</a></li>
        </ul>
    </nav>

    <div class="form-container">
        <h2 class="section__header" style="margin-bottom: 2rem;">
            <i class="ri-edit-line"></i> Машин засах
        </h2>

        @if ($errors->any())
            <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem;">
                <strong>Алдаа:</strong>
                <ul style="margin: 0.5rem 0 0 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="brand">
                        <i class="ri-car-line"></i> Брэнд *
                    </label>
                    <input type="text" name="brand" id="brand" value="{{ old('brand', $car->brand) }}" required>
                    <small>Жишээ: Toyota, BMW, Mercedes</small>
                </div>

                <div class="form-group">
                    <label for="model">
                        <i class="ri-settings-4-line"></i> Загвар *
                    </label>
                    <input type="text" name="model" id="model" value="{{ old('model', $car->model) }}" required>
                    <small>Жишээ: Camry, X5, E-Class</small>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="year">
                        <i class="ri-calendar-line"></i> Он *
                    </label>
                    <input type="text" name="year" id="year" value="{{ old('year', $car->year) }}" required>
                </div>

                <div class="form-group">
                    <label for="color">
                        <i class="ri-palette-line"></i> Өнгө
                    </label>
                    <input type="text" name="color" id="color" value="{{ old('color', $car->color) }}">
                </div>

                <div class="form-group">
                    <label for="seats">
                        <i class="ri-group-line"></i> Суудал
                    </label>
                    <input type="number" name="seats" id="seats" value="{{ old('seats', $car->seats) }}" min="1" max="20">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="plate_number">
                        <i class="ri-price-tag-3-line"></i> Улсын дугаар *
                    </label>
                    <input type="text" name="plate_number" id="plate_number" value="{{ old('plate_number', $car->plate_number) }}" required>
                    <small>Жишээ: УБ-1234</small>
                </div>

                <div class="form-group">
                    <label for="category_id">
                        <i class="ri-folder-line"></i> Ангилал *
                    </label>
                    <select name="category_id" id="category_id" required>
                        <option value="">Сонгох</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $car->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="daily_rate">
                        <i class="ri-money-dollar-circle-line"></i> Өдрийн үнэ (₮) *
                    </label>
                    <input type="number" name="daily_rate" id="daily_rate" value="{{ old('daily_rate', $car->daily_rate) }}" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="status">
                        <i class="ri-checkbox-circle-line"></i> Төлөв *
                    </label>
                    <select name="status" id="status" required>
                        <option value="available" {{ old('status', $car->status) == 'available' ? 'selected' : '' }}>Боломжтой</option>
                        <option value="rented" {{ old('status', $car->status) == 'rented' ? 'selected' : '' }}>Түрээсэлсэн</option>
                        <option value="maintenance" {{ old('status', $car->status) == 'maintenance' ? 'selected' : '' }}>Засварт</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="features">
                    <i class="ri-star-line"></i> Онцлог шинж чанарууд
                </label>
                <textarea name="features" id="features" rows="3">{{ old('features', $car->features) }}</textarea>
                <small>Жишээ: GPS, Арын камер, Арын суудлын халаалт</small>
            </div>

            <div class="form-group">
                <label for="image">
                    <i class="ri-image-line"></i> Зураг оруулах
                </label>
                <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)">
                <small>JPG, PNG, GIF файл сонгоно уу (хамгийн ихдээ 2MB)</small>

                @if($car->image)
                    <div style="margin-top: 1rem;">
                        <strong>Одоогийн зураг:</strong><br>
                        <img id="currentImage" src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->brand }} {{ $car->model }}" class="current-image">
                        <br><small style="color: var(--text-light);">{{ $car->image }}</small>
                    </div>
                @endif

                <div id="imagePreview" style="margin-top: 1rem;"></div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn" style="flex: 1; background: var(--primary-color);">
                    <i class="ri-save-line"></i> Хадгалах
                </button>
                <a href="{{ route('admin.cars.index') }}" class="btn" style="flex: 1; background: var(--text-light); color: var(--text-dark);">
                    <i class="ri-close-line"></i> Болих
                </a>
            </div>
        </form>
    </div>

    <footer style="margin-top: 3rem; background-color: var(--text-dark); padding: 2rem 0;">
        <div class="footer__bar">
            Copyright © 2024 Premium Car Rental. Бүх эрх хуулиар хамгаалагдсан.
        </div>
    </footer>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            const currentImage = document.getElementById('currentImage');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `
                        <strong style="color: var(--primary-color);">Шинэ зураг:</strong><br>
                        <img src="${e.target.result}" style="max-width: 300px; border-radius: 8px; margin-top: 0.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    `;
                    if (currentImage) {
                        currentImage.style.opacity = '0.5';
                    }
                }
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '';
                if (currentImage) {
                    currentImage.style.opacity = '1';
                }
            }
        }
    </script>
</body>
</html>
