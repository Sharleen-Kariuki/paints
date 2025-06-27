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
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td>KES {{ number_format($order->total, 2) }}</td>
                    <td><span class="badge bg-warning">{{ ucfirst($order->status) }}</span></td>
                  
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
