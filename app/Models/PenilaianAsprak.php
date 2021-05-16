<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\PseudoTypes\False_;

class PenilaianAsprak extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'calon_asprak_id',
        'mata_kuliah_id',
        'jawaban',
        'nilai',
        'lulus',
    ];

    public function calonasprak()
    {
        return $this->belongsTo(CalonAsprak::class, 'calon_asprak_id', 'id');
    }

    public function matakuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id', 'id');
    }
}
