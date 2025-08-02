@extends('layouts.app')

@section('title', 'Order Confirmation')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Order Confirmation</h2>
    <form method="POST" action="{{ route('order.savePhone') }}">
        @csrf

        {{-- User Details --}}
        <div class="border rounded p-4 mb-4">
            <h5>User Information</h5>
            <p><strong>Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
        </div>

        {{-- Order Details --}}
        <div class="border rounded p-4 mb-4">
            <h5>Order Details</h5>
            <p><strong>Color:</strong> {{ $color ?? $order->paintcolor ?? 'N/A' }}</p>
            <p><strong>Quantity:</strong> {{ $quantity ?? $order->quantity ?? 'N/A' }}</p>
            <p><strong>Capacity:</strong> {{ $capacity ?? $order->capacity ?? 'N/A' }}L</p>
        </div>

        {{-- Phone Number --}}
        <div class="border rounded p-4 mb-4">
            <h5>Enter Phone Number</h5>
            <p class="text-muted">Number to be called to confirm the order</p>
            <input 
            type="tel" 
            class="form-control @error('phone') is-invalid @enderror" 
            name="phone" 
            placeholder="e.g. 0712345678" 
            pattern="^(07\d{8}|01[0-9]\d{7})$" 
            required
            value="{{ old('phone') }}"
            >
            @error('phone')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <small class="text-danger">* Required. Must be a valid Kenyan phone number (e.g. 0712345678).</small>
        </div>

        {{-- Total Amount --}}
        <div class="border rounded p-4 mb-4">
            <h5>Total Amount</h5>
            <p class="fs-4">Ksh <strong>{{ number_format($order->total_price) }}</strong></p>
        </div>

        {{-- Submit Button --}}
        <div class="mt-4">
            <button class="btn btn-success" type="submit">
                Place Order
            </button>
        </div>
    </form>
</div>
@endsection
