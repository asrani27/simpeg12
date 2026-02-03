<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pegawai;
use App\Models\Pengajuan;
use App\Models\Skpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the superadmin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function superadmin()
    {
        // Statistics data
        $totalPegawai = Pegawai::count();
        $totalSkpd = Skpd::where('is_aktif', 1)->count();
        $totalPengajuan = Pengajuan::count();
        $totalUsers = \App\Models\User::count();

        // Pegawai by status
        $pegawaiPNS = Pegawai::where('status_pegawai', 'PNS')->count();
        $pegawaiCPNS = Pegawai::where('status_pegawai', 'CPNS')->count();
        $pegawaiPPPK = Pegawai::where('status_pegawai', 'like', 'PPPK%')->count();

        // Pengajuan by status
        $pengajuanMenunggu = Pengajuan::where('status', 'menunggu')->count();
        $pengajuanDiproses = Pengajuan::where('status', 'diproses')->count();
        $pengajuanSelesai = Pengajuan::where('status', 'selesai')->count();

        // Recent activities - get latest pegawai additions
        $recentPegawai = Pegawai::with('skpd')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Recent pengajuan
        $recentPengajuan = Pengajuan::with(['pegawai', 'layanan'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // DMS statistics
        $totalDMS = \App\Models\Dms::count();
        $dmsComplete = \App\Models\Dms::whereNotNull('drh')
            ->whereNotNull('sk_cpns')
            ->whereNotNull('d2np')
            ->whereNotNull('spmt')
            ->whereNotNull('sk_pns')
            ->count();

        return view('superadmin.dashboard', compact(
            'totalPegawai',
            'totalSkpd',
            'totalPengajuan',
            'totalUsers',
            'pegawaiPNS',
            'pegawaiCPNS',
            'pegawaiPPPK',
            'pengajuanMenunggu',
            'pengajuanDiproses',
            'pengajuanSelesai',
            'recentPegawai',
            'recentPengajuan',
            'totalDMS',
            'dmsComplete'
        ));
    }

    /**
     * Display the SKPD dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function skpd()
    {
        // Get the SKPD of the current logged-in user
        $user = Auth::user();
        $kodeSkpd = $user->skpd->kode_skpd ?? null;

        // Statistics data
        $totalPegawai = Pegawai::where('kode_skpd', $kodeSkpd)->count();

        // Pengajuan statistics by status
        $pengajuanMenunggu = Pengajuan::whereHas('pegawai', function ($query) use ($kodeSkpd) {
            $query->where('kode_skpd', $kodeSkpd);
        })->where('status', 'menunggu')->count();

        $pengajuanDiproses = Pengajuan::whereHas('pegawai', function ($query) use ($kodeSkpd) {
            $query->where('kode_skpd', $kodeSkpd);
        })->where('status', 'diproses')->count();

        $pengajuanSelesai = Pengajuan::whereHas('pegawai', function ($query) use ($kodeSkpd) {
            $query->where('kode_skpd', $kodeSkpd);
        })->where('status', 'selesai')->count();

        // Recent pengajuan (5 most recent)
        $recentPengajuan = Pengajuan::with(['pegawai', 'layanan'])
            ->whereHas('pegawai', function ($query) use ($kodeSkpd) {
                $query->where('kode_skpd', $kodeSkpd);
            })
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('skpd.dashboard', compact(
            'totalPegawai',
            'pengajuanMenunggu',
            'pengajuanDiproses',
            'pengajuanSelesai',
            'recentPengajuan'
        ));
    }

    /**
     * Display the DMS dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dms(Request $request)
    {
        $query = \App\Models\Dms::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nip', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('drh', 'like', "%{$search}%")
                    ->orWhere('sk_cpns', 'like', "%{$search}%")
                    ->orWhere('d2np', 'like', "%{$search}%")
                    ->orWhere('spmt', 'like', "%{$search}%")
                    ->orWhere('sk_pns', 'like', "%{$search}%");
            });
        }

        // Order by created_at descending
        $query->orderBy('created_at', 'desc');

        // Pagination with 20 items per page, preserving search parameters
        $dmsData = $query->paginate(20)->appends(['search' => $request->search]);

        // Calculate statistics for each document type based on actual filenames
        $totalData = \App\Models\Dms::count();
        $documentFields = ['drh', 'sk_cpns', 'd2np', 'spmt', 'sk_pns'];

        $stats = [];
        foreach ($documentFields as $field) {
            $stats[$field] = [
                'uploaded' => \App\Models\Dms::whereNotNull($field)->where($field, '!=', '')->count(),
                'not_uploaded' => \App\Models\Dms::where(function ($q) use ($field) {
                    $q->whereNull($field)->orWhere($field, '=', '');
                })->count()
            ];
        }

        return view('admin.dms.dashboard', compact('dmsData', 'stats', 'totalData'));
    }

    /**
     * Display the pegawai dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function pegawai()
    {
        // Get all layanan services
        $layananList = \App\Models\Layanan::all();

        // Get current logged-in user
        $user = auth()->user();

        // Find Dms record for this user (assuming user has nip field)
        $dmsData = \App\Models\Dms::where('nip', $user->username ?? null)->first();

        // Check for incomplete documents (status "belum")
        $incompleteDocuments = [];
        $hasWarnings = false;

        if ($dmsData) {
            $fields = ['drh', 'sk_cpns', 'spmt', 'sk_pns'];
            $fieldLabels = [
                'drh' => 'Daftar Riwayat Hidup (DRH)',
                'sk_cpns' => 'SK CPNS',
                'spmt' => 'SPMT',
                'sk_pns' => 'SK PNS'
            ];

            foreach ($fields as $field) {
                if ($dmsData->$field === 'belum' || $dmsData->$field === NULL) {
                    $incompleteDocuments[] = $fieldLabels[$field];
                    $hasWarnings = true;
                }
            }
        } else {
            // If no Dms record found, consider all documents as incomplete
            $incompleteDocuments = [
                'Daftar Riwayat Hidup (DRH)',
                'SK CPNS',
                'SPMT',
                'SK PNS'
            ];
            $hasWarnings = true;
        }


        $pegawai = Auth::user()->pegawai;
        $layanan = Layanan::get();
        $pengajuan = Pengajuan::where('pegawai_id', $pegawai->id)->get();

        return view('pegawai.dashboard', compact('layananList', 'hasWarnings', 'incompleteDocuments', 'dmsData', 'pegawai', 'layanan', 'pengajuan'));
    }

    /**
     * Display the kepangkatan dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function kepangkatan()
    {
        //Sub Bidang Kepangkatan
        $pangkat = Pengajuan::where('jenis', 'kepangkatan')->where('status', 1)->whereNull('verifikator')->count();
        $diproses = Pengajuan::where('jenis', 'kepangkatan')->where('status', 1)->whereNotNull('verifikator')->count();
        $selesai = Pengajuan::where('jenis', 'kepangkatan')->where('status', 2)->count();

        // Get data with pagination - eager load pegawai relationship and uploads
        $query = Pengajuan::with(['pegawai', 'upload', 'nama_verifikator'])
            ->where('jenis', 'kepangkatan')
            ->where(function ($q) {
                $q->where('status', '1')
                    ->orWhere('status', '0');
            });

        // Get all records to sort them properly by gol_pangkat
        $data = $query->get()->map(function ($item) {
            $item->gol_pangkat = $item->pegawai->gol_pangkat ?? '';
            return $item;
        })->sortBy(function ($item) {
            return sortValue($item->gol_pangkat);
        })->values();
        return view('kepangkatan.dashboard', compact('pangkat', 'diproses', 'selesai', 'data'));
    }

    /**
     * Display the pensiun dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function pensiun()
    {
        //Sub Bidang Pensiun
        $pensiun = Pengajuan::where('jenis', 'pensiun')->where('status', 1)->whereNull('verifikator')->count();
        $diproses = Pengajuan::where('jenis', 'pensiun')->where('status', 1)->whereNotNull('verifikator')->count();
        $selesai = Pengajuan::where('jenis', 'pensiun')->where('status', 2)->count();

        // Get data with pagination - eager load pegawai relationship and uploads
        $query = Pengajuan::with(['pegawai', 'upload', 'nama_verifikator'])
            ->where('jenis', 'pensiun')
            ->where(function ($q) {
                $q->where('status', '1')
                    ->orWhere('status', '0');
            });

        // Get all records to sort them properly by gol_pangkat
        $data = $query->get()->map(function ($item) {
            $item->gol_pangkat = $item->pegawai->gol_pangkat ?? '';
            return $item;
        })->sortBy(function ($item) {
            return sortValue($item->gol_pangkat);
        })->values();
        return view('pensiun.dashboard', compact('pensiun', 'diproses', 'selesai', 'data'));
    }

    public function usul_pns()
    {
        //Sub Bidang usul_pns
        $usul_pns = Pengajuan::where('jenis', 'usul_pns')->where('status', 1)->whereNull('verifikator')->count();
        $diproses = Pengajuan::where('jenis', 'usul_pns')->where('status', 1)->whereNotNull('verifikator')->count();
        $selesai = Pengajuan::where('jenis', 'usul_pns')->where('status', 2)->count();

        // Get data with pagination - eager load pegawai relationship and uploads
        $query = Pengajuan::with(['pegawai', 'upload', 'nama_verifikator'])
            ->where('jenis', 'usul_pns')
            ->where(function ($q) {
                $q->where('status', '1')
                    ->orWhere('status', '0');
            });

        // Get all records to sort them properly by gol_pangkat
        $data = $query->get()->map(function ($item) {
            $item->gol_pangkat = $item->pegawai->gol_pangkat ?? '';
            return $item;
        })->sortBy(function ($item) {
            return sortValue($item->gol_pangkat);
        })->values();
        return view('usul_pns.dashboard', compact('usul_pns', 'diproses', 'selesai', 'data'));
    }
}
