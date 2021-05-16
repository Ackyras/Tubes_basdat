<?php

namespace Database\Seeders;

use App\Models\Asprak;
use Illuminate\Database\Seeder;

class asprakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $asprak = [
            [
                'nama' => 'Asprak 1',
                'nim' => '118114014',
                'email' => 'asprak1@laboran.com',
                'tanggallahir' => '2021-03-18',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2018',
                'mata_kuliah' => 1,
            ],
            [
                'nama' => 'Asprak 2',
                'nim' => '118114014',
                'email' => 'asprak2@laboran.com',
                'tanggallahir' => '2021-03-18',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2017',
                'mata_kuliah' => 3,
            ],
            [
                'nama' => 'Asprak 1',
                'nim' => '118114012',
                'email' => 'asprak1@laboran.com',
                'tanggallahir' => '2021-03-18',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2011',
                'mata_kuliah' => 2,
            ],
            [
                'nama' => 'Asprak 1',
                'nim' => '118114014',
                'email' => 'asprak1@laboran.com',
                'tanggallahir' => '2021-03-18',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2018',
                'mata_kuliah' => 3,
            ],
            [
                'nama' => 'Asprak 1',
                'nim' => '118114014',
                'email' => 'asprak1@laboran.com',
                'tanggallahir' => '2021-03-18',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2018',
                'mata_kuliah' => 2,
            ],
        ];
        foreach ($asprak as $key => $value) {
            Asprak::create($value);
        }
    }
}
