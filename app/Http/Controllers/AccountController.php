<?php

namespace App\Http\Controllers;

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
    $user->update($request->all());

    return redirect()->back()->with('success', 'Profile updated successfully.');
}

}
