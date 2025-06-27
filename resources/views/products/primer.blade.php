
@extends('layouts.app')

@section('title', 'Interior Paint')

@section('content')
<div class="container min-vh-100 py-5 d-flex flex-column justify-content-center">
<h1 class="mb-4">Primers</h1>
    <p>Explore our range of high-quality interior paints designed to beautify and protect your indoor spaces.</p>
    <p>Key Features</p>
    <ul>
        <li>Ensures better bonding of paint to the surface.</li>
        <li>Helps block stains and previous colors from bleeding through.</li>
        <li>Can be used on bare walls, repaired patches, wood, metal, or masonry.</li>
        <li>Available as water-based or oil-based formulas</li>
        <li>Essential for repainting over darker shades or unpainted surfaces</li>
    </ul>
    <p>Best For:</p>
    <ul>
        <li>New or previously unpainted surfaces, glossy finishes, porous materials (like drywall or wood), and surfaces with stains.</li>
    </ul>
<div class="row">
                <div class="col-12 col-md-6 mb-4">
                   <a href="{{ route('products.detail',['category' => 'primer','type'=>'water-based primer'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                   Water-Based Primers
                    <span class="stretched-link"></span>
                </h5>
                <p >Use: Easy to clean, low-odor primer that dries quickly and provides a smooth base.</p>
                  <p >Best For: Drywall, softwoods, brick, and previously painted surfaces in low-humidity areas.</p>
            </div>
        </div>
    </a>
                </div>
                <div class="col-12 col-md-6 mb-4">
                   <a href="{{route('products.detail',['category' => 'primer','type'=>'oil-based primer'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                   Oil-Based Primers
                    <span class="stretched-link"></span>
                </h5>
               <p >Use: Penetrates and seals surfaces well; blocks stains and tannins; offers excellent adhesion.</p>
                  <p >Best For: Wood (especially bare or stained), metal, and surfaces prone to moisture or stains.</p>
            </div>
        </div>
    </a>
                </div>
                <div class="col-12 col-md-6 mb-4">
                   <a href="{{ route('products.detail',['category' => 'primer','type'=>'masonry primer'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    Masonry Primers
                    <span class="stretched-link"></span>
                </h5>
                <p >Use: Fast-drying primer with strong stain-blocking and odor-sealing properties.</p>
                  <p >Best For: Smoke-damaged walls, water stains, ink, grease marks, and odor-sealing in fire restoration.</p>
            </div>
        </div>
    </a>
                </div>
                                <div class="col-12 col-md-6 mb-4">
                 <a href="{{route('products.detail',['category' => 'primer','type'=>'stain-blocking primer'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    Stain-Blocking Primers
                    <span class="stretched-link"></span>
                </h5>
               <p >Use: Specifically designed to prevent tough stains from bleeding through topcoats.</p>
                  <p >Best For: Water stains, nicotine, crayon marks, rust, and mildew spots on walls or ceilings.</p>
            </div>
        </div>
    </a>
                </div>
                                <div class="col-12 col-md-6 mb-4">
                 <a href="{{route('products.detail',['category' => 'primer','type'=>'rust-inhibiting primer'])}}" class="text-decoration-none text-dark">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    Rust-Inhibiting Primers
                    <span class="stretched-link"></span>
                </h5>
               <p >Use:  Designed for slick or hard-to-paint surfaces that standard primers can't grip well.</p>
                  <p >Best For: Glass, tiles, glossy finishes, PVC, plastic, and laminate surfaces.</p>
            </div>
        </div>
    </a>
                </div>
            </div>
</div>
@endsection
