@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Declined Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">No declined orders found.</div>
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
                    <td>{{ $order->name ?? 'N/A' }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td>KES {{ number_format($order->total_price, 2) }}</td>
                    <td><span class="badge bg-danger">{{ ucfirst($order->status) }}</span></td>
                  
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
