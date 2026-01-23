@extends('layouts.app')

@section('header_title', 'Dashboard DMS')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard DMS</h1>
            <p class="text-sm text-gray-600 mt-1">Selamat datang di panel admin DMS</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
        <!-- Drh Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-500 uppercase">DRH</span>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Sudah Upload</span>
                    <span class="text-lg font-bold text-green-600">{{ $stats['drh']['uploaded'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Belum Upload</span>
                    <span class="text-lg font-bold text-red-600">{{ $stats['drh']['not_uploaded'] }}</span>
                </div>
            </div>
        </div>

        <!-- SK CPNS Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-500 uppercase">SK CPNS</span>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Sudah Upload</span>
                    <span class="text-lg font-bold text-green-600">{{ $stats['sk_cpns']['uploaded'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Belum Upload</span>
                    <span class="text-lg font-bold text-red-600">{{ $stats['sk_cpns']['not_uploaded'] }}</span>
                </div>
            </div>
        </div>

        <!-- D2NP Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-500 uppercase">D2NP</span>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Sudah Upload</span>
                    <span class="text-lg font-bold text-green-600">{{ $stats['d2np']['uploaded'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Belum Upload</span>
                    <span class="text-lg font-bold text-red-600">{{ $stats['d2np']['not_uploaded'] }}</span>
                </div>
            </div>
        </div>

        <!-- SPMT Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-500 uppercase">SPMT</span>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Sudah Upload</span>
                    <span class="text-lg font-bold text-green-600">{{ $stats['spmt']['uploaded'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Belum Upload</span>
                    <span class="text-lg font-bold text-red-600">{{ $stats['spmt']['not_uploaded'] }}</span>
                </div>
            </div>
        </div>

        <!-- SK PNS Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-500 uppercase">SK PNS</span>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Sudah Upload</span>
                    <span class="text-lg font-bold text-green-600">{{ $stats['sk_pns']['uploaded'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Belum Upload</span>
                    <span class="text-lg font-bold text-red-600">{{ $stats['sk_pns']['not_uploaded'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <form action="{{ route('dashboard.dms') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan NIP, Nama, atau kolom lainnya..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>
            </div>
            <div class="flex gap-2">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari
                </button>
                @if(request('search'))
                <a href="{{ route('dashboard.dms') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">Data DMS</h2>
            @if($dmsData->total() > 0)
            <span
                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                {{ $dmsData->total() }} Data
            </span>
            @endif
        </div>

        @if($dmsData->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        </th>
                        <?php
                        $firstItem = $dmsData->first();
                        $attributes = collect($firstItem->getAttributes())->except(['id', 'created_at', 'updated_at']);
                        ?>
                        @foreach($attributes as $field => $value)
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{
                            ucwords(str_replace('_', ' ', $field)) }}</th>
                        @endforeach
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($dmsData as $item)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ ($loop->iteration +
                                (($dmsData->currentPage() - 1) * $dmsData->perPage())) }}</div>
                        </td>
                        @foreach($attributes as $field => $value)
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                            $fieldValue = $item->$field ?? null;
                            $isDocument = in_array($field, ['drh', 'sk_cpns', 'd2np', 'spmt', 'sk_pns']);

                            if ($isDocument) {
                            // For document fields, check if file exists
                            if (!empty($fieldValue)) {
                            // File exists - show download button with icon only
                            echo '<a href="' . route('dms.admin.download', ['nip' => $item->nip, 'type' => $field]) . '"
                                class="inline-flex items-center justify-center w-8 h-8 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors" title="Download">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </a>';
                            } else {
                            // No file - show "belum"
                            echo '<span class="text-sm text-red-600 font-semibold">belum</span>';
                            }
                            } else {
                            // For non-document fields (nip, nama, created_at), show the value
                            echo '<div class="text-sm text-gray-900">' . ($fieldValue ?? '-') . '</div>';
                            }
                            @endphp
                        </td>
                        @endforeach
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('dms.admin.zip', ['nip' => $item->nip]) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-xs font-medium rounded-full hover:bg-indigo-700 transition-colors">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                ZIP & Download
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($dmsData->hasPages())
        {{ $dmsData->links('pagination.custom') }}
        @endif
        @else
        <div class="px-6 py-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data</h3>
            <p class="mt-1 text-sm text-gray-500">Belum ada data DMS yang tersedia.</p>
        </div>
        @endif
    </div>
</div>
@endsection