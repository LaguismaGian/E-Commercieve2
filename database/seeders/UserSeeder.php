<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Account
        User::create([
            'name' => 'Kyle',
            'email' => 'quizonkyle9@gmail.com',
            'password' => Hash::make('kyle721'), 
            'role' => 'admin', 
        ]);
    }
}