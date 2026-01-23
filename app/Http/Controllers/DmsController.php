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
        $originalName = $file->getClientOriginalName();
        $fileName = time() . '_' . str_replace(' ', '_', $originalName);
        $filePath = $file->storeAs('dms/documents', $fileName, 'public');

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
        $filePath = "dms/documents/{$fileName}";
        
        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di storage.');
        }

        // Extract original name from filename (remove timestamp prefix)
        $originalName = preg_replace('/^\d+_/', '', $fileName);

        return Storage::disk('public')->download($filePath, $originalName);
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
        $filePath = "dms/documents/{$dms->$type}";
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Clear the field
        $dms->$type = null;
        $dms->save();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus!');
    }
}
