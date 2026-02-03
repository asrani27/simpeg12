<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorController extends Controller
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    /**
     * Show the 2FA setup page
     */
    public function showSetup()
    {
        $user = Auth::user();

        // Check if 2FA is already enabled
        if ($user->google2fa_enabled) {
            return redirect()->route('profile.index')
                ->with('info', 'Two-Factor Authentication sudah diaktifkan.');
        }

        // Generate new secret key
        $secret = $this->google2fa->generateSecretKey();

        // Store the secret temporarily in session
        session(['google2fa_secret' => $secret]);

        // Generate QR code URL
        $companyName = 'SIMPEG';
        $email = $user->email ?: $user->username;
        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            $companyName,
            $email,
            $secret
        );

        return view('auth.2fa-setup', compact('secret', 'qrCodeUrl'));
    }

    /**
     * Enable 2FA for the user
     */
    public function enable(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ], [
            'code.required' => 'Kode verifikasi wajib diisi',
        ]);

        $user = Auth::user();
        $secret = session('google2fa_secret');

        if (!$secret) {
            return back()->withErrors(['error' => 'Sesi kadaluarsa. Silakan mulai kembali.']);
        }

        // Verify the code
        $valid = $this->google2fa->verifyKey($secret, $request->code);

        if ($valid) {
            // Enable 2FA for the user
            $user->google2fa_secret = $secret;
            $user->google2fa_enabled = true;
            $user->save();

            // Clear the session
            session()->forget('google2fa_secret');

            return redirect()->route('profile.index')
                ->with('success', 'Two-Factor Authentication berhasil diaktifkan.');
        }

        return back()
            ->withInput()
            ->withErrors(['code' => 'Kode verifikasi tidak valid. Silakan coba lagi.']);
    }

    /**
     * Disable 2FA for the user
     */
    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ], [
            'password.required' => 'Password wajib diisi',
        ]);

        $user = Auth::user();

        // Verify password
        if (!password_verify($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password tidak valid.']);
        }

        // Disable 2FA
        $user->google2fa_secret = null;
        $user->google2fa_enabled = false;
        $user->save();

        return redirect()->route('profile.index')
            ->with('success', 'Two-Factor Authentication berhasil dinonaktifkan.');
    }

    /**
     * Show the 2FA verification page after login
     */
    public function showVerification()
    {
        return view('auth.2fa-verify');
    }

    /**
     * Verify 2FA code after login
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ], [
            'code.required' => 'Kode verifikasi wajib diisi',
        ]);

        $user = Auth::user();

        if (!$user->google2fa_secret) {
            return back()->withErrors(['error' => 'Two-Factor Authentication tidak dikonfigurasi.']);
        }

        // Verify the code
        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->code);

        if ($valid) {
            // Mark 2FA as verified in session
            session(['2fa_verified' => true]);

            // Redirect to intended page
            return redirect()->intended(roleUser($user));
        }

        return back()
            ->withInput()
            ->withErrors(['code' => 'Kode verifikasi tidak valid. Silakan coba lagi.']);
    }
}