<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table = 'upload_persyaratan';
    protected $guarded = ['id'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function persyaratan()
    {
        return $this->belongsTo(Persyaratan::class, 'persyaratan_id');
    }
}
