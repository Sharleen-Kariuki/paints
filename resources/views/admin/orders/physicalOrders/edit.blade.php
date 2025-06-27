@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Details</h1>
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
    <form action="{{ route('physicalOrders.update', $physicalOrder->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input 
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                id="name" 
                name="name" 
                value="{{ old('name', $physicalOrder->name) }}" 
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
                value="{{ old('phone', $physicalOrder->phone) }}" 
                required
            >
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
                <div class="mb-3">
            <label for="paintCategory" class="form-label">paintCategory</label>
            <input 
                type="text" 
                class="form-control @error('paintCategory') is-invalid @enderror" 
                id="paintCategory" 
                name="paintCategory" 
                value="{{ old('paintCategory', $physicalOrder->paintCategory) }}" 
                required
            >
            @error('paintCategory')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
         <div class="mb-3">
            <label for="paintType" class="form-label">paintType</label>
            <input 
                type="text" 
                class="form-control @error('paintCategory') is-invalid @enderror" 
                id="paintType" 
                name="paintType" 
                value="{{ old('paintType', $physicalOrder->paintType) }}" 
                required
            >
            @error('paintType')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

                <div class="mb-3">
            <label for="quantity" class="form-label">quantity</label>
            <input 
                type="text" 
                class="form-control @error('quantity') is-invalid @enderror" 
                id="quantity" 
                name="quantity" 
                value="{{ old('quantity', $physicalOrder->quantity) }}" 
                required
            >
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
         <div class="mb-3">
            <label for="capacity" class="form-label">capacity</label>
            <input 
                type="text" 
                class="form-control @error('paintType') is-invalid @enderror" 
                id="capacity" 
                name="capacity" 
                value="{{ old('capacity', $physicalOrder->capacity) }}" 
                required
            >
            @error('capacity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
         <div class="mb-3">
            <label for="paintcolor" class="form-label">paintcolor</label>
            <input 
                type="text" 
                class="form-control @error('paintType') is-invalid @enderror" 
                id="paintcolor" 
                name="paintcolor" 
                value="{{ old('paintcolor', $physicalOrder->paintcolor) }}" 
                required
            >
            @error('paintcolor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
    <label for="needs_painter" class="form-label">Needs Painter</label>
    <select 
        class="form-select @error('needs_painter') is-invalid @enderror" 
        id="needs_painter" 
        name="needs_painter" 
        required
    >
        <option value="yes" {{ old('needs_painter', $physicalOrder->needs_painter) == 'yes' ? 'selected' : '' }}>Yes</option>
        <option value="no" {{ old('needs_painter', $physicalOrder->needs_painter) == 'no' ? 'selected' : '' }}>No</option>
    </select>
    @error('needs_painter')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

         <div class="mb-3">
            <label for="'description'," class="form-label">description</label>
            <input 
                type="text" 
                class="form-control @error('description') is-invalid @enderror" 
                id="description" 
                name="description" 
                value="{{ old('description', $physicalOrder->description) }}" 
                required
            >
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
         

        <button type="submit" class="btn btn-primary">Update Record</button>
        <a href="{{ route('physicalOrders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
    <br>
</div>
@endsection