<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'mahasiswa@skillnest.id'],
            [
                'name'     => 'Budi Santoso',
                'nickname' => 'Budi',
                'role'     => 'mahasiswa',
                'password' => Hash::make('password'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'umkm@skillnest.id'],
            [
                'name'     => 'Toko Maju Jaya',
                'nickname' => 'Maju',
                'role'     => 'umkm',
                'password' => Hash::make('password'),
            ]
        );
    }
}
