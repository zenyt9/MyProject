<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Car Rental</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #000;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }

        .intro-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #000;
            z-index: 9999;
        }

        #intro-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .skip-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: 2px solid #fff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
            z-index: 10000;
            backdrop-filter: blur(10px);
        }

        .skip-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-size: 24px;
            text-align: center;
        }

        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 4px solid #fff;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .fade-out {
            animation: fadeOut 0.5s ease-out forwards;
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="intro-container" id="introContainer">
        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p>Уншиж байна...</p>
        </div>
        <video id="intro-video" muted playsinline preload="auto">
            <source src="{{ asset('videos/CarRental.mp4') }}" type="video/mp4">
            <source src="{{ asset('videos/intro.mkv') }}" type="video/x-matroska">
            Таны browser видео дэмждэггүй байна.
        </video>
        <button class="skip-btn" id="skipBtn" style="display: none;">
            Алгасах →
        </button>
    </div>

    <script>
        // Intro үзсэн эсэхийг шалгах
        if (localStorage.getItem('intro_viewed') === 'true') {
            // Intro аль хэдийн үзсэн бол шууд home руу шилжих
            window.location.href = '{{ route('home') }}';
        }

        const video = document.getElementById('intro-video');
        const skipBtn = document.getElementById('skipBtn');
        const loading = document.getElementById('loading');
        const introContainer = document.getElementById('introContainer');

        // Видео тоглуулах функц
        function playVideo() {
            const playPromise = video.play();

            if (playPromise !== undefined) {
                playPromise.then(function() {
                    // Видео амжилттай тоглож эхэлсэн
                    console.log('Видео тоглож эхэллээ');
                    loading.style.display = 'none';
                    skipBtn.style.display = 'block';
                }).catch(function(error) {
                    // Автомат тоглуулалт амжилтгүй болсон
                    console.log('Автомат тоглуулалт амжилтгүй:', error);
                    loading.style.display = 'none';
                    skipBtn.style.display = 'block';
                    // Видео тоглуулахыг дахин оролдох
                    video.play().catch(e => console.log('Дахин оролдлого:', e));
                });
            }
        }

        // Video бэлэн болоход
        video.addEventListener('canplay', function() {
            loading.style.display = 'none';
            playVideo();
        });

        // Video ачааллагдсаны дараа
        video.addEventListener('loadeddata', function() {
            loading.style.display = 'none';
            playVideo();
        });

        // Видео тоглож эхлэхэд
        video.addEventListener('playing', function() {
            loading.style.display = 'none';
            skipBtn.style.display = 'block';
        });

        // Video дууссаны дараа home руу шилжих
        video.addEventListener('ended', function() {
            goToHome();
        });

        // Алгасах товч
        function skipToHome() {
            goToHome();
        }

        skipBtn.addEventListener('click', skipToHome);

        // Home хуудас руу шилжих
        function goToHome() {
            // Intro үзсэн гэж тэмдэглэх
            localStorage.setItem('intro_viewed', 'true');

            introContainer.classList.add('fade-out');
            setTimeout(function() {
                window.location.href = '{{ route('home') }}';
            }, 500);
        }

        // Video ачаалах алдаа
        video.addEventListener('error', function(e) {
            console.error('Видео ачаалах алдаа:', e);
            loading.innerHTML = '<p>Видео ачаалахад алдаа гарлаа.</p><p>Хүлээнэ үү...</p>';
            setTimeout(goToHome, 3000);
        });

        // Escape товч дарахад алгасах
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                skipToHome();
            }
        });

        // Хуудас ачаалагдсаны дараа видео тоглуулахыг оролдох
        window.addEventListener('load', function() {
            playVideo();
        });

        // Хуудас харагдахад видео тоглуулах
        document.addEventListener('DOMContentLoaded', function() {
            playVideo();
        });

        // Immediate оролдлого
        setTimeout(function() {
            if (video.paused) {
                playVideo();
            }
        }, 100);
    </script>
</body>
</html>
