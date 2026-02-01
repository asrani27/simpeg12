@extends('layouts.app')

@section('header_title', 'Buat User untuk SKPD')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Buat User untuk SKPD</h1>
            <p class="text-sm text-gray-600 mt-1">Buat akun user baru untuk SKPD ini</p>
        </div>
        <a href="{{ route('superadmin.skpd.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <!-- SKPD Info Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi SKPD</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kode SKPD</label>
                <p class="text-sm text-gray-900">{{ $skpd->kode_skpd }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama SKPD</label>
                <p class="text-sm text-gray-900">{{ $skpd->nama }}</p>
            </div>
        </div>
    </div>

    <!-- Create User Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form Buat User</h2>
        </div>
        
        @if($errors->any())
            <div class="px-6 py-4 bg-red-50 border-b border-red-200">
                <div class="flex">
                    <svg class="w-5 h-5 text-red-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan!</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('superadmin.skpd.createUser') }}" method="POST" class="p-6 space-y-6">
            @csrf
            <input type="hidden" name="skpd_id" value="{{ $skpd->id }}">
            
            <!-- User Name -->
            <div>
                <label for="user_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama User <span class="text-red-500">*</span>
                </label>
                <input type="text" id="user_name" name="user_name"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukkan nama lengkap user" required
                    value="{{ old('user_name') }}">
                <p class="mt-1 text-xs text-gray-500">Nama lengkap yang akan ditampilkan dalam sistem</p>
            </div>
            
            <!-- Username -->
            <div>
                <label for="user_username" class="block text-sm font-medium text-gray-700 mb-2">
                    Username <span class="text-red-500">*</span>
                </label>
                <input type="text" id="user_username" name="user_username"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukkan username untuk login" required
                    value="{{ old('user_username') }}">
                <p class="mt-1 text-xs text-gray-500">Username harus unik dan akan digunakan untuk login</p>
            </div>
            
            <!-- Email -->
            <div>
                <label for="user_email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" id="user_email" name="user_email"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukkan alamat email" required
                    value="{{ old('user_email') }}">
                <p class="mt-1 text-xs text-gray-500">Email harus valid dan unik dalam sistem</p>
            </div>
            
            <!-- Password -->
            <div>
                <label for="user_password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="password" id="user_password" name="user_password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pr-10"
                        placeholder="Masukkan password" required>
                    <button type="button" onclick="togglePassword('user_password', this)"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="{{ route('superadmin.skpd.index') }}" 
                   class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Buat User
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('svg');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
            `;
        } else {
            input.type = 'password';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            `;
        }
    }
</script>
@endsection