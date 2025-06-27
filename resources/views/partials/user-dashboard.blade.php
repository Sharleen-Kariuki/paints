@extends('layouts.app')

@section('title', 'PaintsCo Dashboard')

@section('content')
{{-- Hero section --}}
<header id="hero" class="bg-light py-5 text-center min-vh-100 d-flex flex-column justify-content-center align-items-center">
    <div class="container position-relative w-100 h-100 d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="row w-100">
            <!-- On small screens, image appears above text; on md+, side by side -->
            <div class="col-12 col-md-6 order-1 order-md-0 p-0">
                <div style="background: url('/images/hero.jpg') center center/cover no-repeat; min-height: 40vh; height: 100%; min-height: 100vh;" class="d-block d-md-none"></div>
                <div style="background: url('/images/hero.jpg') center center/cover no-repeat; min-height: 100vh; height: 100%;" class="d-none d-md-block"></div>
            </div>
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-start text-start order-0 order-md-1 py-4 py-md-0">
                <h1 class="display-4">Welcome to PaintsCo</h1>
                <p class="lead">Your one-stop shop for quality paints and coatings.</p>
            </div>
        </div>
    </div>
</header>

<!-- About Us Section -->
<section id="about" class="py-5 text-center min-vh-100 d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <h2 class="text-center mb-4">About Us</h2>
        <p>
            PaintsCo has been providing top-quality paints for over 20 years. Our mission is to bring color and life to your spaces with our wide range of products.
        </p>
        <p>
            Founded by a team of passionate professionals, PaintsCo started as a small family business and has grown into a trusted name in the paint industry. We believe that every wall tells a story, and our goal is to help you express yours with vibrant, long-lasting colors. Our commitment to quality and innovation drives us to source the finest raw materials and use advanced manufacturing processes, ensuring that every can of paint meets the highest standards.
        </p>
        <p>
            At PaintsCo, we offer a comprehensive selection of interior and exterior paints, primers, and finishes designed to suit every need and budget. Whether you are a homeowner looking to refresh your living space, a contractor working on a large-scale project, or a designer seeking the perfect shade, we have the right solution for you. Our expert team is always available to provide personalized advice and color consultations, making your painting experience smooth and enjoyable.
        </p>
        <p>
            Sustainability is at the heart of our operations. We are dedicated to minimizing our environmental impact by developing eco-friendly products, reducing waste, and supporting responsible sourcing. Our paints are formulated to be low in volatile organic compounds (VOCs), making them safer for your family and the planet.
        </p>
        <p>
            Over the years, we have built lasting relationships with our customers, suppliers, and community partners. We take pride in our reputation for reliability, integrity, and customer satisfaction. Thank you for choosing PaintsCo as your trusted partner in creating beautiful, inspiring spaces. We look forward to adding color to your world for many years to come.
        </p>
    </div>
</section>

<!-- Products Section -->
<section id="products" class="py-5 bg-light text-center min-vh-100 d-flex flex-column justify-content-center align-items-center">
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
                                <div class="flip-card-front d-flex align-items-center justify-content-center" style="background: url('{{ $product['image'] }}') center center/cover no-repeat; min-height: 50vh;">
                                </div>
                                <div class="flip-card-back d-flex flex-column justify-content-center align-items-center" style="min-height: 50vh; background: rgba(255,255,255,0.95);">
                                    <h5 class="card-title">
                                        {{ $product['title'] }}
                                        <span class="stretched-link"></span>
                                    </h5>
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


    <!-- Contact Us Section -->
    <section id="contact" class=" py-5 text-center min-vh-100 d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <h2 class="text-center mb-4">Contact Us</h2>
           <form action="https://formsubmit.co/a39e5b61acc260dfeee93179c409b00f" method="POST">

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3" placeholder="Your message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </section>

   @endsection
   
</body>
</html>