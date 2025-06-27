@extends('layouts.app')

@section('title', ucfirst($type ?? 'unknown') . ' Paint')

@section('content')
<div class="container py-5 min-vh-100">
    <h1 class="mb-4">{{ ucfirst($type ?? 'unknown') }} Paint</h1>

    @if (($type ?? null) === 'acrylic exterior paint')
        <p>This is water-based emulsion paint, perfect for walls and ceilings. It dries quickly and has a matte finish.</p>
    @elseif (($type ?? null) === 'textured paint')
        <p>This oil-based enamel paint is great for wood and metal surfaces. It's glossy, durable, and washable.</p>
    @elseif (($type ?? null) === 'cemented-based paint')
        <p>Lustre paint provides a shiny, pearl-like finish ideal for stylish interiors. It's stain-resistant and easy to clean.</p>
    @elseif (($type ?? null) === 'oil-based paint')
        <p>Acrylic paint is versatile, quick-drying, and suitable for a variety of indoor surfaces. It offers vibrant color and good coverage.</p>
     @elseif (($type ?? null) === 'elastomeric paint')
        <p>Acrylic paint is versatile, quick-drying, and suitable for a variety of indoor surfaces. It offers vibrant color and good coverage.</p>    
    @else
        <p>Paint description not found.</p>
    @endif

    
@include('partials.partial-form')