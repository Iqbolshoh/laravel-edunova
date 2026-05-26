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
        User::firstOrCreate(
            ['email' => 'admin@templates.uz'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('$qb01S7#o&05'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'teacher@templates.uz'],
            [
                'name' => 'Teacher',
                'password' => Hash::make('$qb01S7#o&05'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'student@templates.uz'],
            [
                'name' => 'Student',
                'password' => Hash::make('$qb01S7#o&05'),
            ]
        );

        /*
        |---------------------------------------------------------------
        | outputSuccessMessage
        |---------------------------------------------------------------
        | Outputs success message after seeding.
        |
        */
        $this->command->info('1. Users seeded successfully!');
    }
}
