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

@include('layouts.navbar')

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
        <div class="row gx-5">
            <!-- Image Gallery -->
            <div class="col-md-6">
                @php
                    $images = $product->product_images ? explode(',', $product->product_images) : [];
                @endphp

                <!-- Main Image -->
                <div class="mb-3">
                    <img id="main-image" class="img-fluid" src="{{ asset('images/' . trim($images[0] ?? 'default-product.png')) }}" alt="Product Image" style="border: 1px solid #ddd; border-radius: 8px;">
                </div>

                <!-- Thumbnail Images -->
                <div class="d-flex flex-wrap gap-2">
                    @foreach($images as $image)
                        <img src="{{ asset('images/' . trim($image)) }}" alt="Thumbnail"
                             class="img-thumbnail thumb-image"
                             style="width: 70px; height: 70px; object-fit: cover; cursor: pointer;">
                    @endforeach
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-md-6">
                <p class="text-muted mb-1">SKU: {{ $product->id }}</p>
                <h2 class="mb-3">{{ $product->product_name }}</h2>

                <div class="fs-4 fw-bold text-dark mb-3">
                    IDR {{ number_format($product->price, 0, ',', '.') }}
                </div>

                <!-- Short Description -->
                <p class="description-short" style="color: #555;">
                    {!! nl2br(e(Str::limit($product->description, 100))) !!}
                </p>

                <!-- Full Description -->
                <p class="description-full d-none" style="color: #555;">
                    {!! nl2br(e($product->description)) !!}
                </p>

        <button class="btn btn-link text-decoration-underline p-0 mb-3 show-more-less">Show More</button>


                <!-- Add to Cart Button -->
                <div class="d-grid">
                    <button class="btn btn-dark btn-lg rounded-3">
                        <i class="bi bi-cart-fill me-2"></i> Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')

<!-- Bootstrap core JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap core JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Core theme JS -->
<script src="{{ asset('js/scripts.js') }}"></script>

<script>
    document.querySelectorAll('.thumb-image').forEach(img => {
        img.addEventListener('click', function () {
            document.getElementById('main-image').src = this.src;
        });
    });

    document.querySelector('.show-more-less')?.addEventListener('click', function () {
        const fullDesc = document.querySelector('.description-full');
        const shortDesc = document.querySelector('.description-short');

        if (fullDesc.classList.contains('d-none')) {
            fullDesc.classList.remove('d-none');
            shortDesc.classList.add('d-none');
            this.textContent = "Show Less";
        } else {
            fullDesc.classList.add('d-none');
            shortDesc.classList.remove('d-none');
            this.textContent = "Show More";
        }
    });
</script>

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
