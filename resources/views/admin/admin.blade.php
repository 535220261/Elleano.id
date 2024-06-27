<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/admin.png') }}">

    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('styles.css') }}" rel="stylesheet">
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('images/elleano.png') }}" alt="Logo" style="height: 100px; width: auto;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/about') }}">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ url('/all-product') }}">All Products</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('/popular-items') }}">Popular Items</a></li>
                        <li><a class="dropdown-item" href="{{ url('/new-arrival') }}">New Arrivals</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex me-3" action="{{ url('/cart') }}" method="get">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">
                        {{ session()->has('cart') ? count(session('cart')) : 0 }}
                    </span>
                </button>
            </form>
            <div class="d-flex">
                @if (session()->has('user_name'))
                    <div class="d-flex align-items-center">
                        <span class="me-2">Welcome, {{ session('user_name') }}</span>
                        <a href="{{ url('/logout') }}" class="btn btn-outline-dark">Logout</a>
                    </div>
                @else
                    <a href="{{ url('/login') }}" class="d-flex align-items-center">
                        <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>

<style>
    /* Style untuk form create product */
    form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
    }

    form label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }

    form input[type="text"],
    form textarea,
    form input[type="file"] {
        width: calc(100% - 22px); /* adjust for padding */
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    form textarea {
        resize: vertical;
        height: 100px;
    }

    form input[type="checkbox"] {
        margin-right: 10px;
    }

    form button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    form button:hover {
        background-color: #45a049;
    }

    /* Style untuk section daftar produk */
    h1 {
        text-align: center;
        margin-top: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .short-description {
        max-height: 50px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .see-more {
        color: blue;
        cursor: pointer;
        text-decoration: underline;
    }

    .full-description {
        display: none;
    }
</style>

<div class="main-content">
    <div class="create-product-container">
        <h1>Tambah Produk Baru</h1>
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="product_images">Unggah Foto (Maksimal 8):</label><br>
            <input type="file" name="product_images[]" multiple><br>
            <input type="text" name="product_name" placeholder="Nama Produk"><br>
            <textarea name="description" placeholder="Deskripsi Produk"></textarea><br>
            <input type="text" name="price" placeholder="Harga"><br>
            <label><input type="checkbox" name="is_new" value="1"> Produk Baru</label><br>
            <label><input type="checkbox" name="is_popular" value="1"> Produk Populer</label><br>
            <button type="submit">Simpan</button>
        </form>
    </div>
</div>

<hr>

<h2>Daftar Produk</h2>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Produk Baru</th>
            <th>Produk Populer</th>
            <th>Gambar</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ Str::limit($product->description, 50, '...') }}</td>
            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td>{{ $product->is_new ? 'Ya' : 'Tidak' }}</td>
            <td>{{ $product->is_popular ? 'Ya' : 'Tidak' }}</td>
            <td>
                @if ($product->product_images)
                    @foreach (explode(',', $product->product_images) as $image)

                        <img src="{{ asset('images/' . $product->product_images) }}" alt="{{ $product->product_images }}" width="100">
                    @endforeach
                @else
                    No Image
                @endif
            </td>
            <td>
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
</form>
                <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    function toggleDescription(id) {
        var shortDescription = document.getElementById('short-' + id);
        var fullDescription = document.getElementById('full-' + id);
        var seeMore = document.getElementById('see-more-' + id);

        if (shortDescription.style.display === 'none') {
            shortDescription.style.display = 'block';
            fullDescription.style.display = 'none';
            seeMore.innerText = 'lihat selengkapnya';
        } else {
            shortDescription.style.display = 'none';
            fullDescription.style.display = 'block';
            seeMore.innerText = 'lihat lebih sedikit';
        }
    }
</script>

</body>
</html>
