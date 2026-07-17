<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun demo untuk login & testing
        $demoUser = User::firstOrCreate(
            ['email' => 'demo@exploreaceh.com'],
            [
                'name' => 'Admin Explore Aceh',
                'password' => bcrypt('password123'),
            ]
        );

        // 5 kategori contoh
        $categoryData = [
            ['name' => 'Pantai', 'description' => 'Destinasi pantai indah dengan pasir putih dan air laut jernih di sepanjang pesisir Aceh.'],
            ['name' => 'Danau', 'description' => 'Destinasi danau dengan pemandangan tenang dan udara sejuk, cocok untuk healing dan menikmati alam.'],
            ['name' => 'Air Terjun', 'description' => 'Air terjun alami dengan suasana asri, cocok untuk aktivitas trekking dan menyegarkan diri.'],
            ['name' => 'Pegunungan', 'description' => 'Destinasi dataran tinggi dan pegunungan dengan udara sejuk serta pemandangan hijau yang memukau.'],
            ['name' => 'Pulau', 'description' => 'Pulau dengan keindahan bawah laut yang memukau dengan air jernih, terumbu karang yang indah.'],
        ];

        $categories = [];
        foreach ($categoryData as $data) {
            $categories[$data['name']] = Category::firstOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'user_id' => $demoUser->id,
                    'name' => $data['name'],
                    'description' => $data['description'],
                ]
            );
        }

        // 5 artikel contoh
        $articleData = [
            [
                'title' => 'Pantai Iboih: Surga Bawah Laut Sabang',
                'category' => 'Pantai',
                'content' => "Pantai Iboih terletak di ujung barat Indonesia, tepatnya di Pulau Weh, Sabang. Pantai ini terkenal dengan air lautnya yang jernih dan kehidupan bawah laut yang masih terjaga, menjadikannya destinasi favorit untuk snorkeling dan diving.\n\nWisatawan dapat menikmati keindahan terumbu karang serta berbagai jenis ikan tropis hanya dengan berenang beberapa meter dari bibir pantai.",
                'status' => 'published',
            ],
            [
                'title' => 'Menikmati Sejuknya Danau Laut Tawar',
                'category' => 'Danau',
                'content' => "Danau Laut Tawar terletak di dataran tinggi Gayo, Aceh Tengah, dikelilingi perbukitan hijau yang menawarkan udara sejuk sepanjang tahun. Danau ini menjadi tempat favorit wisatawan untuk menikmati ketenangan sambil menyeruput kopi Gayo khas daerah setempat.\n\nAktivitas seperti berperahu, memancing, dan menikmati matahari terbenam di tepi danau menjadi daya tarik utama bagi pengunjung.",
                'status' => 'published',
            ],
            [
                'title' => 'Keindahan Air Terjun Blang Kolam',
                'category' => 'Air Terjun',
                'content' => "Air Terjun Blang Kolam merupakan salah satu destinasi alam tersembunyi di Aceh yang masih sangat asri. Terletak di tengah hutan yang rimbun, air terjun ini menawarkan kesegaran alami dengan air yang jernih dan suasana yang tenang.\n\nUntuk mencapainya, pengunjung perlu melakukan trekking ringan melewati jalur setapak yang dikelilingi pepohonan hijau.",
                'status' => 'published',
            ],
            [
                'title' => 'Pesona Gunung Burni Telong di Bener Meriah',
                'category' => 'Pegunungan',
                'content' => "Gunung Burni Telong merupakan salah satu gunung berapi yang menjadi ikon Kabupaten Bener Meriah, Aceh. Dengan ketinggian sekitar 2.600 meter di atas permukaan laut, gunung ini menjadi destinasi pendakian favorit bagi para pecinta alam.\n\nDari jalur pendakian, pengunjung akan disuguhi pemandangan hamparan kebun kopi khas dataran tinggi Gayo serta udara sejuk pegunungan. Dari puncaknya, terlihat panorama kawasan Bener Meriah dan Aceh Tengah yang begitu memukau.",
                'status' => 'published',
            ],
            [
                'title' => 'Pesona Pulau Rubiah',
                'category' => 'Pulau',
                'content' => "Pulau Rubiah merupakan salah satu destinasi wisata yang terletak di Kota Sabang, Pulau Weh. Pulau kecil ini dikenal karena keindahan bawah lautnya yang masih terjaga dengan baik dan menjadi tujuan favorit bagi wisatawan yang ingin menikmati aktivitas snorkeling maupun diving.",
                'status' => 'published',
            ],
        ];

        foreach ($articleData as $data) {
            Article::firstOrCreate(
                ['slug' => Str::slug($data['title']) . '-demo'],
                [
                    'user_id' => $demoUser->id,
                    'category_id' => $categories[$data['category']]->id,
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'status' => $data['status'],
                ]
            );
        }
    }
}
