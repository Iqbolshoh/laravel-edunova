<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // O'qituvchini topish yoki yaratish
        $teacher = User::where('email', 'teacher@edunova.uz')->first();

        if (!$teacher) {
            $teacher = User::create([
                'name'     => 'O\'qituvchi',
                'email'    => 'teacher@edunova.uz',
                'password' => bcrypt('password'),
            ]);
            $teacher->assignRole('teacher');
        }

        // Kurslar ro'yxati
        $courses = [
            [
                'title'       => 'Web Dasturlash Asoslari',
                'description' => 'HTML, CSS va JavaScript yordamida zamonaviy veb-saytlar yaratishni o\'rganing. Kurs davomida 10 ta amaliy loyiha tayyorlaysiz.',
                'price'       => 450000,
                'duration'    => 48,
                'status'      => 'active',
                'image'       => 'https://images.unsplash.com/photo-1621839673705-6617adf9e890?w=800&h=400&fit=crop',
            ],
            [
                'title'       => 'Laravel Framework',
                'description' => 'PHP Laravel frameworkida to\'liq veb-ilovalar yaratish. MVC arxitekturasi, Eloquent ORM, autentifikatsiya va REST API.',
                'price'       => 650000,
                'duration'    => 64,
                'status'      => 'active',
                'image'       => 'https://images.unsplash.com/photo-1504639725590-34d0984388bd?w=800&h=400&fit=crop',
            ],
            [
                'title'       => 'Python va Sun\'iy Intellekt',
                'description' => 'Python dasturlash tili asoslari va sun\'iy intellekt yo\'nalishiga kirish. Machine Learning, Deep Learning asoslari.',
                'price'       => 750000,
                'duration'    => 72,
                'status'      => 'active',
                'image'       => 'https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=800&h=400&fit=crop',
            ],
            [
                'title'       => 'Mobil Ilovalar (Flutter)',
                'description' => 'Flutter frameworki yordamida Android va iOS uchun chiroyli mobil ilovalar yaratish. Dart tili, Widget\'lar va State Management.',
                'price'       => 550000,
                'duration'    => 56,
                'status'      => 'active',
                'image'       => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=800&h=400&fit=crop',
            ],
        ];

        // Kurslarni yaratish va rasmlarni saqlash
        foreach ($courses as $courseData) {
            $imageUrl = $courseData['image'];
            $imageName = 'courses/' . uniqid() . '.jpg';

            try {
                // Rasmni yuklab olish va saqlash
                $imageContent = file_get_contents($imageUrl);
                if ($imageContent) {
                    Storage::disk('public')->put($imageName, $imageContent);
                }
            } catch (\Exception $e) {
                $imageName = null;
            }

            Course::create([
                'title'       => $courseData['title'],
                'description' => $courseData['description'],
                'price'       => $courseData['price'],
                'duration'    => $courseData['duration'],
                'status'      => $courseData['status'],
                'image'       => $imageName,
                'teacher_id'  => $teacher->id,
                'students_count' => rand(10, 150),
            ]);
        }

        /*
        |---------------------------------------------------------------
        | outputSuccessMessage
        |---------------------------------------------------------------
        | Outputs success message after seeding.
        |
        */
        $this->command->info('2. Courses seeded successfully!');
    }
}
