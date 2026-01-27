@extends('layouts.app')

@section('title')
Pangkat
@endsection
@section('content')

<!-- Main Content Card -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
  <!-- Card Header -->
  <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-4">
    <h3 class="text-lg font-semibold text-white">Daftar Pengajuan Kenaikan Pangkat</h3>
  </div>

  <!-- Card Body -->
  <div class="p-6">
    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">NIP/Nama/Jabatan</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jenis</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach ($data as $key => $item)
          <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-4 py-4 text-sm text-gray-900 font-medium">
              {{$data->firstItem() + $key}}
            </td>
            <td class="px-4 py-4">
              <div class="text-sm text-gray-900 font-medium">{{$item->pegawai->nip}}</div>
              <div class="text-sm text-gray-700">{{$item->pegawai->nama}}</div>
              <div class="text-sm text-gray-600">{{$item->pegawai->nm_pangkat}} {{$item->pegawai->gol_pangkat}}</div>
            </td>
            <td class="px-4 py-4 text-sm text-gray-600">
              {{\Carbon\Carbon::parse($item->created_at)->format('d M Y H:i')}}
            </td>
            <td class="px-4 py-4 text-sm text-gray-900">
              {{$item->layanan->nama}}
            </td>
            <td class="px-4 py-4 text-sm">
              <a href="/kepangkatan/dokumen/{{$item->id}}"
                class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 transition-colors">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                  </path>
                </svg>
                Dokumen Persyaratan
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
      {{$data->appends(request()->query())->links()}}
    </div>
  </div>
</div>


<!-- Modal -->
<div x-data="{ openModal: false }" x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
  <!-- Backdrop -->
  <div x-show="openModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="openModal = false"></div>

  <!-- Modal Panel -->
  <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
    <div x-show="openModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative bg-white rounded-xl shadow-xl transform transition-all sm:max-w-md w-full">
      
      <!-- Modal Content -->
      <form method="post" action="/kepangkatan/pangkat/ditolak" enctype="multipart/form-data">
        @csrf
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4 rounded-t-xl">
          <h3 class="text-sm font-semibold text-white">Isi Alasan / Keterangan</h3>
        </div>

        <!-- Body -->
        <div class="px-6 py-4">
          <textarea name="keterangan_tolak" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-colors resize-none" placeholder="Masukkan alasan penolakan..."></textarea>
          <input type="hidden" id="pangkat_id" name="pangkat_id">
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex justify-between space-x-3">
          <button type="button" @click="openModal = false" class="flex-1 px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-md border border-gray-300 hover:bg-gray-50 transition-colors">
            Batal
          </button>
          <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition-colors">
            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
            </svg>
            Kirim
          </button>
        </div>
      </form>

      <!-- Close Button -->
      <button @click="openModal = false" class="absolute top-4 right-4 text-white/80 hover:text-white transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
  </div>
</div>

<script>
  $(document).on('click', '.kembalikan', function() {
   $('#pangkat_id').val($(this).data('id'));
   // Use Alpine.js to open modal
   document.querySelector('[x-data]').__x.$data.openModal = true;
});
</script>
@endsection
