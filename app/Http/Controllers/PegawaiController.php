<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Skpd;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of pegawai.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Pegawai::with('skpd');

        // Search by nama, NIK, atau NIP
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        // Filter by status pegawai
        if ($request->status) {
            $query->where('status_pegawai', $request->status);
        }

        // Filter by SKPD
        if ($request->kode_skpd) {
            $query->where('kode_skpd', $request->kode_skpd);
        }

        $pegawais = $query->latest()->paginate(10)->withQueryString();
        $skpds = Skpd::where('is_aktif', 1)->get();
        $statuses = ['PNS', 'CPNS', 'PPPK PENUH WAKTU', 'PPPK PARUH WAKTU'];

        return view('superadmin.pegawai.index', compact('pegawais', 'skpds', 'statuses'));
    }

    /**
     * Show the form for creating a new pegawai.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $skpds = Skpd::where('is_aktif', 1)->get();
        $statuses = ['PNS', 'CPNS', 'PPPK PENUH WAKTU', 'PPPK PARUH WAKTU'];
        $jabatans = ['Eselon I', 'Eselon II', 'Eselon III', 'Eselon IV', 'Fungsional', 'Staf'];

        return view('superadmin.pegawai.create', compact('skpds', 'statuses', 'jabatans'));
    }

    /**
     * Store a newly created pegawai in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:16|unique:pegawai',
            'nip' => 'nullable|string|max:18|unique:pegawai',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'ket_jabatan' => 'nullable|string|max:255',
            'status_pegawai' => 'required|string|in:PNS,CPNS,PPPK PENUH WAKTU,PPPK PARUH WAKTU',
            'kode_skpd' => 'required|exists:skpd,kode_skpd',
        ]);

        Pegawai::create([
            'nik' => $request->nik,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'ket_jabatan' => $request->ket_jabatan,
            'status_pegawai' => $request->status_pegawai,
            'kode_skpd' => $request->kode_skpd,
        ]);

        return redirect()
            ->route('superadmin.pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan');
    }

    /**
     * Display the specified pegawai.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $pegawai = Pegawai::with('skpd')->findOrFail($id);
        return view('superadmin.pegawai.show', compact('pegawai'));
    }

    /**
     * Display DMS for a specific pegawai (SKPD)
     */
    public function skpdDmsShow($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        // Ensure SKPD can only view their own employees
        $skpdUser = Auth::user()->skpd;
        if ($pegawai->kode_skpd !== $skpdUser->kode_skpd) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        $dmsRecord = \App\Models\Dms::where('nip', $pegawai->nip)->first();

        return view('skpd.pegawai.dms', compact('pegawai', 'dmsRecord'));
    }

    /**
     * Store a newly uploaded file for pegawai (SKPD)
     */
    public function skpdDmsStore(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        // Ensure SKPD can only manage their own employees
        $skpdUser = Auth::user()->skpd;
        if ($pegawai->kode_skpd !== $skpdUser->kode_skpd) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        $request->validate([
            'document_type' => 'required|in:drh,sk_cpns,d2np,spmt,sk_pns',
            'file' => 'required|file|mimes:pdf|max:1536', // Max 1.5MB, PDF only
        ]);

        $pegawaiNip = $pegawai->nip;
        $documentType = $request->document_type;
        $file = $request->file('file');

        // Generate filename: nip_documentType.pdf
        $fileName = $pegawaiNip . '_' . $documentType . '.pdf';
        $filePath = $file->storeAs('dms/' . $pegawaiNip, $fileName, 'public');

        // Find or create DMS record for this pegawai
        $dms = \App\Models\Dms::firstOrCreate(
            ['nip' => $pegawaiNip],
            ['nama' => $pegawai->nama]
        );

        // Update specific document field
        $dms->$documentType = $fileName;
        $dms->save();

        return redirect()->back()->with('success', 'Dokumen berhasil diunggah!');
    }

    /**
     * Download specified file for pegawai (SKPD)
     */
    public function skpdDmsDownload($id, $type)
    {
        $pegawai = Pegawai::findOrFail($id);

        // Ensure SKPD can only download their own employees' documents
        $skpdUser = Auth::user()->skpd;
        if ($pegawai->kode_skpd !== $skpdUser->kode_skpd) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        $dms = \App\Models\Dms::where('nip', $pegawai->nip)->firstOrFail();

        if (!$dms->$type) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan.');
        }

        $fileName = $dms->$type;
        $filePath = "dms/{$pegawai->nip}/{$fileName}";

        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di storage.');
        }

        return Storage::disk('public')->download($filePath, $fileName);
    }

    /**
     * Remove specified file for pegawai (SKPD)
     */
    public function skpdDmsDestroy($id, $type)
    {
        $pegawai = Pegawai::findOrFail($id);

        // Ensure SKPD can only delete their own employees' documents
        $skpdUser = Auth::user()->skpd;
        if ($pegawai->kode_skpd !== $skpdUser->kode_skpd) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        $dms = \App\Models\Dms::where('nip', $pegawai->nip)->firstOrFail();

        if (!$dms->$type) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan.');
        }

        // Delete file from storage
        $filePath = "dms/{$pegawai->nip}/{$dms->$type}";
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Clear field
        $dms->$type = null;
        $dms->save();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus!');
    }

    /**
     * Update the specified pegawai in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            'nik' => 'required|string|max:16|unique:pegawai,nik,' . $pegawai->id,
            'nip' => 'nullable|string|max:18|unique:pegawai,nip,' . $pegawai->id,
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'ket_jabatan' => 'nullable|string|max:255',
            'status_pegawai' => 'required|string|in:PNS,CPNS,PPPK PENUH WAKTU,PPPK PARUH WAKTU',
            'kode_skpd' => 'required|exists:skpd,kode_skpd',
        ]);

        $pegawai->update([
            'nik' => $request->nik,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'ket_jabatan' => $request->ket_jabatan,
            'status_pegawai' => $request->status_pegawai,
            'kode_skpd' => $request->kode_skpd,
        ]);

        return redirect()
            ->route('superadmin.pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui');
    }

    /**
     * Remove the specified pegawai from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()
            ->route('superadmin.pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus');
    }

    /**
     * Display listing of pegawai for SKPD.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function skpdIndex(Request $request)
    {
        $user = Auth::user();
        $kodeSkpd = $user->skpd->kode_skpd;

        $query = Pegawai::where('kode_skpd', $kodeSkpd);

        // Search by nama, NIK, atau NIP
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        // Filter by status pegawai
        if ($request->status) {
            $query->where('status_pegawai', $request->status);
        }

        $pegawais = $query->latest()->paginate(10)->withQueryString();
        $statuses = ['PNS', 'CPNS', 'PPPK PENUH WAKTU', 'PPPK PARUH WAKTU'];

        return view('skpd.pegawai.index', compact('pegawais', 'statuses'));
    }


    /**
     * Import pegawai from Excel file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // Max 10MB
        ]);

        try {
            $file = $request->file('file');

            // Read Excel file
            $data = Excel::toArray([], $file);

            if (empty($data[0])) {
                return redirect()
                    ->route('superadmin.pegawai.index')
                    ->with('error', 'File Excel kosong atau tidak valid');
            }

            // Get headers from first row
            $headers = array_map('strtolower', $data[0][0]);
            $importedCount = 0;
            $skippedCount = 0;
            $errorMessages = [];

            // Skip header row, start from row 2
            foreach ($data[0] as $index => $row) {
                if ($index === 0) continue; // Skip header

                // Create associative array with lowercase keys
                $pegawaiData = array_combine($headers, $row);

                // Validate required fields
                if (empty($pegawaiData['nik']) || empty($pegawaiData['nama'])) {
                    $skippedCount++;
                    $errorMessages[] = "Baris " . ($index + 1) . ": NIK dan Nama wajib diisi";
                    continue;
                }

                // Check if NIK already exists
                $existingPegawai = Pegawai::where('nik', $pegawaiData['nik'])->first();
                if ($existingPegawai) {
                    $skippedCount++;
                    $errorMessages[] = "Baris " . ($index + 1) . ": NIK {$pegawaiData['nik']} sudah ada";
                    continue;
                }

                // Find SKPD by kode_skpd or name
                $skpd = null;
                if (!empty($pegawaiData['kode_skpd'])) {
                    $skpd = Skpd::where('kode_skpd', $pegawaiData['kode_skpd'])->first();
                } elseif (!empty($pegawaiData['skpd'])) {
                    $skpd = Skpd::where('nama', 'like', '%' . $pegawaiData['skpd'] . '%')->first();
                }

                // Prepare data for insertion
                $insertData = [
                    'nik' => $pegawaiData['nik'],
                    'nama' => $pegawaiData['nama'],
                    'nip' => $pegawaiData['nip'] ?? null,
                    'tempat_lahir' => $pegawaiData['tempat_lahir'] ?? null,
                    'tanggal_lahir' => !empty($pegawaiData['tanggal_lahir'])
                        ? \Carbon\Carbon::parse($pegawaiData['tanggal_lahir'])->format('Y-m-d')
                        : null,
                    'ket_jabatan' => $pegawaiData['ket_jabatan'] ?? null,
                    'status_pegawai' => $pegawaiData['status_pegawai'] ?? 'PNS',
                    'kode_skpd' => $skpd ? $skpd->kode_skpd : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Validate NIP uniqueness if provided
                if (!empty($insertData['nip'])) {
                    $existingNip = Pegawai::where('nip', $insertData['nip'])->first();
                    if ($existingNip) {
                        $insertData['nip'] = null;
                        $errorMessages[] = "Baris " . ($index + 1) . ": NIP {$pegawaiData['nip']} sudah ada, NIP dikosongkan";
                    }
                }

                // Insert data
                Pegawai::create($insertData);
                $importedCount++;
            }

            $message = "Berhasil mengimpor {$importedCount} data pegawai";
            if ($skippedCount > 0) {
                $message .= ". {$skippedCount} data dilewati.";
            }

            return redirect()
                ->route('superadmin.pegawai.index')
                ->with('success', $message)
                ->with('import_errors', $errorMessages);
        } catch (\Exception $e) {
            return redirect()
                ->route('superadmin.pegawai.index')
                ->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }
}
