<?php

namespace Database\Seeders;

use App\Models\CalonAsprak;
use Illuminate\Database\Seeder;

class CalonAsprakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $calon = [
            [
                'periode'       => 1,
                'nama'          => 'Muhammad Ikhbal',
                'nim'           => '118140123',
                'email'         => 'muhammad.118140123@student.itera.ac.id',
                'tanggal_lahir' => '2000-04-16',
                'program_studi' => 'Teknik Informatika',
                'angkatan'      => 2018,
                'cv'            => 'cv',
                'khs'           => 'khs',
                'ktm'           => 'ktm'
            ],
            [
                'periode'       => 1,
                'nama'          => 'Annisa Dwi Atika',
                'nim'           => '118140082',
                'email'         => 'annisa.118140082@student.itera.ac.id',
                'tanggal_lahir' => '2000-07-20',
                'program_studi' => 'Teknik Biologi',
                'angkatan'      => 2018,
                'cv'            => 'cv',
                'khs'           => 'khs',
                'ktm'           => 'ktm'
            ],
            [
                'periode'       => 1,
                'nama'          => 'Ofyar',
                'nim'           => '118140171',
                'email'         => 'ezra.118140171@student.itera.ac.id',
                'tanggal_lahir' => '2000-04-16',
                'program_studi' => 'Teknik Nuklir',
                'angkatan'      => 2018,
                'cv'            => 'cv',
                'khs'           => 'khs',
                'ktm'           => 'ktm'
            ],
            [
                'periode'       => 1,
                'nama'          => 'Ackyra',
                'nim'           => '118140160',
                'email'         => 'ackyra.118140160@student.itera.ac.id',
                'tanggal_lahir' => '2000-04-16',
                'program_studi' => 'Teknik Informatika',
                'angkatan'      => 2018,
                'cv'            => 'cv',
                'khs'           => 'khs',
                'ktm'           => 'ktm'
            ],
        ];

        foreach ($calon as $key => $value) {
            CalonAsprak::create($value);
        }
    }
}
