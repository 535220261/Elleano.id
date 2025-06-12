<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
 
class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

public function register(Request $request)
{
    $this->validator($request->all())->validate();

    try {
        Log::info('Register Request Data:', $request->all()); // Tambahkan ini

        event(new Registered($user = $this->create($request->all())));
        Auth::login($user);

        return redirect()->route('register')->with('success', 'Registration successful. Please log in.');
    } catch (\Exception $e) {
        Log::error('Registration error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Registration failed.');
    }
}
protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ], [
        'name.unique' => 'The username has already been taken. Please pick another username.',
    ]);
}


protected function create(array $data)
{
    return User::create([
        'name' => $data['name'],
        'password' => \Hash::make($data['password']),
    ]);
}
}

if (request()->has('redirect')) {
    $redirectReason = request()->get('redirect');

    switch ($redirectReason) {
        case 'add-to-cart':
            session()->flash('message', 'Silakan login terlebih dahulu untuk menambahkan produk ke keranjang.');
            break;
        case 'cart':
            session()->flash('message', 'Silakan login terlebih dahulu untuk melihat keranjang.');
            break;
    }
}
