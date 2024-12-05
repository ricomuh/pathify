<?php

namespace Database\Seeders;

use App\Models\QuestionnaireResultCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionnaireCategorySeeder extends Seeder
{
    public $categories;

    public function __construct()
    {
        $this->categories = collect([
            [
                'name' => 'Arsitek Logika',
                'description' => 'Anda adalah ahli dalam menyusun struktur logis di balik aplikasi. Anda menikmati menyelesaikan masalah teknis kompleks dan membangun fondasi yang kokoh untuk aplikasi.',
                'color' => '#FF0000',
                'icon' => 'fas fa-server',
            ],
            [
                'name' => 'Pemahat Antarmuka',
                'description' => 'Anda adalah seniman dalam menyusun pengalaman pengguna. Fokus Anda adalah membuat antarmuka aplikasi yang interaktif, responsif, dan indah.',
                'color' => '#00FF00',
                'icon' => 'fas fa-desktop',
            ],
            [
                'name' => 'Penggerak Aplikasi',
                'description' => 'Anda ahli dalam membuat aplikasi yang berjalan mulus di perangkat seluler. Fokus Anda adalah kenyamanan dan performa pada platform mobile.',
                'color' => '#0000FF',
                'icon' => 'fas fa-mobile-alt',
            ],
            [
                'name' => 'Pengelola Infrastruktur',
                'description' => 'Anda adalah jembatan antara pengembangan dan operasional. Anda memastikan aplikasi dapat berjalan dengan lancar dan stabil di berbagai lingkungan.',
                'color' => '#FF00FF',
                'icon' => 'fas fa-cogs',
            ],
            [
                'name' => 'Pengolah Wawasan',
                'description' => 'Anda adalah detektif data yang mencari pola tersembunyi. Anda menikmati bekerja dengan angka, statistik, dan prediksi berbasis data.',
                'color' => '#FFFF00',
                'icon' => 'fas fa-chart-line',
            ],
            [
                'name' => 'Penjaga Sistem',
                'description' => 'Anda adalah pelindung aplikasi dari ancaman dunia maya. Keamanan adalah prioritas utama Anda dalam setiap proyek.',
                'color' => '#00FFFF',
                'icon' => 'fas fa-shield-alt',
            ],
            [
                'name' => 'Perancang Pengalaman',
                'description' => 'Anda adalah kreator di balik pengalaman pengguna yang menarik dan intuitif. Anda selalu memastikan setiap elemen desain berfungsi dengan sempurna.',
                'color' => '#FFA500',
                'icon' => 'fas fa-paint-brush',
            ],
            [
                'name' => 'Pencipta Dunia',
                'description' => 'Anda adalah inovator di balik pengalaman bermain yang luar biasa. Anda menikmati menciptakan mekanik permainan dan dunia virtual yang mendalam.',
                'color' => '#800080',
                'icon' => 'fas fa-gamepad',
            ],
            [
                'name' => 'Seniman Digital',
                'description' => 'Anda adalah penggabung seni dan teknologi. Anda memastikan antarmuka tidak hanya menarik secara visual tetapi juga mudah digunakan.',
                'color' => '#FF4500',
                'icon' => 'fas fa-palette',
            ],
            [
                'name' => 'Insinyur Sistem',
                'description' => 'Anda ahli dalam membangun sistem backend yang kuat sekaligus memastikan infrastruktur operasional berjalan optimal.',
                'color' => '#008000',
                'icon' => 'fas fa-cogs',
            ],
            [
                'name' => 'Pendesain Aplikasi Seluler',
                'description' => 'Anda menciptakan aplikasi mobile yang memukau secara visual dan efisien dalam performa.',
                'color' => '#000080',
                'icon' => 'fas fa-mobile-alt',
            ],
            [
                'name' => 'Analis Data Teknis',
                'description' => 'Anda adalah ahli data yang mampu mengolah informasi sekaligus membangun sistem backend untuk mendukung analitik.',
                'color' => '#800000',
                'icon' => 'fas fa-database',
            ],
            [
                'name' => 'Pengawal Infrastruktur',
                'description' => 'Anda memastikan keamanan sistem di setiap tahap, dari pengembangan hingga deployment.',
                'color' => '#008080',
                'icon' => 'fas fa-shield-alt',
            ],
            [
                'name' => 'Desainer Dunia Virtual',
                'description' => 'Anda memastikan dunia game yang Anda buat memukau secara visual dan mudah dinavigasi oleh pemain.',
                'color' => '#800080',
                'icon' => 'fas fa-gamepad',
            ],
            [
                'name' => 'Arsitek Gameplay',
                'description' => 'Anda menciptakan mekanisme permainan yang kompleks dan memastikan performa server mendukung pengalaman bermain yang optimal.',
                'color' => '#008000',
                'icon' => 'fas fa-gamepad',
            ],
            [
                'name' => 'Operator Aplikasi Mobile',
                'description' => 'Anda adalah spesialis dalam menjaga performa aplikasi mobile dari sisi operasional dan teknis.',
                'color' => '#000080',
                'icon' => 'fas fa-mobile-alt',
            ],
            [
                'name' => 'Analis Keamanan Data',
                'description' => 'Anda mengolah data untuk mendeteksi ancaman sekaligus menciptakan sistem keamanan yang tangguh.',
                'color' => '#800000',
                'icon' => 'fas fa-shield-alt',
            ],
            [
                'name' => 'Programmer Interaktif',
                'description' => 'Anda menciptakan antarmuka yang dinamis dan terintegrasi dengan elemen gameplay.',
                'color' => '#FF4500',
                'icon' => 'fas fa-gamepad',
            ],
        ]);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->categories->each(function ($category) {
            QuestionnaireResultCategory::create($category);
        });
    }
}
