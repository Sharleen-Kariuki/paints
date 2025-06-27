@extends('layouts.app')

@section('title', 'Order Confirmation')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Order Confirmation</h2>
     <form method="POST" action="{{ route('order.savePhone') }}">
    @csrf
    {{-- Tabs --}}
    <ul class="nav nav-tabs justify-content-between mb-3" id="orderTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button" role="tab">User Details</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order" type="button" role="tab">Order Details</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="phone-tab" data-bs-toggle="tab" data-bs-target="#phone" type="button" role="tab">Phone Number</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="amount-tab" data-bs-toggle="tab" data-bs-target="#amount" type="button" role="tab">Total Amount</button>
        </li>
    </ul>

    {{-- Tab Content --}}
    <div class="tab-content border rounded p-4" id="orderTabContent">

        {{-- User Details --}}
        <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
            <h5>User Information</h5>
            <p><strong>Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
        </div>

        {{-- Order Details --}}
        <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
            <h5>Order Details</h5>
            <p><strong>Color:</strong> {{ $color ?? $order->paintcolor ?? 'N/A' }}</p>
            <p><strong>Quantity:</strong> {{ $quantity ?? $order->quantity ?? 'N/A' }}</p>
            <p><strong>Capacity:</strong> {{ $capacity ?? $order->capacity ?? 'N/A' }}L</p>
        </div>

        {{-- Phone Number --}}
        <div class="tab-pane fade" id="phone" role="tabpanel" aria-labelledby="phone-tab">
            <h5>Enter Phone Number</h5>
            <p class="text-muted">Number to be called to confirm the order</p>
            <input type="text" class="form-control" name="phone" placeholder="e.g. 0712345678" required>
        </div>

        {{-- Total Amount --}}
        <div class="tab-pane fade" id="amount" role="tabpanel" aria-labelledby="amount-tab">
            <h5>Total Amount</h5>
            <p class="fs-4">Ksh <strong>0</strong></p> {{-- Replace with calculated total if needed --}}
        </div>
    </div>

    {{-- Submit Button --}}
    <div class="mt-4">
        <button class="btn btn-success" type="submit">
            Place Order
        </button>
    </div>
</div>
</form>
@endsection
