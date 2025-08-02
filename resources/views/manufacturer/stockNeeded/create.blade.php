
@extends('layouts.manufacturer')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add Material for Order</h4>
                </div>
                <div class="card-body">
                    <p class="mb-4 text-muted">Create New Order</p>
                    {{-- @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif --}}
                    <form action="{{ url('manufacturer/orders/' . $order_id . '/stockNeeded/store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order_id }}">

                        <div class="mb-3">
                            <label class="form-label" for="order_id">Order ID</label>
                            <input type="text" class="form-control" value="{{ $order_id }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="material_name">Material Name</label>
                            <input type="text" class="form-control" name="material_name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Save</button>
                        <br></br>                             
                        {{-- Back Button --}}
    <div class="mb-3">
        <a href="{{ url('manufacturer/orders/' . $order_id  . '/stockNeeded')  }}" class="btn btn-secondary">Back</a>
    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
