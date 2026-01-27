@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush

@section('title', 'Dokumen Kepangkatan')

@section('content')
<div class="mb-4">
    <a href="/kepangkatan/dashboard"
        class="inline-flex items-center gap-2 px-3 py-1.5 bg-white hover:bg-gray-50 text-gray-700 text-xs font-medium rounded-lg shadow-sm transition-all duration-200 hover:shadow-md">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
            </path>
        </svg>
        Kembali
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-5 gap-4">
    <!-- Card Kiri: Informasi Permohonan -->
    <div class="lg:col-span-2 space-y-4">
        <!-- Card Informasi Permohonan -->
        <div class="bg-white border-2 border-indigo-500 rounded-lg shadow-lg overflow-hidden">
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-4 py-2">
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
                    <span class="text-xs text-gray-800">: {{ $data->layanan->nama }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 text-xs text-gray-600 font-medium">No. HP/WA Aktif</span>
                    <span class="text-xs text-gray-800">:</span>
                </div>
            </div>
        </div>

        <!-- Card Informasi Pegawai -->
        <div class="bg-white border-2 border-indigo-500 rounded-lg shadow-lg overflow-hidden">
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-4 py-2">
                <h3 class="text-sm font-semibold text-white">Informasi Pegawai</h3>
            </div>

            <div class="p-4 space-y-2">
                <div class="flex">
                    <span class="w-40 text-xs text-gray-600 font-medium">NIP</span>
                    <span class="text-xs text-gray-800">: {{ $data->pegawai->nip }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 text-xs text-gray-600 font-medium">Nama Pegawai</span>
                    <span class="text-xs text-gray-800">: {{ $data->pegawai->nama }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 text-xs text-gray-600 font-medium">Pangkat / Gol</span>
                    <span class="text-xs text-gray-800">: {{ $data->pegawai->nm_pangkat }} {{
                        $data->pegawai->gol_pangkat }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 text-xs text-gray-600 font-medium">Jabatan</span>
                    <span class="text-xs text-gray-800">: {{ $data->pegawai->ket_jabatan }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 text-xs text-gray-600 font-medium">SKPD</span>
                    <span class="text-xs text-gray-800">: {{ $data->pegawai->skpd }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 text-xs text-gray-600 font-medium">UNIT KERJA</span>
                    <span class="text-xs text-gray-800">: {{ $data->pegawai->skpd }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Kanan: Tabel Dokumen -->
    <div class="lg:col-span-3">
        <div class="bg-white border-2 border-indigo-500 rounded-lg shadow-lg overflow-hidden">
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-4 py-2">
                <h3 class="text-sm font-semibold text-white">Dokumen Persyaratan</h3>
            </div>

            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-xs">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-3 py-2 text-left font-semibold text-gray-700 border border-gray-300">No
                                </th>
                                <th class="px-3 py-2 text-left font-semibold text-gray-700 border border-gray-300">
                                    Persyaratan Dokumen</th>
                                <th class="px-3 py-2 text-left font-semibold text-gray-700 border border-gray-300">File
                                </th>
                                <th class="px-3 py-2 text-left font-semibold text-gray-700 border border-gray-300">
                                    Preview</th>
                                <th class="px-3 py-2 text-left font-semibold text-gray-700 border border-gray-300">
                                    Keterangan</th>
                                <th class="px-3 py-2 text-center font-semibold text-gray-700 border border-gray-300">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (dokumen($layanan_id, $data->jenis) as $key => $item)
                            @php
                            $dokumen = checkFile($id, $data->pegawai->id, $item->id);
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-3 py-2 border border-gray-300 text-xs">{{ $item->no_urut }}</td>
                                <td class="px-3 py-2 border border-gray-300 text-xs">{{ $item->nama }}</td>
                                <td class="px-3 py-2 border border-gray-300 text-xs text-gray-600">PDF 1 MB</td>
                                <td class="px-3 py-2 border border-gray-300">
                                    @if ($dokumen)
                                    <a target="_blank"
                                        href="/storage/kepangkatan/{{ $data->pegawai->nip }}/pengajuan{{ $id }}/{{ $dokumen->file }}"
                                        class="inline-flex items-center gap-1 px-2 py-1 bg-green-500 hover:bg-green-600 text-white text-xs font-medium rounded transition-colors duration-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Preview
                                    </a>
                                    @else
                                    <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2 border border-gray-300">
                                    @if ($dokumen != null)
                                    @if ($dokumen->verifikasi == 1)
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Disetujui
                                    </span>
                                    @endif
                                    @if ($dokumen->verifikasi == 2)
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Ditolak
                                    </span>
                                    <span class="text-xs text-gray-600 block mt-1">{{ $dokumen->keterangan }}</span>
                                    @endif
                                    @endif
                                </td>
                                <td class="px-3 py-2 border border-gray-300 text-center">
                                    @if ($data->status != 2)
                                    @if ($dokumen != null)
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="/kepangkatan/dokumen/{{ $id }}/berkas-ok/{{ $dokumen->id }}"
                                            onclick="return confirm('Berkas sudah OK?')"
                                            class="inline-flex items-center justify-center p-1 bg-green-500 hover:bg-green-600 text-white rounded transition-colors duration-200"
                                            title="Setujui">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </a>
                                        <button
                                            class="perbaiki-dokumen inline-flex items-center justify-center p-1 bg-red-500 hover:bg-red-600 text-white rounded transition-colors duration-200"
                                            data-id="{{ $dokumen->id }}" title="Tolak">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Perbaiki Dokumen -->
<div id="modal-perbaiki" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div id="modal-backdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- Modal panel -->
        <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form method="post" action="/kepangkatan/dokumen/{{ $id }}/perbaikidokumen" enctype="multipart/form-data">
                @csrf
                <div class="bg-gradient-to-r from-red-500 to-red-600 px-4 py-2 flex justify-between items-center">
                    <h3 class="text-sm leading-6 font-medium text-white" id="modal-title">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        Berikan Keterangan Dokumen Ditolak
                    </h3>
                    <button type="button" onclick="closeModal('modal-perbaiki')" class="text-white hover:text-gray-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="px-4 py-4">
                    <div class="space-y-2">
                        <label for="keterangan" class="block text-xs font-medium text-gray-700">
                            Alasan Penolakan
                        </label>
                        <input type="hidden" id="persyaratan_id" name="persyaratan_id">
                        <input type="text" id="keterangan" name="keterangan"
                            class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 p-2"
                            placeholder="Masukkan alasan penolakan..." required>
                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('modal-perbaiki')"
                        class="px-3 py-1.5 text-xs text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-3 py-1.5 bg-gradient-to-r from-purple-600 to-blue-600 text-white text-xs font-medium rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all duration-200">
                        Kirim ke Pegawai
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

    // Perbaiki dokumen button click handler
    document.addEventListener('DOMContentLoaded', function() {
        document.body.addEventListener('click', function(e) {
            const perbaikiBtn = e.target.closest('.perbaiki-dokumen');
            if (perbaikiBtn) {
                e.preventDefault();
                const id = perbaikiBtn.getAttribute('data-id');
                
                const persyaratanInput = document.getElementById('persyaratan_id');
                if (persyaratanInput) {
                    persyaratanInput.value = id;
                }
                
                openModal('modal-perbaiki');
            }
        });
    });
</script>
@endpush
