@extends('layouts.app')

@section('title', 'Interior Paint')

@section('content')
<div class="container min-vh-100 py-5 d-flex flex-column justify-content-center">
<h1 class="mb-2">Interior Paint</h1>
    <p>Explore our range of high-quality interior paints designed to beautify and protect your indoor spaces.</p>
    <p>Key Features</p>
    <ul>
        <li>Smooth, washable finish for high-traffic areas like living rooms, kitchens, and hallways.</li>
        <li>Resistant to staining and easy to clean.</li>
        <li>Comes in various sheens: matte, eggshell, satin, semi-gloss.</li>
        <li>Formulated to resist scuffing, peeling, and fading in indoor conditions.</li>
        <li>Quick-drying with minimal odor.</li>
    </ul>
    <p>Best for:</p>
    <ul>
        <li>Drywalls, plaster, ceilings, trims, and previously painted interior surfaces.</li>
    </ul>
<div class="row">
                <div class="col-12 col-md-6 mb-4">
                   <a href="{{ route('products.detail',['category' => 'interior','type'=>'emulsion'])}}"  class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    Emulsion Paint(Water-based)
                    <span class="stretched-link"></span>
                </h5>
                <p>Use: Most common for interior walls and ceilings.</p>
                <p>Best For: Living rooms, bedrooms, and general wall areas.</p>
            </div>
        </div>
    </a>
                </div>
                <div class="col-12 col-md-6 mb-4">
                   <a href="{{route('products.detail' ,['category' => 'interior','type'=>'enamel'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    Enamel Paint (Oil-based)
                    <span class="stretched-link"></span>
                </h5>
                 <p>Use: Used where durability and a glossy finish are needed.</p>
                <p>Best For: Doors, trims, windows, and wooden furniture.</p>
            </div>
        </div>
    </a>
                </div>
                <div class="col-12 col-md-6 mb-4">
                   <a href="{{ route('products.detail',['category' => 'interior','type'=>'lustre'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    Lustre Paint
                    <span class="stretched-link"></span>
                </h5>
                  <p>Use: Provides a smooth, mildly glossy finish that is durable, easy to clean, and resistant to stains and moisture.</p>
                <p>Best For: living rooms, bedrooms, hallways, and wood surfaces like doors and trims.</p>
            </div>
        </div>
    </a>
                </div>
                                <div class="col-12 col-md-6 mb-4">
                 <a href="{{route('products.detail',['category' => 'interior','type'=>'acrylic'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    Acrylic Paint
                    <span class="stretched-link"></span>
                </h5>
                <p>Use: Offers a durable and flexible coating.</p>
                <p>Best For: Kitchens, bathrooms, high-traffic hallways.</p>
            </div>
        </div>
    </a>
                </div>
            </div>
</div>
@endsection
