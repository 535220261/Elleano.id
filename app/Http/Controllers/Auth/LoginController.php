<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses login pengguna
    public function login(Request $request)
    {
        // Validasi input form
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('name', 'password');

        // Coba melakukan autentikasi pengguna
        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil...
            if (auth()->user()->name == 'admin') {
                // Jika user adalah admin, redirect ke dashboard admin
                session()->put('user_name', auth()->user()->name);
                return redirect()->route('admin.dashboard');
                session()->put('user_avatar', auth()->user()->avatar);
            } else {
                // Jika user bukan admin, redirect ke halaman utama
                session()->put('user_name', auth()->user()->name);
                return redirect()->route('home');
            }
        } else {
            // Autentikasi gagal...
            // Periksa apakah user terdaftar atau tidak
            if (!User::where('name', $request->name)->exists()) {
                return back()->with('error', 'User tidak terdaftar.');
            }
            // Jika user terdaftar tapi password salah
            return back()->with('error', 'Nama atau password salah.');
        }
    }

    // Memproses logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Hapus session user_name saat logout
        session()->forget('user_name');
        session()->forget('user_avatar');

        return redirect('/');
    }
}

?>
