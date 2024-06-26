<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $product->product_name }} - Elleano.id</title>

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
            
            <form class="d-flex me-3" action="{{ Auth::check() ? route('cart.index') : route('login') }}" method="get">
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

<style>
    .description-short {
        display: block; /* Menampilkan deskripsi pendek */
        overflow: hidden; /* Memastikan teks yang berlebih tidak terlihat */
        text-overflow: ellipsis; /* Menambahkan titik-titik jika teks terlalu panjang */
        white-space: nowrap; /* Mencegah teks memecah baris */
        max-width: 100%; /* Maksimum lebar teks */
    }
    .description-full {
        display: none; /* Sembunyikan deskripsi lengkap secara default */
        white-space: normal; /* Memungkinkan teks memecah baris */
    }
</style>

<!-- Product Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <!-- Display multiple product images -->
                @if($product->product_images)
                    @foreach(explode(',', $product->product_images) as $image)
                        <img class="card-img-top mb-5 mb-md-0" src="{{ asset('images/' . trim($image)) }}" alt="Product Image" style="width: 100%; height: auto;">
                    @endforeach
                @else
                    <img class="card-img-top mb-5 mb-md-0" src="{{ asset('images/default-product.png') }}" alt="Product Image">
                @endif
            </div>

            <div class="col-md-6">
                <div class="small mb-1">SKU: {{ $product->id }}</div>
                <h1 class="display-5 fw-bolder">{{ $product->product_name }}</h1>
                <div class="fs-5 mb-5">
                    <span>Rp {{ number_format($product->price, 2) }}</span>
                </div>
                <p class="description-short">{{ Str::limit($product->description, 100) }}</p>
                <p class="description-full">{{ $product->description }}</p>
                <button class="btn btn-primary show-more-less">Show More</button>
                <div class="d-flex">
                    <button class="btn btn-outline-dark flex-shrink-0" type="button">
                        <i class="bi-cart-fill me-1"></i>
                        Add to cart
                    </button>
                </div>
            </div>
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

<!-- Bootstrap core JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Core theme JS -->
<script src="{{ asset('js/scripts.js') }}"></script>

<!-- Custom JS for Show More/Less -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showMoreLessBtn = document.querySelector('.show-more-less');
        const descriptionShort = document.querySelector('.description-short');
        const descriptionFull = document.querySelector('.description-full');

        showMoreLessBtn.addEventListener('click', function() {
            if (descriptionShort.style.display === 'none') {
                descriptionShort.style.display = 'inline';
                descriptionFull.style.display = 'none';
                showMoreLessBtn.textContent = 'Show More';
            } else {
                descriptionShort.style.display = 'none';
                descriptionFull.style.display = 'inline';
                showMoreLessBtn.textContent = 'Show Less';
            }
        });
    });
</script>
<!-- Bootstrap core JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
