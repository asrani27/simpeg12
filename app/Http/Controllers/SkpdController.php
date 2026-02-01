<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Skpd;
use App\Models\User;
use Illuminate\Http\Request;

class SkpdController extends Controller
{
    /**
     * Display a listing of SKPD.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $skpds = Skpd::with('user')
            ->latest()
            ->paginate(10);

        return view('superadmin.skpd.index', compact('skpds'));
    }

    /**
     * Show the form for creating a new SKPD.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('superadmin.skpd.create');
    }

    /**
     * Store a newly created SKPD in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_skpd' => 'required|string|max:50|unique:skpd',
            'nama' => 'required|string|max:255',
            'is_aktif' => 'sometimes|boolean',
        ]);

        Skpd::create([
            'kode_skpd' => $request->kode_skpd,
            'nama' => $request->nama,
            'is_aktif' => $request->has('is_aktif') ? 1 : 0,
        ]);

        return redirect()
            ->route('superadmin.skpd.index')
            ->with('success', 'SKPD berhasil ditambahkan');
    }

    /**
     * Display the specified SKPD.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $skpd = Skpd::with('user', 'pegawai')->findOrFail($id);
        return view('superadmin.skpd.show', compact('skpd'));
    }

    /**
     * Show the form for editing the specified SKPD.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $skpd = Skpd::with('user')->findOrFail($id);
        return view('superadmin.skpd.edit', compact('skpd'));
    }

    /**
     * Update the specified SKPD in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $skpd = Skpd::findOrFail($id);

        $request->validate([
            'kode_skpd' => 'required|string|max:50|unique:skpd,kode_skpd,' . $skpd->id,
            'nama' => 'required|string|max:255',
            'is_aktif' => 'sometimes|boolean',
        ]);

        $skpd->update([
            'kode_skpd' => $request->kode_skpd,
            'nama' => $request->nama,
            'is_aktif' => $request->has('is_aktif') ? 1 : 0,
        ]);

        return redirect()
            ->route('superadmin.skpd.index')
            ->with('success', 'SKPD berhasil diperbarui');
    }

    /**
     * Remove the specified SKPD from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $skpd = Skpd::findOrFail($id);
        $skpd->delete();

        return redirect()
            ->route('superadmin.skpd.index')
            ->with('success', 'SKPD berhasil dihapus');
    }

    /**
     * Show the form for creating a new user for the specified SKPD.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function showCreateUser($id)
    {
        $skpd = Skpd::findOrFail($id);
        
        if ($skpd->user_id) {
            return redirect()
                ->route('superadmin.skpd.index')
                ->with('error', 'SKPD ini sudah memiliki user');
        }
        
        return view('superadmin.skpd.create-user', compact('skpd'));
    }

    /**
     * Create a new user for the specified SKPD.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(Request $request)
    {
        $request->validate([
            'skpd_id' => 'required|exists:skpd,id',
            'user_name' => 'required|string|max:255',
            'user_username' => 'required|string|max:255|unique:users,username',
            'user_email' => 'required|email|max:255|unique:users,email',
            'user_password' => 'required|string|min:8',
        ]);

        $skpd = Skpd::findOrFail($request->skpd_id);

        if ($skpd->user_id) {
            return redirect()
                ->route('superadmin.skpd.index')
                ->with('error', 'SKPD ini sudah memiliki user');
        }

        $user = User::create([
            'name' => $request->user_name,
            'username' => $request->user_username,
            'email' => $request->user_email,
            'password' => bcrypt($request->user_password),
            'admin_layanan' => false,
        ]);

        // Sync role 'skpd' to the user
        $role = Role::where('name', 'skpd')->first();
        if ($role) {
            $user->roles()->sync([$role->id]);
        }

        $skpd->update([
            'user_id' => $user->id,
        ]);

        return redirect()
            ->route('superadmin.skpd.index')
            ->with('success', 'User berhasil dibuat untuk SKPD ' . $skpd->nama);
    }

    /**
     * Reset password for the SKPD's user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'skpd_id' => 'required|exists:skpd,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $skpd = Skpd::findOrFail($request->skpd_id);

        if (!$skpd->user) {
            return redirect()
                ->route('superadmin.skpd.index')
                ->with('error', 'SKPD ini tidak memiliki user');
        }

        $skpd->user->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()
            ->route('superadmin.skpd.index')
            ->with('success', 'Password berhasil direset untuk user ' . $skpd->user->name);
    }
}
