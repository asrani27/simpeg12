<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skpd extends Model
{
    protected $table = 'skpd';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'kode_skpd', 'kode_skpd');
    }
}
