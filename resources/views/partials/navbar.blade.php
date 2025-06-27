<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">PaintsCo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#hero">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#about">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#products">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#contact">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
