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

<header class="bg-white py-10">
    <div class="container mx-auto px-4 text-center">
        
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800">About <img src="{{ asset('images/elleano.png') }}" alt="Elleano Logo" style="height: 200px; width: auto;"></h1>
    </div>
</header>

<section class="about-section">
    <!-- Konten -->
    <div class="about-content">
        <h2>Mengapa Memilih Elleano.id ?</h2>
        <div class="about-text">
            <p>
                <strong>Elleano.id</strong> adalah brand fashion yang mengutamakan kenyamanan dan kesesuaian ukuran untuk wanita bertubuh kecil (petite), dengan fokus menciptakan pakaian yang pas dan nyaman dipakai.
                Elleano.id bercita-cita menjadi destinasi fashion utama bagi wanita petite dengan koleksi yang beragam dan berkualitas tinggi untuk meningkatkan kepercayaan diri dan gaya hidup mereka.
            </p>
            <h4>Gratis Ongkir ke Seluruh Indonesia</h4>
            <p>
                Temukan ratusan produk terbaru hanya di Elleano.id. Ikuti media sosial kami dan kunjungi platform e-commerce kami untuk menikmati berbagai promo menarik seperti gratis ongkir dan diskon cuci gudang.
            </p>
        </div>
    </div>
</section>

@include('layouts.footer')
    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS -->
    <script src="js/scripts.js"></script>
</body>
</html>