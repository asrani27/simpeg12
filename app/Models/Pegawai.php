<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $guarded = ['id'];
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'kode_skpd', 'kode_skpd');
    }

    /**
     * Scope untuk filter berdasarkan status pegawai
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status_pegawai', $status);
    }

    /**
     * Scope untuk filter berdasarkan SKPD
     */
    public function scopeSkpd($query, $kodeSkpd)
    {
        return $query->where('kode_skpd', $kodeSkpd);
    }
}
