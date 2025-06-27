@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Suppliers</h2>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">Add Supplier</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="suppliers" class="table table-bordered">
        <thead>
            <tr>
                <th>Company_Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Material_bought</th>
                <th>Amount_paid</th>
                <th>Quantity</th>
                <th>Unit_price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->Company_name }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>{{ $supplier->material_bought }}</td>
                    <td>{{ $supplier->amount_paid }}</td>
                    <td>{{ $supplier->quantity }}</td>
                    <td>{{ $supplier->unit_price }}</td>

                    
                    <td>
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this supplier?')" class="btn btn-sm btn-danger">Delete</button>
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
        $('#suppliers').DataTable();
    });
</script>
@endpush
