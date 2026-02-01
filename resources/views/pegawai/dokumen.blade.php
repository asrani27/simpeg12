@extends('layouts.app')

@section('title', 'Dashboard Pegawai')

@section('header_title', 'Dashboard Pegawai')

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <div>
        <a href="/pegawai/dashboard"
            class="inline-flex items-center gap-2 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-lg transition-colors duration-200">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Left Column - Information Cards -->
        <div class="lg:col-span-5 space-y-4">
            <!-- Permohonan Information Card -->
            <div class="bg-white border-2 border-indigo-500 rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-2">
                    <h3 class="text-sm font-semibold text-white">Informasi Permohonan</h3>
                </div>
                <div class="p-4 space-y-2">
                    <div class="flex">
                        <span class="w-40 text-xs text-gray-600 font-medium">No. Permohonan</span>
                        <span class="text-xs text-gray-800">:</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 text-xs text-gray-600 font-medium">Tgl Permohonan</span>
                        <span class="text-xs text-gray-800">:</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 text-xs text-gray-600 font-medium">Permohonan</span>
                        <span class="text-xs text-gray-800">: {{$data->layanan->nama}}</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 text-xs text-gray-600 font-medium">No. HP/WA Aktif</span>
                        <span class="text-xs text-gray-800">:</span>
                    </div>
                </div>
            </div>

            <!-- Pegawai Information Card -->
            <div class="bg-white border-2 border-indigo-500 rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-2">
                    <h3 class="text-sm font-semibold text-white">Informasi Pegawai</h3>
                </div>
                <div class="p-4 space-y-2">
                    <div class="flex">
                        <span class="w-40 text-xs text-gray-600 font-medium">NIP</span>
                        <span class="text-xs text-gray-800">: {{$data->pegawai->nip}}</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 text-xs text-gray-600 font-medium">Nama Pegawai</span>
                        <span class="text-xs text-gray-800">: {{$data->pegawai->nama}}</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 text-xs text-gray-600 font-medium">Pangkat / Gol</span>
                        <span class="text-xs text-gray-800">: {{$data->pegawai->nm_pangkat}}
                            {{$data->pegawai->gol_pangkat}}</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 text-xs text-gray-600 font-medium">Jabatan</span>
                        <span class="text-xs text-gray-800">: {{$data->pegawai->ket_jabatan}}</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 text-xs text-gray-600 font-medium">SKPD</span>
                        <span class="text-xs text-gray-800">: {{$data->pegawai->skpd->nama}}</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 text-xs text-gray-600 font-medium">Unit Kerja</span>
                        <span class="text-xs text-gray-800">:-</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Document Table -->
        <div class="lg:col-span-7">
            <div class="bg-white border-2 border-indigo-500 rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-2">
                    <h3 class="text-sm font-semibold text-white">Dokumen Persyaratan</h3>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-xs">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-3 py-2 text-left font-semibold text-gray-700 border border-gray-300">
                                        No Urut</th>
                                    <th class="px-3 py-2 text-left font-semibold text-gray-700 border border-gray-300">
                                        Persyaratan Dokumen</th>
                                    <th class="px-3 py-2 text-left font-semibold text-gray-700 border border-gray-300">
                                        File</th>
                                    <th class="px-3 py-2 text-left font-semibold text-gray-700 border border-gray-300">
                                        Preview</th>
                                    <th class="px-3 py-2 text-left font-semibold text-gray-700 border border-gray-300">
                                        Keterangan</th>
                                    <th
                                        class="px-3 py-2 text-center font-semibold text-gray-700 border border-gray-300">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (dokumen($layanan_id, $data->jenis) as $key => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 py-2 border border-gray-300 text-xs">{{$item->no_urut}}</td>
                                    <td class="px-3 py-2 border border-gray-300 text-xs">
                                        {{$item->nama}}
                                        @if($item->wajib)
                                        <span class="text-red-500">({{$item->wajib}})</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2 border border-gray-300 text-xs text-gray-600">PDF 1 MB</td>
                                    <td class="px-3 py-2 border border-gray-300">
                                        @php
                                        $dokumen = checkFile($id, $data->pegawai->id, $item->id);
                                        @endphp
                                        @if ($dokumen)
                                        <a class="inline-flex items-center gap-1 px-2 py-1 bg-green-500 hover:bg-green-600 text-white text-xs font-medium rounded transition-colors duration-200"
                                            target="_blank"
                                            href="/storage/{{$data->jenis}}/{{$data->pegawai->nip}}/pengajuan{{$id}}/{{$dokumen->file}}">
                                            <i class="fas fa-eye"></i> Preview
                                        </a>
                                        @else
                                        <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 border border-gray-300">
                                        @if ($dokumen != null)
                                        @if ($dokumen->verifikasi == 1)
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded">
                                            <i class="fas fa-check"></i> Valid
                                        </span>
                                        @endif

                                        @if ($dokumen->verifikasi == 2)
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">
                                            <i class="fas fa-times"></i> Revisi
                                        </span>
                                        <span class="text-xs text-gray-600 block mt-1">{{$dokumen->keterangan}}</span>
                                        @endif

                                        @if ($dokumen->perbaikan == 1)
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 bg-indigo-100 text-indigo-700 text-xs font-medium rounded">
                                            <i class="fas fa-check"></i> Telah diperbaiki
                                        </span>
                                        @endif
                                        @endif
                                    </td>
                                    <td class="px-3 py-2 border border-gray-300 text-center">
                                        @if ($data->status != 2)
                                        @if ($dokumen == null)
                                        <button
                                            class="inline-flex items-center gap-1 px-2 py-1 bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-medium rounded transition-colors duration-200 upload-dokumen"
                                            data-id="{{$item->id}}" data-nama="{{$item->nama}}">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                        @else
                                        @if ($dokumen->verifikasi == 2)
                                        <button
                                            class="inline-flex items-center gap-1 px-2 py-1 bg-purple-500 hover:bg-purple-600 text-white text-xs font-medium rounded transition-colors duration-200 upload-perbaikan"
                                            data-id="{{$item->id}}" data-nama="{{$item->nama}}">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                        @else
                                        <button
                                            class="inline-flex items-center gap-1 px-2 py-1 bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-medium rounded transition-colors duration-200 upload-dokumen"
                                            data-id="{{$item->id}}" data-nama="{{$item->nama}}">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                        @endif
                                        @endif
                                        @php
                                        $dokumen = checkFile($id, $data->pegawai->id, $item->id);
                                        @endphp
                                        @if ($dokumen)
                                        <a href="/pegawai/dashboard/{{$id}}/deletedokumen/{{$item->id}}"
                                            onclick="return confirm('Yakin Ingin Dihapus?')"
                                            class="inline-flex items-center gap-1 px-2 py-1 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded transition-colors duration-200">
                                            <i class="fas fa-times"></i> Hapus
                                        </a>
                                        @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Submit Button -->
                    @if ($data->status != 2)
                    <div class="mt-4">
                        <a href="/pegawai/dashboard/{{$id}}/dokumen/kirim"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-semibold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl"
                            onclick="return confirm('Yakin Siap untuk di kirim?');">
                            <i class="fas fa-paper-plane"></i> Kirim Pengajuan
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div id="modal-upload" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
            onclick="closeModal('modal-upload')"></div>

        <!-- Modal panel -->
        <div
            class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form method="post" action="/pegawai/dashboard/{{$id}}/dokumen" enctype="multipart/form-data">
                @csrf
                <div
                    class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-2 sm:px-4 flex justify-between items-center">
                    <h3 class="text-sm leading-6 font-medium text-white" id="modal-title">
                        Upload <span id="nama-upload"></span>
                    </h3>
                    <button type="button" onclick="closeModal('modal-upload')"
                        class="text-white hover:text-gray-200 transition-colors">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <div class="px-4 py-4 sm:p-4">
                    <p class="text-xs text-gray-600 mb-3">
                        <i class="fas fa-info-circle mr-1"></i> Maksimal ukuran file: 1 MB (PDF)
                    </p>
                    <input type="hidden" id="persyaratan_id" name="persyaratan_id">
                    <div class="space-y-2">
                        <label for="file-upload" class="block text-xs font-medium text-gray-700">Pilih File</label>
                        <input type="file" id="file-upload" name="file" accept="application/pdf" required class="block w-full text-xs text-gray-500
                                file:mr-3 file:py-1 file:px-3
                                file:rounded-md file:border-0
                                file:text-xs file:font-medium
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100
                                cursor-pointer
                                focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-4 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                        class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-xs transition-colors duration-200">
                        <i class="fas fa-upload mr-2"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload Perbaikan Modal -->
<div id="modal-perbaikan" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
            onclick="closeModal('modal-perbaikan')"></div>

        <!-- Modal panel -->
        <div
            class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form method="post" action="/pegawai/dashboard/{{$id}}/perbaikan" enctype="multipart/form-data">
                @csrf
                <div
                    class="bg-gradient-to-r from-purple-600 to-pink-600 px-4 py-2 sm:px-4 flex justify-between items-center">
                    <h3 class="text-sm leading-6 font-medium text-white" id="modal-title">
                        Upload Perbaikan <span id="nama-perbaikan"></span>
                    </h3>
                    <button type="button" onclick="closeModal('modal-perbaikan')"
                        class="text-white hover:text-gray-200 transition-colors">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <div class="px-4 py-4 sm:p-4">
                    <p class="text-xs text-gray-600 mb-3">
                        <i class="fas fa-info-circle mr-1"></i> Maksimal ukuran file: 1 MB (PDF)
                    </p>
                    <input type="hidden" id="perbaikan_id" name="perbaikan_id">
                    <div class="space-y-2">
                        <label for="file-perbaikan" class="block text-xs font-medium text-gray-700">Pilih File
                            Perbaikan</label>
                        <input type="file" id="file-perbaikan" name="file" accept="application/pdf" required class="block w-full text-xs text-gray-500
                                file:mr-3 file:py-1 file:px-3
                                file:rounded-md file:border-0
                                file:text-xs file:font-medium
                                file:bg-purple-50 file:text-purple-700
                                hover:file:bg-purple-100
                                cursor-pointer
                                focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-4 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                        class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-purple-600 text-sm font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-3 sm:w-auto sm:text-xs transition-colors duration-200">
                        <i class="fas fa-upload mr-2"></i> Upload Perbaikan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }

    // Upload dokumen button click handler
    document.addEventListener('DOMContentLoaded', function() {
        // Handle upload-dokumen clicks
        document.body.addEventListener('click', function(e) {
            const uploadBtn = e.target.closest('.upload-dokumen');
            if (uploadBtn) {
                e.preventDefault();
                const id = uploadBtn.getAttribute('data-id');
                const nama = uploadBtn.getAttribute('data-nama');
                
                const persyaratanInput = document.getElementById('persyaratan_id');
                const namaSpan = document.getElementById('nama-upload');
                
                if (persyaratanInput) {
                    persyaratanInput.value = id;
                }
                if (namaSpan) {
                    namaSpan.textContent = nama;
                }
                
                openModal('modal-upload');
            }
        });

        // Handle upload-perbaikan clicks
        document.body.addEventListener('click', function(e) {
            const uploadBtn = e.target.closest('.upload-perbaikan');
            if (uploadBtn) {
                e.preventDefault();
                const id = uploadBtn.getAttribute('data-id');
                const nama = uploadBtn.getAttribute('data-nama');
                
                const perbaikanInput = document.getElementById('perbaikan_id');
                const namaSpan = document.getElementById('nama-perbaikan');
                
                if (perbaikanInput) {
                    perbaikanInput.value = id;
                }
                if (namaSpan) {
                    namaSpan.textContent = nama;
                }
                
                openModal('modal-perbaikan');
            }
        });
    });
</script>
@endpush