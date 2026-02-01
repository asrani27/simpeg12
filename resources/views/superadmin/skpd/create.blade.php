@extends('layouts.app')

@section('header_title', 'Tambah SKPD')

@section('content')
<div class="space-y-6">
    <!-- Error Notification -->
    @if(session('error') || $errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700 font-medium">
                    @if(session('error'))
                    {{ session('error') }}
                    @else
                    Terjadi kesalahan saat menyimpan data. Mohon periksa kembali input Anda.
                    @endif
                </p>
            </div>
        </div>
    </div>
    @endif

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
            <h1 class="text-2xl font-bold text-gray-900">Tambah SKPD</h1>
            <p class="text-sm text-gray-600 mt-1">Tambahkan Satuan Kerja Perangkat Daerah baru ke sistem</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form SKPD</h2>
        </div>

        <form action="{{ route('superadmin.skpd.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Kode SKPD -->
            <div>
                <label for="kode_skpd" class="block text-sm font-medium text-gray-700 mb-2">
                    Kode SKPD <span class="text-red-500">*</span>
                </label>
                <input type="text" id="kode_skpd" name="kode_skpd" value="{{ old('kode_skpd') }}"
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
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                    placeholder="Contoh: Dinas Pendidikan" required>
                @error('nama')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Aktif -->
            <div class="flex items-center">
                <input type="checkbox" id="is_aktif" name="is_aktif" value="1" checked
                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="is_aktif" class="ml-2 block text-sm text-gray-700">
                    SKPD Aktif
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('superadmin.skpd.index') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection