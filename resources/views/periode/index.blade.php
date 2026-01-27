@extends('layouts.app')

@section('title')
Periode
@endsection

@section('content')

<!-- Main Content Card -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
  <!-- Card Header -->
  <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-4 flex justify-between items-center">
    <h3 class="text-lg font-semibold text-white">Data Periode</h3>
    <button type="button" onclick="document.getElementById('modalTambah').style.display='block'"
      class="inline-flex items-center px-3 py-1.5 bg-white/20 hover:bg-white/30 text-white text-sm font-medium rounded-md transition-colors">
      <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
      </svg>
      Tambah Periode
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
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Periode
            </th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Mulai</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Sampai</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach ($data as $key => $item)
          <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-4 py-4 text-sm text-gray-900 font-medium">
              {{$data->firstItem() + $key}}
            </td>
            <td class="px-4 py-4 text-sm text-gray-900">
              {{$item->nama}}
            </td>
            <td class="px-4 py-4 text-sm text-gray-600">
              {{$item->mulai}}
            </td>
            <td class="px-4 py-4 text-sm text-gray-600">
              {{$item->sampai}}
            </td>
            <td class="px-4 py-4 text-sm">
              <div class="flex space-x-2">
                <button type="button"
                  onclick="editPeriode('{{$item->id}}', '{{$item->nama}}', '{{$item->mulai}}', '{{$item->sampai}}')"
                  class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 transition-colors">
                  <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                  </svg>
                  Edit
                </button>
                <a href="/periode/delete/{{$item->id}}" onclick="return confirm('Yakin ingin menghapus data ini?');"
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

    <!-- Pagination -->
    <div class="mt-6">
      {{$data->appends(request()->query())->links()}}
    </div>
  </div>
</div>

<!-- Modal Tambah -->
<div id="modalTambah" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
  <!-- Backdrop -->
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
    onclick="document.getElementById('modalTambah').style.display='none'"></div>

  <!-- Modal Panel -->
  <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
    <div class="relative bg-white rounded-xl shadow-xl transform transition-all sm:max-w-md w-full">

      <!-- Modal Content -->
      <form method="post" action="/periode" enctype="multipart/form-data">
        @csrf

        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-4 rounded-t-xl">
          <h3 class="text-sm font-semibold text-white">Tambah Data Periode</h3>
        </div>

        <!-- Body -->
        <div class="px-6 py-4 space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Periode</label>
            <input type="text" name="nama" placeholder="Masukkan nama periode"
              class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mulai</label>
            <input type="datetime-local" name="mulai"
              class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sampai</label>
            <input type="datetime-local" name="sampai"
              class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors">
          </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex justify-between space-x-3">
          <button type="button" onclick="document.getElementById('modalTambah').style.display='none'"
            class="flex-1 px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-md border border-gray-300 hover:bg-gray-50 transition-colors">
            Batal
          </button>
          <button type="submit"
            class="flex-1 px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md hover:bg-purple-700 transition-colors">
            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Simpan
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
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
    onclick="document.getElementById('modalEdit').style.display='none'"></div>

  <!-- Modal Panel -->
  <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
    <div class="relative bg-white rounded-xl shadow-xl transform transition-all sm:max-w-md w-full">

      <!-- Modal Content -->
      <form method="post" action="/periode/edit" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="periode_id" name="periode_id">

        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-4 rounded-t-xl">
          <h3 class="text-sm font-semibold text-white">Edit Data Periode</h3>
        </div>

        <!-- Body -->
        <div class="px-6 py-4 space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Periode</label>
            <input type="text" id="nama_periode" name="nama"
              class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mulai</label>
            <input type="datetime-local" id="mulai" name="mulai"
              class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sampai</label>
            <input type="datetime-local" id="sampai" name="sampai"
              class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
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
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
              </path>
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
function editPeriode(id, nama, mulai, sampai) {
  document.getElementById('periode_id').value = id;
  document.getElementById('nama_periode').value = nama;
  document.getElementById('mulai').value = mulai;
  document.getElementById('sampai').value = sampai;
  document.getElementById('modalEdit').style.display = 'block';
}
</script>
@endsection