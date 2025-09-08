<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@teste.com',
            'password' => 'admin'
        ]);

        User::create([
            'name' => 'eduardo',
            'email' => 'eduardo@teste.com',
            'password' => 'admin'
        ]);
    }
}
