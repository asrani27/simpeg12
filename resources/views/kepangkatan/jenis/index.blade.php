@extends('layouts.app')

@section('title')
Data Jenis Kenaikan Pangkat
@endsection
@section('content')

<!-- Main Content Card -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
    <!-- Card Header -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-4 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-white">Data Jenis Kenaikan Pangkat</h3>
        <button type="button" onclick="document.getElementById('modalTambah').style.display='block'"
            class="inline-flex items-center px-3 py-1.5 bg-white/20 hover:bg-white/30 text-white text-sm font-medium rounded-md transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Jenis
        </button>
    </div>

    <!-- Card Body -->
    <div class="p-6">
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Jenis</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($data as $key => $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-4 text-sm text-gray-900 font-medium">
                            {{$data->firstItem() + $key}}
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-700">
                            {{$item->nama}}
                        </td>
                        <td class="px-4 py-4 text-sm">
                            <div class="flex space-x-2">
                                <button type="button"
                                    onclick="editJenis('{{$item->id}}', '{{$item->nama}}')"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 transition-colors">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </button>
                                <a href="/kepangkatan/jenis_kenaikan/delete/{{$item->id}}"
                                    onclick="return confirm('Yakin ingin menghapus data ini?');"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-md hover:bg-red-700 transition-colors">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
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
<div id="modalTambah" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="document.getElementById('modalTambah').style.display='none'"></div>

    <!-- Modal Panel -->
    <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
        <div class="relative bg-white rounded-xl shadow-xl transform transition-all sm:max-w-md w-full">

            <!-- Modal Content -->
            <form method="post" action="/kepangkatan/jenis_kenaikan/create" enctype="multipart/form-data">
                @csrf

                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-4 rounded-t-xl">
                    <h3 class="text-sm font-semibold text-white">Tambah Data Jenis Kenaikan</h3>
                </div>

                <!-- Body -->
                <div class="px-6 py-4">
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Jenis Kenaikan Pangkat</label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama jenis kenaikan pangkat"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex justify-between space-x-3">
                    <button type="button" onclick="document.getElementById('modalTambah').style.display='none'"
                        class="flex-1 px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-md border border-gray-300 hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Kirim
                    </button>
                </div>
            </form>

            <!-- Close Button -->
            <button onclick="document.getElementById('modalTambah').style.display='none'"
                class="absolute top-4 right-4 text-white/80 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="document.getElementById('modalEdit').style.display='none'"></div>

    <!-- Modal Panel -->
    <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
        <div class="relative bg-white rounded-xl shadow-xl transform transition-all sm:max-w-md w-full">

            <!-- Modal Content -->
            <form method="post" action="/kepangkatan/jenis_kenaikan/edit" enctype="multipart/form-data">
                @csrf

                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-4 rounded-t-xl">
                    <h3 class="text-sm font-semibold text-white">Edit Data Jenis Kenaikan Pangkat</h3>
                </div>

                <!-- Body -->
                <div class="px-6 py-4">
                    <div class="mb-4">
                        <label for="edit_nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Jenis</label>
                        <input type="text" id="edit_nama" name="nama"
                            placeholder="Masukkan nama jenis kenaikan pangkat"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        <input type="hidden" id="edit_id" name="jenis_id">
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex justify-between space-x-3">
                    <button type="button" onclick="document.getElementById('modalEdit').style.display='none'"
                        class="flex-1 px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-md border border-gray-300 hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Update
                    </button>
                </div>
            </form>

            <!-- Close Button -->
            <button onclick="document.getElementById('modalEdit').style.display='none'"
                class="absolute top-4 right-4 text-white/80 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
function editJenis(id, nama) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('modalEdit').style.display = 'block';
}
</script>
@endsection