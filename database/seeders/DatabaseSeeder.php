<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(akunSeeder::class);
        $this->call(asprakSeeder::class);
        // $this->call(BarangSeeder::class);
        // $this->call(FormPeminjam::class);
        // $this->call(PeminjamanBarang::class);
        $this->call(DaftarMataKuliah::class);
        // $this->call(RuangLabSeeder::class);
        // $this->call(RuanganSeeder::class);
        $this->call(PembukaanAsprakSeeder::class);
        $this->call(MataKuliahSeeder::class);
        $this->call(CalonAsprakSeeder::class);
        $this->call(PilihanAsprakSeeder::class);
    }
}
