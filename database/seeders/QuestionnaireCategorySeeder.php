<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\QuestionnaireResultCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionnaireCategorySeeder extends Seeder
{
    public $categories;

    public function __construct()
    {
        /*
Backend Development
Nama: Arsitek Logika
Deskripsi: Anda adalah ahli dalam menyusun struktur logis di balik aplikasi. Anda menikmati menyelesaikan masalah teknis kompleks dan membangun fondasi yang kokoh untuk aplikasi.
Frontend Development
Nama: Pemahat Antarmuka
Deskripsi: Anda adalah seniman dalam menyusun pengalaman pengguna. Fokus Anda adalah membuat antarmuka aplikasi yang interaktif, responsif, dan indah.
Mobile Development
Nama: Penggerak Aplikasi
Deskripsi: Anda ahli dalam membuat aplikasi yang berjalan mulus di perangkat seluler. Fokus Anda adalah kenyamanan dan performa pada platform mobile.
DevOps
Nama: Pengelola Infrastruktur
Deskripsi: Anda adalah jembatan antara pengembangan dan operasional. Anda memastikan aplikasi dapat berjalan dengan lancar dan stabil di berbagai lingkungan.
Data Science
Nama: Pengolah Wawasan
Deskripsi: Anda adalah detektif data yang mencari pola tersembunyi. Anda menikmati bekerja dengan angka, statistik, dan prediksi berbasis data.
Cybersecurity
Nama: Penjaga Sistem
Deskripsi: Anda adalah pelindung aplikasi dari ancaman dunia maya. Keamanan adalah prioritas utama Anda dalam setiap proyek.
UI/UX
Nama: Perancang Pengalaman
Deskripsi: Anda adalah kreator di balik pengalaman pengguna yang menarik dan intuitif. Anda selalu memastikan setiap elemen desain berfungsi dengan sempurna.
Game Development
Nama: Pencipta Dunia
Deskripsi: Anda adalah inovator di balik pengalaman bermain yang luar biasa. Anda menikmati menciptakan mekanik permainan dan dunia virtual yang mendalam.

Kategori Kombinasi
Frontend + UI/UX
Nama: Seniman Digital
Deskripsi: Anda adalah penggabung seni dan teknologi. Anda memastikan antarmuka tidak hanya menarik secara visual tetapi juga mudah digunakan.
Backend + DevOps
Nama: Insinyur Sistem
Deskripsi: Anda ahli dalam membangun sistem backend yang kuat sekaligus memastikan infrastruktur operasional berjalan optimal.
Mobile Development + UI/UX
Nama: Pendesain Aplikasi Seluler
Deskripsi: Anda menciptakan aplikasi mobile yang memukau secara visual dan efisien dalam performa.
Data Science + Backend
Nama: Analis Data Teknis
Deskripsi: Anda adalah ahli data yang mampu mengolah informasi sekaligus membangun sistem backend untuk mendukung analitik.
Cybersecurity + DevOps
Nama: Pengawal Infrastruktur
Deskripsi: Anda memastikan keamanan sistem di setiap tahap, dari pengembangan hingga deployment.
Game Development + UI/UX
Nama: Desainer Dunia Virtual
Deskripsi: Anda memastikan dunia game yang Anda buat memukau secara visual dan mudah dinavigasi oleh pemain.
Game Development + Backend
Nama: Arsitek Gameplay
Deskripsi: Anda menciptakan mekanisme permainan yang kompleks dan memastikan performa server mendukung pengalaman bermain yang optimal.
DevOps + Mobile Development
Nama: Operator Aplikasi Mobile
Deskripsi: Anda adalah spesialis dalam menjaga performa aplikasi mobile dari sisi operasional dan teknis.
Data Science + Cybersecurity
Nama: Analis Keamanan Data
Deskripsi: Anda mengolah data untuk mendeteksi ancaman sekaligus menciptakan sistem keamanan yang tangguh.
Frontend + Game Development
Nama: Programmer Interaktif
Deskripsi: Anda menciptakan antarmuka yang dinamis dan terintegrasi dengan elemen gameplay.
*/

        /*
[{"id":1,"icon_image":"fas fa-server","name":"Backend Development","slug":"backend-development","color":"#FF5733","parent_id":null},{"id":12,"icon_image":"fas fa-desktop","name":"Frontend Development","slug":"frontend-development","color":"#61dafb","parent_id":null},{"id":22,"icon_image":"fas fa-mobile-alt","name":"Mobile Development","slug":"mobile-development","color":"#ff6f61","parent_id":null},{"id":31,"icon_image":"fas fa-cogs","name":"DevOps","slug":"devops","color":"#f05032","parent_id":null},{"id":35,"icon_image":"fas fa-chart-line","name":"Data Science","slug":"data-science","color":"#4caf50","parent_id":null},{"id":42,"icon_image":"fas fa-shield-alt","name":"Cybersecurity","slug":"cybersecurity","color":"#5a5a5a","parent_id":null},{"id":46,"icon_image":"fas fa-paint-brush","name":"UI\/UX Design","slug":"uiux-design","color":"#ff6347","parent_id":null},{"id":50,"icon_image":"fas fa-gamepad","name":"Game Development","slug":"game-development","color":"#3498db","parent_id":null}]
*/
        $this->categories = collect([
            [
                'name' => 'Arsitek Logika',
                'description' => 'Anda adalah ahli dalam menyusun struktur logis di balik aplikasi. Anda menikmati menyelesaikan masalah teknis kompleks dan membangun fondasi yang kokoh untuk aplikasi.',
                'color' => '#FF0000',
                'icon' => 'fas fa-server',
                '1st_category' => 'Backend Development',
                '2nd_category' => null,
            ],
            [
                'name' => 'Pemahat Antarmuka',
                'description' => 'Anda adalah seniman dalam menyusun pengalaman pengguna. Fokus Anda adalah membuat antarmuka aplikasi yang interaktif, responsif, dan indah.',
                'color' => '#00FF00',
                'icon' => 'fas fa-desktop',
                '1st_category' => 'Frontend Development',
                '2nd_category' => null,
            ],
            [
                'name' => 'Penggerak Aplikasi',
                'description' => 'Anda ahli dalam membuat aplikasi yang berjalan mulus di perangkat seluler. Fokus Anda adalah kenyamanan dan performa pada platform mobile.',
                'color' => '#0000FF',
                'icon' => 'fas fa-mobile-alt',
                '1st_category' => 'Mobile Development',
                '2nd_category' => null,
            ],
            [
                'name' => 'Pengelola Infrastruktur',
                'description' => 'Anda adalah jembatan antara pengembangan dan operasional. Anda memastikan aplikasi dapat berjalan dengan lancar dan stabil di berbagai lingkungan.',
                'color' => '#FF00FF',
                'icon' => 'fas fa-cogs',
                '1st_category' => 'DevOps',
                '2nd_category' => null,
            ],
            [
                'name' => 'Pengolah Wawasan',
                'description' => 'Anda adalah detektif data yang mencari pola tersembunyi. Anda menikmati bekerja dengan angka, statistik, dan prediksi berbasis data.',
                'color' => '#FFFF00',
                'icon' => 'fas fa-chart-line',
                '1st_category' => 'Data Science',
                '2nd_category' => null,
            ],
            [
                'name' => 'Penjaga Sistem',
                'description' => 'Anda adalah pelindung aplikasi dari ancaman dunia maya. Keamanan adalah prioritas utama Anda dalam setiap proyek.',
                'color' => '#00FFFF',
                'icon' => 'fas fa-shield-alt',
                '1st_category' => 'Cybersecurity',
                '2nd_category' => null,
            ],
            [
                'name' => 'Perancang Pengalaman',
                'description' => 'Anda adalah kreator di balik pengalaman pengguna yang menarik dan intuitif. Anda selalu memastikan setiap elemen desain berfungsi dengan sempurna.',
                'color' => '#FFA500',
                'icon' => 'fas fa-paint-brush',
                '1st_category' => 'UI/UX Design',
                '2nd_category' => null,
            ],
            [
                'name' => 'Pencipta Dunia',
                'description' => 'Anda adalah inovator di balik pengalaman bermain yang luar biasa. Anda menikmati menciptakan mekanik permainan dan dunia virtual yang mendalam.',
                'color' => '#800080',
                'icon' => 'fas fa-gamepad',
                '1st_category' => 'Game Development',
                '2nd_category' => null,
            ],
            [
                'name' => 'Seniman Digital',
                'description' => 'Anda adalah penggabung seni dan teknologi. Anda memastikan antarmuka tidak hanya menarik secara visual tetapi juga mudah digunakan.',
                'color' => '#FF4500',
                'icon' => 'fas fa-palette',
                '1st_category' => 'Frontend Development',
                '2nd_category' => 'UI/UX Design',
            ],
            [
                'name' => 'Insinyur Sistem',
                'description' => 'Anda ahli dalam membangun sistem backend yang kuat sekaligus memastikan infrastruktur operasional berjalan optimal.',
                'color' => '#008000',
                'icon' => 'fas fa-cogs',
                '1st_category' => 'Backend Development',
                '2nd_category' => 'DevOps',
            ],
            [
                'name' => 'Pendesain Aplikasi Seluler',
                'description' => 'Anda menciptakan aplikasi mobile yang memukau secara visual dan efisien dalam performa.',
                'color' => '#000080',
                'icon' => 'fas fa-mobile-alt',
                '1st_category' => 'Mobile Development',
                '2nd_category' => 'UI/UX Design',
            ],
            [
                'name' => 'Analis Data Teknis',
                'description' => 'Anda adalah ahli data yang mampu mengolah informasi sekaligus membangun sistem backend untuk mendukung analitik.',
                'color' => '#800000',
                'icon' => 'fas fa-database',
                '1st_category' => 'Data Science',
                '2nd_category' => 'Backend Development',
            ],
            [
                'name' => 'Pengawal Infrastruktur',
                'description' => 'Anda memastikan keamanan sistem di setiap tahap, dari pengembangan hingga deployment.',
                'color' => '#008080',
                'icon' => 'fas fa-shield-alt',
                '1st_category' => 'Cybersecurity',
                '2nd_category' => 'DevOps',
            ],
            [
                'name' => 'Desainer Dunia Virtual',
                'description' => 'Anda memastikan dunia game yang Anda buat memukau secara visual dan mudah dinavigasi oleh pemain.',
                'color' => '#800080',
                'icon' => 'fas fa-gamepad',
                '1st_category' => 'Game Development',
                '2nd_category' => 'UI/UX Design',
            ],
            [
                'name' => 'Arsitek Gameplay',
                'description' => 'Anda menciptakan mekanisme permainan yang kompleks dan memastikan performa server mendukung pengalaman bermain yang optimal.',
                'color' => '#008000',
                'icon' => 'fas fa-gamepad',
                '1st_category' => 'Game Development',
                '2nd_category' => 'Backend Development',
            ],
            [
                'name' => 'Operator Aplikasi Mobile',
                'description' => 'Anda adalah spesialis dalam menjaga performa aplikasi mobile dari sisi operasional dan teknis.',
                'color' => '#000080',
                'icon' => 'fas fa-mobile-alt',
                '1st_category' => 'DevOps',
                '2nd_category' => 'Mobile Development',
            ],
            [
                'name' => 'Analis Keamanan Data',
                'description' => 'Anda mengolah data untuk mendeteksi ancaman sekaligus menciptakan sistem keamanan yang tangguh.',
                'color' => '#800000',
                'icon' => 'fas fa-shield-alt',
                '1st_category' => 'Data Science',
                '2nd_category' => 'Cybersecurity',
            ],
            [
                'name' => 'Programmer Interaktif',
                'description' => 'Anda menciptakan antarmuka yang dinamis dan terintegrasi dengan elemen gameplay.',
                'color' => '#FF4500',
                'icon' => 'fas fa-gamepad',
                '1st_category' => 'Frontend Development',
                '2nd_category' => 'Game Development',
            ],
        ]);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::whereNull('parent_id')->get();


        $this->categories->each(function ($category) use ($categories) {
            QuestionnaireResultCategory::create([
                'name' => $category['name'],
                'description' => $category['description'],
                'color' => $category['color'],
                'icon' => $category['icon'],
                '1st_category_id' => $categories->where('name', $category['1st_category'])->first()->id,
                '2nd_category_id' => $category['2nd_category'] ? $categories->where('name', $category['2nd_category'])->first()->id : null,
            ]);
        });
    }
}
