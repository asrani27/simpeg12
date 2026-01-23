<?php

namespace App\Http\Controllers;

use App\Models\Dms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DmsController extends Controller
{
    /**
     * Display the DMS dashboard with file upload form
     */
    public function index()
    {
        $userNip = Auth::user()->username;
        $dmsRecord = Dms::where('nip', $userNip)->first();
        return view('pegawai.dms.index', compact('dmsRecord'));
    }

    /**
     * Store a newly uploaded file
     */
    public function store(Request $request)
    {
        $request->validate([
            'document_type' => 'required|in:drh,sk_cpns,d2np,spmt,sk_pns',
            'file' => 'required|file|mimes:pdf|max:2048', // Max 2MB, PDF only
        ]);

        $userNip = Auth::user()->username;
        $documentType = $request->document_type;
        $file = $request->file('file');

        // Generate filename: username_documentType.pdf
        $fileName = $userNip . '_' . $documentType . '.pdf';
        $filePath = $file->storeAs('dms/' . $userNip, $fileName, 'public');

        // Find or create DMS record for this user
        $dms = Dms::firstOrCreate(
            ['nip' => $userNip],
            ['nama' => Auth::user()->name]
        );

        // Update the specific document field
        $dms->$documentType = $fileName;
        $dms->save();

        return redirect()->back()->with('success', 'Dokumen berhasil diunggah!');
    }

    /**
     * Download the specified file
     */
    public function download($type)
    {
        $userNip = Auth::user()->username;
        $dms = Dms::where('nip', $userNip)->firstOrFail();

        if (!$dms->$type) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan.');
        }

        $fileName = $dms->$type;
        $filePath = "dms/{$userNip}/{$fileName}";

        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di storage.');
        }

        return Storage::disk('public')->download($filePath, $fileName);
    }

    /**
     * Remove the specified file
     */
    public function destroy($type)
    {
        $userNip = Auth::user()->username;
        $dms = Dms::where('nip', $userNip)->firstOrFail();

        if (!$dms->$type) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan.');
        }

        // Delete file from storage
        $filePath = "dms/{$userNip}/{$dms->$type}";
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Clear the field
        $dms->$type = null;
        $dms->save();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus!');
    }

    /**
     * Download file as admin (for any user's document)
     */
    public function adminDownload($nip, $type)
    {
        $dms = Dms::where('nip', $nip)->firstOrFail();

        if (!$dms->$type) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan.');
        }

        $fileName = $dms->$type;
        $filePath = "dms/{$nip}/{$fileName}";

        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di storage.');
        }

        return Storage::disk('public')->download($filePath, $fileName);
    }

    /**
     * Zip and download all documents for a user
     */
    public function zipDownload($nip)
    {
        $dms = Dms::where('nip', $nip)->firstOrFail();

        // Get the user's folder path from storage
        $folderPath = Storage::disk('public')->path('dms/' . $nip);
        
        if (!file_exists($folderPath) || count(scandir($folderPath)) <= 2) {
            return redirect()->back()->with('error', 'Tidak ada dokumen untuk diunduh.');
        }

        // Create zip file name and path in temporary storage
        $zipFileName = $nip . '.zip';
        $zipFilePath = storage_path('app/temp/' . $zipFileName);

        // Ensure temp directory exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        // Create zip archive
        $zip = new \ZipArchive();
        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== TRUE) {
            return redirect()->back()->with('error', 'Gagal membuat file ZIP.');
        }

        // Add all files from the folder to the zip
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($folderPath),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folderPath) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();

        // Download the zip file
        if (file_exists($zipFilePath)) {
            return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
        }

        return redirect()->back()->with('error', 'Gagal mengunduh file ZIP.');
    }
}
