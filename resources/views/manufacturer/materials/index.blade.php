@extends('layouts.manufacturer')
@section('title', 'Materials')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Materials Inventory</h2>

    @if($data && $data->role === 'manufacturer')
        <a href="{{ route('materials.create') }}" class="btn btn-primary mb-3">Add New Material</a>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Unit</th>
                <th>Stock Quantity</th>
                <th>Reorder Level</th>
                <th>Status</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
                <tr>
                    <td>{{ $material->name }}</td>
                    <td>{{ $material->unit }}</td>
                    <td>{{ $material->stock_qty }}</td>
                    <td>{{ $material->reorder_level }}</td>
                    <td>
                        @if($material->stock_qty < $material->reorder_level)
                            <span class="badge bg-danger">Low Stock</span>
                        @else
                            <span class="badge bg-success">Sufficient</span>
                        @endif
                    </td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
          {{-- Back Button --}}
    <div class="mb-3">
        <a href="{{ url('/dashboard')}}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
