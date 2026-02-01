@extends('layouts.app')

@section('header_title', 'Dashboard - Superadmin')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Pegawai -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Pegawai</p>
                    <p class="text-3xl font-bold mt-1">{{ number_format($totalPegawai) }}</p>
                    <div class="mt-2 text-xs text-blue-200">
                        <span class="text-white">PNS: {{ $pegawaiPNS }}</span> |
                        <span class="text-white">CPNS: {{ $pegawaiCPNS }}</span> |
                        <span class="text-white">PPPK: {{ $pegawaiPPPK }}</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total SKPD -->
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-lg p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm font-medium">Total SKPD Aktif</p>
                    <p class="text-3xl font-bold mt-1">{{ number_format($totalSkpd) }}</p>
                    <div class="mt-2 text-xs text-emerald-200">
                        Satuan Kerja Perangkat Daerah
                    </div>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Pengajuan -->
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Total Pengajuan</p>
                    <p class="text-3xl font-bold mt-1">{{ number_format($totalPengajuan) }}</p>
                    <div class="mt-2 text-xs text-purple-200">
                        <span class="text-white">Menunggu: {{ $pengajuanMenunggu }}</span> |
                        <span class="text-white">Diproses: {{ $pengajuanDiproses }}</span> |
                        <span class="text-white">Selesai: {{ $pengajuanSelesai }}</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Total Users</p>
                    <p class="text-3xl font-bold mt-1">{{ number_format($totalUsers) }}</p>
                    <div class="mt-2 text-xs text-orange-200">
                        Pengguna sistem aktif
                    </div>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- DMS Stats Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Statistik Dokumen Manajemen Sistem (DMS)</h3>
            <span class="text-sm text-gray-500">Dokumen Pegawai</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-blue-50 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-blue-600 font-medium">Total Data DMS</p>
                        <p class="text-2xl font-bold text-blue-900 mt-1">{{ number_format($totalDMS) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-green-50 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-green-600 font-medium">Dokumen Lengkap</p>
                        <p class="text-2xl font-bold text-green-900 mt-1">{{ number_format($dmsComplete) }}</p>
                        <p class="text-xs text-green-600 mt-1">{{ $totalDMS > 0 ? round(($dmsComplete / $totalDMS) * 100, 1) : 0 }}% dari total</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Menu -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Pegawai Management -->
        <a href="{{ route('superadmin.pegawai.index') }}"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-blue-300 transition-all duration-200 group">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-blue-200 transition-colors">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Kelola Pegawai</h3>
                    <p class="text-sm text-gray-500">Tambah, edit, dan hapus data pegawai</p>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-400">{{ number_format($totalPegawai) }} pegawai terdaftar</span>
                <svg class="w-5 h-5 text-blue-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </a>

        <!-- SKPD Management -->
        <a href="{{ route('superadmin.skpd.index') }}"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-emerald-300 transition-all duration-200 group">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-emerald-200 transition-colors">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Kelola SKPD</h3>
                    <p class="text-sm text-gray-500">Kelola satuan kerja perangkat daerah</p>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-400">{{ number_format($totalSkpd) }} SKPD aktif</span>
                <svg class="w-5 h-5 text-emerald-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </a>

        <!-- User Management -->
        <a href="{{ route('superadmin.admin_layanan.index') }}"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-purple-300 transition-all duration-200 group">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-purple-200 transition-colors">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Kelola User</h3>
                    <p class="text-sm text-gray-500">Kelola admin layanan dan hak akses</p>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-400">{{ number_format($totalUsers) }} user terdaftar</span>
                <svg class="w-5 h-5 text-purple-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </a>
    </div>

    <!-- Recent Activities Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Pegawai -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Pegawai Terbaru</h2>
                    <a href="{{ route('superadmin.pegawai.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        Lihat Semua →
                    </a>
                </div>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($recentPegawai as $pegawai)
                <a href="{{ route('superadmin.pegawai.show', $pegawai->id) }}"
                    class="p-4 hover:bg-gray-50 transition-colors block">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $pegawai->nama }}</p>
                            <p class="text-xs text-gray-500">
                                {{ $pegawai->skpd->nama ?? 'SKPD Tidak Diketahui' }} · {{ $pegawai->status_pegawai }}
                            </p>
                        </div>
                        <div class="text-xs text-gray-400">
                            {{ $pegawai->created_at->diffForHumans() }}
                        </div>
                    </div>
                </a>
                @empty
                <div class="p-6 text-center text-gray-500">
                    <p class="text-sm">Belum ada data pegawai</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Pengajuan -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Pengajuan Terbaru</h2>
                    <span class="text-sm text-gray-500">Menunggu: {{ $pengajuanMenunggu }}</span>
                </div>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($recentPengajuan as $pengajuan)
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <div class="w-10 h-10 {{ $pengajuan->status === 'menunggu' ? 'bg-yellow-100' : ($pengajuan->status === 'diproses' ? 'bg-blue-100' : 'bg-green-100') }} rounded-full flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 {{ $pengajuan->status === 'menunggu' ? 'text-yellow-600' : ($pengajuan->status === 'diproses' ? 'text-blue-600' : 'text-green-600') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $pengajuan->pegawai->nama ?? 'N/A' }}</p>
                            <p class="text-xs text-gray-500">
                                {{ $pengajuan->layanan->nama ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="flex-shrink-0 ml-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $pengajuan->status === 'menunggu' ? 'bg-yellow-100 text-yellow-800' : ($pengajuan->status === 'diproses' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                {{ ucfirst($pengajuan->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500">
                    <p class="text-sm">Belum ada pengajuan</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection