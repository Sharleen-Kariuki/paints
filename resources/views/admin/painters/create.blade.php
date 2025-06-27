@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Add Painter</h2>
    <form action="{{ route('painters.store') }}" method="POST">
       @csrf
<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $painter->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Phone</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $painter->phone ?? '') }}" required>
</div>
<div class="mb-3">
    <label>National_ID</label>
    <input type="text" name="National_ID" class="form-control" value="{{ old('National_ID', $painter->email ?? '') }}">
</div>
<div class="mb-3">
    <label>Address</label>
    <input type="text" name="address" class="form-control" value="{{ old('address', $painter->address ?? '') }}">
</div>

<button type="submit" class="btn btn-success">Save</button>

    </form>
    <br>
</div>
@endsection