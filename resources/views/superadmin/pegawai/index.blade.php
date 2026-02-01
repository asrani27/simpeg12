@extends('layouts.app')

@section('header_title', 'Data Pegawai')

@section('content')
<div class="space-y-6">
    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Data Pegawai</h1>
            <p class="text-sm text-gray-600 mt-1">Kelola data pegawai di seluruh SKPD</p>
        </div>
        <div class="flex items-center space-x-3">
            <button onclick="openImportModal()"
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                </svg>
                Import Excel
            </button>
            <a href="{{ route('superadmin.pegawai.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Pegawai
            </a>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
        <form action="{{ route('superadmin.pegawai.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Pegawai</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        placeholder="Nama, NIK, atau NIP">
                </div>

                <!-- Filter by SKPD -->
                <div>
                    <label for="kode_skpd" class="block text-sm font-medium text-gray-700 mb-1">SKPD</label>
                    <select id="kode_skpd" name="kode_skpd"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option value="">Semua SKPD</option>
                        @foreach($skpds as $skpd)
                        <option value="{{ $skpd->kode_skpd }}" {{ request('kode_skpd')==$skpd->kode_skpd ? 'selected' :
                            '' }}>
                            {{ $skpd->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter by Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Pegawai</label>
                    <select id="status" name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option value="">Semua Status</option>
                        @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status')==$status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Terapkan Filter
                </button>
                <a href="{{ route('superadmin.pegawai.index') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Import Errors -->
    @if(session('import_errors'))
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-r-lg mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3 flex-1">
                <h3 class="text-sm font-medium text-yellow-800">Peringatan Import</h3>
                <div class="mt-2 text-sm text-yellow-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach(session('import_errors') as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Data Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKPD
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jabatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pegawais as $pegawai)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pegawai->nik }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pegawai->nip ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pegawai->nama }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $pegawai->skpd->nama ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($pegawai->status_pegawai === 'PNS')
                            <span
                                class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">PNS</span>
                            @elseif($pegawai->status_pegawai === 'CPNS')
                            <span
                                class="px-2 py-1 text-xs font-medium bg-cyan-100 text-cyan-800 rounded-full">CPNS</span>
                            @elseif($pegawai->status_pegawai === 'PPPK PENUH WAKTU')
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">PPPK
                                Penuh Waktu</span>
                            @elseif($pegawai->status_pegawai === 'PPPK PARUH WAKTU')
                            <span class="px-2 py-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full">PPPK
                                Paruh Waktu</span>
                            @else
                            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">{{
                                $pegawai->status_pegawai }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $pegawai->ket_jabatan ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('superadmin.pegawai.show', $pegawai->id) }}"
                                    class="text-blue-600 hover:text-blue-900 transition-colors duration-150"
                                    title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </a>
                                <a href="{{ route('superadmin.pegawai.edit', $pegawai->id) }}"
                                    class="text-yellow-600 hover:text-yellow-900 transition-colors duration-150"
                                    title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </a>
                                <form action="{{ route('superadmin.pegawai.destroy', $pegawai->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pegawai ini?');"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 transition-colors duration-150"
                                        title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-sm text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                                </path>
                            </svg>
                            <p class="mt-2">Tidak ada data pegawai</p>
                            <p class="mt-1">Silakan tambah data pegawai baru</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($pegawais->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $pegawais->links('pagination::tailwind') }}
        </div>
        @endif
    </div>
</div>

<!-- Import Modal -->
<div id="importModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full mx-4">
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Import Data Pegawai dari Excel</h3>
            <button onclick="closeImportModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <div class="p-6">
            <form action="{{ route('superadmin.pegawai.import') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        File Excel
                    </label>
                    <input type="file" id="file" name="file" accept=".xlsx,.xls,.csv" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
                    <p class="mt-2 text-sm text-gray-500">
                        Format file: .xlsx, .xls, atau .csv (Maksimal 10MB)
                    </p>
                </div>

                <!-- Format Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-blue-800 mb-2">Format File Excel:</h4>
                    <p class="text-xs text-blue-700 mb-2">File harus memiliki baris header dengan kolom berikut:</p>
                    <ul class="text-xs text-blue-700 list-disc list-inside space-y-1">
                        <li><strong>nik</strong> (Wajib) - Nomor Induk Kependudukan</li>
                        <li><strong>nama</strong> (Wajib) - Nama lengkap pegawai</li>
                        <li><strong>nip</strong> - Nomor Induk Pegawai</li>
                        <li><strong>tempat_lahir</strong> - Tempat lahir</li>
                        <li><strong>tanggal_lahir</strong> - Tanggal lahir (format: DD/MM/YYYY atau YYYY-MM-DD)</li>
                        <li><strong>status_pegawai</strong> - PNS, CPNS, PPPK PENUH WAKTU, atau PPPK PARUH WAKTU</li>
                        <li><strong>ket_jabatan</strong> - Keterangan jabatan</li>
                        <li><strong>kode_skpd</strong> atau <strong>skpd</strong> - Kode atau nama SKPD</li>
                    </ul>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeImportModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Import Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openImportModal() {
        const modal = document.getElementById('importModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeImportModal() {
        const modal = document.getElementById('importModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        // Reset form
        const form = modal.querySelector('form');
        form.reset();
    }

    // Close modal when clicking outside
    document.getElementById('importModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImportModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImportModal();
        }
    });
</script>
@endsection