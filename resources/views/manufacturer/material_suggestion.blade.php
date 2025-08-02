@extends('layouts.manufacturer')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Suggested Materials for Order #{{ $order->id }}</h2>

    {{-- Back Button --}}
    <div class="mb-3">
        <a href="{{ url('manufacturer/orders/pending')}}" class="btn btn-secondary">Back</a>
    </div>

    {{-- Error Display --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    @foreach ($materials as $index => $material)
    <form action="{{ route('stockNeeded.store', ['order' => $order->id]) }}" method="POST" class="mb-3 row align-items-center flex-column flex-md-row g-2">
        @csrf

        <div class="col-12 col-md-6">
            <label>Material Name</label>
            <input type="text" name="material_name" value="{{ $material['name'] }}" class="form-control" required>
        </div>

        <div class="col-12 col-md-5">
            <label>Quantity</label>
            <input type="text" name="quantity" value="{{ $material['quantity'] }}" class="form-control" required>
        </div>

        <div class="col-12 col-md-1 text-end">
            <button type="button" class="btn btn-danger btn-sm w-100" onclick="removeMaterialRow(this)">Delete</button>
        </div>
        <div class="col-12 col-md-1 text-end">
            <button type="submit" class="btn btn-success btn-sm w-100">Save</button>
        </div>
    </form>
    @endforeach

    {{-- <div class="text-end">
        <button type="submit" class="btn btn-success w-100 w-md-auto">Save Materials</button>
    </div> --}}
    <br>&nbsp;</br>
    <br>&nbsp;</br>
</div>
<script>
function removeMaterialRow(button) {
    const row = button.closest('.mb-3.row');
    
    row.style.transition = 'opacity 0.3s ease';
    row.style.opacity = '0';
    
    setTimeout(() => {
        row.remove();
    }, 300);
}
</script>
<style>
@media (max-width: 767.98px) {
    .row.align-items-center.flex-column.flex-md-row.g-2 > div {
        margin-bottom: 8px;
    }
    .btn-success.w-100 {
        width: 100%;
    }
}
</style>
@endsection
