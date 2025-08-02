@extends('layouts.app') {{-- Or use 'layouts.master' or your actual layout file --}}

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">My Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">
            Your cart is empty.
        </div>
    @else
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Paint Category</th>
                <th>Type</th>
                <th>Color</th>
                <th>Capacity</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Ordered On</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $index => $order)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $order->paintCategory }}</td>
                <td>{{ $order->paintType }}</td>
                <td>
                <span style="background-color: {{ $order->paintcolor }}; padding: 5px 10px; color: #fff; border-radius: 4px;">
                    {{ $order->paintcolor }}
                </span>
                </td>
                <td>{{ $order->capacity }} L</td>
                <td>{{ $order->quantity }}</td>
                <td>KES {{ number_format($order->total_price, 2) }}</td>
                <td>
                @if($order->status === 'approved')
                    <span class="badge bg-success">Approved</span>
                @elseif($order->status === 'declined')
                    <span class="badge bg-danger">Declined</span>
                @else
                   <span class="badge bg-warning">Pending</span>
                @endif
                </td>
                <td>{{ $order->created_at->format('d M Y') }}</td>
                <td>
                        <a href="{{ route('invoice.preview', $order->id) }}" class="btn btn-sm btn-primary mt-1" target="_blank">
        View Invoice
    </a>
    
                    @if($order->status === 'pending')
                        <form action="{{ route('myOrders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                        </form>
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{-- <a href="{{ route('invoices.statement') }}" class="btn btn-sm btn-primary mt-1" target="_blank">
            View All Paid Orders Statement
        </a> --}}

        <div class="mt-3">
            <h5>Status Key:</h5>
            <ul class="list-unstyled">
            <li>
                <span class="badge bg-success">Approved</span> - Your order has been approved and is being processed.
            </li>
             <li>
                <span class="badge bg-danger">Declined</span> - You have cancelled that order .
            </li>
            <li>
                <span class="badge bg-warning">Pending</span> - Your order is awaiting your approval.
            </li>
            <li>
                <span class="badge bg-success">Completed</span> - Your order has been processed awaiting delivery or collection.
            </li>
            </ul>
            <br></br>
        </div>

        
    @endif
</div>
@endsection
