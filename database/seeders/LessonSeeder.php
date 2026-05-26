<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            $lessons = $this->getLessonsForCourse($course->title);

            foreach ($lessons as $index => $lessonData) {
                Lesson::create([
                    'course_id'   => $course->id,
                    'title'       => $lessonData['title'],
                    'description' => $lessonData['description'],
                    'video_url'   => $lessonData['video_url'] ?? null,
                    'duration'    => $lessonData['duration'],
                    'order'       => $index + 1,
                    'status'      => 'active',
                ]);
            }
        }

        $this->command->info('3. Lessons seeded successfully!');
    }

    /**
     * Har bir kurs uchun 3 ta dars.
     */
    private function getLessonsForCourse(string $courseTitle): array
    {
        return match ($courseTitle) {
            'Web Dasturlash Asoslari' => [
                [
                    'title'       => 'HTML asoslari va tuzilishi',
                    'description' => 'HTML nima, teglar, atributlar, semantik elementlar va sahifa tuzilishi.',
                    'video_url'   => 'https://www.youtube.com/embed/pQN-pnXPaVg',
                    'duration'    => 45,
                ],
                [
                    'title'       => 'CSS yordamida dizayn',
                    'description' => 'CSS selektorlari, ranglar, flexbox, grid tizimi va responsiv dizayn asoslari.',
                    'video_url'   => 'https://www.youtube.com/embed/yfoY53QXEnI',
                    'duration'    => 55,
                ],
                [
                    'title'       => 'JavaScript bilan interaktivlik',
                    'description' => 'JavaScript asoslari, DOM manipulyatsiyasi, hodisalar va funksiyalar.',
                    'video_url'   => 'https://www.youtube.com/embed/PkZNo7MFNFg',
                    'duration'    => 60,
                ],
            ],
            'Laravel Framework' => [
                [
                    'title'       => 'Laravel o\'rnatish va sozlash',
                    'description' => 'Composer, Laravel installer, .env fayli, artisan buyruqlari va loyiha tuzilishi.',
                    'video_url'   => 'https://www.youtube.com/embed/Rz6SMgKrSYE',
                    'duration'    => 40,
                ],
                [
                    'title'       => 'Routing va Controllerlar',
                    'description' => 'Route turlari, controller yaratish, resurs controllerlar va middleware.',
                    'video_url'   => 'https://www.youtube.com/embed/iBaM5LYgyPk',
                    'duration'    => 50,
                ],
                [
                    'title'       => 'Eloquent ORM va Ma\'lumotlar Bazasi',
                    'description' => 'Migration, model, relationship, query builder va ma\'lumotlarni boshqarish.',
                    'video_url'   => 'https://www.youtube.com/embed/52WpfAQfgXs',
                    'duration'    => 65,
                ],
            ],
            'Python va Sun\'iy Intellekt' => [
                [
                    'title'       => 'Python asoslari',
                    'description' => 'O\'zgaruvchilar, ma\'lumot turlari, shart operatorlari, sikllar va funksiyalar.',
                    'video_url'   => 'https://www.youtube.com/embed/rfscVS0vtbw',
                    'duration'    => 50,
                ],
                [
                    'title'       => 'NumPy va Pandas kutubxonalari',
                    'description' => 'Massivlar, DataFrame, ma\'lumotlarni tozalash va tahlil qilish.',
                    'video_url'   => 'https://www.youtube.com/embed/vmEHCJofslg',
                    'duration'    => 55,
                ],
                [
                    'title'       => 'Machine Learning asoslari',
                    'description' => 'Scikit-learn, model yaratish, o\'qitish va baholash. Chiziqli regressiya.',
                    'video_url'   => 'https://www.youtube.com/embed/7eh4d6sabA0',
                    'duration'    => 70,
                ],
            ],
            'Mobil Ilovalar (Flutter)' => [
                [
                    'title'       => 'Flutter va Dart bilan tanishuv',
                    'description' => 'Flutter SDK o\'rnatish, Dart tili asoslari, birinchi ilova yaratish.',
                    'video_url'   => 'https://www.youtube.com/embed/1ukSR1GRtMU',
                    'duration'    => 45,
                ],
                [
                    'title'       => 'Widget\'lar va Layout',
                    'description' => 'Stateless vs Stateful widget, Container, Row, Column, Stack va boshqa widgetlar.',
                    'video_url'   => 'https://www.youtube.com/embed/bKueYVtV0eA',
                    'duration'    => 55,
                ],
                [
                    'title'       => 'Navigatsiya va State Management',
                    'description' => 'Sahifalar orasida o\'tish, Provider bilan holat boshqaruvi.',
                    'video_url'   => 'https://www.youtube.com/embed/FLQ-Vhw1NYQ',
                    'duration'    => 60,
                ],
            ],
            default => [
                [
                    'title'       => '1-dars: Kirish',
                    'description' => 'Kursga kirish va asosiy tushunchalar.',
                    'duration'    => 30,
                ],
                [
                    'title'       => '2-dars: Asosiy mavzu',
                    'description' => 'Asosiy mavzuni batafsil o\'rganish.',
                    'duration'    => 45,
                ],
                [
                    'title'       => '3-dars: Amaliyot',
                    'description' => 'Amaliy mashg\'ulot va topshiriqlar.',
                    'duration'    => 50,
                ],
            ],
        };
    }
}
