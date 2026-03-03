<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $guarded = [];

    public function anggota(){
        return $this->belongsTo(Anggota::class);
    }

    public function buku(){
        return $this->belongsTo(Buku::class);
    }

    public function getStatusAttribute()
    {
        if ($this->tanggal_dikembalikan) {
            return 'kembali';
        }

        if (now()->gt($this->tanggal_kembali)) {
            return 'lewat';
        }

        return 'pinjam';
    }
}
