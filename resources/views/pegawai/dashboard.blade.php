@extends('layouts.app')

@section('title', 'Dashboard Pegawai')

@section('header_title', 'Dashboard Pegawai')

@section('content')
<!-- Warning Alert for Incomplete Documents -->
@if($hasWarnings)
<div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 rounded-lg shadow-md overflow-hidden">
    <div class="p-4">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3 flex-1">
                <h3 class="text-sm font-medium text-yellow-800">
                    Perhatian: Dokumen Belum Lengkap
                </h3>
                <div class="mt-2 text-sm text-yellow-700">
                    <p>Dokumen berikut belum diunggah:</p>
                    <ul class="mt-1 ml-4 list-disc">
                        @foreach($incompleteDocuments as $document)
                        <li>{{ $document }}</li>
                        @endforeach
                    </ul>
                    <p class="mt-2">Silakan lengkapi dokumen Anda di menu DMS.</p>
                </div>
                <div class="mt-4">
                    <a href="/pegawai/dms"
                        class="inline-flex items-center px-3 py-1.5 border border-yellow-300 text-xs font-medium rounded-md text-yellow-800 bg-yellow-50 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Ke Menu DMS
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Welcome Card -->
<div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg shadow-lg p-6 mb-6 text-white">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <div class="bg-white/20 rounded-full p-3">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>
        <div class="ml-4">
            <h3 class="text-lg font-semibold">Selamat Datang, {{ auth()->user()->name }}!</h3>
            <p class="text-white/80 text-sm mt-1">Anda login sebagai Pegawai. Silakan gunakan menu di sebelah kiri untuk
                mengakses berbagai layanan.</p>
        </div>
    </div>
</div>

<!-- Layanan BKD Section -->
<div class="grid grid-cols-1 gap-6 mb-6">
    <div class="bg-white/90 backdrop-blur-lg rounded-xl shadow-lg border border-white/20">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
                Layanan BKD
            </h3>
            <form method="post" action="/pegawai/dashboard/ajukan-layanan" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Layanan</label>
                    <select name="layanan_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 shadow-sm hover:shadow-md">
                        @foreach ($layanan as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="w-full inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white transition-all duration-200 bg-gradient-to-r from-purple-600 to-purple-700 rounded-xl hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    Ajukan Layanan
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Riwayat Pengajuan Section -->
<div class="bg-white/90 backdrop-blur-lg rounded-xl shadow-lg border border-white/20 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                </path>
            </svg>
            Riwayat Pengajuan Anda
        </h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        NIP/Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Layanan
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal
                        Dibuat</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Diproses Oleh</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi
                    </th>
                </tr>
            </thead>
            @php
            $no=1;
            @endphp
            <tbody class="divide-y divide-gray-200">
                @foreach ($pengajuan as $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{$no++}}</td>
                    <td class="px-4 py-4 text-sm text-gray-900">
                        <div class="font-medium">{{$item->pegawai->nip}}</div>
                        <div class="text-gray-500">{{$item->pegawai->nama}}</div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{$item->layanan->nama}}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i')}}
                    </td>
                    <td class="px-4 py-4 text-sm">
                        @if ($item->status == 0)
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            HARAP UPLOAD DOKUMEN
                        </span>
                        @endif
                        @if ($item->status == 1 && $item->verifikator == null)
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            DIKIRIM
                        </span>
                        @endif
                        @if ($item->status == 1 && $item->verifikator != null)
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            DIPROSES
                        </span>
                        @endif
                        @if ($item->status == 2)
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            SELESAI
                        </span>
                        @endif
                        @if ($item->upload->where('verifikasi',2)->count() > 0)
                        <div class="mt-1">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Ada yang perlu diperbaiki
                            </span>
                        </div>
                        @endif
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{$item->nama_verifikator == null ? '-' : $item->nama_verifikator->name}}
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="/pegawai/dashboard/{{$item->id}}/dokumen"
                            class="inline-flex items-center px-3 py-1.5 border border-purple-600 text-xs font-medium rounded-lg text-purple-700 bg-white hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Dokumen
                        </a>
                        @if ($item->status != 2)
                        <a href="/pegawai/dashboard/{{$item->id}}/delete"
                            class="inline-flex items-center px-3 py-1.5 border border-red-600 text-xs font-medium rounded-lg text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors"
                            onclick="return confirm('Yakin Di Hapus?');">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            Hapus
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection