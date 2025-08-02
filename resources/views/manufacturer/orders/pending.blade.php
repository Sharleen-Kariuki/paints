@extends('layouts.manufacturer')

@section('content')
@if ($data && $data->role === 'admin')
<div class="container mt-4">
    <h2>Approved Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">No approved orders found.</div>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Order Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
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
    @endif

@else
<div class="container mt-4">
    <h2>Pending Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">No pending orders found.</div>
    @else
      {{-- Back Button --}}
    <div class="mb-3">
        <a href="{{ url('/dashboard')}}" class="btn btn-secondary">Back</a>
    </div>
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
                    <th>Action</th> {{-- Added --}}
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
                    <td>{{ $order->capacity }}</td>
                    <td>
                        {{-- <a href="{{ route('stockNeeded.index', Crypt::encryptString($order->id)) }}" class="btn btn-sm btn-primary">
                            Stock Needed
                        </a> --}}
                        <a href="{{ url('manufacturer/orders/' . $order->id  . '/stockNeeded') }}" class="btn btn-sm btn-primary">
                            Stock Needed
                        </a>
                        <br>
                        &nbsp;
                        <br>
<form action="{{ route('manufacturer.orders.markCompleted', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to mark this order as completed?')">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-success btn-sm">Mark as Completed</button>
</form>
 <br>
                        &nbsp;
                        <br>
                        <a href="{{ route('manufacturer.suggest.materials', $order->id) }}" class="btn btn-outline-info btn-sm mt-2">
    🧠 Suggest Materials
</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endif

@endsection
