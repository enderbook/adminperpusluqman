<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function penulis(){
        return $this->belongsTo(Penulis::class);
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function pinjam(){
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }
}
