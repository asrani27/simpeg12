@extends('layouts.app')

@section('header_title', 'Edit Pegawai')

@section('content')
<div class="space-y-6">
    <!-- Error Notification -->
    @if($errors->any())
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
                    Terjadi kesalahan saat menyimpan data. Mohon periksa kembali input Anda.
                </p>
            </div>
        </div>
    </div>
    @endif

    <!-- Page Header -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('superadmin.pegawai.index') }}"
            class="text-gray-600 hover:text-gray-900 transition-colors duration-150">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Pegawai</h1>
            <p class="text-sm text-gray-600 mt-1">Edit data pegawai: {{ $pegawai->nama }}</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form Edit Pegawai</h2>
        </div>

        <form action="{{ route('superadmin.pegawai.update', $pegawai->id) }}" method="POST"
            class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Data Identitas -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-sm font-medium text-gray-900 mb-4 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Data Identitas
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">
                            NIK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nik" name="nik" value="{{ old('nik', $pegawai->nik) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                            placeholder="Nomor Induk Kependudukan" required maxlength="16">
                        @error('nik')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIP -->
                    <div>
                        <label for="nip" class="block text-sm font-medium text-gray-700 mb-2">
                            NIP
                        </label>
                        <input type="text" id="nip" name="nip" value="{{ old('nip', $pegawai->nip) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                            placeholder="Nomor Induk Pegawai" maxlength="18">
                        @error('nip')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama -->
                    <div class="md:col-span-2">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $pegawai->nama) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                            placeholder="Nama lengkap pegawai" required>
                        @error('nama')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2">
                            Tempat Lahir
                        </label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir"
                            value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                            placeholder="Kota/kabupaten kelahiran">
                        @error('tempat_lahir')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Lahir
                        </label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                            value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir ? $pegawai->tanggal_lahir->format('Y-m-d') : '') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        @error('tanggal_lahir')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Data Pekerjaan -->
            <div>
                <h3 class="text-sm font-medium text-gray-900 mb-4 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Data Pekerjaan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- SKPD -->
                    <div>
                        <label for="kode_skpd" class="block text-sm font-medium text-gray-700 mb-2">
                            SKPD <span class="text-red-500">*</span>
                        </label>
                        <select id="kode_skpd" name="kode_skpd"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                            required>
                            <option value="">-- Pilih SKPD --</option>
                            @foreach($skpds as $skpd)
                            <option value="{{ $skpd->kode_skpd }}" {{ old('kode_skpd', $pegawai->kode_skpd)==$skpd->kode_skpd ? 'selected' : '' }}>
                                {{ $skpd->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('kode_skpd')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Pegawai -->
                    <div>
                        <label for="status_pegawai" class="block text-sm font-medium text-gray-700 mb-2">
                            Status Pegawai <span class="text-red-500">*</span>
                        </label>
                        <select id="status_pegawai" name="status_pegawai"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                            required>
                            <option value="">-- Pilih Status --</option>
                            @foreach($statuses as $status)
                            <option value="{{ $status }}" {{ old('status_pegawai', $pegawai->status_pegawai)==$status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                            @endforeach
                        </select>
                        @error('status_pegawai')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan Jabatan -->
                    <div class="md:col-span-2">
                        <label for="ket_jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                            Keterangan Jabatan
                        </label>
                        <input type="text" id="ket_jabatan" name="ket_jabatan"
                            value="{{ old('ket_jabatan', $pegawai->ket_jabatan) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                            placeholder="Contoh: Eselon III.a atau Fungsional Ahli Muda">
                        @error('ket_jabatan')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Pegawai Info -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Informasi Pegawai</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">ID:</span>
                        <span class="ml-2 text-gray-900">{{ $pegawai->id }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Dibuat:</span>
                        <span class="ml-2 text-gray-900">{{ $pegawai->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Terakhir Update:</span>
                        <span class="ml-2 text-gray-900">{{ $pegawai->updated_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('superadmin.pegawai.index') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </a>
                <a href="{{ route('superadmin.pegawai.show', $pegawai->id) }}"
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