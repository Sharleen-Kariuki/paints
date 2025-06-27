
@extends('layouts.app')

@section('title', 'Interior Paint')

@section('content')
<div class="container min-vh-100 py-5 d-flex flex-column justify-content-center">
<h1 class="mb-4">Finishes</h1>
    <p>Explore our range of high-quality interior paints designed to beautify and protect your indoor spaces.</p>
    <p>Key Features</p>
    <ul>
        <li>Available in multiple sheen levels — from flat to high-gloss — to suit different aesthetic and functional needs.</li>
        <li>Adds visual depth, texture, and light reflectivity to surfaces for a polished, elegant, or subtle look.</li>
        <li>Provides an added layer that protects painted surfaces from wear, moisture, and staining.</li>
        <li>Higher-sheen finishes (like satin, semi-gloss, and gloss) are designed for easy maintenance in high-traffic or humid areas.</li>
        <li>Glossy finishes offer long-lasting protection, especially in areas prone to frequent contact or cleaning.</li>
    </ul>
<div class="row">
                <div class="col-12 col-md-6 mb-4">
                   <a href="{{ route('products.detail',['category' => 'finishes','type'=>'flat or matte'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                   Flat/Matte
                    <span class="stretched-link"></span>
                </h5>
                <p>Use: Non-reflective finish that hides surface imperfections and provides a smooth, soft look.

</p>
                <p>Best For: Ceilings, low-traffic areas like adult bedrooms or study rooms.</p>
            </div>
        </div>
    </a>
                </div>
                <div class="col-12 col-md-6 mb-4">
                   <a href="{{route('products.detail',['category' => 'finishes','type'=>'Low Sheen'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                   Low Sheen
                    <span class="stretched-link"></span>
                </h5>
               <p>Use:Low-sheen finish that offers a slight luster with better durability than flat paint.</p>
                <p>Best For: Living rooms, dining rooms, and bedrooms with moderate traffic.</p>
            </div>
        </div>
    </a>
                </div>
                <div class="col-12 col-md-6 mb-4">
                   <a href="{{ route('products.detail',['category' => 'finishes','type'=>'semi-gloss/gloss'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    Semi Gloss/Gloss
                    <span class="stretched-link"></span>
                </h5>
                 <p>Use: Reflective, durable finish that resists moisture and stains; easy to clean.

</p>
                <p>Best For: Bathrooms, kitchens, doors, trims, baseboards, and cabinets.

</p>
            </div>
        </div>
    </a>
                </div>
                                <div class="col-12 col-md-6 mb-4">
                 <a href="{{route('products.detail',['category' => 'finishes','type'=>'eggshell'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    Stain-Blocking Primers
                    <span class="stretched-link"></span>
                </h5>
                <p>Use: Smooth, slightly glossy finish that is easy to clean and resists mildew.</p>
                <p>Best For: Hallways, children’s rooms, family rooms, and kitchens.</p>
            </div>
        </div>
    </a>
                </div>
                                <div class="col-12 col-md-6 mb-4">
                 <a href="{{route('products.detail',['category' => 'finishes','type'=>'satin'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                   Eggshell
                    <span class="stretched-link"></span>
                </h5>
                <p>Use: Very shiny and durable finish that gives a polished, glass-like look.</p>
                <p>Best For: Accent areas, furniture, cabinets, doors, and trims in high-traffic areas.

</p>
            </div>
        </div>
    </a>
                </div>
                            
            </div>
</div>
@endsection
