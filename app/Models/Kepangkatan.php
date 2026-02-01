<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kepangkatan extends Model
{
    protected $table = 'pangkat';
    protected $guarded = ['id'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'kode_skpd', 'kode_skpd');
    }
}
