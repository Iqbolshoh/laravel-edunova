<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the UserSeeder to create initial users
        $this->call([
            RolePermissionSeeder::class,
            CourseSeeder::class,
            LessonSeeder::class,
            AssignmentSeeder::class,
            AssignmentSubmissionSeeder::class,
        ]);
    }
}
