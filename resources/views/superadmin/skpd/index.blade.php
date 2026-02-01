@extends('layouts.app')

@section('header_title', 'Kelola SKPD')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola SKPD</h1>
            <p class="text-sm text-gray-600 mt-1">Kelola data Satuan Kerja Perangkat Daerah di sistem</p>
        </div>
        <a href="{{ route('superadmin.skpd.create') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            Tambah SKPD
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total SKPD</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $skpds->total() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Aktif</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $skpds->where('is_aktif', 1)->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Non-Aktif</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $skpds->where('is_aktif', 0)->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Daftar SKPD</h2>
        </div>

        @if($skpds->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode
                            SKPD</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            SKPD</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Dibuat</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($skpds as $skpd)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $skpd->kode_skpd }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $skpd->nama }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($skpd->user)
                                <img src="https://ui-avatars.com/api/?name={{ $skpd->user->name }}&background=8b5cf6&color=fff"
                                    alt="{{ $skpd->user->name }}" class="w-8 h-8 rounded-full mr-2">
                                <div class="text-sm text-gray-900">{{ $skpd->user->username }}</div>
                                @else
                                <span class="text-sm text-gray-400">-</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($skpd->is_aktif)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Aktif
                            </span>
                            @else
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Non-Aktif
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $skpd->created_at->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('superadmin.skpd.show', $skpd->id) }}"
                                    class="text-blue-600 hover:text-blue-900 transition-colors duration-150"
                                    title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </a>
                                <a href="{{ route('superadmin.skpd.edit', $skpd->id) }}"
                                    class="text-yellow-600 hover:text-yellow-900 transition-colors duration-150"
                                    title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </a>

                                @if(!$skpd->user_id)
                                <a href="{{ route('superadmin.skpd.showCreateUser', $skpd->id) }}"
                                    class="text-green-600 hover:text-green-900 transition-colors duration-150"
                                    title="Buat User">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                        </path>
                                    </svg>
                                </a>
                                @else
                                <button
                                    onclick="openResetPasswordModal({{ $skpd->id }}, {{ json_encode($skpd->user->name) }})"
                                    class="text-purple-600 hover:text-purple-900 transition-colors duration-150"
                                    title="Reset Password">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                        </path>
                                    </svg>
                                </button>
                                @endif

                                <form action="{{ route('superadmin.skpd.destroy', $skpd->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus SKPD ini?');"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 transition-colors duration-150"
                                        title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($skpds->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-600">
                Menampilkan {{ $skpds->firstItem() }} sampai {{ $skpds->lastItem() }} dari {{ $skpds->total() }} data
            </div>
            <div class="flex items-center">
                {{ $skpds->links() }}
            </div>
        </div>
        @endif
        @else
        <div class="px-6 py-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                </path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data</h3>
            <p class="mt-1 text-sm text-gray-500">Belum ada SKPD yang ditambahkan.</p>
            <div class="mt-6">
                <a href="{{ route('superadmin.skpd.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah SKPD
                </a>
            </div>
        </div>
        @endif
    </div>


    <!-- Reset Password Modal -->
    <div id="resetPasswordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Reset Password User</h3>
            </div>
            <form id="resetPasswordForm" action="{{ route('superadmin.skpd.resetPassword') }}" method="POST"
                class="p-6 space-y-4">
                @csrf
                <input type="hidden" id="reset_skpd_id" name="skpd_id">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">User</label>
                    <input type="text" id="reset_user_name" name="user_name" readonly
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                </div>

                <div>
                    <label for="reset_password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru <span
                            class="text-red-500">*</span></label>
                    <input type="password" id="reset_password" name="password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan password baru (minimal 8 karakter)" required>
                </div>

                <div>
                    <label for="reset_password_confirmation"
                        class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password <span
                            class="text-red-500">*</span></label>
                    <input type="password" id="reset_password_confirmation" name="password_confirmation"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ulangi password baru" required>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeResetPasswordModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openResetPasswordModal(skpdId, userName) {
        document.getElementById('resetPasswordModal').classList.remove('hidden');
        document.getElementById('resetPasswordModal').classList.add('flex');
        document.getElementById('reset_skpd_id').value = skpdId;
        document.getElementById('reset_user_name').value = userName;
        document.getElementById('reset_password').value = '';
        document.getElementById('reset_password_confirmation').value = '';
    }

    function closeResetPasswordModal() {
        document.getElementById('resetPasswordModal').classList.add('hidden');
        document.getElementById('resetPasswordModal').classList.remove('flex');
    }

    // Close modals when clicking outside
    document.getElementById('resetPasswordModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeResetPasswordModal();
        }
    });
</script>
@endsection