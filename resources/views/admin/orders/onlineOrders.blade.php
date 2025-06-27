@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Online Orders</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="onlineOrdersTable" class="table table-bordered">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Category</th>
                <th>Type</th>
                <th>Capacity</th>
                <th>Quantity</th>
                <th>Paint Color</th>
                <th>Needs Painter</th>
                <th>Description</th>
                <th>Phone</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ $order->paintCategory }}</td>
                    <td>{{ $order->paintType }}</td>
                    <td>{{ $order->capacity }}</td>
                    <td>{{ $order->quantity }}</td>
                    
                    <td>
                        <span style="background-color: {{ $order->paintcolor }}; padding: 5px 10px; color: #fff; border-radius: 4px;">
                            {{ $order->paintcolor }}
                        </span>
                    </td>
                    <td>{{ $order->needs_painter == 'yes' ? 'Yes' : 'No' }}</td>
                    <td>{{ $order->description ?? '-' }}</td>
                    <td>{{ $order->phone ?? 'N/A' }}</td>
                  
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
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#onlineOrdersTable').DataTable();
    });
</script>
@endpush

