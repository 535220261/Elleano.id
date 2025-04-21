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

@include('layouts.navbar')
@include('layouts.header')

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
