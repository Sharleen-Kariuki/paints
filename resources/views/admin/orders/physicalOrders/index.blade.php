@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Physical Orders</h2>
    <a href="{{ route('physicalOrders.create') }}" class="btn btn-primary mb-3">Add Order</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="physicalOrdersTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Paint Category</th>
                <th>PaintType</th>
                <th>Capacity</th>
                <th>Quantity</th>
                <th>Color</th>
                <th>Painter</th>
                <th>Description</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($physicalOrders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->paintCategory}}</td>
                    <td>{{ $order->paintType }}</td>
                    <td>{{ $order->capacity }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>
                        <span style="background-color: {{ $order->paintcolor }}; padding: 5px 10px; color: #fff; border-radius: 4px;">
                            {{ $order->paintcolor }}
                        </span>
                    </td>
                    <td>{{ $order->needs_painter ? 'Yes' : 'No' }}</td>
                    <td>{{ $order->description }}</td>
                    <td>{{ $order->total_price }}</td>
                   
        <td>
    <form action="{{ route('physicalOrder.updateStatus', $order->id) }}" method="POST">
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
                    
                    <td>
                        <a href="{{ route('physicalOrders.edit', $order->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('physicalOrders.destroy', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this painter?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
       {{-- Back Button --}}
    <div class="mb-3">
        <a href="{{ url('dashboard')}}" class="btn btn-secondary">Back</a>
    </div>

    <br>
    &nbsp;
</br>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#physicalOrdersTable').DataTable();
    });
</script>
@endpush
