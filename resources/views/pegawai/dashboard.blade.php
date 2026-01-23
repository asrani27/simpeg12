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

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-blue-100 rounded-lg p-3">
                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total Layanan</p>
                <p class="text-2xl font-bold text-gray-900">{{ $layananList->count() }}</p>
            </div>
        </div>
    </div>

    @if($dmsData)
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0 {{ $hasWarnings ? 'bg-yellow-100' : 'bg-green-100' }} rounded-lg p-3">
                <svg class="h-6 w-6 {{ $hasWarnings ? 'text-yellow-600' : 'text-green-600' }}" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Status Dokumen</p>
                <p class="text-lg font-bold {{ $hasWarnings ? 'text-yellow-700' : 'text-green-700' }}">
                    {{ $hasWarnings ? 'Belum Lengkap' : 'Lengkap' }}
                </p>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-purple-100 rounded-lg p-3">
                <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Role</p>
                <p class="text-lg font-bold text-gray-900">Pegawai</p>
            </div>
        </div>
    </div>
</div>
@endsection