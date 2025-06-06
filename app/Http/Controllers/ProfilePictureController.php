<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilePictureController extends Controller
{
public function create(Request $request)
{
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:5120',
    ]);

    $user = Auth::user();

    // Simpan ke storage/app/public/profile_pictures
    $path = $request->file('profile_picture')->store('profile_pictures', 'public');

    // Simpan path ke database (tanpa /storage)
    $user->profile_picture = $path;
    $user->save();

    return back()->with('success', 'Profile picture berhasil diunggah.');
}

    public function edit()
    {
        return view('profile.edit');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        if ($user->profile_picture && Storage::exists($user->profile_picture)) {
            Storage::delete($user->profile_picture);
        }

        $user->profile_picture = null;
        $user->save();

        return back()->with('success', 'Profile picture berhasil dihapus.');
    }
}
