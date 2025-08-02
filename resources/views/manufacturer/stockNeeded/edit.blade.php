@extends('layouts.manufacturer')

@section('content')
<div class="container">
    <h2>Edit Stock Needed</h2>
    <form action="{{ url("manufacturer/orders/{$order->id}/stockNeeded/{$stockNeeded->id}/update") }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="orderid" class="form-label">Order ID</label>
            <input type="text" class="form-control" id="order_id" name="product" value="{{ old('order_id', $stockNeeded->order_id) }}" required>
        </div>
        <div class="mb-3">
            <label for="material_name" class="form-label">Material Needed</label>
            <input type="text" class="form-control" id="text" name="material_name" value="{{ old('material_name', $stockNeeded->material_name) }}" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $stockNeeded->quantity) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url('manufacturer/orders/' . $order->id  . '/stockNeeded') }}" class="btn btn-secondary">Cancel</a>
    </form>
    <br></br>
                                 {{-- Back Button --}}
    <div class="mb-3">
        <a href="{{ url('manufacturer/orders/' . $order->id  . '/stockNeeded')  }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection