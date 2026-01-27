<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodeController extends Controller
{

    public function index()
    {
        $layanan = Auth::user()->roles->first()->name;
        $data = Periode::where('jenis', $layanan)->paginate(10);
        return view('periode.index', compact('data'));
    }

    public function store(Request $req)
    {

        $param = $req->all();
        $param['jenis'] = Auth::user()->roles->first()->name;

        if (Periode::where('jenis', Auth::user()->roles->first()->name)->first() == null) {
            Periode::create($param);
            return redirect('/periode')->with('success', 'Berhasil Di Simpan');
        } else {
            return redirect('/periode')->with('error', 'Periode sudah ada, harap edit yang ada');
        }
    }
    public function update(Request $req)
    {
        $param = $req->all();
        $param['jenis'] = Auth::user()->roles->first()->name;
        Periode::find($req->periode_id)->update($param);
        return redirect('/periode')->with('success', 'Berhasil Di Update');
    }
    public function delete($id)
    {

        if (Periode::find($id)->jenis === Auth::user()->roles->first()->name) {
            Periode::find($id)->delete();
            return redirect('/periode')->with('success', 'Berhasil Di Hapus');
        } else {
            return redirect('/periode')->with('error', 'Tidak Bisa Di Hapus');
        }
    }
}
