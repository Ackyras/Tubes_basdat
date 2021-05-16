<?php

namespace Database\Seeders;

use App\Models\PembukaanAsprak;
use Illuminate\Database\Seeder;

class PembukaanAsprakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PembukaanAsprak::create(
            [
                'judul'             => 'Testing',
                'awal_pembukaan'    => '2021-04-09',
                'akhir_pembukaan'   => '2021-05-02'
            ]
        );
    }
}
