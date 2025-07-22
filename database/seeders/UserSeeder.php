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
        // User::factory(10)->create();

        User::firstOrCreate([
            'name' => 'Eko Susanto',
            'email' => 'ekosuesanto25@gmail.com',
            'password' => Hash::make('tes123')
        ]);

        User::firstOrCreate([
            'name' => 'Wade Warren',
            'email' => 'wade@example.com',
            'password' => Hash::make('tes123')
        ]);

        User::firstOrCreate([
            'name' => 'Diana Prince',
            'email' => 'diana@example.com',
            'password' => Hash::make('tes123')
        ]);

        User::firstOrCreate([
            'name' => 'Claire Underwood',
            'email' => 'claire@example.com',
            'password' => Hash::make('tes123')
        ]);
    }
}
