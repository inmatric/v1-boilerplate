<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@example.com',
            'username' => 'admin',
            'address' => 'Jl. Admin No. 1, Jakarta',
            'password' => Hash::make('password'),
            'role_name' => 'admin',
        ]);
        
        User::create([
            'email' => 'hrd@example.com',
            'username' => 'hrd_user',
            'address' => 'Jl. HRD No. 2, Bandung',
            'password' => Hash::make('password'),
            'role_name' => 'hrd',
        ]);
        
        User::create([
            'email' => 'user@example.com',
            'username' => 'regular_user',
            'address' => 'Jl. User No. 3, Surabaya',
            'password' => Hash::make('password'),
            'role_name' => 'user',
        ]);
    }
}