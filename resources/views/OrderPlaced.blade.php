@extends('layouts.app')

@section('title', 'Order Placed')

@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center min-vh-100 text-center">
    <div class="mb-4">
        {{-- ✅ Tick Animation --}}
        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 10.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 0 0-1.06-1.06L7.5 8.439 5.53 6.47a.75.75 0 0 0-1.06 1.06l2.5 2.5z"/>
        </svg>
    </div>

    <h2 class="mb-2">Order is being processed...</h2>
    <p class="text-muted">You will be redirected to the dashboard shortly.</p>
</div>

<script>
    // Redirect to dashboard after 4 seconds
    setTimeout(() => {
        window.location.href = "{{ route('dashboard') }}"; 
    }, 4000);
</script>
@endsection
