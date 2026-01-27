<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{

    protected $table = 'pengajuan';
    protected $guarded = ['id'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }
    public function nama_verifikator()
    {
        return $this->belongsTo(User::class, 'verifikator');
    }
    public function upload()
    {
        return $this->hasMany(Upload::class, 'pengajuan_id');
    }
}
