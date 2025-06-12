<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cart | Elleano</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/elleano.png') }}">

    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
    
</head>
<body>

@include('layouts.navbar')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-5">
    <h1 class="mb-5">Your Shopping Cart</h1>
    <div class="row">
        <div class="col-lg-8">
            @if($cart && count($cart) > 0)
                @foreach($cart as $productId => $item)
                    <div class="card mb-4" id="cart-item-{{ $productId }}">
                        <div class="card-body">
                            <div class="row cart-item mb-3">
                                <div class="col-md-3">
                                <img src="{{ asset('images/' . $item['images']) }}" alt="{{ $item['name'] }}" class="img-fluid rounded">
                                </div>
                                <div class="col-md-5">
                                    <h5 class="card-title">{{ $item['name'] }}</h5>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary btn-sm quantity-decrease" data-id="{{ $productId }}" type="button">-</button>
                                        <input style="max-width:100px" type="text" class="form-control form-control-sm text-center quantity-input" data-id="{{ $productId }}" value="{{ $item['quantity'] }}">
                                        <button class="btn btn-outline-secondary btn-sm quantity-increase" data-id="{{ $productId }}" type="button">+</button>
                                    </div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <p class="fw-bold">Rp{{ number_format($item['price'], 2) }}</p>
                                    <button class="btn btn-sm btn-outline-danger remove-item" data-id="{{ $productId }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Keranjangmu masih kosong!</p>
                <br>
                <p>Ayo cari produk Elleano untukmu!</p>
            @endif

            <!-- Continue Shopping Button -->
            <div class="text-start mb-4">
                <a href="{{ route('all-products') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-2"></i>Lihat Semua Produk
                </a>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Cart Summary -->
            @if(session('cart') && count(session('cart')) > 0)
                <div class="card cart-summary">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format(array_sum(array_map(function ($item) {
                                return $item['price'] * $item['quantity'];
                            }, session('cart'))), 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping</span>
                            <span>Rp</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Tax</span>
                            <span>Rp</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Insurance</span>
                            <span>Rp</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total</strong>
                            <strong>Rp{{ number_format(array_sum(array_map(function ($item) {
                                return $item['price'] * $item['quantity'];
                            }, session('cart'))), 2) }}</strong>
                        </div>
                        <button class="btn btn-primary w-100">Proceed to Checkout</button>
                    </div>
                </div>
            @endif

            <!-- Promo Code -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Apply Promo Code</h5>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Enter promo code">
                        <button class="btn btn-outline-secondary" type="button">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

<script>
    $(document).ready(function () {
        // Increase quantity
        $('.quantity-increase').click(function () {
            const id = $(this).data('id');
            let input = $('.quantity-input[data-id="' + id + '"]');
            let qty = parseInt(input.val()) + 1;
            updateQuantity(id, qty);
            input.val(qty);
        });

        // Decrease quantity
        $('.quantity-decrease').click(function () {
            const id = $(this).data('id');
            let input = $('.quantity-input[data-id="' + id + '"]');
            let qty = Math.max(1, parseInt(input.val()) - 1);
            updateQuantity(id, qty);
            input.val(qty);
        });

        // Delete item
        $('.remove-item').click(function () {
            const id = $(this).data('id');
            if (confirm('Yakin ingin menghapus item ini?')) {
                $.post('{{ route("cart.ajaxDelete") }}', {
                    _token: '{{ csrf_token() }}',
                    id: id
                }, function (response) {
                    if (response.success) {
                        location.reload();
                    }
                });
            }
        });

        function updateQuantity(id, qty) {
    $.post('{{ route("cart.ajaxUpdate") }}', {
        _token: '{{ csrf_token() }}',
        id: id,
        quantity: qty
    }, function (response) {
        if (response.success) {
            location.reload(); // <-- Tambahkan ini agar summary ikut update
        }
    });
}
    });
</script>