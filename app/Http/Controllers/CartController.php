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

    public function add($id)
    {
        // Ambil data cart dari session
        $cart = session()->get('cart', []);

        // Tambahkan item ke dalam cart
        if (!in_array($id, $cart)) {
            $cart[] = $id;
        }

        // Simpan kembali data cart ke dalam session
        session()->put('cart', $cart);

        // Redirect ke halaman index cart
        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        // Ambil data cart dari session
        $cart = session()->get('cart', []);

        // Hapus item dari cart
        $cart = array_diff($cart, [$id]);

        // Simpan kembali data cart ke dalam session
        session()->put('cart', $cart);

        // Redirect ke halaman index cart
        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        // Proses checkout bisa diimplementasikan di sini
        // Contoh sederhana, kosongkan session cart setelah checkout
        session()->forget('cart');

        // Redirect ke halaman sukses checkout atau halaman lainnya
        return redirect()->route('cart.index')->with('success_message', 'Checkout berhasil dilakukan!');
    }
}
