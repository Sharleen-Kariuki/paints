{{-- This is the base layout that all pages will extend --}}
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - PaintsCo</title>

<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
  

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">PaintsCo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Dashboard</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="ordersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Orders</a>
                    <ul class="dropdown-menu" aria-labelledby="ordersDropdown">
                        <li><a class="dropdown-item" href="{{ url('admin/orders/online') }}">Online Orders</a></li>
                        <li><a class="dropdown-item" href="{{ url('/physicalOrders') }}">Physical Orders</a></li>
                    </ul>
                <li class="nav-item"><a class="nav-link" href="{{ url('/painters') }}">Painters</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/suppliers') }}">Suppliers</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/settings') }}">Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>


    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <!-- Pickr JS -->
<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
