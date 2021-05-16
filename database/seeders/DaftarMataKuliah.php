<?php

namespace Database\Seeders;

use App\Models\DaftarMataKuliah as ModelsDaftarMataKuliah;
use Illuminate\Database\Seeder;

class DaftarMataKuliah extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama' => 'Pemrograman Berorientasi Objek'
            ],
            [
                'nama' => 'PKS 1'
            ],
            [
                'nama' => 'PKS 2'
            ],
            [
                'nama' => 'Basis Data'
            ],
            [
                'nama' => 'Algoritma Struktur Data'
            ],
            [
                'nama' => 'Algoritma Pemrograman'
            ],
        ];

        foreach ($data as $key => $value) {
            ModelsDaftarMataKuliah::create($value);
        }
    }
}
