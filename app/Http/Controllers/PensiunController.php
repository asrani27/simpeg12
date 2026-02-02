<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Persyaratan;
use Illuminate\Http\Request;

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
}
