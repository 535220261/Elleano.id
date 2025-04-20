{{-- resources/views/popular-items.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Elleano Popular Items</title>

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
        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/elleano.png') }}" alt="Logo" style="height: 100px; width: auto;"></a>
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
            <form class="d-flex me-3" action="cart.php" method="get">
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
                    <a href="logout.php" class="btn btn-outline-dark">Logout</a>
                    </div>
                @else
                    <a href="login.php" class="d-flex align-items-center">
                        <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>

<header>
    <div class="container-fluid px-0">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <!-- Tambahkan button sesuai dengan jumlah slide yang Anda miliki -->
            </div>
            <div class="carousel-inner">
                @php
                    $images = [
                        'banner2.jpg',
                        'banner3.jpg',
                        'banner4.jpg',
                    ];
                @endphp
                @foreach ($images as $key => $image)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                        <img src="{{ asset('images/' . $image) }}" class="d-block w-100" style="object-fit: cover; height: 100vh; max-width: 100%;" alt="Slide {{ $key + 1 }}">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</header>

<!-- Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <!-- Form Pencarian dan Sorting -->
        <div class="row mb-4">
            <div class="col-md-6">
                <!-- Form Pencarian -->
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search products...">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-md-end">
                 <!-- Dropdown Sort -->
                 <form action="{{ route('products.index') }}" method="GET" class="d-inline">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sort" value="low_high" id="low_high" {{ request('sort') == 'low_high' ? 'checked' : '' }} onchange="this.form.submit()">
                        <label class="form-check-label" for="low_high">Price: Low to High</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sort" value="high_low" id="high_low" {{ request('sort') == 'high_low' ? 'checked' : '' }} onchange="this.form.submit()">
                        <label class="form-check-label" for="high_low">Price: High to Low</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sort" value="az" id="az" {{ request('sort') == 'az' ? 'checked' : '' }} onchange="this.form.submit()">
                        <label class="form-check-label" for="az">A-Z</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sort" value="za" id="za" {{ request('sort') == 'za' ? 'checked' : '' }} onchange="this.form.submit()">
                        <label class="form-check-label" for="za">Z-A</label>
                    </div>
                </form>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-2 row-cols-lg-4 justify-content-center">
            @foreach ($products as $product)
                @if ($product->is_popular)
                    <div class="col mb-5">
                        <div class="card h-100">
                            @if (!empty($product->badge))
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem;">
                                    {{ $product->badge }}
                                </div>
                            @endif
                            <a href="{{ route('product.show', ['id' => $product->id]) }}">
                                <img class="card-img-top img-fluid" src="{{ asset('images/' . $product->product_images) }}" alt="{{ $product->product_images }}">
                            </a>
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                                    @if (!empty($product->rating))
                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                            @for ($i = 0; $i < $product->rating; $i++)
                                                <div class="bi-star-fill"></div>
                                            @endfor
                                        </div>
                                    @endif
                                    @if (!empty($product->old_price))
                                        <span class="text-muted text-decoration-line-through">Rp {{ $product->old_price }}</span>
                                    @endif
                                    <span>Rp {{ $product->price }}</span>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="{{ route('product.show', ['id' => $product->id]) }}">View Product</a>
                                    <a class="btn btn-outline-dark mt-auto ms-2"
                                       href="{{ Auth::check() ? route('cart.add', ['id' => $product->id]) : route('login') }}"
                                       onclick="{{ Auth::check() ? 'addToCart('.$product->id.')' : 'return false;' }}">
                                        Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <!-- Tombol "Show More" -->
        <div class="text-center mt-4">
            <a href="{{ route('all-products') }}" class="btn btn-primary">Show More</a>
        </div>
    </div>
</section>


<script>
function addToCart(productId) {
    @if (session('user_id'))
        // Jika user sudah login
        window.location.href = 'cart.php?id=' + productId;
    @else
        // Jika user belum login
        alert('Anda harus login terlebih dahulu!');
        window.location.href = '{{ url('/login') }}';
    @endif
}
</script>

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
                    <a href="https://www.tiktok.com/@elleano.id"><img src="{{ asset('images/tiktokshop.png') }}" alt="Logo" style="height: 40px; width: auto;"></a>
                </li>
                <li>
                    <a href="https://www.lazada.co.id/shop/elleano-id"><img src="{{ asset('images/lazada.png') }}" alt="Logo" style="height: 40px; width: auto;"></a>
                </li>
            </ul>
            <h3 class="fs-poppins fs-200 bold-800">Shipping Options</h3>
            <ul>
                <li>
                    <img src="{{ asset('images/JNE.png') }}" alt="Logo" style="height: 40px; width: auto;">
                </li>
                <li>
                    <img src="{{ asset('images/J&T.png') }}" alt="Logo" style="height: 40px; width: auto;">
                </li>
                <li>
                    <img src="{{ asset('images/sicepat.png') }}" alt="Logo" style="height: 40px; width: auto;">
                </li>
                <li>
                    <img src="{{ asset('images/spx.png') }}" alt="Logo" style="height: 40px; width: auto;">
                </li>
            </ul>
        </div>
    </div>

    <div class="contact">
        <h3 class="fs-poppins fs-200 bold-800">Contact Us</h3>
        <p class="fs-montserrat">
            michael.535220261@stu.untar.ac.id <br>
            firzi.535220260@stu.untar.ac.id <br>
            rafael.535220086@stu.untar.ac.id <br>
            +6285217788878 <br>
            Universitas Tarumanagara
        </p>
    </div>

    <form action="/" method="POST" class="emails">
        <h3 class="fs-poppins fs-200 bold-800">Subscribe To Our Email</h3>
        <p class="updates fs-poppins fs-300 bold-800">
            For Latest News & Updates
        </p>
        <div class="inputField flex bg-gray">
            <input type="email" name="email" placeholder="Enter Your Email" class="fs-montserrat bg-gray"/>
        </div>
        <button class="bg-black text-white fs-poppins fs-50">Subscribe</button>
    </form>
</section>

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Elleano.id 2024</p>
    </div>
</footer>


<!-- Bootstrap core JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Core theme JS -->
<script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
