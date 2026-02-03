<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Models\Layanan;
use App\Models\Pengajuan;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Auth;

class UsulPnsController extends Controller
{

    public function jenis_usul_pns()
    {
        $data = Layanan::where('jenis', 'usul_pns')->paginate(10);
        return view('usul_pns.jenis.index', compact('data'));
    }
    public function jenis_usul_pns_store(Request $req)
    {
        $param = $req->all();
        $param['jenis'] = 'usul_pns';
        Layanan::create($param);
        return back();
    }
    public function jenis_usul_pns_update(Request $req)
    {
        $attr = $req->all();
        Layanan::find($req->jenis_id)->update($attr);
        return back()->with('success', 'Berhasil Diupdate');
    }
    public function jenis_usul_pns_delete($id)
    {
        Layanan::find($id)->delete();
        return back()->with('success', 'Berhasil Di Hapus');
    }
    public function persyaratan()
    {
        $data = Persyaratan::where('jenis', 'usul_pns')->paginate(100);
        return view('usul_pns.persyaratan.index', compact('data'));
    }
    public function persyaratan_store(Request $req)
    {
        $param = $req->all();
        $param['jenis'] = 'usul_pns';
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
        return $this->renderusul_pnsView('baru');
    }

    public function diproses()
    {
        return $this->renderusul_pnsView('diproses');
    }

    public function selesai()
    {
        return $this->renderusul_pnsView('selesai');
    }

    private function renderusul_pnsView($tipe)
    {
        $usul_pns = Pengajuan::where('jenis', 'usul_pns')->where('status', 1)->whereNull('verifikator')->count();
        $diproses = Pengajuan::where('jenis', 'usul_pns')->where('status', 1)->whereNotNull('verifikator')->count();
        $selesai = Pengajuan::where('jenis', 'usul_pns')->where('status', 2)->count();

        $query = Pengajuan::with('pegawai')
            ->where('jenis', 'usul_pns');

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

        return view('usul_pns.dashboard', compact('usul_pns', 'diproses', 'selesai', 'data'));
    }
    public function dokumen_pengajuan($id)
    {
        $data = Pengajuan::find($id);
        if ($data->verifikator == null) {
            return back()->with('error', 'Harap klik tombol proses terlebih dahulu');
        } else {
            $layanan_id = $data->layanan->id;
            return view('usul_pns.dokumen', compact('data', 'layanan_id', 'id'));
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
}
