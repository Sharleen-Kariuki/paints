{{-- This is the base layout that all pages will extend --}}
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - PaintsCo</title>
    <!-- Pickr Styles Used to create a color wheel-->
<!-- For 'monolith' theme -->
<!-- Pickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/>
 <style>
/* Flip container */
.flip-card {
  perspective: 1000px;
  height: 300px;
  position: relative;
  width: 100%;
  margin-bottom: 1rem; /* <- adds spacing between cards */
}

@media (max-width: 768px) {
  .flip-card {
    height: 200px;
    margin-bottom: 3rem; /* slightly more spacing for mobile */
  }
}

/* Inner container */
.flip-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.6s;
    transform-style: preserve-3d;
}

/* Flip effect on hover */
.flip-card:hover .flip-card-inner {
    transform: rotateY(180deg);
}

/* Front & back sides */
.flip-card-front,
.flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: .25rem;
}

/* Front side with image */
.flip-card-front {
    background-size: cover;
    background-position: center;
    z-index: 2;
}

/* Back side content */
.flip-card-back {
    background: rgba(255,255,255,0.95);
    transform: rotateY(180deg);
    z-index: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 1rem;
    text-align: center;
}

/* Optional: mobile-specific adjustment */
@media (max-width: 768px) {
    .flip-card {
        height: 250px; /* slightly smaller for phones */
    }
}


      
    .wall-container {
        position: relative;
        width: 400px; /* adjust as needed */
        height: 300px;
        margin-bottom: 1rem;
    }

    .wall-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .wall-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(52, 152, 219, 0.6); /* default */
        pointer-events: none; /* allow clicks to pass through */
    }
</style>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    @include('partials.navbar')

    <main >
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Pickr JS -->
<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
