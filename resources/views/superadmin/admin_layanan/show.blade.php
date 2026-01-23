@extends('layouts.app')

@section('header_title', 'Detail Admin Layanan')

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
            <h1 class="text-2xl font-bold text-gray-900">Detail Admin Layanan</h1>
            <p class="text-sm text-gray-600 mt-1">Informasi lengkap admin layanan</p>
        </div>
    </div>

    <!-- Profile Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-8">
            <div class="flex items-center space-x-6">
                <img src="https://ui-avatars.com/api/?name={{ $adminLayanan->name }}&background=ffffff&color=8b5cf6&size=128"
                    alt="{{ $adminLayanan->name }}" class="w-24 h-24 rounded-full border-4 border-white shadow-lg">
                <div class="text-white">
                    <h2 class="text-2xl font-bold">{{ $adminLayanan->name }}</h2>
                    <p class="text-purple-100 mt-1">{{ $adminLayanan->username }}</p>
                    <div class="flex items-center mt-2 space-x-2">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 backdrop-blur-sm text-white">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Admin Layanan
                        </span>
                        @if($adminLayanan->roles->count() > 0)
                        @foreach($adminLayanan->roles->take(1) as $role)
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 backdrop-blur-sm text-white">
                            {{ $role->name }}
                        </span>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900 pb-2 border-b border-gray-200">Informasi Pribadi</h3>

                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Nama Lengkap</p>
                            <p class="text-gray-900 font-medium">{{ $adminLayanan->name }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-1">Username</p>
                            <p class="text-gray-900 font-medium">{{ $adminLayanan->username }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-1">Email</p>
                            <p class="text-gray-900 font-medium">{{ $adminLayanan->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900 pb-2 border-b border-gray-200">Informasi Sistem</h3>

                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">User ID</p>
                            <p class="text-gray-900 font-medium">#{{ $adminLayanan->id }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-1">Status Admin Layanan</p>
                            <p class="text-gray-900 font-medium">
                                @if($adminLayanan->admin_layanan)
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aktif
                                </span>
                                @else
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Tidak Aktif
                                </span>
                                @endif
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-1">Roles</p>
                            <div class="flex flex-wrap gap-1">
                                @if($adminLayanan->roles->count() > 0)
                                @foreach($adminLayanan->roles as $role)
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $role->name }}
                                </span>
                                @endforeach
                                @else
                                <span class="text-gray-500 text-sm">Tidak ada role</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timestamps -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Dibuat Pada</p>
                        <p class="text-gray-900 font-medium">{{ $adminLayanan->created_at->format('d F Y, H:i:s') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Terakhir Diupdate</p>
                        <p class="text-gray-900 font-medium">{{ $adminLayanan->updated_at->format('d F Y, H:i:s') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end space-x-3">
            <a href="{{ route('superadmin.admin_layanan.index') }}"
                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                Kembali
            </a>
            <a href="{{ route('superadmin.admin_layanan.edit', $adminLayanan->id) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
                Edit
            </a>
            <form action="{{ route('superadmin.admin_layanan.destroy', $adminLayanan->id) }}" method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin layanan ini?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection