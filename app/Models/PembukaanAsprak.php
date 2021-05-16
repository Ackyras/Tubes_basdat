<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembukaanAsprak extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'awal_pembukaan',
        'akhir_pembukaan'
    ];

    public function matakuliahs()
    {
        return $this->hasMany(MataKuliah::class, 'pembukaan_asprak_id', 'id');
    }
}
