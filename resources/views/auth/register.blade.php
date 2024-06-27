{{-- signup.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register Account | Elleano Fashion Wears</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/elleano.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
    <link href="{{ asset('login.css') }}" rel="stylesheet">
</head>
<body>

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
            <form class="d-flex me-3" action="/cart" method="get">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </button>
            </form>
            <div class="d-flex">
                @if (session('user_name'))
                    <div class="d-flex align-items-center">
                        <a href="account.php" class="me-2">Welcome, {{ session('user_name') }}</a>
                        <a href="{{ route('logout') }}" class="btn btn-outline-dark"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
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

<!-- Form Register -->
<div class="main-content">
    <div class="login-container">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <h1>Signup</h1>
            <input placeholder="Name" name="name" type="text" required>
            <br>
            <input placeholder="Password" name="password" type="password" required>
            <br>
            <input placeholder="Confirm Password" name="password_confirmation" type="password" required>
            <br>
            <button type="submit" class="sub">Sign Up</button>
            <h6>Already have an account?</h6>
            <a href="{{ route('login') }}">Login</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('.alert-message')) {
        alert(document.querySelector('.alert-message').innerText);
    }
});
</script>

<!-- Displaying Session Messages -->
@if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif

@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
            alert("{{ $error }}");
        @endforeach
    </script>
@endif

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
        window.location.href = "{{ route('login') }}";
    </script>
@endif

</body>
</html>
