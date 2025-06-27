@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Add Supplier</h2>
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

    <form action="{{ route('suppliers.store') }}" method="POST">
       @csrf
<div class="mb-3">
    <label>Company Name</label>
    <input type="text" name="Company_name" class="form-control" value="{{ old('Company_name', $supplier->Company_name ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Phone</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $supplier->phone ?? '') }}" >
</div>
<div class="mb-3">
    <label>Address</label>
    <input type="text" name="address" class="form-control" value="{{ old('address', $supplier->address ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Material_Bought</label>
    <input type="text" name="material_bought" class="form-control" value="{{ old('material_bought', $supplier->material_bought ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Amount_Paid</label>
    <input type="text" name="amount_paid" class="form-control" value="{{ old('amount_paid', $supplier->amount_paid ?? '') }}">
</div>
<div class="mb-3">
    <label>quantity</label>
    <input type="text" name="quantity" class="form-control" value="{{ old('quantity', $supplier->quantity ?? '') }}">
</div>
<div class="mb-3">
    <label>Unit_price</label>
    <input type="text" name="unit_price" class="form-control" value="{{ old('unit_price', $supplier->unit_price ?? '') }}">
</div>

<button type="submit" class="btn btn-success">Save</button>

    </form>
    <br>
</div>
@endsection