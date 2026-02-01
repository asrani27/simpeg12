@extends('layouts.app')

@section('header_title', 'Detail Pegawai')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('skpd.pegawai.index') }}"
                class="text-gray-600 hover:text-gray-900 transition-colors duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Pegawai</h1>
                <p class="text-sm text-gray-600 mt-1">Informasi lengkap pegawai: {{ $pegawai->nama }}</p>
            </div>
        </div>
    </div>

    <!-- Data Identitas Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Data Identitas
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- NIK -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">NIK</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $pegawai->nik }}</p>
                </div>

                <!-- NIP -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">NIP</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $pegawai->nip ?? '-' }}</p>
                </div>

                <!-- Nama -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $pegawai->nama }}</p>
                </div>

                <!-- Tempat Lahir -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Tempat Lahir</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $pegawai->tempat_lahir ?? '-' }}</p>
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Lahir</label>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ $pegawai->tanggal_lahir ? $pegawai->tanggal_lahir->format('d F Y') : '-' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Pekerjaan Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Data Pekerjaan
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- SKPD -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">SKPD</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $pegawai->skpd->nama ?? '-' }}</p>
                    @if($pegawai->skpd)
                    <p class="text-sm text-gray-500 mt-1">Kode: {{ $pegawai->skpd->kode_skpd }}</p>
                    @endif
                </div>

                <!-- Status Pegawai -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Status Pegawai</label>
                    <div class="mt-1">
                        @if($pegawai->status_pegawai === 'PNS')
                        <span class="px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full">PNS</span>
                        @elseif($pegawai->status_pegawai === 'CPNS')
                        <span class="px-3 py-1 text-sm font-medium bg-cyan-100 text-cyan-800 rounded-full">CPNS</span>
                        @elseif($pegawai->status_pegawai === 'PPPK PENUH WAKTU')
                        <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">PPPK Penuh Waktu</span>
                        @elseif($pegawai->status_pegawai === 'PPPK PARUH WAKTU')
                        <span class="px-3 py-1 text-sm font-medium bg-teal-100 text-teal-800 rounded-full">PPPK Paruh Waktu</span>
                        @else
                        <span class="px-3 py-1 text-sm font-medium bg-gray-100 text-gray-800 rounded-full">{{ $pegawai->status_pegawai }}</span>
                        @endif
                    </div>
                </div>

                <!-- Keterangan Jabatan -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500 mb-1">Keterangan Jabatan</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $pegawai->ket_jabatan ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Sistem Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Informasi Sistem
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- ID -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">ID Pegawai</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $pegawai->id }}</p>
                </div>

                <!-- Dibuat -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Dibuat</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $pegawai->created_at->format('d F Y H:i') }}</p>
                </div>

                <!-- Terakhir Update -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Terakhir Update</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $pegawai->updated_at->format('d F Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection