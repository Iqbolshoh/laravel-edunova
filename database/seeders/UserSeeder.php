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
            ['email' => 'admin@edunova.uz'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('12345678'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'teacher@edunova.uz'],
            [
                'name' => 'Teacher',
                'password' => Hash::make('12345678'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'student@edunova.uz'],
            [
                'name' => 'Student',
                'password' => Hash::make('12345678'),
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
