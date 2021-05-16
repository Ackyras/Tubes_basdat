<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;

class akunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'username' => 'rekrut',
                'name' => 'Admin Rekrut',
                'email' => 'adminasprak@laboran.com',
                'role' => 'admin',
                'password' => bcrypt('laboran')
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
