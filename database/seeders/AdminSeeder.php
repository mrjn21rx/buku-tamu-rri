<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator RRI',
            'email' => 'admin@rri-bukittinggi.co.id', // Bisa diganti sesuai kebutuhan
            'password' => Hash::make('password123'), // Default password
        ]);
    }
}