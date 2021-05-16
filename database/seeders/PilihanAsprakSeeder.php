<?php

namespace Database\Seeders;

use App\Models\PenilaianAsprak;
use Illuminate\Database\Seeder;

class PilihanAsprakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pilihan = [
            [
                'calon_asprak_id'   => 1,
                'mata_kuliah_id'    => 1,
            ],
            [
                'calon_asprak_id'   => 1,
                'mata_kuliah_id'    => 2,
            ],
            [
                'calon_asprak_id'   => 1,
                'mata_kuliah_id'    => 3,
            ],
            [
                'calon_asprak_id'   => 2,
                'mata_kuliah_id'    => 1,
            ],
            [
                'calon_asprak_id'   => 2,
                'mata_kuliah_id'    => 3,
            ],
            [
                'calon_asprak_id'   => 3,
                'mata_kuliah_id'    => 2,
            ],
            [
                'calon_asprak_id'   => 4,
                'mata_kuliah_id'    => 2,
            ],
            [
                'calon_asprak_id'   => 4,
                'mata_kuliah_id'    => 3
            ],
        ];

        foreach ($pilihan as $key => $value) {
            PenilaianAsprak::create($value);
        }
    }
}
