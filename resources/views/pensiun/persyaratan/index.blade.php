@extends('layouts.app')

@section('title')
Data Persyaratan Pensiun
@endsection
@section('content')

<!-- Wrap content in Alpine.js x-data -->
<div x-data="{ openTambahModal: false }">
<!-- Main Content Card -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
    <!-- Card Header -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-4 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-white">Data Persyaratan Pensiun</h3>
        <button @click="openTambahModal = true"
            class="inline-flex items-center px-3 py-1.5 bg-white/20 hover:bg-white/30 text-white text-xs font-medium rounded-md transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Persyaratan
        </button>
    </div>

    <!-- Card Body -->
    <div class="p-6">
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No
                            Urut</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Nama Persyaratan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Jenis Persyaratan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Jenis Kenaikan Pangkat</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($data as $key => $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-4 text-sm text-gray-900 font-medium">
                            {{$data->firstItem() + $key}}
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-700">
                            {{$item->no_urut}}
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-700">
                            {{$item->nama}}
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-700">
                            {{$item->wajib ? $item->wajib : '-'}}
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-700">
                            {{$item->nama_jenis}}
                        </td>
                        <td class="px-4 py-4 text-sm">
                            <div class="flex space-x-2">
                                <button
                                    @click="editSyarat({{$item->id}}, '{{$item->nama}}', {{$item->no_urut}}, {{$item->layanan_id}}, '{{$item->wajib}}')"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 transition-colors">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Edit
                                </button>
                                <a href="/pensiun/persyaratan/delete/{{$item->id}}"
                                    onclick="return confirm('Yakin ingin menghapus data ini?');"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-md hover:bg-red-700 transition-colors">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div x-show="openTambahModal" class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
    <!-- Backdrop -->
    <div x-show="openTambahModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="openTambahModal = false"></div>

    <!-- Modal Panel -->
    <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
        <div x-show="openTambahModal" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative bg-white rounded-xl shadow-xl transform transition-all sm:max-w-md w-full">

            <!-- Modal Content -->
            <form method="post" action="/pensiun/persyaratan/create" enctype="multipart/form-data">
                @csrf

                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-4 rounded-t-xl">
                    <h3 class="text-sm font-semibold text-white">Tambah Data Syarat Kenaikan</h3>
                </div>

                <!-- Body -->
                <div class="px-6 py-4">
                    <div class="mb-4">
                        <label for="no_urut" class="block text-sm font-medium text-gray-700 mb-2">Nomor Urut</label>
                        <input type="text" id="no_urut" name="no_urut" placeholder="Masukkan nomor urut"
                            onkeypress="return hanyaAngka(event)"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    </div>
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Persyaratan</label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama persyaratan"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    </div>
                    <div class="mb-4">
                        <label for="layanan_id" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kenaikan
                            Pangkat</label>
                        <select id="layanan_id" name="layanan_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                            @foreach (layanan('pensiun') as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="wajib" class="block text-sm font-medium text-gray-700 mb-2">Jenis
                            Persyaratan</label>
                        <select id="wajib" name="wajib"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                            <option value="">-- Pilih --</option>
                            <option value="optional">Optional</option>
                        </select>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex justify-between space-x-3">
                    <button type="button" @click="openTambahModal = false"
                        class="flex-1 px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-md border border-gray-300 hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Kirim
                    </button>
                </div>
            </form>

            <!-- Close Button -->
            <button @click="openTambahModal = false"
                class="absolute top-4 right-4 text-white/80 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div x-data="{ openEditModal: false, editNama: '', editNoUrut: '', editLayananId: '', editWajib: '', editId: '' }"
    x-show="openEditModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true" style="display: none;">
    <!-- Backdrop -->
    <div x-show="openEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="openEditModal = false"></div>

    <!-- Modal Panel -->
    <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
        <div x-show="openEditModal" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative bg-white rounded-xl shadow-xl transform transition-all sm:max-w-md w-full">

            <!-- Modal Content -->
            <form method="post" action="/pensiun/persyaratan/edit" enctype="multipart/form-data">
                @csrf

                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-4 rounded-t-xl">
                    <h3 class="text-sm font-semibold text-white">Edit Data Persyaratan</h3>
                </div>

                <!-- Body -->
                <div class="px-6 py-4">
                    <div class="mb-4">
                        <label for="edit_no_urut" class="block text-sm font-medium text-gray-700 mb-2">Nomor
                            Urut</label>
                        <input type="text" id="edit_no_urut" name="no_urut" x-model="editNoUrut"
                            placeholder="Masukkan nomor urut" onkeypress="return hanyaAngka(event)"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    </div>
                    <div class="mb-4">
                        <label for="edit_nama" class="block text-sm font-medium text-gray-700 mb-2">Nama
                            Persyaratan</label>
                        <input type="text" id="edit_nama" name="nama" x-model="editNama"
                            placeholder="Masukkan nama persyaratan"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        <input type="hidden" id="edit_id" name="syarat_id" x-model="editId">
                    </div>
                    <div class="mb-4">
                        <label for="edit_layanan_id" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kenaikan
                            Pangkat</label>
                        <select id="edit_layanan_id" name="layanan_id" x-model="editLayananId"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                            @foreach (layanan('pensiun') as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="edit_wajib" class="block text-sm font-medium text-gray-700 mb-2">Jenis
                            Persyaratan</label>
                        <select id="edit_wajib" name="wajib" x-model="editWajib"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                            <option value="">-- Pilih --</option>
                            <option value="optional">Optional</option>
                        </select>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex justify-between space-x-3">
                    <button type="button" @click="openEditModal = false"
                        class="flex-1 px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-md border border-gray-300 hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Update
                    </button>
                </div>
            </form>

            <!-- Close Button -->
            <button @click="openEditModal = false"
                class="absolute top-4 right-4 text-white/80 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
    function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function editSyarat(id, nama, noUrut, layananId, wajib) {
    const editModal = document.querySelectorAll('[x-data]')[1];
    editModal.__x.$data.editId = id;
    editModal.__x.$data.editNama = nama;
    editModal.__x.$data.editNoUrut = noUrut;
    editModal.__x.$data.editLayananId = layananId;
    editModal.__x.$data.editWajib = wajib;
    editModal.__x.$data.openEditModal = true;
}
</script>
</div>
@endsection
