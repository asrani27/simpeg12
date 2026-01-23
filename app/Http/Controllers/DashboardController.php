<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the superadmin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function superadmin()
    {
        return view('superadmin.dashboard');
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

        // Calculate statistics for each document type based on actual values
        $totalData = \App\Models\Dms::count();

        $stats = [
            'drh' => [
                'uploaded' => \App\Models\Dms::where('drh', 'sudah')->count(),
                'not_uploaded' => \App\Models\Dms::where('drh', 'belum')->count()
            ],
            'sk_cpns' => [
                'uploaded' => \App\Models\Dms::where('sk_cpns', 'sudah')->count(),
                'not_uploaded' => \App\Models\Dms::where('sk_cpns', 'belum')->count()
            ],
            'd2np' => [
                'uploaded' => \App\Models\Dms::where('d2np', 'sudah')->count(),
                'not_uploaded' => \App\Models\Dms::where('d2np', 'belum')->count()
            ],
            'spmt' => [
                'uploaded' => \App\Models\Dms::where('spmt', 'sudah')->count(),
                'not_uploaded' => \App\Models\Dms::where('spmt', 'belum')->count()
            ],
            'sk_pns' => [
                'uploaded' => \App\Models\Dms::where('sk_pns', 'sudah')->count(),
                'not_uploaded' => \App\Models\Dms::where('sk_pns', 'belum')->count()
            ]
        ];

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
            $fields = ['drh', 'sk_cpns', 'd2np', 'spmt', 'sk_pns'];
            $fieldLabels = [
                'drh' => 'Daftar Riwayat Hidup (DRH)',
                'sk_cpns' => 'SK CPNS',
                'd2np' => 'D2NP',
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
                'D2NP',
                'SPMT',
                'SK PNS'
            ];
            $hasWarnings = true;
        }

        return view('pegawai.dashboard', compact('layananList', 'hasWarnings', 'incompleteDocuments', 'dmsData'));
    }
}
