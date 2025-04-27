<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function index()
    {
        // Ambil data cart dari session
        $cartItems = session()->get('cart', []);

        // Kirim data ke view
        return view('products.cart', compact('cartItems'));
    }

    public function addItem(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id', // validasi produk yang ada
            'quantity' => 'required|integer|min:1'
        ]);
    
        $cartItem = CartItem::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $request->product_id
            ],
            [
                'quantity' => \DB::raw("quantity + {$request->quantity}")
            ]
        );
    
        return response()->json($cartItem, 201);
    }
    public function viewCart()
    {
        $cartItems = CartItem::with('product')->where('user_id', auth()->id())->get();
        return response()->json($cartItems);
    }
    public function updateItem(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
    
        $cartItem = CartItem::where('user_id', auth()->id())->where('id', $id)->first();
    
        if (!$cartItem) {
            return response()->json(['message' => 'Item not found'], 404);
        }
    
        $cartItem->quantity = $request->quantity;
        $cartItem->save();
    
        return response()->json($cartItem);
    }
    public function removeItem($id)
    {
        $cartItem = CartItem::where('user_id', auth()->id())->where('id', $id)->first();
    
        if (!$cartItem) {
            return response()->json(['message' => 'Item not found'], 404);
        }
    
        $cartItem->delete();
    
        return response()->json(['message' => 'Item removed']);
    }
                
}
