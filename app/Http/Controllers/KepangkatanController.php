<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pegawai;
use App\Models\Pengajuan;
use App\Models\Kepangkatan;
use App\Models\Upload;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use ZipArchive;

class KepangkatanController extends Controller
{
    public function baru()
    {
        return $this->renderKepangkatanView('baru');
    }

    public function diproses()
    {
        return $this->renderKepangkatanView('diproses');
    }

    public function selesai()
    {
        return $this->renderKepangkatanView('selesai');
    }

    private function renderKepangkatanView($tipe)
    {
        $pangkat = Pengajuan::where('jenis', 'kepangkatan')->where('status', 1)->whereNull('verifikator')->count();
        $diproses = Pengajuan::where('jenis', 'kepangkatan')->where('status', 1)->whereNotNull('verifikator')->count();
        $selesai = Pengajuan::where('jenis', 'kepangkatan')->where('status', 2)->count();

        $query = Pengajuan::with('pegawai')
            ->where('jenis', 'kepangkatan');

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

        return view('kepangkatan.dashboard', compact('pangkat', 'diproses', 'selesai', 'data'));
    }


    public function user()
    {
        return Auth::user();
    }

    public function index()
    {
        $data = Kepangkatan::where('skpd_id', $this->user()->skpd->id)->orderBy('created_at', 'DESC')->get();

        return view('skpd.kepangkatan.index', compact('data'));
    }

    public function k_index()
    {
        $layanan = Layanan::where('jenis', 'kepangkatan')->pluck('id');
        $data = Pengajuan::where('status', 2)->where('jenis', 'kepangkatan')->paginate(10);

        return view('kepangkatan.pangkat.index', compact('data'));
    }

    public function k_dokumen($id)
    {
        $pangkat =  Kepangkatan::find($id);
        $pegawai = $pangkat->pegawai;
        return view('kepangkatan.pangkat.detail', compact('pangkat', 'pegawai'));
    }

    public function create()
    {
        $pegawai = Pegawai::where('skpd_id', $this->user()->skpd->id)->get();
        return view('skpd.kepangkatan.create', compact('pegawai'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $attr['skpd_id'] = $this->user()->skpd->id;

        Kepangkatan::create($attr);
        return redirect('/admin/kepangkatan')->with('success', 'Berhasil Di Simpan');
    }

    public function detail($id)
    {
        $pangkat = Kepangkatan::find($id);
        $pegawai = $pangkat->pegawai;
        return view('skpd.kepangkatan.detail', compact('pegawai', 'id', 'pangkat'));
    }

    public function uploadSyarat(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'file'  => 'mimes:pdf|max:2058',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'File harus PDF dan Maks 2MB');
        }

        $pangkat = Kepangkatan::find($id);

        $filename = $req->penamaan . '_' . $pangkat->pegawai->nip . '.pdf';

        if ($req->hasFile('file')) {
            $req->file->storeAs('/public/' . $pangkat->pegawai->nip . '/pangkat/' . $req->jenis . '/' . $pangkat->id, $filename);
        }

        $pangkat->update([
            $req->field => $filename,
        ]);
        return back()->with('success', 'Berhasil Di Simpan');
    }

    public function validasi_kirim($id)
    {
        Kepangkatan::find($id)->update(['status' => 1]);
        return redirect('/admin/kepangkatan')->with('success', 'Berhasil Di Kirim ke BKD');
    }

    public function k_tolak(Request $req)
    {
        Kepangkatan::find($req->pangkat_id)->update([
            'status' => 2,
            'keterangan' => $req->keterangan_tolak,
        ]);

        return back()->with('success', 'Berhasil Dikembalikan ke SKPD terkait');
    }

    // public function downloadZip($id)
    // {
    //     $pangkat = Kepangkatan::find($id);
    //     $pegawai = $pangkat->pegawai;
    //     $files = glob('storage/'. $pegawai->nip.'/pangkat/*');
    //     Madzipper::make('storage/'. $pegawai->nip.'/download.zip')->add($files)->close();

    //     $name = $pegawai->nip;
    //     return Storage::download('/public/'. $pegawai->nip.'/download.zip', $name);

    //     return back()->with('success', 'Berhasil Di Download');
    // }

    public function downloadZip($id)
    {
        $zip = new ZipArchive;
        $pangkat = Kepangkatan::find($id);
        $pegawai = $pangkat->pegawai;
        $fileName = 'myNewFile.zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
            $files = File::files(public_path('storage/' . $pegawai->nip . '/pangkat'));
            // foreach ($files as $key => $value) {
            //     $relativeNameInZipFile = basename($value);
            //     $zip->addFile($value, $relativeNameInZipFile);
            // }
            // $zip->close();
        }
        return response()->download(public_path($fileName));
    }

    public function jenis_kenaikan()
    {
        $data = Layanan::where('jenis', 'kepangkatan')->paginate(10);
        return view('kepangkatan.jenis.index', compact('data'));
    }
    public function jenis_kenaikan_store(Request $req)
    {
        $param = $req->all();
        $param['jenis'] = 'kepangkatan';
        Layanan::create($param);
        return back();
    }
    public function jenis_kenaikan_update(Request $req)
    {
        $attr = $req->all();
        Layanan::find($req->jenis_id)->update($attr);
        return back()->with('success', 'Berhasil Diupdate');
    }
    public function jenis_kenaikan_delete($id)
    {
        Layanan::find($id)->delete();
        return back()->with('success', 'Berhasil Di Hapus');
    }

    public function persyaratan()
    {
        $data = Persyaratan::where('jenis', 'kepangkatan')->paginate(100);
        return view('kepangkatan.persyaratan.index', compact('data'));
    }
    public function persyaratan_store(Request $req)
    {
        $param = $req->all();
        $param['jenis'] = 'kepangkatan';
        $param['nama_jenis'] = Layanan::find($req->layanan_id)->nama;

        Persyaratan::create($param);
        return back();
    }
    public function persyaratan_update(Request $req)
    {
        $param = $req->all();
        $param['nama_jenis'] = Layanan::find($req->layanan_id)->nama;

        // M_jenis_kenaikan_pangkat::find($req->jenis_id)->update($attr);
        Persyaratan::find($req->syarat_id)->update($param);
        return back()->with('success', 'Berhasil Diupdate');
    }
    public function persyaratan_delete($id)
    {
        Persyaratan::find($id)->delete();
        return back()->with('success', 'Berhasil Di Hapus');
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
    public function proses_pengajuan($id)
    {
        Pengajuan::find($id)->update([
            'verifikator' => Auth::user()->id,
        ]);
        return back()->with('success', 'proses di lanjutkan');
    }
    public function dokumen_pengajuan($id)
    {
        $data = Pengajuan::find($id);
        if ($data->verifikator == null) {
            return back()->with('error', 'Harap klik tombol proses terlebih dahulu');
        } else {
            $layanan_id = $data->layanan->id;
            return view('kepangkatan.dokumen', compact('data', 'layanan_id', 'id'));
        }
    }

    public function verif_dokumen($id, $dokumen_id)
    {
        $data = Upload::find($dokumen_id)->update(['verifikasi' => 1]);
        return back()->with('success', 'berhasil di verifikasi');
    }
    public function perbaiki_dokumen(Request $req)
    {
        $data = Upload::find($req->persyaratan_id)->update(['verifikasi' => 2, 'keterangan' => $req->keterangan]);
        return back()->with('success', 'berhasil di simpan');
    }
}
