<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Models\Layanan;
use App\Models\Pensiun;
use App\Models\Pengajuan;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class PensiunController extends Controller
{

    public function jenis_pensiun()
    {
        $data = Layanan::where('jenis', 'pensiun')->paginate(10);
        return view('pensiun.jenis.index', compact('data'));
    }
    public function jenis_pensiun_store(Request $req)
    {
        $param = $req->all();
        $param['jenis'] = 'pensiun';
        Layanan::create($param);
        return back();
    }
    public function jenis_pensiun_update(Request $req)
    {
        $attr = $req->all();
        Layanan::find($req->jenis_id)->update($attr);
        return back()->with('success', 'Berhasil Diupdate');
    }
    public function jenis_pensiun_delete($id)
    {
        Layanan::find($id)->delete();
        return back()->with('success', 'Berhasil Di Hapus');
    }
    public function persyaratan()
    {
        $data = Persyaratan::where('jenis', 'pensiun')->paginate(100);
        return view('pensiun.persyaratan.index', compact('data'));
    }
    public function persyaratan_store(Request $req)
    {
        $param = $req->all();
        $param['jenis'] = 'pensiun';
        $param['nama_jenis'] = Layanan::find($req->layanan_id)->nama;

        Persyaratan::create($param);
        return back();
    }
    public function persyaratan_update(Request $req)
    {
        $param = $req->all();
        $param['nama_jenis'] = Layanan::find($req->layanan_id)->nama;

        Persyaratan::find($req->syarat_id)->update($param);
        return back()->with('success', 'Berhasil Diupdate');
    }
    public function persyaratan_delete($id)
    {
        Persyaratan::find($id)->delete();
        return back()->with('success', 'Berhasil Di Hapus');
    }
    public function baru()
    {
        return $this->renderPensiunView('baru');
    }

    public function diproses()
    {
        return $this->renderPensiunView('diproses');
    }

    public function selesai()
    {
        return $this->renderPensiunView('selesai');
    }

    private function renderPensiunView($tipe)
    {
        $pensiun = Pengajuan::where('jenis', 'pensiun')->where('status', 1)->whereNull('verifikator')->count();
        $diproses = Pengajuan::where('jenis', 'pensiun')->where('status', 1)->whereNotNull('verifikator')->count();
        $selesai = Pengajuan::where('jenis', 'pensiun')->where('status', 2)->count();

        $query = Pengajuan::with('pegawai')
            ->where('jenis', 'pensiun');

        if ($tipe === 'baru') {
            $query->where('status', 1)->whereNull('verifikator');
        } elseif ($tipe === 'diproses') {
            $query->where('status', 1)->whereNotNull('verifikator');
        } elseif ($tipe === 'selesai') {
            $query->where('status', 2);
        }

        $data = $query->get()->map(function ($item) {
            $item->gol_pangkat = $item->pegawai->gol_pangkat;
            return $item;
        })->sortBy(function ($item) {
            return sortValue($item->gol_pangkat);
        })->values();

        return view('pensiun.dashboard', compact('pensiun', 'diproses', 'selesai', 'data'));
    }
    public function dokumen_pengajuan($id)
    {
        $data = Pengajuan::find($id);
        if ($data->verifikator == null) {
            return back()->with('error', 'Harap klik tombol proses terlebih dahulu');
        } else {
            $layanan_id = $data->layanan->id;
            return view('pensiun.dokumen', compact('data', 'layanan_id', 'id'));
        }
    }
    public function proses_pengajuan($id)
    {
        Pengajuan::find($id)->update([
            'verifikator' => Auth::user()->id,
        ]);
        return back()->with('success', 'proses di lanjutkan');
    }

    public function perbaiki_dokumen(Request $req)
    {
        $data = Upload::find($req->persyaratan_id)->update(['verifikasi' => 2, 'keterangan' => $req->keterangan]);
        return back()->with('success', 'berhasil di simpan');
    }
    public function user()
    {
        return Auth::user();
    }

    public function index()
    {
        $data = Pensiun::where('kode_skpd', $this->user()->skpd->kode_skpd)->orderBy('created_at', 'DESC')->get();

        return view('skpd.pensiun.index', compact('data'));
    }
    public function verif_dokumen($id, $dokumen_id)
    {
        $data = Upload::find($dokumen_id)->update(['verifikasi' => 1]);
        return back()->with('success', 'berhasil di verifikasi');
    }
    public function delete_pengajuan($id)
    {
        Pengajuan::find($id)->delete();
        return back()->with('success', 'Berhasil Di Hapus');
    }
    public function selesai_pengajuan($id)
    {
        Pengajuan::find($id)->update(['status' => 2]);
        return back()->with('success', 'Pengajuan selesai');
    }

    public function downloadZip($id)
    {
        $pengajuan = Pengajuan::with(['pegawai', 'upload'])->findOrFail($id);
        
        if ($pengajuan->upload->isEmpty()) {
            return back()->with('error', 'Tidak ada dokumen untuk diunduh');
        }

        $nip = $pengajuan->pegawai->nip;
        $zipFileName = $nip . '_pensiun.zip';
        $zipFilePath = storage_path('app/temp/' . $zipFileName);

        // Create temp directory if not exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $zip = new ZipArchive();
        
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            return back()->with('error', 'Gagal membuat file ZIP');
        }

        $addedFiles = 0;
        
        foreach ($pengajuan->upload as $upload) {
            $filePath = storage_path('app/public/pensiun/' . $nip . '/pengajuan' . $id . '/' . $upload->file);
            
            if (file_exists($filePath)) {
                // Add file to zip with a cleaner name
                $fileExtension = pathinfo($upload->file, PATHINFO_EXTENSION);
                $cleanFileName = $upload->persyaratan->nama ?? 'dokumen';
                // Remove special characters
                $cleanFileName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $cleanFileName);
                $zip->addFile($filePath, $cleanFileName . '.' . $fileExtension);
                $addedFiles++;
            }
        }

        $zip->close();

        if ($addedFiles === 0) {
            // Clean up empty zip
            if (file_exists($zipFilePath)) {
                unlink($zipFilePath);
            }
            return back()->with('error', 'Tidak ada dokumen fisik yang ditemukan');
        }

        // Download and delete zip file
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
}
