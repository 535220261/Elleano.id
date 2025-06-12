<!-- resources/views/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Elleano Fashion Wears</title>

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
                        <a href="{{ route('product.show', ['id' => $product->id]) }}">
                            <img class="card-img-top img-fluid" src="{{ asset('images/' . $product->product_images) }}" alt="{{ $product->product_images }}">
                        </a>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                                <span>Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="{{ route('product.show', ['id' => $product->id]) }}">View Product</a>
                                <!-- Tombol “Add to cart” dengan pengecekan login -->
@if (Auth::check())
    <a class="btn btn-outline-dark mt-auto ms-2"
       href="{{ route('cart.add', ['productId' => $product->id]) }}">
        Add to cart
    </a>
@else
    <a class="btn btn-outline-dark mt-auto ms-2"
       href="{{ route('login', ['redirect' => urlencode(route('cart.add', ['productId' => $product->id])) ]) }}">
        Add to cart
    </a>
@endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tombol "Show More" -->
        <div class="text-center mt-4">
            <a href="{{ route('all-products') }}" class="btn btn-primary">Show More</a>
        </div>
    </div>
</section>

@include('layouts.footer')

<script>
function addToCart(productId) {
    @auth
        // Kirim request untuk menambahkan produk ke cart
        fetch(`{{ url('cart/add') }}/${productId}`)
            .then(response => response.json())
            .then(data => {
                alert(data.success);
                // Anda bisa menambahkan pembaruan UI di sini jika diperlukan
            })
            .catch(error => alert('Terjadi kesalahan.'));
    @else
        // Jika user belum login
        alert('Anda harus login terlebih dahulu!');
        window.location.href = "{{ route('login') }}";
    @endauth
}
</script>

</body>
</html>