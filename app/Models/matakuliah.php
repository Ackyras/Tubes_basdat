<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'mata_kuliah_id',
        'pembukaan_asprak_id',
        'dosen',
        'tanggal_seleksi',
        'awal_seleksi',
        'akhir_seleksi',
        'soal'
    ];

    public function pembukaanasprak()
    {
        return $this->belongsTo(PembukaanAsprak::class, 'pembukaan_asprak_id', 'id');
    }

    public function daftarmatakuliah()
    {
        return $this->belongsTo(DaftarMataKuliah::class, 'mata_kuliah_id', 'id');
    }

    public function penilaianasprak()
    {
        return $this->hasMany(PenilaianAsprak::class, 'mata_kuliah_id', 'id');
    }
}
