@extends('layouts.app')

@section('title')
Beranda
@endsection

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
  <!-- usul_pns Baru -->
  <a href="/usul_pns/baru" class="group">
    <div
      class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-4 hover:shadow-xl hover:scale-105 transition-all duration-300">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-blue-100 text-xs font-medium mb-0.5">usul_pns Baru</p>
          <h3 class="text-2xl font-bold text-white">{{ $usul_pns }}</h3>
          <p class="text-blue-100 text-[10px] mt-1">Total Data Pengajuan usul_pns Baru</p>
        </div>
        <div class="bg-white/20 rounded-full p-3 group-hover:bg-white/30 transition-colors">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
            </path>
          </svg>
        </div>
      </div>
      <div class="mt-4">
        <div class="bg-white/20 rounded-full h-2 overflow-hidden">
          <div class="bg-white h-full rounded-full" style="width: 70%"></div>
        </div>
      </div>
    </div>
  </a>

  <!-- usul_pns Diproses -->
  <a href="/usul_pns/diproses" class="group">
    <div
      class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-lg p-4 hover:shadow-xl hover:scale-105 transition-all duration-300">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-emerald-100 text-xs font-medium mb-0.5">usul_pns Diproses</p>
          <h3 class="text-2xl font-bold text-white">{{ $diproses }}</h3>
          <p class="text-emerald-100 text-[10px] mt-1">Total Data usul_pns Diproses</p>
        </div>
        <div class="bg-white/20 rounded-full p-3 group-hover:bg-white/30 transition-colors">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
            </path>
          </svg>
        </div>
      </div>
      <div class="mt-4">
        <div class="bg-white/20 rounded-full h-2 overflow-hidden">
          <div class="bg-white h-full rounded-full" style="width: 70%"></div>
        </div>
      </div>
    </div>
  </a>

  <!-- usul_pns Selesai -->
  <a href="/usul_pns/selesai" class="group">
    <div
      class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-lg p-4 hover:shadow-xl hover:scale-105 transition-all duration-300">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-amber-100 text-xs font-medium mb-0.5">usul_pns Selesai</p>
          <h3 class="text-2xl font-bold text-white">{{ $selesai }}</h3>
          <p class="text-amber-100 text-[10px] mt-1">Total Data usul_pns Selesai</p>
        </div>
        <div class="bg-white/20 rounded-full p-3 group-hover:bg-white/30 transition-colors">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
      </div>
      <div class="mt-3">
        <div class="bg-white/20 rounded-full h-1.5 overflow-hidden">
          <div class="bg-white h-full rounded-full" style="width: 70%"></div>
        </div>
      </div>
    </div>
  </a>
</div>

<!-- Data Table Card -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
  <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-4 py-3">
    <h3 class="text-sm font-semibold text-white">Daftar ASN yang mengajukan usul_pns</h3>
  </div>

  <div class="p-6">
    <div class="overflow-x-auto">
      <table id="usul_pnsTable" class="display" style="width:100%">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK/Nama</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Golongan</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokumen</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Di Proses Oleh
            </th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach ($data as $item)
          <tr data-id="{{ $loop->index + 1 }}">
            <td class="px-4 py-4 text-sm text-gray-900 font-medium"></td>
            <td class="px-4 py-4 text-sm text-gray-600">
              {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
            </td>
            <td class="px-4 py-4 text-sm text-gray-900">
              <div class="font-medium text-gray-900">{{ $item->pegawai->nama }}</div>
              <div class="text-xs text-gray-500">{{ $item->pegawai->nip }}</div>
              <div class="text-xs text-gray-600">{{ $item->pegawai->nm_pangkat }}</div>
            </td>
            <td class="px-4 py-4 text-sm text-gray-600">
              {{ $item->pegawai->gol_pangkat }}
            </td>
            <td class="px-4 py-4 text-sm">
              <a href="/usul_pns/dokumen/{{ $item->id }}"
                class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 transition-colors">
                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                  </path>
                </svg>
                Dokumen
              </a>
            </td>
            <td class="px-4 py-4 text-sm text-gray-600">
              @if ($item->upload->where('verifikasi', 2)->count() != 0)
              <div class="flex items-center text-red-600 text-xs mb-1">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
                </svg>
                {{ $item->upload->where('verifikasi', 2)->count() }} Perlu Perbaikan
              </div>
              @endif
              @if ($item->upload->where('perbaikan', 1)->count() != 0)
              <div class="flex items-center text-green-600 text-xs">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd"></path>
                </svg>
                {{ $item->upload->where('perbaikan', 1)->count() }} Telah Diperbaiki
              </div>
              @endif
            </td>
            <td class="px-4 py-4 text-sm text-gray-600">
              {{ $item->nama_verifikator == null ? '-' : wordwrap($item->nama_verifikator->name, 17, true) }}
            </td>
            <td class="px-4 py-4 text-sm">
              @if ($item->status == 1 && $item->verifikator != null)
              <span
                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                DIPROSES
              </span>
              @endif
              @if ($item->status == 2)
              <span
                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                SELESAI
              </span>
              @endif
            </td>
            <td class="px-4 py-4 text-sm">
              @if ($item->status == 2)
              @else
              <div class="flex space-x-1">
                @if ($item->nama_verifikator == null)
                <a href="/usul_pns/prosespengajuan/{{ $item->id }}" onclick="return confirm('Yakin Ingin di proses?')"
                  class="inline-flex items-center px-3 py-1.5 bg-emerald-600 text-white text-xs font-medium rounded-md hover:bg-emerald-700 transition-colors">
                  <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                    </path>
                  </svg>
                  PROSES
                </a>
                @endif
                <a href="/usul_pns/deletepengajuan/{{ $item->id }}" onclick="return confirm('Yakin Ingin Dihapus?')"
                  class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-md hover:bg-red-700 transition-colors">
                  <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>
                  </svg>
                  HAPUS
                </a>
                @if ($item->nama_verifikator != null)
                <a href="/usul_pns/selesaipengajuan/{{ $item->id }}" onclick="return confirm('Yakin sudah selesai?')"
                  class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 transition-colors">
                  <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                  SELESAI
                </a>
                @endif
              </div>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    var table = $('#usul_pnsTable').DataTable({
      responsive: true,
      pageLength: 10,
      lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
      language: {
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ data",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        infoEmpty: "Tidak ada data",
        infoFiltered: "(difilter dari _MAX_ total data)",
        paginate: {
          first: "Pertama",
          last: "Terakhir",
          next: "Selanjutnya",
          previous: "Sebelumnya"
        },
        zeroRecords: "Data tidak ditemukan",
        emptyTable: "Tidak ada data tersedia"
      },
      columnDefs: [
        { orderable: false, targets: [0, 8] } // Disable sorting for # and Aksi columns
      ],
      order: [[1, 'desc']], // Default sort by Tanggal (column 1) descending
      drawCallback: function(settings) {
        var api = this.api();
        var rows = api.rows({ page: 'current' }).nodes();
        var page = api.page.info();
        
        // Update row numbers based on current page
        api.column(0, { page: 'current' }).nodes().each(function(cell, i) {
          cell.innerHTML = page.start + i + 1;
        });
      }
    });
  });
</script>
@endpush