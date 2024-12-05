<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CourseCategory;
use App\Models\QuestionnaireAnswer;
use App\Models\QuestionnaireAnswerScore;
use App\Models\QuestionnaireQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionnaireSeeder extends Seeder
{
    public $questionnaire;

    public function __construct()
    {
        $this->questionnaire = collect([
            [
                'question' => 'Apakah Anda lebih suka bekerja dengan data atau desain?',
                'options' => [
                    'Data mentah' => ['Backend Development' => 5, 'Data Science' => 3],
                    'Data visual' => ['UI/UX Design' => 5, 'Frontend Development' => 3],
                    'Desain aplikasi' => ['UI/UX Design' => 5, 'Mobile Development' => 3],
                    'Logika sistem' => ['Backend Development' => 5, 'DevOps' => 3],
                ],
            ],
            [
                'question' => 'Ketika bekerja, Anda lebih fokus pada:',
                'options' => [
                    'Membuat antarmuka pengguna' => ['UI/UX Design' => 5, 'Frontend Development' => 3],
                    'Mengoptimalkan performa aplikasi' => ['Backend Development' => 5, 'DevOps' => 3],
                    'Membuat fitur keamanan' => ['Cybersecurity' => 5, 'Backend Development' => 3],
                    'Membuat simulasi game' => ['Game Development' => 5],
                ],
            ],
            [
                'question' => 'Apakah Anda lebih tertarik mendalami:',
                'options' => [
                    'Cara kerja algoritma' => ['Data Science' => 5, 'Backend Development' => 3],
                    'Membuat pengalaman pengguna yang menarik' => ['UI/UX Design' => 5, 'Frontend Development' => 3],
                    'Infrastruktur aplikasi' => ['DevOps' => 5, 'Backend Development' => 3],
                    'Aplikasi di perangkat mobile' => ['Mobile Development' => 5],
                ],
            ],
            [
                'question' => 'Ketika mengerjakan proyek IT, Anda lebih nyaman:',
                'options' => [
                    'Mendesain antarmuka yang kreatif' => ['UI/UX Design' => 5],
                    'Memperbaiki logika program' => ['Backend Development' => 5, 'DevOps' => 3],
                    'Menganalisis pola data' => ['Data Science' => 5],
                    'Membuat sistem keamanan' => ['Cybersecurity' => 5],
                ],
            ],
            [
                'question' => 'Apa yang lebih menarik untuk Anda pelajari?',
                'options' => [
                    'Bahasa pemrograman baru' => ['Backend Development' => 5, 'Data Science' => 3],
                    'Alat desain prototipe' => ['UI/UX Design' => 5, 'Frontend Development' => 3],
                    'Framework untuk pengembangan aplikasi mobile' => ['Mobile Development' => 5],
                    'Platform untuk mengelola server' => ['DevOps' => 5],
                ],
            ],
            [
                'question' => 'Anda lebih tertarik untuk:',
                'options' => [
                    'Membuat game dengan mekanisme yang kompleks' => ['Game Development' => 5],
                    'Membuat aplikasi dengan performa tinggi' => ['Backend Development' => 5, 'Mobile Development' => 3],
                    'Mendesain aplikasi yang user-friendly' => ['UI/UX Design' => 5],
                    'Menganalisis data untuk pengambilan keputusan' => ['Data Science' => 5],
                ],
            ],
            [
                'question' => 'Ketika bekerja, Anda lebih suka:',
                'options' => [
                    'Mengimplementasikan fitur interaktif' => ['Frontend Development' => 5, 'Mobile Development' => 3],
                    'Menangani data besar' => ['Data Science' => 5, 'Backend Development' => 3],
                    'Menyelesaikan masalah jaringan' => ['Cybersecurity' => 5, 'DevOps' => 3],
                    'Membuat pengalaman bermain yang menyenangkan' => ['Game Development' => 5],
                ],
            ],
            [
                'question' => 'Dalam tim, Anda lebih sering:',
                'options' => [
                    'Menyelesaikan masalah desain' => ['UI/UX Design' => 5, 'Frontend Development' => 3],
                    'Membuat logika sistem backend' => ['Backend Development' => 5, 'DevOps' => 3],
                    'Menganalisis data untuk rekomendasi' => ['Data Science' => 5],
                    'Membuat fungsi dalam game' => ['Game Development' => 5],
                ],
            ],
            [
                'question' => 'Ketika menggunakan aplikasi, Anda lebih memperhatikan:',
                'options' => [
                    'Tampilan dan interaksinya' => ['UI/UX Design' => 5, 'Frontend Development' => 3],
                    'Kecepatan dan performanya' => ['Backend Development' => 5, 'DevOps' => 3],
                    'Keamanannya' => ['Cybersecurity' => 5],
                    'Alurnya saat digunakan' => ['Game Development' => 5],
                ],
            ],
            [
                'question' => 'Dalam mengembangkan aplikasi, Anda lebih suka:',
                'options' => [
                    'Fokus pada pengalaman pengguna' => ['UI/UX Design' => 5],
                    'Memperbaiki performa kode' => ['Backend Development' => 5],
                    'Mengoptimalkan server' => ['DevOps' => 5],
                    'Menggunakan data untuk prediksi' => ['Data Science' => 5],
                ],
            ],
            [
                "question" => "Apakah Anda lebih suka mempelajari:",
                "options" => [
                    "Bahasa seperti Python" => ["Backend Development" => 5, "Data Science" => 3],
                    "Framework desain seperti Figma" => ["UI/UX Design" => 5],
                    "Alat pengembangan game seperti Unity" => ["Game Development" => 5],
                    "Alat pengelolaan server seperti Kubernetes" => ["DevOps" => 5]
                ]
            ],
            [
                "question" => "Apakah Anda nyaman menggunakan HTML, CSS, dan JavaScript?",
                "options" => [
                    "Sangat nyaman" => ["Frontend Development" => 5, "UI/UX Design" => 3],
                    "Cukup nyaman" => ["Frontend Development" => 3],
                    "Tidak terlalu nyaman" => ["Backend Development" => 3],
                    "Tidak sama sekali" => ["DevOps" => 3]
                ]
            ],
            [
                "question" => "Anda lebih suka mempelajari:",
                "options" => [
                    "Pemrograman aplikasi mobile" => ["Mobile Development" => 5],
                    "Keamanan jaringan" => ["Cybersecurity" => 5],
                    "Pemrosesan data besar" => ["Data Science" => 5],
                    "Mekanisme permainan" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Apakah Anda pernah bekerja dengan database seperti MySQL?",
                "options" => [
                    "Sangat sering" => ["Backend Development" => 5, "Data Science" => 3],
                    "Kadang-kadang" => ["Backend Development" => 3],
                    "Jarang" => ["UI/UX Design" => 3],
                    "Tidak pernah" => ["Frontend Development" => 3]
                ]
            ],
            [
                "question" => "Anda lebih suka membuat:",
                "options" => [
                    "API untuk aplikasi" => ["Backend Development" => 5],
                    "Visualisasi data" => ["Data Science" => 5],
                    "Komponen interaktif untuk aplikasi" => ["Frontend Development" => 5],
                    "Game berbasis cerita" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Apakah Anda tertarik untuk belajar tentang:",
                "options" => [
                    "Keamanan aplikasi" => ["Cybersecurity" => 5],
                    "Infrastruktur server" => ["DevOps" => 5],
                    "Algoritma prediksi" => ["Data Science" => 5],
                    "Desain visual" => ["UI/UX Design" => 5]
                ]
            ],
            [
                "question" => "Apakah Anda pernah mengelola aplikasi di cloud?",
                "options" => [
                    "Sering" => ["DevOps" => 5],
                    "Kadang-kadang" => ["Backend Development" => 3],
                    "Tidak pernah" => ["Frontend Development" => 3],
                    "Tertarik mencoba" => ["UI/UX Design" => 3]
                ]
            ],
            [
                "question" => "Apakah Anda suka mengoptimalkan game untuk performa tinggi?",
                "options" => [
                    "Sangat suka" => ["Game Development" => 5],
                    "Cukup suka" => ["Backend Development" => 3],
                    "Tidak terlalu suka" => ["UI/UX Design" => 3],
                    "Tidak suka sama sekali" => ["DevOps" => 3]
                ]
            ],
            [
                "question" => "Dalam pembuatan proyek, Anda lebih tertarik untuk:",
                "options" => [
                    "Mengatur alur data backend" => ["Backend Development" => 5, "Data Science" => 3],
                    "Membuat layout antarmuka aplikasi" => ["Frontend Development" => 5, "UI/UX Design" => 3],
                    "Mengelola server untuk kinerja maksimal" => ["DevOps" => 5],
                    "Menambahkan fitur baru ke game" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Dalam memilih alat kerja, Anda lebih suka:",
                "options" => [
                    "Framework seperti React atau Angular" => ["Frontend Development" => 5],
                    "Alat manajemen server seperti Docker" => ["DevOps" => 5],
                    "Tool desain seperti Adobe XD" => ["UI/UX Design" => 5],
                    "Bahasa untuk analisis data seperti R" => ["Data Science" => 5]
                ]
            ],
            [
                "question" => "Ketika membuat aplikasi mobile, Anda lebih fokus pada:",
                "options" => [
                    "Desain dan user experience" => ["UI/UX Design" => 5, "Mobile Development" => 3],
                    "Backend yang mendukung aplikasi" => ["Backend Development" => 5],
                    "Mengelola deployment aplikasi" => ["DevOps" => 5],
                    "Analitik penggunaan aplikasi" => ["Data Science" => 5]
                ]
            ],
            [
                "question" => "Apakah Anda pernah menggunakan alat pengembangan game seperti Unreal Engine?",
                "options" => [
                    "Ya, sering" => ["Game Development" => 5],
                    "Pernah mencoba" => ["Game Development" => 3],
                    "Tidak pernah, tapi tertarik" => ["UI/UX Design" => 3],
                    "Tidak tertarik" => ["Backend Development" => 3]
                ]
            ],
            [
                "question" => "Anda lebih nyaman bekerja dengan:",
                "options" => [
                    "Data terstruktur seperti tabel" => ["Data Science" => 5, "Backend Development" => 3],
                    "Visualisasi antarmuka pengguna" => ["UI/UX Design" => 5],
                    "Infrastruktur jaringan" => ["DevOps" => 5],
                    "Elemen interaktif dalam game" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Dalam proyek tim, Anda lebih suka menjadi:",
                "options" => [
                    "Pengelola desain aplikasi" => ["UI/UX Design" => 5],
                    "Pengembang backend aplikasi" => ["Backend Development" => 5],
                    "Pengelola keamanan sistem" => ["Cybersecurity" => 5],
                    "Pengembang fitur gameplay" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Anda lebih tertarik untuk memahami:",
                "options" => [
                    "Algoritma machine learning" => ["Data Science" => 5],
                    "Proses debugging aplikasi" => ["Backend Development" => 5],
                    "Cara mengatur server besar" => ["DevOps" => 5],
                    "Teknik animasi dalam game" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Apakah Anda suka mempelajari perkembangan teknologi terbaru dalam IT?",
                "options" => [
                    "Teknologi keamanan" => ["Cybersecurity" => 5],
                    "Teknologi visualisasi data" => ["Data Science" => 5],
                    "Framework untuk front-end" => ["Frontend Development" => 5],
                    "Engine game modern" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Ketika menghadapi masalah teknis, Anda lebih nyaman:",
                "options" => [
                    "Mengoptimalkan performa backend" => ["Backend Development" => 5],
                    "Membuat desain ulang tampilan" => ["UI/UX Design" => 5],
                    "Mengelola deploy server" => ["DevOps" => 5],
                    "Menganalisis data untuk solusi" => ["Data Science" => 5]
                ]
            ],
            [
                "question" => "Apakah Anda tertarik membuat aplikasi berbasis web atau mobile?",
                "options" => [
                    "Web aplikasi" => ["Frontend Development" => 5, "Backend Development" => 3],
                    "Aplikasi mobile" => ["Mobile Development" => 5, "UI/UX Design" => 3],
                    "Infrastruktur server" => ["DevOps" => 5],
                    "Game berbasis aplikasi" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Dalam mengelola proyek, Anda lebih suka:",
                "options" => [
                    "Memperhatikan aspek desain" => ["UI/UX Design" => 5],
                    "Mengelola logika kode" => ["Backend Development" => 5],
                    "Mengatur workflow deployment" => ["DevOps" => 5],
                    "Memastikan kecepatan eksekusi data" => ["Data Science" => 5]
                ]
            ],
            [
                "question" => "Apakah Anda nyaman menggunakan alat analisis data?",
                "options" => [
                    "Sangat nyaman" => ["Data Science" => 5, "Backend Development" => 3],
                    "Cukup nyaman" => ["Data Science" => 3],
                    "Tidak terlalu nyaman" => ["UI/UX Design" => 3],
                    "Tidak sama sekali" => ["Game Development" => 3]
                ]
            ],
            [
                "question" => "Apakah Anda lebih suka menyelesaikan masalah yang bersifat:",
                "options" => [
                    "Visual dan estetika" => ["UI/UX Design" => 5, "Frontend Development" => 3],
                    "Logis dan struktural" => ["Backend Development" => 5, "Data Science" => 3],
                    "Fungsional pada server" => ["DevOps" => 5],
                    "Interaktif dalam game" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Apakah Anda lebih nyaman bekerja dengan:",
                "options" => [
                    "Tim besar dengan banyak divisi" => ["DevOps" => 5, "UI/UX Design" => 3],
                    "Tim kecil dengan peran fleksibel" => ["Game Development" => 5, "Mobile Development" => 3],
                    "Secara individu dengan tanggung jawab spesifik" => ["Backend Development" => 5, "Data Science" => 3],
                    "Kombinasi individu dan tim" => ["Frontend Development" => 5]
                ]
            ],
            [
                "question" => "Dalam pengembangan aplikasi, Anda lebih suka:",
                "options" => [
                    "Menganalisis pola dan prediksi data" => ["Data Science" => 5],
                    "Membuat arsitektur backend" => ["Backend Development" => 5],
                    "Mendesain pengalaman pengguna" => ["UI/UX Design" => 5],
                    "Membuat fitur interaktif di aplikasi/game" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Anda lebih nyaman menggunakan tools seperti:",
                "options" => [
                    "Docker atau Kubernetes" => ["DevOps" => 5],
                    "Pandas atau TensorFlow" => ["Data Science" => 5],
                    "Figma atau Sketch" => ["UI/UX Design" => 5],
                    "Unity atau Unreal Engine" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Ketika mengembangkan aplikasi, Anda lebih suka:",
                "options" => [
                    "Memastikan desain dapat digunakan dengan baik" => ["UI/UX Design" => 5],
                    "Memperbaiki bug pada server" => ["Backend Development" => 5, "DevOps" => 3],
                    "Meningkatkan keamanan aplikasi" => ["Cybersecurity" => 5],
                    "Menambah fitur baru pada aplikasi" => ["Mobile Development" => 5]
                ]
            ],
            [
                "question" => "Dalam membangun proyek IT, Anda lebih suka:",
                "options" => [
                    "Menyusun sistem keamanan" => ["Cybersecurity" => 5],
                    "Mengembangkan aplikasi real-time" => ["DevOps" => 5, "Backend Development" => 3],
                    "Membuat elemen interaktif" => ["Frontend Development" => 5],
                    "Menyusun data untuk pengambilan keputusan" => ["Data Science" => 5]
                ]
            ],
            [
                "question" => "Apa yang lebih menarik bagi Anda?",
                "options" => [
                    "Membuat prototipe desain aplikasi" => ["UI/UX Design" => 5],
                    "Mengoptimalkan query database" => ["Backend Development" => 5],
                    "Menyusun infrastruktur server yang efisien" => ["DevOps" => 5],
                    "Membuat animasi karakter dalam game" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Dalam menghadapi tantangan teknis, Anda lebih suka:",
                "options" => [
                    "Menganalisis dan memperbaiki kode" => ["Backend Development" => 5],
                    "Menyusun data menjadi insight" => ["Data Science" => 5],
                    "Menyelesaikan masalah visual" => ["UI/UX Design" => 5],
                    "Menambah efek visual di game" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Ketika menghadapi deadline, Anda lebih nyaman:",
                "options" => [
                    "Menyelesaikan tugas secara bertahap" => ["Frontend Development" => 5],
                    "Menyelesaikan masalah secara efisien" => ["Backend Development" => 5],
                    "Bekerja dengan prioritas tinggi pada desain" => ["UI/UX Design" => 5],
                    "Menyelesaikan tantangan performa game" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Dalam pembelajaran teknologi baru, Anda lebih suka:",
                "options" => [
                    "Framework untuk desain visual" => ["UI/UX Design" => 5],
                    "Alat untuk pengembangan backend" => ["Backend Development" => 5],
                    "Alat untuk menganalisis data" => ["Data Science" => 5],
                    "Engine untuk pengembangan game" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Dalam pengujian aplikasi, Anda lebih suka:",
                "options" => [
                    "Menguji user experience" => ["UI/UX Design" => 5],
                    "Menguji kestabilan sistem" => ["DevOps" => 5],
                    "Menganalisis data dari hasil pengujian" => ["Data Science" => 5],
                    "Mengoptimalkan performa aplikasi/game" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Apakah Anda tertarik mendalami:",
                "options" => [
                    "Performa server dan deployment" => ["DevOps" => 5],
                    "Keamanan aplikasi terhadap serangan" => ["Cybersecurity" => 5],
                    "Struktur data dan algoritma" => ["Backend Development" => 5],
                    "Proses desain antarmuka" => ["UI/UX Design" => 5]
                ]
            ],
            [
                "question" => "Anda lebih suka bekerja pada:",
                "options" => [
                    "Aplikasi berbasis web" => ["Frontend Development" => 5, "Backend Development" => 3],
                    "Aplikasi berbasis mobile" => ["Mobile Development" => 5],
                    "Infrastruktur cloud" => ["DevOps" => 5],
                    "Proyek berbasis game" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Ketika menghadapi bug, Anda lebih sering:",
                "options" => [
                    "Memperbaiki dari sisi kode" => ["Backend Development" => 5],
                    "Memastikan masalah pada server" => ["DevOps" => 5],
                    "Mengubah desain agar lebih intuitif" => ["UI/UX Design" => 5],
                    "Meningkatkan mekanisme gameplay" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Dalam pengembangan proyek, Anda lebih nyaman:",
                "options" => [
                    "Mengatur database" => ["Backend Development" => 5],
                    "Mengoptimalkan aplikasi pada cloud" => ["DevOps" => 5],
                    "Meningkatkan visual aplikasi" => ["UI/UX Design" => 5],
                    "Menambahkan fitur berbasis data" => ["Data Science" => 5]
                ]
            ],
            [
                "question" => "Apakah Anda tertarik bekerja dengan teknologi:",
                "options" => [
                    "Augmented Reality/Virtual Reality" => ["Game Development" => 5],
                    "Big Data dan analitik" => ["Data Science" => 5],
                    "Desain responsif" => ["UI/UX Design" => 5],
                    "Backend untuk aplikasi skala besar" => ["Backend Development" => 5]
                ]
            ],
            [
                "question" => "Dalam bekerja, Anda lebih suka fokus pada:",
                "options" => [
                    "Pengembangan sisi server" => ["Backend Development" => 5, "DevOps" => 3],
                    "Desain interaksi pengguna" => ["UI/UX Design" => 5, "Frontend Development" => 3],
                    "Analisis data untuk prediksi" => ["Data Science" => 5],
                    "Peningkatan fitur interaktif" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Ketika mengerjakan proyek, Anda lebih fokus pada:",
                "options" => [
                    "Memastikan pengalaman pengguna berjalan baik" => ["UI/UX Design" => 5],
                    "Membuat struktur kode yang optimal" => ["Backend Development" => 5],
                    "Membuat deployment otomatis" => ["DevOps" => 5],
                    "Mengembangkan elemen gameplay inovatif" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Dalam mempelajari teknologi, Anda lebih nyaman:",
                "options" => [
                    "Membaca dokumentasi alat baru" => ["Backend Development" => 5, "Data Science" => 3],
                    "Melakukan eksperimen desain" => ["UI/UX Design" => 5],
                    "Melakukan simulasi server" => ["DevOps" => 5],
                    "Membuat prototipe game" => ["Game Development" => 5]
                ]
            ],
            [
                "question" => "Dalam memilih proyek, Anda lebih suka:",
                "options" => [
                    "Sistem manajemen data" => ["Data Science" => 5, "Backend Development" => 3],
                    "Desain antarmuka aplikasi" => ["UI/UX Design" => 5],
                    "Infrastruktur cloud dan CI/CD" => ["DevOps" => 5],
                    "Pengembangan game yang menarik" => ["Game Development" => 5]
                ]
            ]
        ]);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseCategories = Category::where('parent_id', null)->get();

        $this->command->info(json_encode($courseCategories));

        $this->questionnaire->each(function ($question) use ($courseCategories) {
            $questionnaire = QuestionnaireQuestion::create([
                'question' => $question['question'],
                'order' => QuestionnaireQuestion::count() + 1,
            ]);

            foreach ($question['options'] as $option => $scores) {
                $questionnaireAnswer = QuestionnaireAnswer::create([
                    'questionnaire_question_id' => $questionnaire->id,
                    'answer' => $option,
                ]);

                foreach ($scores as $category => $score) {
                    $courseCategory = $courseCategories->firstWhere('name', $category);
                    QuestionnaireAnswerScore::create([
                        'category_id' => $courseCategory->id,
                        'questionnaire_answer_id' => $questionnaireAnswer->id,
                        'score' => $score,
                    ]);
                }
            }
        });
    }
}
