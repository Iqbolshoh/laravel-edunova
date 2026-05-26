<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the main super admin user
        User::firstOrCreate(
            ['email' => 'iilhomjonov777@gmail.com'],
            [
                'name' => 'Iqbolshoh Ilhomjonov',
                'password' => Hash::make('Iqbolshoh$777@i'),
            ]
        );

        // Create a collaborator or secondary test user
        User::firstOrCreate(
            ['email' => 'admin@templates.uz'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('$qb01S7#o&05'),
            ]
        );
    }
}
