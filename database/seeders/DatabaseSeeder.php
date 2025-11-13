<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create default secretary account
        User::create([
            'username' => 'secretary',
            'password' => Hash::make('demo-pass123'),
            'email' => 'secretary@sjitc.rw',
            'full_name' => 'SJITC Secretary',
        ]);

        // You can add more default users if needed
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'email' => 'admin@sjitc.rw',
            'full_name' => 'System Administrator',
        ]);
    }
}