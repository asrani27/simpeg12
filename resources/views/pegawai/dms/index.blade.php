@extends('layouts.app')

@section('title', 'Document Management System')

@section('content')
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dokumen Kepegawaian</h1>
        <p class="text-gray-600 mt-1">Upload dan kelola dokumen penting Anda</p>
    </div>


    <!-- Single Card with Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-blue-600 rounded-t-lg">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-bold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Daftar Dokumen
                </h2>
                <span class="text-sm text-blue-100">Format: PDF (Maksimal 1.5MB)</span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Jenis Dokumen</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Nama File</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- DRH -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">Daftar Riwayat Hidup (DRH)</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($dmsRecord && $dmsRecord->drh)
                            <span
                                class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">TERUPLOAD</span>
                            @else
                            <span
                                class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">BELUM</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($dmsRecord && $dmsRecord->drh)
                            <span class="text-sm text-gray-700">{{ Str::limit($dmsRecord->drh, 30) }}</span>
                            @else
                            <span class="text-sm text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-2">
                                @if($dmsRecord && $dmsRecord->drh)
                                <a href="{{ route('pegawai.dms.download', 'drh') }}"
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Download
                                </a>
                                <form action="{{ route('pegawai.dms.destroy', 'drh') }}" method="POST" class="inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('pegawai.dms.store') }}" method="POST"
                                    enctype="multipart/form-data" class="inline-flex items-center">
                                    @csrf
                                    <input type="hidden" name="document_type" value="drh">
                                    <input type="file" id="file_drh" name="file" class="hidden" accept=".pdf"
                                        onchange="this.form.submit()">
                                    <button type="button" onclick="document.getElementById('file_drh').click()"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                            </path>
                                        </svg>
                                        Upload
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- SK CPNS -->
                    <tr class="bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">SK CPNS</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($dmsRecord && $dmsRecord->sk_cpns)
                            <span
                                class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">TERUPLOAD</span>
                            @else
                            <span
                                class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">BELUM</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($dmsRecord && $dmsRecord->sk_cpns)
                            <span class="text-sm text-gray-700">{{ Str::limit($dmsRecord->sk_cpns, 30) }}</span>
                            @else
                            <span class="text-sm text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-2">
                                @if($dmsRecord && $dmsRecord->sk_cpns)
                                <a href="{{ route('pegawai.dms.download', 'sk_cpns') }}"
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-green-700 bg-green-100 hover:bg-green-200 rounded transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Download
                                </a>
                                <form action="{{ route('pegawai.dms.destroy', 'sk_cpns') }}" method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('pegawai.dms.store') }}" method="POST"
                                    enctype="multipart/form-data" class="inline-flex items-center">
                                    @csrf
                                    <input type="hidden" name="document_type" value="sk_cpns">
                                    <input type="file" id="file_sk_cpns" name="file" class="hidden" accept=".pdf"
                                        onchange="this.form.submit()">
                                    <button type="button" onclick="document.getElementById('file_sk_cpns').click()"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                            </path>
                                        </svg>
                                        Upload
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- D2NP -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">D2NP</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($dmsRecord && $dmsRecord->d2np)
                            <span
                                class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">TERUPLOAD</span>
                            @else
                            <span
                                class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">BELUM</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($dmsRecord && $dmsRecord->d2np)
                            <span class="text-sm text-gray-700">{{ Str::limit($dmsRecord->d2np, 30) }}</span>
                            @else
                            <span class="text-sm text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-2">
                                @if($dmsRecord && $dmsRecord->d2np)
                                <a href="{{ route('pegawai.dms.download', 'd2np') }}"
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-purple-700 bg-purple-100 hover:bg-purple-200 rounded transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Download
                                </a>
                                <form action="{{ route('pegawai.dms.destroy', 'd2np') }}" method="POST" class="inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('pegawai.dms.store') }}" method="POST"
                                    enctype="multipart/form-data" class="inline-flex items-center">
                                    @csrf
                                    <input type="hidden" name="document_type" value="d2np">
                                    <input type="file" id="file_d2np" name="file" class="hidden" accept=".pdf"
                                        onchange="this.form.submit()">
                                    <button type="button" onclick="document.getElementById('file_d2np').click()"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 rounded transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                            </path>
                                        </svg>
                                        Upload
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- SPMT -->
                    <tr class="bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">SPMT</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($dmsRecord && $dmsRecord->spmt)
                            <span
                                class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">TERUPLOAD</span>
                            @else
                            <span
                                class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">BELUM</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($dmsRecord && $dmsRecord->spmt)
                            <span class="text-sm text-gray-700">{{ Str::limit($dmsRecord->spmt, 30) }}</span>
                            @else
                            <span class="text-sm text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-2">
                                @if($dmsRecord && $dmsRecord->spmt)
                                <a href="{{ route('pegawai.dms.download', 'spmt') }}"
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-orange-700 bg-orange-100 hover:bg-orange-200 rounded transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Download
                                </a>
                                <form action="{{ route('pegawai.dms.destroy', 'spmt') }}" method="POST" class="inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('pegawai.dms.store') }}" method="POST"
                                    enctype="multipart/form-data" class="inline-flex items-center">
                                    @csrf
                                    <input type="hidden" name="document_type" value="spmt">
                                    <input type="file" id="file_spmt" name="file" class="hidden" accept=".pdf"
                                        onchange="this.form.submit()">
                                    <button type="button" onclick="document.getElementById('file_spmt').click()"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 rounded transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                            </path>
                                        </svg>
                                        Upload
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- SK PNS -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">SK PNS</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($dmsRecord && $dmsRecord->sk_pns)
                            <span
                                class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">TERUPLOAD</span>
                            @else
                            <span
                                class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">BELUM</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($dmsRecord && $dmsRecord->sk_pns)
                            <span class="text-sm text-gray-700">{{ Str::limit($dmsRecord->sk_pns, 30) }}</span>
                            @else
                            <span class="text-sm text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-2">
                                @if($dmsRecord && $dmsRecord->sk_pns)
                                <a href="{{ route('pegawai.dms.download', 'sk_pns') }}"
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Download
                                </a>
                                <form action="{{ route('pegawai.dms.destroy', 'sk_pns') }}" method="POST" class="inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('pegawai.dms.store') }}" method="POST"
                                    enctype="multipart/form-data" class="inline-flex items-center">
                                    @csrf
                                    <input type="hidden" name="document_type" value="sk_pns">
                                    <input type="file" id="file_sk_pns" name="file" class="hidden" accept=".pdf"
                                        onchange="this.form.submit()">
                                    <button type="button" onclick="document.getElementById('file_sk_pns').click()"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                            </path>
                                        </svg>
                                        Upload
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection