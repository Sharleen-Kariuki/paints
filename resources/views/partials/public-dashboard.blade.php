@extends('layouts.app')

@section('title', 'PaintsCo Dashboard')




@section('content')

<!-- Styles -->
<style>
    body {
        background-color: #04274a;
    }

    .flip-card {
        background-color: transparent;
        width: 100%;
        perspective: 1000px;
        position: relative;
        min-height: 50vh;
    }
    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.6s;
        transform-style: preserve-3d;
    }
    .flip-card:hover .flip-card-inner {
        transform: rotateY(180deg);
    }
    .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border-radius: 1rem;
        overflow: hidden;
    }
    .flip-card-back {
        transform: rotateY(180deg);
    }
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    .fade-in[data-delay] {
        transition-delay: var(--delay, 0s);
    }
</style>


<!-- Hero Section -->
<header id="hero" class="text-center min-vh-70 d-flex flex-column justify-content-center align-items-center fade-in" style="--delay: 6s;">
    <div class="w-100 min-vh-100 d-flex align-items-center justify-content-center position-relative" style="background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1500&q=80') center center/cover no-repeat;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.5);"></div>
        <div class=" p-5 rounded-4 shadow-lg text-center position-relative" style="backdrop-filter: blur(6px); z-index: 1;">
            <h1 class="display-4 text-light">Welcome to PaintsCo</h1>
            <p class="lead text-light">Your one-stop shop for quality paints and coatings.</p>
        </div>
    </div>
</header>

<!-- About Us Section -->
<section id="about" class="py-5 text-center min-vh-100 d-flex flex-column justify-content-center align-items-center fade-in">
    <div class="container">
        <h2 class="text-center mb-4 text-white">About Us</h2>
        <div class="row justify-content-center mb-4">
            <div class="col-12 col-md-8">
                <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=900&q=80" alt="Beautiful House" class="img-fluid rounded-4 shadow mb-3" style="max-height: 350px; object-fit: cover;">
            </div>
        </div>
        <p class="text-white">PaintsCo has been providing top-quality paints for over 20 years. Our mission is to bring color and life to your spaces with our wide range of products.</p>
        <p class="text-white">Founded by a team of passionate professionals, PaintsCo started as a small family business and has grown into a trusted name in the paint industry. We pride ourselves on our commitment to innovation, sustainability, and customer satisfaction.</p>
        <p class="text-white">Our expert staff is always ready to help you choose the perfect paint for your project, whether it's a cozy home makeover or a large commercial renovation. We believe every wall deserves a beautiful finish, and every customer deserves exceptional service.</p>
        <p class="text-white">Join thousands of happy customers who have transformed their homes and businesses with PaintsCo. Discover the difference quality makes!</p>
    </div>
</section>

<!-- Products Section -->
<section id="products" class="py-5 bg-light text-center min-vh-100 d-flex flex-column justify-content-center align-items-center fade-in">
    <div class="container">
        <h2>Our Products</h2>
        <div class="row">
            @php
           $products = [
    [
        'title' => 'Interior Paint',
        'route' => route('products.category', ['category' => 'interior']),
        'image' => '/images/interior.jpg',
        'text'  => 'Interior paints are specifically designed for indoor surfaces such as walls, ceilings, and trim. They prioritize easy application, smooth finish, and low odor or low-VOC (Volatile Organic Compounds) formulations for safer indoor air quality.'
    ],
    [
        'title' => 'Exterior Paint',
        'route' => route('products.category', ['category' => 'exterior']),
        'image' => '/images/exterior.jpg',
        'text'  => 'Exterior paints are developed to withstand the harsh conditions of outdoor environments — including sun, rain, wind, temperature changes, and pollution.'
    ],
    [
        'title' => 'Primer',
        'route' => route('products.category', ['category' => 'primer']),
        'image' => '/images/primer.jpg',
        'text'  => 'Primers are preparatory coatings applied before painting. They improve paint adhesion, seal porous surfaces, and create a uniform base for the topcoat.'
    ],
    [
        'title' => 'Finishes',
        'route' => route('products.category', ['category' => 'finishes']),
        'image' => '/images/finishes.jpg',
        'text'  => 'Finishes refer to the final layer of coating that determines the look and texture of a painted surface. They also contribute to durability, washability, and light reflection.'
    ]
];


            @endphp

            @foreach ($products as $product)
                <div class="col-12 col-md-6 mb-4">
                    <a href="{{ $product['route'] }}" class="text-decoration-none text-dark">
                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front d-flex align-items-center justify-content-center" style="background: url('{{ $product['image'] }}') center center/cover no-repeat; min-height: 50vh;"></div>
                                <div class="flip-card-back d-flex flex-column justify-content-center align-items-center" style="min-height: 50vh; background: rgba(255,255,255,0.95);">
                                    <h5 class="card-title">{{ $product['title'] }}</h5>
                                    <p class="card-text">{{$product['text']}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    // Navbar text color change on #products section
    document.addEventListener('DOMContentLoaded', function() {
        const productsSection = document.getElementById('products');
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        const navbar = document.querySelector('.navbar');

        if (productsSection && navLinks.length) {
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        navLinks.forEach(link => link.style.color = '#0d1a4a'); // blue
                    } else {
                        navLinks.forEach(link => link.style.color = ''); // reset
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(productsSection);
        }
    });
</script>

<!-- Contact Us Section -->
<section id="contact" class="py-5 text-center min-vh-100 d-flex flex-column justify-content-center align-items-center fade-in">
    <div class="container">
        <h2 class="text-center mb-4 text-white">Contact Us</h2>
        <form action="https://formsubmit.co/a39e5b61acc260dfeee93179c409b00f" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label text-white">Name</label>
                <input type="text" class="form-control text-white" id="name" name="name" placeholder="Your Name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label text-white">Email address</label>
                <input type="email" class="form-control text-white" id="email" name="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label text-white">Message</label>
                <textarea class="form-control text-white" id="message" name="message" rows="3" placeholder="Your message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary ">Send</button>
        </form>
    </div>
</section>

<!-- Scripts -->
<script>
    const fadeEls = document.querySelectorAll('.fade-in');
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                obs.unobserve(entry.target);
            }
        });
    });
    fadeEls.forEach(el => observer.observe(el));

    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
        });
    });
</script>

@endsection
