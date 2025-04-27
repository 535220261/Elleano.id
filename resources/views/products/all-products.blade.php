<!-- resources/views/all-product.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>All Products Elleano</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/elleano.png') }}">

    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
</head>
<body>

@include('layouts.navbar')
 
<!-- Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <!-- Form Pencarian dan Sorting -->
        <div class="row mb-4">
            <div class="col-md-6">
                <!-- Form Pencarian -->
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari Produk...">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
                @if($products->isEmpty())
    <div class="text-center py-5">
        <h5 class="text-muted">Produk tidak ditemukan 😥</h5>
        <p>Coba gunakan kata kunci lain atau filter yang berbeda.</p>
    </div>
@endif
            </div>
            <div class="col-md-6 text-md-end">
                 <!-- Dropdown Sort -->
                 <form action="{{ route('products.index') }}" method="GET" class="d-inline">
    <input type="hidden" name="search" value="{{ request('search') }}">
    <select name="sort" class="form-select d-inline w-auto" onchange="this.form.submit()">
        <option disabled {{ request('sort') ? '' : 'selected' }}>Sort by</option>
        <option value="low_high" {{ request('sort') == 'low_high' ? 'selected' : '' }}>Price: Low to High</option>
        <option value="high_low" {{ request('sort') == 'high_low' ? 'selected' : '' }}>Price: High to Low</option>
        <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>A-Z</option>
        <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Z-A</option>
    </select>
</form>
            </div>
        </div>

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-2 row-cols-lg-4 justify-content-center">
            @foreach ($products as $product)
                <div class="col mb-5">
                    <div class="card h-100">
                        @if (!empty($product->badge))
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem;">
                                {{ $product->badge }}
                            </div>
                        @endif
                        <a href="{{ route('product.show', $product->id) }}">
                            <img class="card-img-top img-fluid" src="{{ asset('images/' . $product->product_images) }}" alt="...">
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
                                <a class="btn btn-outline-dark mt-auto" href="{{ route('product.show', $product->id) }}">View options</a>
                                <a class="btn btn-outline-dark mt-auto ms-2" href="#" onclick="addToCart({{ $product->id }})">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@include('layouts.footer')

<!-- Bootstrap core JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Core theme JS -->
<script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
