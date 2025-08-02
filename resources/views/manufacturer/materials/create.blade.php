@extends('layouts.manufacturer')
@section('title', 'Add Material')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Add New Material</h2>

    <form method="POST" action="{{ route('materials.store') }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Unit (e.g. L, kg)</label>
            <input type="text" name="unit" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stock Quantity</label>
            <input type="number" name="stock_qty" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Reorder Level</label>
            <input type="number" name="reorder_level" step="0.01" class="form-control" required>
        </div>

        <button class="btn btn-success">Save Material</button>
           
    </form>

     <div class="mt-4">
        <a href="{{ url('manufacturer/materials/index')}}" class="btn btn-secondary">Back</a>
    </div>
   

</div>
@endsection
