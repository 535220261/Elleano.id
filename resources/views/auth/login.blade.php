<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tag untuk pengaturan tampilan dan karakter -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Judul halaman -->
    <title>Login Account | Elleano Fashion Wears</title>
    <!-- Favicon (ikon tab browser) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/elleano.png') }}">
    <!-- Font dan ikon Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Stylesheet kustom -->
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
    <link href="{{ asset('login.css') }}" rel="stylesheet">
    <!-- Include Bootstrap CSS untuk modal -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navigasi -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <!-- Logo di bagian kiri navigasi -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/elleano.png') }}" alt="Logo" style="height: 100px; width: auto;">
        </a>
        <!-- Tombol toggle untuk responsif pada layar kecil -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Daftar menu navigasi -->
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
            <!-- Form untuk tombol keranjang belanja -->
            <form class="d-flex me-3" action="/cart" method="get">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </button>
            </form>
            <!-- Area untuk informasi login pengguna -->
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
                    <!-- Tombol untuk registrasi jika pengguna belum login -->
                    <a href="{{ route('register') }}" class="d-flex align-items-center">
                        <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>

<div class="main-content">
    <div class="login-container">
        <!-- Form login -->
        <form action="{{ route('login') }}" method="post">
            @csrf
            <h1>Login</h1>
            <input placeholder="Name" name="name" type="text" required>
            <br>
            <input placeholder="Password" name="password" type="password" required>
            <br>
            <button type="submit" class="sub">Login</button>
            <h6>Don't have an account?</h6>
            <a href="{{ route('register') }}">Create a new account</a>
        </form>
    </div>
</div>

<!-- Modal untuk pesan kesalahan saat login -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Judul modal -->
                <h5 class="modal-title" id="errorModalLabel">Login Error</h5>
                <!-- Tombol untuk menutup modal -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Bagian tubuh modal untuk menampilkan pesan kesalahan -->
                {{ session('error') }}
            </div>
            <div class="modal-footer">
                <!-- Tombol untuk menutup modal -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<section class="footer flex">
    <div class="footer-logo">
        <!-- Deskripsi tentang Elleano.id -->
        <img src="{{ asset('images/elleano.png') }}" alt="Logo" style="height: 200px; width: auto;">
        <p class="fs-montserrat fs-200">
            Elleano.id adalah merek fashion yang memprioritaskan kenyamanan dan kecocokan untuk wanita mungil dengan fokus pada pembuatan pakaian yang nyaman dan sesuai. Elleano.id berambisi menjadi destinasi fashion utama bagi wanita mungil, menyediakan koleksi yang beragam dan berkualitas tinggi untuk meningkatkan kepercayaan diri dan gaya hidup mereka.
        </p>
    </div>

    <div class="social-icons">
        <div class="social-media">
            <!-- Ikonsosial media -->
            <h3>Our Social Media</h3>
            <a href="https://www.tiktok.com/@elleano.id"><img src="images/tiktok.png" alt="Logo" style="height: 60px; width: auto;"></a>
            <a href="https://www.instagram.com/elleano.id?igsh=MXByZXFuYjM5MWd4cQ=="><img src="images/instagram.png" alt="Logo" style="height: 60px; width: auto;"></a>
        </div>

        <div class="footer-menu">
            <!-- Menu footer dengan link ke toko resmi -->
            <h3 class="fs-poppins fs-200 bold-800">Official Store</h3>
            <ul>
                <li>
                    <a href="https://shopee.co.id/elleano.id"><img src="images/shopee.png" alt="Logo" style="height: 40px; width: auto;"></a>
                </li>
                <li>
                    <a href="https://www.tokopedia.com/elleanowears"><img src="images/tokopedia.png" alt="Logo" style="height: 40px; width: auto;"></a>
                </li>
                <li>
                    <a href="https://www.tiktok.com/@elleano.id"><img src="images/tiktokshop.png" alt="Logo" style="height: 40px; width: auto;"></a>
                </li>
                <li>
                    <a href="https://www.lazada.co.id/shop/elleano-id"><img src="images/lazada.png" alt="Logo" style="height: 40px; width: auto;"></a>
                </li>
            </ul>
            <!-- Pilihan pengiriman yang tersedia -->
            <h3 class="fs-poppins fs-200 bold-800">Shipping Options</h3>
            <ul>
                <li>
                    <img src="images/JNE.png" alt="Logo" style="height: 40px; width: auto;">
                </li>
                <li>
                    <img src="images/J&T.png" alt="Logo" style="height: 40px; width: auto;">
                </li>
                <li>
                    <img src="images/sicepat.png" alt="Logo" style="height: 40px; width: auto;">
                </li>
                <li>
                    <img src="images/spx.png" alt="Logo" style="height: 40px; width: auto;">
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
        <!-- Form untuk berlangganan email -->
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('.alert-message')) {
        alert(document.querySelector('.alert-message').innerText);
    }
});
</script>
<!-- Include jQuery dan Bootstrap JS untuk modal -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

@if (session('error'))
    <!-- Script untuk menampilkan modal jika terdapat pesan kesalahan -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#errorModal').modal('show');
        });
    </script>
@endif
</body>
</html>
