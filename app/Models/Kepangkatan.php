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
}
