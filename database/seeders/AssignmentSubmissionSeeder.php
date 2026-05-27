<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AssignmentSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get student
        $student = User::where('email', 'student@cloudnova.uz')->first();

        // Get all assignments
        $assignments = Assignment::all();

        if ($assignments->isEmpty() || !$student) {
            $this->command->warn('No assignments or student found. Please run AssignmentSeeder first.');
            return;
        }

        $submissions = [];

        foreach ($assignments as $index => $assignment) {
            $submittedAt = Carbon::now()->subDays(rand(1, 14));
            $isGraded = $index % 2 == 0; // Grade every other submission

            $submissions[] = [
                'assignment_id' => $assignment->id,
                'user_id'       => $student->id,
                'content'       => $this->getSubmissionContent($assignment->title),
                'file_path'     => null,
                'score'         => $isGraded ? rand(75, 100) : null,
                'feedback'      => $isGraded ? $this->getFeedback($assignment->title, rand(75, 100)) : null,
                'status'        => $isGraded ? 'graded' : 'submitted',
                'submitted_at'  => $submittedAt,
                'graded_at'     => $isGraded ? $submittedAt->copy()->addDays(rand(1, 5)) : null,
                'created_at'    => $submittedAt,
                'updated_at'    => $isGraded ? $submittedAt->copy()->addDays(rand(1, 5)) : $submittedAt,
            ];
        }

        // Insert all submissions
        foreach ($submissions as $submissionData) {
            AssignmentSubmission::create($submissionData);
        }

        $this->command->info('4. Assignment submissions seeded successfully!');
    }

    /**
     * Get sample submission content based on assignment title
     */
    private function getSubmissionContent(string $assignmentTitle): string
    {
        $contents = [
            'Shaxsiy Portfolio Veb-sayt' =>
            "Portfolio veb-saytim quyidagi sahifalardan iborat:\n" .
                "1. Bosh sahifa - o'zim haqimda qisqacha ma'lumot\n" .
                "2. Loyihalar - 5 ta amalga oshirilgan loyiha\n" .
                "3. Aloqa - aloqa formasi va ijtimoiy tarmoqlar\n" .
                "Barcha sahifalar responsive dizaynga ega.",

            'JavaScript To-Do Ilova' =>
            "Vazifalar ilovasi quyidagi funksiyalarga ega:\n" .
                "- Yangi vazifa qo'shish\n" .
                "- Vazifani tahrirlash\n" .
                "- Vazifani o'chirish\n" .
                "- Vazifani bajarilgan deb belgilash\n" .
                "- localStorage da saqlash",

            'Blog Tizimi' =>
            "Laravel blog tizimi:\n" .
                "- Foydalanuvchi ro'yxatdan o'tish va kirish\n" .
                "- Post yaratish, tahrirlash, o'chirish\n" .
                "- Kategoriyalar bo'yicha filtrlash\n" .
                "- Izoh qoldirish tizimi\n" .
                "- Admin panel",

            'E-Commerce API' =>
            "REST API endpointlari:\n" .
                "GET /api/products - mahsulotlar ro'yxati\n" .
                "POST /api/products - yangi mahsulot\n" .
                "GET /api/cart - savatcha\n" .
                "POST /api/orders - buyurtma berish\n" .
                "API dokumentatsiyasi Swagger da tayyorlandi",
        ];

        return $contents[$assignmentTitle] ??
            "Topshiriq muvaffaqiyatli bajarildi. Barcha talablar inobatga olindi. " .
            "Qo'shimcha funksionallik ham qo'shildi.";
    }

    /**
     * Get feedback based on assignment title and score
     */
    private function getFeedback(string $assignmentTitle, int $score): string
    {
        if ($score >= 95) {
            return "A'lo darajada! Topshiriq barcha talablarga javob beradi va qo'shimcha kreativ yechimlar qo'llanilgan. Barakalla!";
        } elseif ($score >= 85) {
            return "Yaxshi ish! Asosiy talablar bajarilgan. Kod sifati va dizaynni biroz yaxshilash mumkin.";
        } elseif ($score >= 75) {
            return "Qoniqarli. Asosiy funksionallik ishlaydi, lekin ba'zi kamchiliklar mavjud. Xatolarni tekshirish tavsiya etiladi.";
        } else {
            return "Topshiriq qayta ko'rib chiqilishi kerak. Asosiy talablar to'liq bajarilmagan.";
        }
    }
}
