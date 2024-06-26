<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'is_new' => 'nullable|boolean',
            'is_popular' => 'nullable|boolean',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->is_new = $request->has('is_new');
        $product->is_popular = $request->has('is_popular');
    
        if ($request->hasFile('product_images')) {
            $images = [];
            foreach ($request->file('product_images') as $file) {
                $filename = $file->getClientOriginalName(); // Simpan nama file asli
                // Atau tambahkan timestamp atau metode lain sesuai kebutuhan
                // $filename = time() . '_' . $file->getClientOriginalName();
                
                // Lakukan penyimpanan file ke direktori yang diinginkan
                $file->storeAs('public/images', $filename);
                
                $images[] = $filename; // Simpan nama file ke dalam array
            }
            $product->product_images = implode(',', $images); // Simpan nama-nama file ke dalam kolom product_images
        }
    
        $product->save();
    
        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil ditambahkan');
    }

public function update(Request $request, $id)
{
    // Validasi input
    $validatedData = $request->validate([
        'product_name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'is_new' => 'nullable|boolean',
        'is_popular' => 'nullable|boolean',
        'product_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    try {
        // Cari produk berdasarkan ID, jika tidak ditemukan, lempar exception
        $product = Product::findOrFail($id);

        // Update data produk
        $product->product_name = $validatedData['product_name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->is_new = $request->has('is_new');
        $product->is_popular = $request->has('is_popular');

        // Proses gambar baru jika ada
        if ($request->hasFile('product_images')) {
            $images = [];
            foreach ($request->file('product_images') as $file) {
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/images', $filename);
                $images[] = $filename;
            }

            // Hapus gambar lama sebelum menyimpan gambar yang baru
            $this->deleteOldImages($product);

            // Simpan nama-nama file baru ke dalam kolom product_images
            $product->product_images = implode(',', $images);
        }

        // Simpan perubahan
        $product->save();

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil diperbarui.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal memperbarui produk. Error: ' . $e->getMessage());
    }
}


    public function destroy(Product $product)
    {
        // Hapus gambar terkait sebelum menghapus produk
        $this->deleteOldImages($product);
        
        $product->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil dihapus.');
    }

    private function deleteOldImages(Product $product)
    {
        if ($product->product_images) {
            $images = explode(',', $product->product_images);
            foreach ($images as $image) {
                Storage::delete('public/images/' . $image);
            }
        }
    }

    public function show($id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            abort(404, 'Product not found');
        }
    
        return view('products.product', ['product' => $product]);
    }

    public function allProduct()
    {
        $products = Product::all();
        return view('products.all-products', compact('products'));
    }
}
