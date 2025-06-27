@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Painter</h1>
    <form action="{{ route('painters.update', $painter->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input 
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                id="name" 
                name="name" 
                value="{{ old('name', $painter->name) }}" 
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
                value="{{ old('phone', $painter->phone) }}" 
                required
            >
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

                <div class="mb-3">
            <label for="national_id" class="form-label">National_ID</label>
            <input 
                type="text" 
                class="form-control @error('national_id') is-invalid @enderror" 
                id="national_id" 
                name="National_ID" 
                value="{{ old('national_id', $painter->National_ID) }}" 
                required
            >
            @error('national_id')
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
                value="{{ old('address', $painter->address) }}" 
                required
            >
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Painter</button>
        <a href="{{ route('painters.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
    <br>
</div>
@endsection