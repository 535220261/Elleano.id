<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $product->product_name }} - Elleano Fashion Wears</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/elleano.png') }}">

    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
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

    <!-- Product section -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-start">
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0" src="{{ asset('images/' . $product->product_image) }}" alt="{{ $product->product_name }}">
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-column">
                        <h1 class="display-5 fw-bolder">{{ $product->product_name }}</h1>
                        <p class="display-5 fw-bolder">
                            @if (!empty($product->old_price))
                                <span class="text-decoration-line-through">Rp {{ $product->old_price }}</span>
                            @endif
                            <span>Rp {{ $product->price }}</span>
                        </p>
                        <p class="lead">
                            <span class="description-short">{{ Str::limit($product->description, 100) }}...</span>
                            <span class="description-full" style="display: none;">{{ $product->description }}</span>
                            <button class="btn btn-link p-0" id="showMoreBtn">Lihat Selengkapnya</button>
                        </p>
                        <div class="d-flex">
                            <input id="inputQuantity" class="form-control text-center me-3" type="number" value="1" min="1" style="max-width: 3rem">
                            <button id="addToCartBtn" class="btn btn-outline-dark flex-shrink-0" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related items section -->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <!-- Here you can add code to display related products if needed -->
            </div>
        </div>
    </section>

    <section class="footer flex">
        <div class="footer-logo">
            <img src="{{ asset('images/elleano.png') }}" alt="Logo" style="height: 200px; width: auto;">
            <p class="fs-montserrat fs-200">
                Elleano.id is a fashion brand that prioritizes comfort and fit for petite women with a focus on creating clothes that are both snug and comfortable. Elleano.id aspire to become the ultimate fashion destination for petite women, providing a diverse and high-quality collection to enhance their confidence and lifestyle.
            </p>
        </div>

        <div class="social-icons">
            <div class="social-media">
                <h3>Our Social Media</h3>
                <a href="https://www.tiktok.com/@elleano.id"><img src="{{ asset('images/tiktok.png') }}" alt="Logo" style="height: 60px; width: auto;"></a>
                <a href="https://www.instagram.com/elleano.id?igsh=MXByZXFuYjM5MWd4cQ=="><img src="{{ asset('images/instagram.png') }}" alt="Logo" style="height: 60px; width: auto;"></a>
            </div>

            <div class="footer-menu">
                <h3 class="fs-poppins fs-200 bold-800">Official Store</h3>
                <ul>
                    <li>
                        <a href="https://shopee.co.id/elleano.id"><img src="{{ asset('images/shopee.png') }}" alt="Logo" style="height: 40px; width: auto;"></a>
                    </li>
                    <li>
                        <a href="https://www.tokopedia.com/elleanowears"><img src="{{ asset('images/tokopedia.png') }}" alt="Logo" style="height: 40px; width: auto;"></a>
                    </li>
                    <li>
                        <a href="https://www.zalora.co.id/catalog/?q=elleano"><img src="{{ asset('images/zalora.png') }}" alt="Logo" style="height: 40px; width: auto;"></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS -->
    <script src="{{ asset('js/scripts.js') }}"></script>

    <script>
        document.getElementById('showMoreBtn').addEventListener('click', function() {
            var shortDesc = document.querySelector('.description-short');
            var fullDesc = document.querySelector('.description-full');
            if (fullDesc.style.display === 'none') {
                fullDesc.style.display = 'inline';
                shortDesc.style.display = 'none';
                this.textContent = 'Lihat Lebih Sedikit';
            } else {
                fullDesc.style.display = 'none');
                shortDesc.style.display = 'inline';
                this.textContent = 'Lihat Selengkapnya';
            }
        });

        document.getElementById('addToCartBtn').addEventListener('click', function() {
            var quantity = document.getElementById('inputQuantity').value;
            var productId = {{ $product->id }};
            // AJAX request to add product to cart
            fetch('/cart/add/' + productId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: quantity })
            }).then(response => {
                if (response.ok) {
                    alert('Product added to cart!');
                } else {
                    alert('Failed to add product to cart.');
                }
            });
        });
    </script>
</body>
</html>
