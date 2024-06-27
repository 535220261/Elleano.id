<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 12 produk terbaru dari database
        $products = Product::take(12)->get();

        // Kirim data produk ke view
        return view('products.index', compact('products'));
    }


    public function admin()
    {
        $products = Product::all();
        return view('admin.admin', compact('products'));
    }

    public function about()
    {
        return view('about');
    }

    public function allProducts()
    {
        // Ambil semua produk dari database
        $products = Product::all();

        // Kirim data produk ke view
        return view('products.all-products', compact('products'));
    }

    public function popularItems()
{
    // Ambil semua produk dari database
    $products = Product::all();

    // Kirim data produk ke view
    return view('products.popular-items', compact('products'));
}

    public function newArrivals()
    {
        // Ambil semua produk dari database
        $products = Product::all();

        // Kirim data produk ke view
        return view('products.new-arrivals', compact('products'));
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showSignupForm()
    {
        return view('auth.signup');
    }
}
