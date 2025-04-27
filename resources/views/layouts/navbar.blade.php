<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/elleano.png') }}" alt="Logo" style="height: 100px; width: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('all-products') }}">All Products</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('popular-items') }}">Popular Items</a></li>
                        <li><a class="dropdown-item" href="{{ route('new-arrivals') }}">New Arrivals</a></li>
                    </ul>
                </li>
            </ul>
            
            <div class="d-flex me-3">
    @if (Auth::check())
        <a href="{{ route('cart.index') }}" class="btn btn-outline-dark">
            <i class="bi-cart-fill me-1"></i>
            Cart
            <span class="badge bg-dark text-white ms-1 rounded-pill">
                {{ session('cart') ? count(session('cart')) : 0 }}
            </span>
        </a>
    @else
        <a href="{{ route('login') }}" class="btn btn-outline-dark">
            <i class="bi-cart-fill me-1"></i>
            Cart
            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
        </a>
    @endif
</div>


            <div class="d-flex">
                @if (session('user_name'))
                    <div class="d-flex align-items-center">
                        <a href="{{ route('account') }}" class="me-2">Welcome, {{ session('user_name') }}</a>
                        <a href="{{ route('logout') }}" class="btn btn-outline-dark"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                @else
                    <a href="{{ route('register') }}" class="d-flex align-items-center">
                        <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>