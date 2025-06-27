@extends('layouts.admin')
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

            <li class="nav-item mb-1 d-none d-md-block">
                <strong class="text-uppercase small text-secondary">Orders</strong>
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{url('admin/orders/online')}}">Online Orders </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{url('/physicalOrders')}}">Physical Orders</a>
                    </li>
                </ul>
            </li>

          
            <li class="nav-item mt-3">
                <a class="nav-link text-white" href="{{url ('/painters')}}"> Painters</a>
            </li>
            <li class="nav-item mt-3">
                <a class="nav-link text-white" href="{{ url('/suppliers') }}">Suppliers</a>

              
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

       
        <div class="row mt-4">
            <div class="col-md-4">
                <a href="{{ url('admin/orders/online') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Online Orders</h5>
                            <p class="card-text display-6">{{$orderscount}}</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ url('/physicalOrders') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Physical Orders</h5>
                            <p class="card-text display-6">{{$physicalcount}}</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ url('admin/orders/approved') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Approved Orders</h5>
                            <p class="card-text display-6">{{$approvedCount}}</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ url('admin/orders/pending') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Pending Orders</h5>
                            <p class="card-text display-6">{{ $pendingCount}}</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ url('admin/orders/declined') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Declined Orders</h5>
                            <p class="card-text display-6">{{$declinedCount}}</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ url('/painters') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Available Painters</h5>
                            <p class="card-text display-6">{{$painterscount}}</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ url('/suppliers') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">My Suppliers</h5>
                            <p class="card-text display-6">{{$supplierscount}}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
            
        </div>
    </div>
</div>
@endsection
