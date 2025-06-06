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
@include('layouts.navbar')

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
                                <button id="addToCartBtn"
        class="btn btn-outline-dark flex-shrink-0"
        type="button"
        data-product-id="{{ $product->id }}">
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

    @include('layouts.footer')
    
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
                fullDesc.style.display = ('none');
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
