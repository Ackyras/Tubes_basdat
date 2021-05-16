<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarMataKuliah extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nama',
    ];

    public function matakuliahs()
    {
        return $this->hasMany(MataKuliah::class, 'mata_kuliah_id', 'id');
    }
}
