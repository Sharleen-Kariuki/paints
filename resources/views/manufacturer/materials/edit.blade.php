@extends('layouts.manufacturer')
@section('title', 'Edit Material')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Material</h2>

    <form method="POST" action="{{ route('materials.update', $material->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $material->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Unit</label>
            <input type="text" name="unit" value="{{ $material->unit }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stock Quantity</label>
            <input type="number" name="stock_qty" step="0.01" value="{{ $material->stock_qty }}" class="form-control" required>
        </div>

        @if($data && $data->role === 'admin')
        <div class="mb-3">
            <label>Reorder Level</label>
            <input type="number" name="reorder_level" step="0.01" value="{{ $material->reorder_level }}" class="form-control" required>
        </div>
        @else
        <div class="mb-3">
            <label>Reorder Level</label>
            <input type="number" class="form-control" value="{{ $material->reorder_level }}" disabled>
            <input type="hidden" name="reorder_level" value="{{ $material->reorder_level }}">
        </div>
        @endif

        <button class="btn btn-primary">Update Material</button>
    </form>
    
     <div class="mt-4">
        <a href="{{ url('manufacturer/materials/index')}}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
