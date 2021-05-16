<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonAsprak extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'periode',
        'nama',
        'nim',
        'email',
        'password',
        'tanggal_lahir',
        'program_studi',
        'angkatan',
        'cv',
        'khs',
        'ktm'
    ];

    public function penilaianaspraks()
    {
        return $this->hasMany(PenilaianAsprak::class, 'calon_asprak_id', 'id');
    }
}
