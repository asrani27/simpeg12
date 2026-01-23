<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminLayananController extends Controller
{
    /**
     * Display a listing of admin layanan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $adminLayanans = User::where('admin_layanan', 1)
            ->with('roles')
            ->latest()
            ->paginate(10);

        return view('superadmin.admin_layanan.index', compact('adminLayanans'));
    }

    /**
     * Show the form for creating a new admin layanan.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();
        return view('superadmin.admin_layanan.create', compact('roles'));
    }

    /**
     * Store a newly created admin layanan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'admin_layanan' => 1,
        ]);

        // Attach role to user
        $user->roles()->attach($request->role_id);

        return redirect()
            ->route('superadmin.admin_layanan.index')
            ->with('success', 'Admin Layanan berhasil ditambahkan');
    }

    /**
     * Display the specified admin layanan.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $adminLayanan = User::where('admin_layanan', 1)->findOrFail($id);
        return view('superadmin.admin_layanan.show', compact('adminLayanan'));
    }

    /**
     * Show the form for editing the specified admin layanan.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $adminLayanan = User::where('admin_layanan', 1)->with('roles')->findOrFail($id);
        $roles = Role::all();
        return view('superadmin.admin_layanan.edit', compact('adminLayanan', 'roles'));
    }

    /**
     * Update the specified admin layanan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $adminLayanan = User::where('admin_layanan', 1)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'username' => 'required|string|max:255|' . Rule::unique('users')->ignore($adminLayanan->id),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $adminLayanan->update([
            'name' => $request->name,
            'username' => $request->username,
        ]);

        if ($request->filled('password')) {
            $adminLayanan->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Update role
        $adminLayanan->roles()->sync([$request->role_id]);

        return redirect()
            ->route('superadmin.admin_layanan.index')
            ->with('success', 'Admin Layanan berhasil diperbarui');
    }

    /**
     * Remove the specified admin layanan from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $adminLayanan = User::where('admin_layanan', 1)->findOrFail($id);
        $adminLayanan->update(['admin_layanan' => 0]);

        return redirect()
            ->route('superadmin.admin_layanan.index')
            ->with('success', 'Admin Layanan berhasil dihapus');
    }
}
