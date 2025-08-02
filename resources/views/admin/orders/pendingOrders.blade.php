@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Pending Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">No pending orders found.</div>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Order Type</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->order_type}}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td>KES {{ number_format($order->total_price, 2) }}</td>
                   <td>
    <span class="badge bg-warning">{{ ucfirst($order->status) }}</span><br>
    
    <a href="{{ route('invoice.preview', $order->id) }}" class="btn btn-sm btn-primary mt-1" target="_blank">
        View Invoice
    </a>
</td>

                  
                </tr>
                @endforeach
            </tbody>
        </table>
                                {{-- Back Button --}}
    <div class="mb-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
    </div>
    @endif

@endsection
