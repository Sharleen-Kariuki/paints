@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Report</h1>
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

    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Company Name</label>
            <input 
                type="text" 
                class="form-control @error('Company_name') is-invalid @enderror" 
                id="Company_name" 
                name="Company_name" 
                value="{{ old('Company_Name', $supplier->Company_name) }}" 
                required
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

                <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input 
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                id="phone" 
                name="phone" 
                value="{{ old('phone', $supplier->phone) }}" 
                required
            >
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

                <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input 
                type="text" 
                class="form-control @error('address') is-invalid @enderror" 
                id="address" 
                name="address" 
                value="{{ old('address', $supplier->address) }}" 
                required
            >
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="national_id" class="form-label">material_bought</label>
            <input 
                type="text" 
                class="form-control @error('national_id') is-invalid @enderror" 
                id="material_bought" 
                name="material_bought" 
                value="{{ old('material_bought', $supplier->material_bought) }}" 
                required
            >
            @error('material_bought')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="national_id" class="form-label">Amount Paid</label>
            <input 
                type="text" 
                class="form-control @error('national_id') is-invalid @enderror" 
                id="amount_paid" 
                name="amount_paid" 
                value="{{ old('amount_paid', $supplier->amount_paid) }}" 
                required
            >
            @error('amount_paid')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Quantity" class="form-label">Quantity</label>
            <input 
                type="text" 
                class="form-control @error('national_id') is-invalid @enderror" 
                id="quantity" 
                name="quantity" 
                value="{{ old('quantity', $supplier->quantity) }}" 
                required
            >
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="unitprice" class="form-label">Unitprice</label>
            <input 
                type="text" 
                class="form-control @error('unit_price') is-invalid @enderror" 
                id="unit_price" 
                name="unit_price" 
                value="{{ old('unit_price', $supplier->unit_price) }}" 
                required
            >
            @error('unit_price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Supplier</button>
        <a href="{{ route('painters.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
    <br>
</div>
@endsection