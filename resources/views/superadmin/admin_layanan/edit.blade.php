@extends('layouts.app')

@section('header_title', 'Edit Admin Layanan')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('superadmin.admin_layanan.index') }}"
            class="text-gray-600 hover:text-gray-900 transition-colors duration-150">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Admin Layanan</h1>
            <p class="text-sm text-gray-600 mt-1">Edit data admin layanan: {{ $adminLayanan->name }}</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form Edit Admin Layanan</h2>
        </div>

        <form action="{{ route('superadmin.admin_layanan.update', $adminLayanan->id) }}" method="POST"
            class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $adminLayanan->name) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                    placeholder="Masukkan nama lengkap" required>
                @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                    Username <span class="text-red-500">*</span>
                </label>
                <input type="text" id="username" name="username" value="{{ old('username', $adminLayanan->username) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                    placeholder="Masukkan username" autocomplete="new-password" required>
                @error('username')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div>
                <label for="role_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Role <span class="text-red-500">*</span>
                </label>

                <select id="role_id" name="role_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                    required>
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id', optional($adminLayanan->roles->first())->id)==$role->id ? 'selected' : '' }}>
                        {{ $role->name ?? 'Role ' . $role->id }}
                    </option>
                    @endforeach
                </select>
                @error('role_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password (Optional) -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                    <span class="text-gray-400 font-normal">(Kosongkan jika tidak ingin mengubah)</span>
                </label>
                <input type="password" id="password" name="password" autocomplete="new-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                    placeholder="Masukkan password baru (minimal 8 karakter)">
                @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Password minimal 8 karakter</p>
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Konfirmasi Password
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    autocomplete="new-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                    placeholder="Ulangi password baru">
                @error('password_confirmation')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Admin Layanan Status -->
            <div class="flex items-center">
                <input type="checkbox" id="admin_layanan" name="admin_layanan" value="1" {{ $adminLayanan->admin_layanan
                ? 'checked' : '' }}
                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="admin_layanan" class="ml-2 block text-sm text-gray-700">
                    Aktif sebagai Admin Layanan
                </label>
            </div>

            <!-- User Info -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Informasi User</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">ID:</span>
                        <span class="ml-2 text-gray-900">{{ $adminLayanan->id }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Dibuat:</span>
                        <span class="ml-2 text-gray-900">{{ $adminLayanan->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Terakhir Update:</span>
                        <span class="ml-2 text-gray-900">{{ $adminLayanan->updated_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('superadmin.admin_layanan.index') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </a>
                <a href="{{ route('superadmin.admin_layanan.show', $adminLayanan->id) }}"
                    class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    Lihat Detail
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
