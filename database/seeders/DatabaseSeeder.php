<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---- Admin ----
        User::create([
            'name'     => 'Super Admin',
            'email'    => 'super_admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role'     => 'admin',
        ]);

        // ---- Cliente de prueba ----
        User::create([
            'name'     => 'Juan Pérez',
            'email'    => 'juan@gmail.com',
            'password' => Hash::make('12345678'),
            'role'     => 'cliente',
        ]);
    }
}