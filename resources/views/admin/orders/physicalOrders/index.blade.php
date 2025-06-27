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
                <th>Name</th>
                <th>Phone</th>
                <th>PaintCategory</th>
                <th>PaintType</th>
                <th>Capacity</th>
                <th>Quantity</th>
                <th>Color</th>
                <th>Painter</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($physicalOrders as $physicalOrder)
                <tr>
                    <td>{{ $physicalOrder->name }}</td>
                    <td>{{ $physicalOrder->phone }}</td>
                    <td>{{ $physicalOrder->paintCategory}}</td>
                    <td>{{ $physicalOrder->paintType }}</td>
                    <td>{{ $physicalOrder->capacity }}</td>
                    <td>{{ $physicalOrder->quantity }}</td>
                    <td>{{ $physicalOrder->paintcolor }}</td>
                    <td>{{ $physicalOrder->needs_painter ? 'Yes' : 'No' }}</td>
                    <td>{{ $physicalOrder->description }}</td>
                    <td>{{$physicalOrder->status}}</td>
                    
                    <td>
                        <a href="{{ route('physicalOrders.edit', $physicalOrder->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('physicalOrders.destroy', $physicalOrder->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this painter?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#physicalOrdersTable').DataTable();
    });
</script>
@endpush
