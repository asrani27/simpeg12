@extends('layouts.app')

@section('header_title', 'Dashboard SKPD')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Selamat Datang, {{ auth()->user()->nama ?? 'User' }}!</h1>
                <p class="text-blue-100 mt-2">Dashboard Sistem Informasi Kepegawaian - {{ auth()->user()->skpd->nama ?? 'SKPD' }}</p>
            </div>
            <div class="hidden md:block">
                <svg class="w-16 h-16 text-white/30" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Pegawai -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pegawai</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPegawai ?? 0 }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pengajuan Menunggu -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pengajuan Menunggu</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pengajuanMenunggu ?? 0 }}</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pengajuan Diproses -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Sedang Diproses</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $pengajuanDiproses ?? 0 }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pengajuan Selesai -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Selesai</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $pengajuanSelesai ?? 0 }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Pengajuan -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">Pengajuan Terbaru</h2>
                <a href="/pegawai/dashboard" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                    Lihat Semua
                </a>
            </div>
            <div class="divide-y divide-gray-200">
                @if(isset($recentPengajuan) && $recentPengajuan->count() > 0)
                    @foreach($recentPengajuan as $pengajuan)
                    <div class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    @if($pengajuan->status === 'menunggu')
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-yellow-100 text-yellow-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </span>
                                    @elseif($pengajuan->status === 'diproses')
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                    </span>
                                    @else
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-green-100 text-green-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </span>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $pengajuan->pegawai->nama ?? '-' }}</p>
                                    <p class="text-sm text-gray-500">{{ $pengajuan->layanan->nama ?? 'Pengajuan Layanan' }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">{{ $pengajuan->created_at->format('d M Y') }}</p>
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full
                                    @if($pengajuan->status === 'menunggu') bg-yellow-100 text-yellow-800
                                    @elseif($pengajuan->status === 'diproses') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($pengajuan->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="px-6 py-12 text-center text-sm text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <p class="mt-2">Belum ada pengajuan</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Aksi Cepat</h2>
            </div>
            <div class="p-6 space-y-3">
                <a href="/pegawai/dms" class="flex items-center w-full px-4 py-3 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span class="text-sm font-medium">Kelola DMS</span>
                </a>
                <a href="/pegawai/dashboard" class="flex items-center w-full px-4 py-3 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                    <span class="text-sm font-medium">Buat Pengajuan</span>
                </a>
                <a href="/profile" class="flex items-center w-full px-4 py-3 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                        </path>
                    </svg>
                    <span class="text-sm font-medium">Profil Saya</span>
                </a>
                <a href="/periode" class="flex items-center w-full px-4 py-3 bg-yellow-50 text-yellow-700 rounded-lg hover:bg-yellow-100 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span class="text-sm font-medium">Periode Aktif</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Notifications / Info -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <svg class="w-8 h-8 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-lg">Informasi Penting</h3>
                <p class="text-purple-100 mt-1">Pastikan untuk memeriksa periode aktif sebelum melakukan pengajuan. Semua dokumen harus lengkap sesuai dengan persyaratan yang ditetapkan.</p>
            </div>
        </div>
    </div>
</div>
@endsection