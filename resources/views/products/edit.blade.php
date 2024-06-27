<!-- resources/views/products/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/admin.png') }}">

    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('styles.css') }}" rel="stylesheet">
</head>
<body>

@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <form id="update-product-form" action="{{ route('products.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="product_name">Nama Produk:</label>
    <input type="text" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}" required><br>

    <label for="description">Deskripsi:</label>
    <textarea id="description" name="description" required>{{ old('description', $product->description) }}</textarea><br>

    <label for="price">Harga:</label>
    <input type="text" id="price" name="price" value="{{ old('price', $product->price) }}" required><br>

    <label for="is_new">Produk Baru:</label>
    <input type="checkbox" id="is_new" name="is_new" {{ $product->is_new ? 'checked' : '' }}><br>

    <label for="is_popular">Produk Populer:</label>
    <input type="checkbox" id="is_popular" name="is_popular" {{ $product->is_popular ? 'checked' : '' }}><br>

    <label for="product_images">Unggah Foto:</label><br>
    <input type="file" id="product_images" name="product_images[]" multiple><br>

    <button type="submit">Simpan</button>
</form>

    <script>
    document.getElementById('update-product-form').addEventListener('submit', function(e) {
        alert('Form submitted!');
    });
</script>
</body>
</html>
