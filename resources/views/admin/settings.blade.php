@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Settings</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <!-- resources/views/admin/price-settings.blade.php -->
<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf
    <label>Price per Litre (Ksh):</label>
    <input type="number" name="price" value="{{ $price }}" required>
    <button type="submit">Update</button>
</form>

</div>
@endsection