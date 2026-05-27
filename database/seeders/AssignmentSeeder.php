<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all courses
        $courses = Course::all();

        // Get teacher
        $teacher = User::where('email', 'teacher@cloudnova.uz')->first();

        if ($courses->isEmpty() || !$teacher) {
            $this->command->warn('No courses or teacher found. Please run CourseSeeder first.');
            return;
        }

        $assignments = [];

        // Create assignments for each course
        foreach ($courses as $course) {
            $courseAssignments = $this->getAssignmentsForCourse($course->title);

            foreach ($courseAssignments as $index => $assignmentData) {
                $assignments[] = [
                    'title'       => $assignmentData['title'],
                    'description' => $assignmentData['description'],
                    'course_id'   => $course->id,
                    'teacher_id'  => $teacher->id,
                    'due_date'    => Carbon::now()->addDays(($index + 1) * 7),
                    'max_score'   => $assignmentData['max_score'],
                    'status'      => $index < 2 ? 'active' : 'closed',
                    'file_path'   => null,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }
        }

        // Insert all assignments
        foreach ($assignments as $assignmentData) {
            Assignment::create($assignmentData);
        }

        $this->command->info('3. Assignments seeded successfully!');
    }

    /**
     * Get assignments based on course title
     */
    private function getAssignmentsForCourse(string $courseTitle): array
    {
        $assignments = [
            'Web Dasturlash Asoslari' => [
                [
                    'title' => 'Shaxsiy Portfolio Veb-sayt',
                    'description' => 'HTML va CSS yordamida o\'zingizning portfolio veb-saytingizni yarating. Kamida 3 ta sahifa bo\'lishi kerak: Bosh sahifa, Loyihalar, Aloqa.',
                    'max_score' => 100,
                ],
                [
                    'title' => 'JavaScript To-Do Ilova',
                    'description' => 'JavaScript yordamida vazifalar ro\'yxatini boshqarish ilovasini yarating. CRUD operatsiyalari va localStorage ishlatilishi shart.',
                    'max_score' => 100,
                ],
                [
                    'title' => 'Responsive Landing Page',
                    'description' => 'Media querylar yordamida barcha qurilmalarga moslashuvchan landing page yarating. Mobile-first yondashuvdan foydalaning.',
                    'max_score' => 100,
                ],
            ],
            'Laravel Framework' => [
                [
                    'title' => 'Blog Tizimi',
                    'description' => 'Laravel yordamida to\'liq blog tizimini yarating. Postlar, kategoriyalar, izohlar va foydalanuvchi autentifikatsiyasi bo\'lishi kerak.',
                    'max_score' => 100,
                ],
                [
                    'title' => 'E-Commerce API',
                    'description' => 'REST API yordamida mahsulotlar katalogi, savatcha va buyurtmalar tizimini yarating. API dokumentatsiyasi ham qo\'shilsin.',
                    'max_score' => 100,
                ],
                [
                    'title' => 'Foydalanuvchilar Dashboard',
                    'description' => 'Admin panel yarating. Foydalanuvchilarni boshqarish, statistika va hisobotlar bo\'limi bo\'lsin.',
                    'max_score' => 100,
                ],
            ],
            'Python va Sun\'iy Intellekt' => [
                [
                    'title' => 'Ma\'lumotlar Tahlili',
                    'description' => 'Pandas va Matplotlib yordamida real datasetni tahlil qiling va vizuallashtirish grafiklarini tayyorlang.',
                    'max_score' => 100,
                ],
                [
                    'title' => 'Rasm Klassifikatsiyasi',
                    'description' => 'TensorFlow/Keras yordamida MNIST yoki CIFAR-10 datasetida rasm klassifikatsiyasi modelini yarating.',
                    'max_score' => 100,
                ],
                [
                    'title' => 'Chatbot Loyihasi',
                    'description' => 'NLP texnologiyalari yordamida oddiy chatbot yarating. Kamida 20 xil savolga javob bera olsin.',
                    'max_score' => 100,
                ],
            ],
            'Mobil Ilovalar (Flutter)' => [
                [
                    'title' => 'Ob-havo Ilovasi',
                    'description' => 'Flutter yordamida ob-havo ilovasini yarating. OpenWeather API dan foydalaning va shaharlar ro\'yxati bo\'lsin.',
                    'max_score' => 100,
                ],
                [
                    'title' => 'Xarajatlar Hisoblagichi',
                    'description' => 'Flutter va Firebase yordamida xarajatlarni kuzatish ilovasini yarating. Grafiklar va kategoriyalar bo\'yicha tahlil qo\'shilsin.',
                    'max_score' => 100,
                ],
                [
                    'title' => 'Task Manager',
                    'description' => 'Provider yoki Riverpod state management yordamida vazifalar boshqaruvi ilovasini yarating.',
                    'max_score' => 100,
                ],
            ],
        ];

        return $assignments[$courseTitle] ?? [
            [
                'title' => 'Kurs Loyihasi',
                'description' => 'Kurs davomida o\'rganilgan barcha mavzularni qamrab oluvchi yakuniy loyiha tayyorlang.',
                'max_score' => 100,
            ],
        ];
    }
}
