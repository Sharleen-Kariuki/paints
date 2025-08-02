<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}" style="font-size:2rem; font-weight:bold; background: linear-gradient(90deg, #000000 20%, #0026b1 80%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; color: transparent;">
            PaintsCo
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: #36c1e0; background: linear-gradient(90deg, #0d1a4a 0%, #36c1e0 100%);">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav" >
            <ul class="navbar-nav ms-auto position-relative" id="navbarMenu" >
                <style>
                    .navbar-nav .nav-item .nav-link:hover,
                    .navbar-nav .nav-item.active .nav-link {
                        color: #ce0000 !important;
                        background-color: transparent;
                        transition: color 0.2s;
                    }
                    .navbar-nav .nav-item .nav-link {
                        position: relative;
                    }
                    .navbar-nav .nav-item.active .nav-link::after {
                        content: '';
                        display: block;
                        position: absolute;
                        left: 0;
                        bottom: -2px;
                        width: 100%;
                        height: 3px;
                        background: #ce0000;
                        border-radius: 2px;
                        transition: left 0.3s, width 0.3s;
                    }
                </style>
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}#hero" style="font-size:20px; color:#000000; font-weight:bold;">Home</a>
                </li>
                <li class="nav-item {{ Request::is('/') && Str::contains(request()->getRequestUri(), '#about') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}#about" style="font-size:20px;  color:#000000; font-weight:bold;">About Us</a>
                </li>
                <li class="nav-item {{ Request::is('/') && Str::contains(request()->getRequestUri(), '#products') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}#products" style="font-size:20px;  color:#000000; font-weight:bold;">Products</a>
                </li>
                <li class="nav-item {{ Request::is('/') && Str::contains(request()->getRequestUri(), '#contact') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}#contact" style="font-size:20px;  color:#000000; font-weight:bold;">Contact Us</a>
                </li>
                @if (!Request::is('dashboard'))
                    <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/login') }}" style="font-size:20px;  color:#000000; font-weight:bold;">Sign in</a>
                    </li>
                @endif
                @if (Request::is('dashboard'))
                    <li class="nav-item {{ Request::is('mycart') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/mycart') }}" style="font-size:20px; color:#ffffff; font-weight:bold;">My Orders</a>
                    </li>
                    <li class="nav-item {{ Request::is('logout') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/logout') }}" style="font-size:20px; color:#ffffff; font-weight:bold;">Logout</a>
                    </li>
                @endif
            </ul>
            <script>
                // Move active class on click
                document.querySelectorAll('#navbarMenu .nav-link').forEach(function(link) {
                    link.addEventListener('click', function() {
                        document.querySelectorAll('#navbarMenu .nav-item').forEach(function(item) {
                            item.classList.remove('active');
                        });
                        this.parentElement.classList.add('active');
                    });
                });
            </script>
        </div>
    </div>
</nav>
