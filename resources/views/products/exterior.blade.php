@extends('layouts.app')

@section('title', 'Exterior Paint')

@section('content')
<div class="container min-vh-100 py-5 d-flex flex-column justify-content-center">
<h1 class="mb-2">Exterior Paint</h1>
    <p>Explore our range of high-quality exterior paints designed to beautify and protect your outdoor spaces.</p>
    Drywalls, plaster, ceilings, trims, and previously painted interior surfaces.
    <ul>
        <li>Weather-resistant and UV-resistant to prevent fading.</li>
        <li>Durable against cracking, peeling, and mildew.</li>
        <li>Often contains fungicides and water-repellent additives.</li>
        <li>Available in a wide variety of colors and finishes suited for outdoor aesthetics.</li>    
        <li>Stronger adhesion for rough or porous surfaces like stucco, brick, or concrete</li>
    </ul>
    <p>Best For:</p>
    <ul>
        <li>Exterior walls, fences, gates, masonry, and wooden structures exposed to the elements.</li>
    </ul>
<div class="row">
                <div class="col-12 col-md-6 mb-4">
                   <a href="{{ route('products.detail',['category' => 'exterior','type'=>'acrylic exterior paint'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    Acrylic Exterior Paint
                    <span class="stretched-link"></span>
                </h5>
                <p >Use: Water-based paint that provides flexibility, color retention, and resistance to fading and cracking.</p>
                <p>Best For: Cement walls, concrete, stucco, and previously painted surfaces.</p>
            </div>
        </div>
    </a>
                </div>
                <div class="col-12 col-md-6 mb-4">
                   <a href="{{route('products.detail',['category' => 'exterior','type'=>'textured paint'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                   Textured Paint
                    <span class="stretched-link"></span>
                </h5>
                  <p >Use: Thick paint that adds a grainy or patterned finish while hiding surface imperfections.</p>
                <p>Best For: Rough plaster, concrete blocks, feature walls, and uneven exterior surfaces.

</p>
            </div>
        </div>
    </a>
                </div>
                <div class="col-12 col-md-6 mb-4">
                   <a href="{{ route('products.detail',['category' => 'exterior','type'=>'cemented-based paint'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    Cemented-Based Paint
                    <span class="stretched-link"></span>
                </h5>
                                  <p >Use: Flexible, waterproof paint that bridges small cracks and withstands expansion/contraction.</p>
                <p>Best For:  Cracked or porous walls, stucco, masonry, and concrete surfaces in rainy or humid regions.</p>
            </div>
        </div>
    </a>
                </div>
                                <div class="col-12 col-md-6 mb-4">
                 <a href="{{route('products.detail',['category' => 'exterior','type'=>'oil-based paint'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    Oil-Based Paint
                    <span class="stretched-link"></span>
                </h5>
                 <p >Use: Durable solvent-based paint with strong adhesion and a smooth, hard finish.</p>
                <p>Best For: Metal surfaces, trims, railings, and exterior wooden doors and windows.
            </div>
        </div>
    </a>
                </div>
            </div>
</div>
@endsection
