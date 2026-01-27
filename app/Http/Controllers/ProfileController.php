<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile page.
     */
    public function index()
    {
        return view('profile.index');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {

        // Validate input
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi',
            'password.required' => 'Password baru wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        $user = $request->user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini salah.'
            ])->withInput();
        }

        // Update password using direct database query to avoid model cast issues
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'password' => Hash::make($request->password),
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Password berhasil diubah!');
    }

    /**
     * Update the user's profile photo.
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => ['required', 'image', 'max:2048'], // Max 2MB
        ]);

        $user = $request->user();

        // Delete old photo if exists
        if ($user->profile_photo && Storage::exists('public/profile_photos/' . $user->profile_photo)) {
            Storage::delete('public/profile_photos/' . $user->profile_photo);
        }

        // Store new photo
        $photoName = time() . '_' . $request->file('profile_photo')->getClientOriginalName();
        $request->file('profile_photo')->storeAs('public/profile_photos', $photoName);

        $user->update([
            'profile_photo' => $photoName,
        ]);

        return back()->with('success', 'Foto profil berhasil diubah!');
    }
}
