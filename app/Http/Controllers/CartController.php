<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    // Menampilkan halaman keranjang
    public function index()
    {
        $cart = session('cart', []);
        return view('products.cart', compact('cart'));
    }

    // Menambahkan produk ke dalam cart
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);

        // Ambil string product_images, lalu explode menjadi array
        $imagesString = $product->product_images;
        $imagesArray  = $imagesString 
            ? explode(',', $imagesString) 
            : [];

        // Ambil elemen pertama, atau fallback ke default.jpg
        $firstImage = count($imagesArray) 
            ? trim($imagesArray[0]) 
            : 'default.jpg';

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name'     => $product->product_name,
                'price'    => $product->price,
                'quantity' => 1,
                'images'   => $firstImage,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }
    public function ajaxDelete(Request $request)
{
    $cart = session()->get('cart', []);
    $id = $request->id;

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 400);
}

public function ajaxUpdate(Request $request)
{
    $cart = session()->get('cart', []);
    $id = $request->id;
    $quantity = $request->quantity;

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] = max(1, (int)$quantity); // minimal qty = 1
        session()->put('cart', $cart);
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 400);
}

}