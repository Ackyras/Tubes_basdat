<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matkul = [
            [
                'mata_kuliah_id'        => 1,
                'pembukaan_asprak_id'   => 1,
                'dosen'                 => 'Habibi',
                'tanggal_seleksi'       => '2021-04-12',
                'awal_seleksi'          => '13:00:00',
                'akhir_seleksi'         => '13:34:00'
            ],
            [
                'mata_kuliah_id'        => 3,
                'pembukaan_asprak_id'   => 1,
                'dosen'                 => 'Ikhbal',
                'tanggal_seleksi'       => '2021-04-12',
                'awal_seleksi'          => '13:05:00',
                'akhir_seleksi'         => '13:34:00'
            ],
            [
                'mata_kuliah_id'        => 5,
                'pembukaan_asprak_id'   => 1,
                'dosen'                 => 'Habibi',
                'tanggal_seleksi'       => '2021-04-12',
                'awal_seleksi'          => '13:10:00',
                'akhir_seleksi'         => '13:34:00'
            ],
        ];

        foreach ($matkul as $key => $value) {
            MataKuliah::create($value);
        }
    }
}
