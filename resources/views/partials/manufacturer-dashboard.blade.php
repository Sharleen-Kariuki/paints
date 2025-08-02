@extends('layouts.manufacturer')
@section('title', 'Dashboard')

@section('content')
<div class="d-flex min-vh-100">
    {{-- Sidebar --}}
 <div class="bg-dark text-white p-3" style="width: 250px;">
        <h4 class="text-white mb-4">PaintsCo</h4>

        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="#"> Dashboard</a>
            </li>

              <li class="nav-item mt-3">
                <a class="nav-link text-white" href="{{ route('logout') }}">Logout</a>

              
            </li>
        </ul>
    </div>

    {{-- Spacer --}}

    {{-- Main Content --}}
    <div class="flex-grow-1 p-4 bg-light">
        <h3>Welcome to Your Dashboard</h3>
        <p class="text-muted">Use the sidebar to manage your orders and painters.</p>
       
            <div class="col-md-4">
                <a href="{{ url('manufacturer/orders/pending') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Pending Orders</h5>
                            <p class="card-text display-6 text-warning">{{$approvedCount}}</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-4 mt-4">
    <a href="{{ url('manufacturer/materials/index') }}" class="text-decoration-none text-dark">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Materials Needed</h5>
                <p class="card-text display-6 text-warning">{{ $materialsCount ?? 0 }}</p>
            </div>
        </div>
    </a>
</div>
<br>

            <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Completed Orders</h5>
                            <p class="card-text display-6 text-warning">{{$finishedOrdersCount }}</p>
                           
                        </div>
                    </div>
            </div>

        </div>
    </div>
</div>
@endsection
