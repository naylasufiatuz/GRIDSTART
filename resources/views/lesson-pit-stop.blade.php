@extends('app')

@section('content')

<section class="pit-stop-section">
    <div class="pit-stop-container">
        <div class="pit-stop-header">
            <p class="stage">STAGE 2 . PIT STOP</p>
            <h1 class="title">Pit Stop — Langkah Penting Sebelum Kembali Melaju</h1>
            <p class="desc">
                Pit Stop adalah area khusus di sirkuit balap tempat para pengemudi dan tim mereka melakukan 
                perawatan penting kendaraan. Fase ini adalah kunci kesuksesan dalam setiap balapan.
            </p>
        </div>

        <!-- CAROUSEL SECTION -->
        <div class="pit-stop-carousel-wrapper">
            <div class="pit-stop-carousel">
                <div class="carousel-item">
                    <div class="carousel-card"></div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-card"></div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-card"></div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-card"></div>
                </div>
            </div>

            <!-- CAROUSEL DOTS -->
            <div class="carousel-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>

        <!-- NAVIGATION BUTTONS -->
        <div class="lesson-nav">
            <a href="/brake-zone" class="btn back">Kembali ke brake zone</a>
            <a href="/simulasi" class="btn next">Lanjut ke Simulasi</a>
        </div>
    </div>
</section>

<script>
    // CAROUSEL FUNCTIONALITY
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-item');
    const dots = document.querySelectorAll('.dot');

    function updateCarousel() {
        dots.forEach((dot, index) => {
            dot.classList.remove('active');
            if (index === currentSlide) {
                dot.classList.add('active');
            }
        });
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            updateCarousel();
        });
    });

    // Auto slide every 5 seconds
    setInterval(() => {
        currentSlide = (currentSlide + 1) % dots.length;
        updateCarousel();
    }, 5000);
</script>

@endsection
