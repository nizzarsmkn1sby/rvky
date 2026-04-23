<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Owner
        User::updateOrCreate(
            ['email' => 'owner@rvky.com'],
            [
                'name' => 'Owner RVKY',
                'password' => Hash::make('password123'),
                'role' => 'owner'
            ]
        );

        // Create Admin
        User::updateOrCreate(
            ['email' => 'admin@rvky.com'],
            [
                'name' => 'Admin RVKY',
                'password' => Hash::make('password123'),
                'role' => 'admin'
            ]
        );

        // Create Cashier
        User::updateOrCreate(
            ['email' => 'kasir@rvky.com'],
            [
                'name' => 'Kasir RVKY',
                'password' => Hash::make('password123'),
                'role' => 'cashier'
            ]
        );

        $this->call([
            PosSeeder::class,
        ]);
    }
}
