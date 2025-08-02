@extends('layouts.admin')

@section('content')
@if ($data && $data->role === 'admin')
<div class="container mt-4">
    <h2>Approved Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">No approved online orders found.</div>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Order Type</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Order Date</th>
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
                    <td>{{ $order->name ?? 'N/A' }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td>KES {{ number_format($order->total_price, 2) }}</td>
                    <td>
                        <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
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

@else
<div class="container mt-4">
    <h2>Pending Online Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">No pending online orders found.</div>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Paint Type</th>
                    <th>Paint Category</th>
                    <th>Paint Color</th>
                    <th>Quantity</th>
                    <th>Capacity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->id }}</td>
                     <td>{{ $order->paintType }}</td>
                    <td>{{ $order->paintCategory }}</td>
                    <td>{{ $order->paintcolor }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->capacity}}</td>
                    <td>
                    <form action="{{ route('order.updateStatus', $order->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="pending" disabled selected>Select Status</option>
            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ $order->status == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="declined" {{ $order->status == 'declined' ? 'selected' : '' }}>Declined</option>
        </select>
    </form>
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

    <hr>

    <h2 class="mt-5">Pending Physical Orders</h2>

    @if($physicalOrders->isEmpty())
        <div class="alert alert-info">No pending physical orders found.</div>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Paint Type</th>
                    <th>Paint Category</th>
                    <th>Paint Color</th>
                    <th>Quantity</th>
                    <th>Capacity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($physicalOrders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->paintType }}</td>
                    <td>{{ $order->paintCategory }}</td>
                    <td>{{ $order->paintcolor }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->capacity}}</td>
                    <td>
                     <form action="{{ route('order.updateStatus', $order->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ $order->status == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="declined" {{ $order->status == 'declined' ? 'selected' : '' }}>Declined</option>
        </select>
    </form>
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
</div>
@endif
@endsection


