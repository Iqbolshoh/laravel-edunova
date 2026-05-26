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
     * Har bir kurs uchun batafsil darslar.
     */
    private function getLessonsForCourse(string $courseTitle): array
    {
        return match ($courseTitle) {
            'Web Dasturlash Asoslari' => [
                [
                    'title'       => 'HTML asoslari va tuzilishi',
                    'description' => "Ushbu darsda siz HTML ning asosiy tushunchalari bilan tanishasiz:\n\n" .
                        "• HTML nima va u qanday ishlaydi\n" .
                        "• Asosiy teglar: html, head, body, div, span\n" .
                        "• Sarlavha teglari: h1-h6\n" .
                        "• Paragraf, havola va rasm teglari\n" .
                        "• Semantik elementlar: header, nav, main, section, article, footer\n" .
                        "• Atributlar bilan ishlash: id, class, style\n" .
                        "• HTML hujjat tuzilishi va nesting qoidalari\n\n" .
                        "Dars oxirida o'z birinchi veb-sahifangizni yaratasiz.",
                    'video_url'   => 'https://www.youtube.com/embed/pQN-pnXPaVg',
                    'duration'    => 45,
                ],
                [
                    'title'       => 'CSS yordamida dizayn',
                    'description' => "Bu darsda veb-sahifalarga chiroyli ko'rinish berishni o'rganasiz:\n\n" .
                        "• CSS sintaksisi va selektorlar (element, class, id)\n" .
                        "• Ranglar: HEX, RGB, RGBA, HSL formatlari\n" .
                        "• Matn bilan ishlash: font-family, font-size, font-weight, line-height\n" .
                        "• Box model: margin, border, padding, content\n" .
                        "• Flexbox: display:flex, justify-content, align-items\n" .
                        "• CSS Grid: grid-template-columns, grid-gap\n" .
                        "• Media queries va responsiv dizayn asoslari\n" .
                        "• CSS o'zgaruvchilari (custom properties)\n\n" .
                        "Amaliy mashq: Berilgan maketni CSS yordamida yaratish.",
                    'video_url'   => 'https://www.youtube.com/embed/yfoY53QXEnI',
                    'duration'    => 55,
                ],
                [
                    'title'       => 'JavaScript bilan interaktivlik',
                    'description' => "JavaScript yordamida veb-sahifalarga jonli interaktivlik qo'shish:\n\n" .
                        "• JavaScript nima va u qayerda ishlaydi\n" .
                        "• O'zgaruvchilar: let, const, var farqlari\n" .
                        "• Ma'lumot turlari: string, number, boolean, array, object\n" .
                        "• Funksiyalar: function declaration, arrow functions\n" .
                        "• DOM (Document Object Model) bilan ishlash\n" .
                        "• Elementlarni tanlash: getElementById, querySelector\n" .
                        "• Hodisalar (Events): click, submit, keydown, mouseover\n" .
                        "• Formalar bilan ishlash va validatsiya\n" .
                        "• LocalStorage yordamida ma'lumotlarni saqlash\n\n" .
                        "Loyiha: Interaktiv vazifalar ro'yxati (ToDo List) yaratish.",
                    'video_url'   => 'https://www.youtube.com/embed/PkZNo7MFNFg',
                    'duration'    => 60,
                ],
            ],
            'Laravel Framework' => [
                [
                    'title'       => 'Laravel o\'rnatish va sozlash',
                    'description' => "Laravel frameworki bilan ishlashni boshlash uchun barcha kerakli qadamlarni o'rganasiz:\n\n" .
                        "• PHP va Composer o'rnatish va tekshirish\n" .
                        "• Laravel installer orqali yangi loyiha yaratish\n" .
                        "• Laravel papka tuzilishi: app, routes, resources, database\n" .
                        "• .env fayli va muhit sozlamalari\n" .
                        "• Artisan CLI buyruqlari: serve, migrate, make, route:list\n" .
                        "• Konfiguratsiya fayllari: config/app.php, config/database.php\n" .
                        "• Debug rejimi va xatoliklarni o'qish\n" .
                        "• Valet yoki Sail bilan lokal muhit\n\n" .
                        "Natija: Ishchi Laravel loyihasi va brauzerda ochilgan bosh sahifa.",
                    'video_url'   => 'https://www.youtube.com/embed/Rz6SMgKrSYE',
                    'duration'    => 40,
                ],
                [
                    'title'       => 'Routing va Controllerlar',
                    'description' => "Laravel routing tizimi va controllerlar bilan ishlash:\n\n" .
                        "• Asosiy route turlari: GET, POST, PUT, PATCH, DELETE\n" .
                        "• Route parametrlari: Route::get('/user/{id}', ...)\n" .
                        "• Route nomlash: ->name('profile') va route() yordamchisi\n" .
                        "• Route guruhlari: prefix, middleware, name, namespace\n" .
                        "• Controller yaratish: php artisan make:controller\n" .
                        "• Resource controllerlar va CRUD operatsiyalari\n" .
                        "• Single Action Controller\n" .
                        "• Form Request va validatsiya\n" .
                        "• Middleware: yaratish va route'ga qo'llash\n\n" .
                        "Amaliyot: PostController yaratish va barcha CRUD route'larini sozlash.",
                    'video_url'   => 'https://www.youtube.com/embed/iBaM5LYgyPk',
                    'duration'    => 50,
                ],
                [
                    'title'       => 'Eloquent ORM va Ma\'lumotlar Bazasi',
                    'description' => "Laravelning kuchli ORM tizimi - Eloquent bilan tanishasiz:\n\n" .
                        "• Migration yaratish va jadval tuzilishi\n" .
                        "• php artisan migrate, rollback, fresh, refresh\n" .
                        "• Model yaratish va konfiguratsiya qilish\n" .
                        "• Mass assignment: fillable va guarded\n" .
                        "• Relationship turlari: hasOne, hasMany, belongsTo, belongsToMany\n" .
                        "• Pivot jadvallar va ko'p-ko'pga bog'lanish\n" .
                        "• Query Scopes: local va global scope\n" .
                        "• Accessor va Mutatorlar\n" .
                        "• Eager Loading: N+1 muammosi va with() metodi\n" .
                        "• Soft Deletes va trash bilan ishlash\n\n" .
                        "Loyiha: Blog tizimi - Post, Category, Comment modellarini yaratish.",
                    'video_url'   => 'https://www.youtube.com/embed/52WpfAQfgXs',
                    'duration'    => 65,
                ],
            ],
            'Python va Sun\'iy Intellekt' => [
                [
                    'title'       => 'Python asoslari',
                    'description' => "Python dasturlash tilini noldan boshlab o'rganasiz:\n\n" .
                        "• Python o'rnatish va IDE sozlash (VS Code, PyCharm)\n" .
                        "• O'zgaruvchilar va ma'lumot turlari: int, float, str, bool\n" .
                        "• Konsolga chiqarish: print() va f-string formatlash\n" .
                        "• Foydalanuvchi kiritishi: input() funksiyasi\n" .
                        "• Shart operatorlari: if, elif, else\n" .
                        "• Taqqoslash operatorlari: ==, !=, >, <, >=, <=\n" .
                        "• Sikllar: for, while, break, continue\n" .
                        "• Ro'yxatlar (lists), tuple, dictionary, set\n" .
                        "• Funksiyalar yaratish: def, parametrlar, return\n" .
                        "• Fayllar bilan ishlash: open, read, write\n\n" .
                        "Amaliyot: Kalkulyator va telefon kitobi dasturlari.",
                    'video_url'   => 'https://www.youtube.com/embed/rfscVS0vtbw',
                    'duration'    => 50,
                ],
                [
                    'title'       => 'NumPy va Pandas kutubxonalari',
                    'description' => "Ma'lumotlarni tahlil qilish uchun asosiy kutubxonalar:\n\n" .
                        "NumPy:\n" .
                        "• NumPy massivlari (ndarray) yaratish\n" .
                        "• Massiv operatsiyalari: qo'shish, ko'paytirish, transponirlash\n" .
                        "• Matematik funksiyalar: mean, median, std, sum\n" .
                        "• Indekslash va slicing\n\n" .
                        "Pandas:\n" .
                        "• Series va DataFrame tushunchalari\n" .
                        "• CSV, Excel, JSON fayllardan ma'lumot o'qish\n" .
                        "• Ma'lumotlarni filtrlash: loc, iloc, query\n" .
                        "• Guruhlash: groupby, aggregate, pivot\n" .
                        "• To'ldirilgan qiymatlar bilan ishlash: dropna, fillna\n" .
                        "• Ma'lumotlarni vizuallashtirish: plot, matplotlib\n\n" .
                        "Amaliyot: Real dataset tahlili (Titanic yo'lovchilari ma'lumotlari).",
                    'video_url'   => 'https://www.youtube.com/embed/vmEHCJofslg',
                    'duration'    => 55,
                ],
                [
                    'title'       => 'Machine Learning asoslari',
                    'description' => "Sun'iy intellekt va mashinali o'qitishga kirish:\n\n" .
                        "• Machine Learning nima va turlari: supervised, unsupervised, reinforcement\n" .
                        "• Scikit-learn kutubxonasi o'rnatish\n" .
                        "• Dataset tayyorlash: train_test_split\n" .
                        "• Chiziqli regressiya (Linear Regression)\n" .
                        "• Logistik regressiya (Logistic Regression)\n" .
                        "• Decision Tree va Random Forest\n" .
                        "• Modelni baholash: accuracy, precision, recall, F1-score\n" .
                        "• Overfitting va underfitting muammolari\n" .
                        "• Cross-validation texnikasi\n" .
                        "• Feature scaling: StandardScaler, MinMaxScaler\n\n" .
                        "Loyiha: Uy narxlarini bashorat qilish modeli.",
                    'video_url'   => 'https://www.youtube.com/embed/7eh4d6sabA0',
                    'duration'    => 70,
                ],
            ],
            'Mobil Ilovalar (Flutter)' => [
                [
                    'title'       => 'Flutter va Dart bilan tanishuv',
                    'description' => "Flutter frameworkiga kirish va birinchi mobil ilovangizni yaratish:\n\n" .
                        "• Flutter nima va nima uchun Flutter?\n" .
                        "• Flutter SDK o'rnatish (Windows, macOS, Linux)\n" .
                        "• Android Studio va VS Code sozlash\n" .
                        "• Dart tili asoslari: o'zgaruvchilar, funksiyalar, sinflar\n" .
                        "• Dart null safety tushunchasi\n" .
                        "• Birinchi Flutter loyihasini yaratish: flutter create\n" .
                        "• main.dart fayli tuzilishi\n" .
                        "• MaterialApp va CupertinoApp widgetlari\n" .
                        "• Hot Reload va Hot Restart imkoniyatlari\n" .
                        "• Emulyator va real qurilmada ishga tushirish\n\n" .
                        "Natija: Ishlaydigan birinchi Flutter ilova.",
                    'video_url'   => 'https://www.youtube.com/embed/1ukSR1GRtMU',
                    'duration'    => 45,
                ],
                [
                    'title'       => 'Widget\'lar va Layout',
                    'description' => "Flutter widget tizimi va interfeys yaratish:\n\n" .
                        "• StatelessWidget vs StatefulWidget farqlari\n" .
                        "• Container widgeti: padding, margin, decoration, constraints\n" .
                        "• Layout widgetlari: Row, Column, Stack, Expanded\n" .
                        "• ListView va GridView: ro'yxatlar va panjaralar\n" .
                        "• SizedBox, AspectRatio, Flexible\n" .
                        "• Text, Image, Icon, Button widgetlari\n" .
                        "• Input va Form widgetlari: TextField, TextFormField\n" .
                        "• SingleChildScrollView va scroll imkoniyatlari\n" .
                        "• Theme va TextStyle bilan ishlash\n\n" .
                        "Amaliyot: Chiroyli profil sahifasi va login formasini yaratish.",
                    'video_url'   => 'https://www.youtube.com/embed/bKueYVtV0eA',
                    'duration'    => 55,
                ],
                [
                    'title'       => 'Navigatsiya va State Management',
                    'description' => "Sahifalararo o'tish va ilova holatini boshqarish:\n\n" .
                        "Navigatsiya:\n" .
                        "• Navigator.push va Navigator.pop\n" .
                        "• MaterialPageRoute va CupertinoPageRoute\n" .
                        "• Named routes va route jadvali\n" .
                        "• PushReplacement va PushAndRemoveUntil\n" .
                        "• Sahifalar orasida ma'lumot uzatish\n\n" .
                        "State Management (Provider):\n" .
                        "• State nima va uni boshqarish usullari\n" .
                        "• Provider paketini o'rnatish va sozlash\n" .
                        "• ChangeNotifier va ChangeNotifierProvider\n" .
                        "• Consumer va context.watch/context.read\n" .
                        "• MultiProvider bilan ko'p providerga ega ilovalar\n\n" .
                        "Loyiha: Savat (Cart) funksiyali mahsulotlar katalogi.",
                    'video_url'   => 'https://www.youtube.com/embed/FLQ-Vhw1NYQ',
                    'duration'    => 60,
                ],
            ],
            default => [
                [
                    'title'       => '1-dars: Kirish',
                    'description' => "Kursga xush kelibsiz! Ushbu darsda:\n\n" .
                        "• Kurs haqida umumiy ma'lumot\n" .
                        "• O'quv rejasi va maqsadlar\n" .
                        "• Kerakli dasturiy ta'minot va resurslar\n" .
                        "• Baholash tizimi va sertifikat olish shartlari\n" .
                        "• Birinchi qadamlar va tayyorgarlik.",
                    'duration'    => 30,
                ],
                [
                    'title'       => '2-dars: Asosiy mavzu',
                    'description' => "Asosiy mavzuni chuqur o'rganish:\n\n" .
                        "• Nazariy tushunchalar va terminlar\n" .
                        "• Asosiy prinsiplar va qoidalar\n" .
                        "• Kod namunalari va tushuntirishlar\n" .
                        "• Eng ko'p uchraydigan xatolar va ularni tuzatish\n" .
                        "• Amaliy mashqlar va test savollari.",
                    'duration'    => 45,
                ],
                [
                    'title'       => '3-dars: Amaliyot',
                    'description' => "O'rganilgan bilimlarni mustahkamlash:\n\n" .
                        "• Real loyiha ustida ishlash\n" .
                        "• Qadam-baqadam yechim ko'rsatish\n" .
                        "• Mustaqil bajarish uchun topshiriqlar\n" .
                        "• Kodni optimallashtirish bo'yicha maslahatlar\n" .
                        "• Keyingi bosqichga tayyorgarlik.",
                    'duration'    => 50,
                ],
            ],
        };
    }
}
