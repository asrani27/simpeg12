<?php

use App\Models\Skpd;
use App\Models\Upload;
use App\Models\Layanan;
use App\Models\Persyaratan;

if (!function_exists('roleUser')) {
    function roleUser($param)
    {

        $routes = [
            'superadmin'   => '/superadmin/dashboard',
            'admin'        => '/admin/dashboard',
            'kepangkatan'  => '/kepangkatan/dashboard',
            'pensiun'      => '/pensiun/dashboard',
            'karpeg'       => '/karpeg/dashboard',
            'disiplin'     => '/disiplin/dashboard',
            'kepegawaian'  => '/kepegawaian/dashboard',
            'slks'         => '/slks/dashboard',
            'usul_pns'     => '/usul_pns/dashboard',
            'pegawai'      => '/pegawai/dashboard',
            'skpd'         => '/skpd/dashboard',
        ];

        foreach ($routes as $role => $path) {
            if ($param->hasRole($role)) {
                return $path;
            }
        }

        return '/dashboard';
    }
    function skpd()
    {
        return Skpd::get();
    }
    function listUpload($pegawai_id, $persyaratan_id)
    {
        return Upload::where('pegawai_id', $pegawai_id)->where('persyaratan_id', $persyaratan_id)->get();
    }
    function sortValue($golongan)
    {
        $parts = explode('/', $golongan);
        $angka = $parts[0] ?? '';
        $huruf = strtolower($parts[1] ?? 'a'); // default a

        $roman = [
            'I' => 1,
            'II' => 2,
            'III' => 3,
            'IV' => 4,
            'V' => 5,
        ];

        $hurufOrder = [
            'a' => 1,
            'b' => 2,
            'c' => 3,
            'd' => 4,
            'e' => 5,
        ];

        return ($roman[$angka] ?? 0) * 10 + ($hurufOrder[$huruf] ?? 0);
    }
    function listSyarat($persyaratan_id)
    {
        $id = json_decode($persyaratan_id);
        return Upload::whereIn('id', $id)->get();
    }
    function layanan($param)
    {
        return Layanan::where('jenis', $param)->get();
    }
    function dokumen($layanan_id, $jenis)
    {
        return Persyaratan::where('layanan_id', $layanan_id)->where('jenis', $jenis)->get();
    }
    function checkFile($pengajuan_id, $pegawai_id, $persyaratan_id)
    {
        $data =  Upload::where('pengajuan_id', $pengajuan_id)->where('pegawai_id', $pegawai_id)->where('persyaratan_id', $persyaratan_id)->first();
        //dd($data, $pengajuan_id, $pegawai_id, $persyaratan_id);
        return $data;
    }
}
