@extends('layouts.app')

@section('header_title', 'Edit SKPD')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('superadmin.skpd.index') }}"
            class="text-gray-600 hover:text-gray-900 transition-colors duration-150">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit SKPD</h1>
            <p class="text-sm text-gray-600 mt-1">Edit data SKPD: {{ $skpd->nama }}</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form Edit SKPD</h2>
        </div>

        <form action="{{ route('superadmin.skpd.update', $skpd->id) }}" method="POST"
            class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Kode SKPD -->
            <div>
                <label for="kode_skpd" class="block text-sm font-medium text-gray-700 mb-2">
                    Kode SKPD <span class="text-red-500">*</span>
                </label>
                <input type="text" id="kode_skpd" name="kode_skpd" value="{{ old('kode_skpd', $skpd->kode_skpd) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                    placeholder="Contoh: 1.01.01.00" required>
                @error('kode_skpd')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama SKPD -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama SKPD <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $skpd->nama) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                    placeholder="Contoh: Dinas Pendidikan" required>
                @error('nama')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Aktif -->
            <div class="flex items-center">
                <input type="checkbox" id="is_aktif" name="is_aktif" value="1" {{ $skpd->is_aktif ? 'checked' : '' }}
                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="is_aktif" class="ml-2 block text-sm text-gray-700">
                    SKPD Aktif
                </label>
            </div>

            <!-- SKPD Info -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Informasi SKPD</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">ID:</span>
                        <span class="ml-2 text-gray-900">{{ $skpd->id }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Dibuat:</span>
                        <span class="ml-2 text-gray-900">{{ $skpd->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Terakhir Update:</span>
                        <span class="ml-2 text-gray-900">{{ $skpd->updated_at->format('d M Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Jumlah Pegawai:</span>
                        <span class="ml-2 text-gray-900">{{ $skpd->pegawai->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('superadmin.skpd.index') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </a>
                <a href="{{ route('superadmin.skpd.show', $skpd->id) }}"
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