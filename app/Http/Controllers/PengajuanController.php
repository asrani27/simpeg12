<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Upload;
use App\Models\Layanan;
use App\Models\Periode;
use App\Models\Pengajuan;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengajuanController extends Controller
{
    public function pegawai()
    {
        return Auth::user()->pegawai;
    }
    public function store(Request $req)
    {
        $layanan = Layanan::find($req->layanan_id);
        if (!$layanan) {
            return back()->with('error', 'Layanan tidak ditemukan.');
        }

        $periode = Periode::where('jenis', $layanan->jenis)->first();
        if (!$periode) {
            return back()->with('error', 'Periode Pengajuan Belum Dibuka');
        }

        $tanggalSekarang = now();
        $mulai = Carbon::parse($periode->mulai);
        $sampai = Carbon::parse($periode->sampai);

        if (!$tanggalSekarang->between($mulai, $sampai)) {
            return back()->with('error', 'Pengajuan mulai tgl: ' . $mulai->translatedFormat('d F Y') . ' s/d ' . $sampai->translatedFormat('d F Y'));
        }

        $pegawaiId = $this->pegawai()->id;
        $pengajuanLama = Pengajuan::where([
            ['layanan_id', $layanan->id],
            ['pegawai_id', $pegawaiId],
            ['status', 0],
        ])->first();

        if ($pengajuanLama) {
            return back()->with('error', 'Anda sudah mengajukan layanan ini dan masih tahap proses');
        }

        Pengajuan::create([
            'layanan_id' => $layanan->id,
            'pegawai_id' => $pegawaiId,
            'jenis'      => $layanan->jenis,
        ]);

        return redirect('/pegawai/dashboard')->with('success', 'Berhasil Diajukan');
    }

    public function dokumen($id)
    {
        $layanan_id = Pengajuan::find($id)->layanan_id;
        $data = Pengajuan::find($id);

        return view('pegawai.dokumen', compact('id', 'layanan_id', 'data'));
    }
    public function kirim_dokumen($id)
    {
        $data = Pengajuan::find($id);
        $data->update(['status' => '1']);
        return redirect('/pegawai/dashboard')->with('success', 'Berhasil dikirim');
    }
    public function delete_dokumen($id, $persyaratan_id)
    {
        Upload::where('pengajuan_id', $id)->where('persyaratan_id', $persyaratan_id)->where('pegawai_id', Auth::user()->pegawai->id)->delete();
        return redirect('/pegawai/dashboard/' . $id . '/dokumen')->with('success', 'Berhasil dihapus');
    }
    public function upload_dokumen(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'file' => 'required|file|mimes:pdf|max:1024',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'Maksimal 1 MB');
        }
        $persyaratan = Persyaratan::find($req->persyaratan_id)->nama;
        $jenis = Persyaratan::find($req->persyaratan_id)->jenis;

        $path = Auth::user()->pegawai->nip . '/' . 'pengajuan' . $id;
        if ($jenis == 'slks') {
            $filename = str_replace(' ', '_', Auth::user()->pegawai->nip . '_' . Auth::user()->pegawai->nama . '_slks.pdf');
        } else {
            $filename = str_replace(' ', '_', Auth::user()->pegawai->nip . '_' . Auth::user()->pegawai->nama . '_' . $persyaratan . '.pdf');
        }
        $upload = $req->file('file')->storeAs($jenis . "/" . $path, $filename, 'public');

        $check = Upload::where('pengajuan_id', $id)->where('persyaratan_id', $req->persyaratan_id)->where('pegawai_id', Auth::user()->pegawai->id)->first();
        if ($check == null) {
            $new = new Upload();
            $new->pegawai_id = Auth::user()->pegawai->id;
            $new->pengajuan_id = $id;
            $new->persyaratan_id = $req->persyaratan_id;
            $new->file = $filename;
            $new->save();
        } else {
            $update = $check;
            $update->file = $filename;
            $update->save();
        }
        return redirect('/pegawai/dashboard/' . $id . '/dokumen')->with('success', 'Berhasil diupload');
    }
    public function upload_perbaikan(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'file' => 'required|file|mimes:pdf|max:1024',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'Maksimal 1 MB');
        }

        $persyaratan = Persyaratan::find($req->perbaikan_id)->nama;
        $jenis = Persyaratan::find($req->perbaikan_id)->jenis;

        $path = Auth::user()->pegawai->nip . '/' . 'pengajuan' . $id;
        if ($jenis == 'slks') {
            $filename = str_replace(' ', '_', Auth::user()->pegawai->nip . '_' . Auth::user()->pegawai->nama . '_slks.pdf');
        } else {
            $filename = str_replace(' ', '_', Auth::user()->pegawai->nip . '_' . Auth::user()->pegawai->nama . '_' . $persyaratan . '.pdf');
        }
        $upload = $req->file('file')->storeAs($jenis . "/" . $path, $filename, 'public');

        $check = Upload::where('pengajuan_id', $id)->where('persyaratan_id', $req->perbaikan_id)->where('pegawai_id', Auth::user()->pegawai->id)->first();
        if ($check == null) {
            $new = new Upload();
            $new->pegawai_id = Auth::user()->pegawai->id;
            $new->pengajuan_id = $id;
            $new->persyaratan_id = $req->perbaikan_id;
            $new->file = $filename;
            $new->save();
        } else {
            $update = $check;
            $update->file = $filename;
            $update->perbaikan = 1;
            $update->save();
        }
        return redirect('/pegawai/dashboard/' . $id . '/dokumen')->with('success', 'Berhasil diupload');
    }

    public function delete($id)
    {
        Pengajuan::find($id)->delete();
        return back()->with('success', 'Berhasil dihapus');
    }
}
