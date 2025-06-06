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
    $product = Product::findOrFail($id);

    $product->product_name = $request->input('product_name');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->is_new = $request->has('is_new');
    $product->is_popular = $request->has('is_popular');

    // Simpan file gambar jika ada
    if ($request->hasFile('product_images')) {
        // Simpan gambar dan update path-nya sesuai logika kamu
    }

    $product->save();

    return redirect()->back()->with('success', 'Produk berhasil diupdate');
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

    public function allProduct(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('product_name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('sort') && in_array($request->sort, ['low_high', 'high_low'])) {
            $query->orderBy('price', $request->sort === 'low_high' ? 'asc' : 'desc');
        }
    
        $products = $query->get();

        return view('products.all-products', compact('products'));
    }

    public function index(Request $request)
    {
        $query = Product::query();
    
            if ($request->has('search') && $request->search != '') {
        $query->where('product_name', 'LIKE', '%' . $request->search . '%');
    }
    
   if ($request->has('sort') && in_array($request->sort, ['low_high', 'high_low', 'az', 'za'])) {
    if ($request->sort === 'low_high') {
        $query->orderBy('price', 'asc');
    } elseif ($request->sort === 'high_low') {
        $query->orderBy('price', 'desc');
    } elseif ($request->sort === 'az') {
        $query->orderBy('product_name', 'asc');
    } elseif ($request->sort === 'za') {
        $query->orderBy('product_name', 'desc');
    }
}
    
        // Menampilkan produk dengan pagination
        $products = $query->paginate(12);

            if ($request->ajax()) {
        return response()->json([
            'html' => view('partials.products', compact('products'))->render()
        ]);
    }
        return view('products.index', compact('products'));
    }
}    


