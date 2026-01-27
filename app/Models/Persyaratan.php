<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    protected $table = 'persyaratan';
    protected $guarded = ['id'];

    public function layanan()
    {
        return $this->belongsToMany(Layanan::class, 'layanan_persyaratan', 'layanan_id', 'persyaratan_id');
    }
}
