@extends('layouts.admin')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input:
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-4 mb-4" style="max-width: 600px;">
    <form method="POST" action="{{ route('physicalOrders.store') }}">
        @csrf
        <input type="hidden" name="order_type" value="physical">

        <div class="form-group">
            <label for="name">Customer Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" name="phone" class="form-control" id="phone" required>
        </div>

        <div class="form-group">
            <label for="category">Paint Category</label>
            <select class="form-select" id="category" name="paintCategory">
                <option value="Interior Paints">Interior Paints</option>
                <option value="Exterior Paints">Exterior Paints</option>
                <option value="Primers">Primers</option>
                <option value="Finishes">Finishes</option>
            </select>
        </div>

        <div class="form-group">
            <label for="type">Paint Type</label>
            <input type="text" name="paintType" class="form-control" id="paintType" required>
        </div>

        <div class="mb-3">
            <label for="capacity_liters" class="form-label">Select Capacity (L):</label>
            <select class="form-select" id="capacity_liters" name="quantity">
                <option value="20">20L</option>
                <option value="10">10L</option>
                <option value="5">4L</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">Enter Quantity:</label>
            <input type="number" class="form-control" id="capacity" name="capacity" min="1" placeholder="Enter Quantity">
        </div>

        <div class="form-group">
            <label for="paintcolor">Color :</label>
            <input type="text" name="paintcolor" class="form-control" id="paintcolor">
        </div>

        <div class="mb-3">
            <label class="form-label">Do you need a painter?</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="needs_painter" id="needPainterYes" value="yes">
                    <label class="form-check-label" for="needPainterYes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="needs_painter" id="needPainterNo" value="no" checked>
                    <label class="form-check-label" for="needPainterNo">No</label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description of area to be painted:</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="e.g. kitchen wall 2m by 3m">
        </div>

        <br>
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>
@endsection
