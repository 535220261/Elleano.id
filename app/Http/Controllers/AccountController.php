<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('profile/profile');
    }

    public function update(Request $request)
{
    $request->validate([
        'username' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'location' => 'nullable',
        'email' => 'required|email',
        'phone' => 'nullable',
        'birthday' => 'nullable|date',
    ]);

    $user = Auth::user();
    $user->update($request->only([
    'username', 'first_name', 'last_name', 'location', 'email', 'phone', 'birthday'
]));

    return redirect()->back()->with('success', 'Profile updated successfully.');
}
public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password successfully updated.');
}

}
