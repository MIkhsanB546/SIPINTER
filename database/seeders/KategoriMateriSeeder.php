<?php

namespace Database\Seeders;

use App\Models\KategoriMateri;
use Illuminate\Database\Seeder;

class KategoriMateriSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama_kategori' => 'Basis Data', 'deskripsi' => 'Konsep dasar basis data dan sistem manajemen basis data relasional'],
            ['nama_kategori' => 'SQL', 'deskripsi' => 'Structured Query Language untuk manipulasi data pada basis data relasional'],
            ['nama_kategori' => 'MySQL', 'deskripsi' => 'Sistem manajemen basis data open source yang populer'],
            ['nama_kategori' => 'Normalisasi Database', 'deskripsi' => 'Teknik perancangan basis data untuk mengurangi redundansi dan anomali data'],
            ['nama_kategori' => 'ERD', 'deskripsi' => 'Entity Relationship Diagram untuk pemodelan basis data konseptual'],
            ['nama_kategori' => 'Sistem Informasi', 'deskripsi' => 'Konsep, analisis, dan perancangan sistem informasi'],
            ['nama_kategori' => 'UML', 'deskripsi' => 'Unified Modeling Language untuk pemodelan perangkat lunak berorientasi objek'],
            ['nama_kategori' => 'Flowchart', 'deskripsi' => 'Diagram alir untuk merepresentasikan algoritma dan logika pemrograman'],
            ['nama_kategori' => 'DFD', 'deskripsi' => 'Data Flow Diagram untuk pemodelan aliran data dalam sistem'],
            ['nama_kategori' => 'Pemrograman Dasar', 'deskripsi' => 'Konsep dasar pemrograman dan logika komputasi'],
            ['nama_kategori' => 'Algoritma', 'deskripsi' => 'Algoritma dan teknik pemecahan masalah dalam pemrograman'],
            ['nama_kategori' => 'Struktur Data', 'deskripsi' => 'Struktur penyimpanan dan pengelolaan data dalam pemrograman'],
            ['nama_kategori' => 'HTML', 'deskripsi' => 'HyperText Markup Language untuk pengembangan halaman web'],
            ['nama_kategori' => 'CSS', 'deskripsi' => 'Cascading Style Sheets untuk styling dan layout halaman web'],
            ['nama_kategori' => 'JavaScript', 'deskripsi' => 'Bahasa pemrograman untuk pengembangan web interaktif'],
            ['nama_kategori' => 'PHP', 'deskripsi' => 'Bahasa pemrograman server-side untuk pengembangan web dinamis'],
            ['nama_kategori' => 'Laravel', 'deskripsi' => 'Framework PHP modern dengan arsitektur MVC untuk pengembangan aplikasi web'],
            ['nama_kategori' => 'REST API', 'deskripsi' => 'Konsep dan implementasi RESTful API untuk komunikasi antar sistem'],
            ['nama_kategori' => 'JSON', 'deskripsi' => 'JavaScript Object Notation sebagai format pertukaran data ringan'],
            ['nama_kategori' => 'Git & GitHub', 'deskripsi' => 'Version control system dan platform kolaborasi pengembangan perangkat lunak'],
            ['nama_kategori' => 'Linux', 'deskripsi' => 'Sistem operasi open source berbasis Unix'],
            ['nama_kategori' => 'Jaringan Komputer', 'deskripsi' => 'Konsep, protokol, dan teknologi jaringan komputer'],
            ['nama_kategori' => 'Rekayasa Perangkat Lunak', 'deskripsi' => 'Metodologi dan proses pengembangan perangkat lunak'],

            // Kategori KOSONG (tanpa materi) — untuk realisme
            ['nama_kategori' => 'PostgreSQL', 'deskripsi' => 'Sistem basis data relasional open source tingkat lanjut'],
            ['nama_kategori' => 'Oracle Database', 'deskripsi' => 'Sistem manajemen basis data enterprise dari Oracle Corporation'],
            ['nama_kategori' => 'Analisis Sistem', 'deskripsi' => 'Teknik analisis kebutuhan dan spesifikasi sistem informasi'],
            ['nama_kategori' => 'Perancangan Sistem', 'deskripsi' => 'Perancangan arsitektur dan desain sistem informasi'],
            ['nama_kategori' => 'CodeIgniter', 'deskripsi' => 'Framework PHP ringan untuk pengembangan aplikasi web'],
            ['nama_kategori' => 'Keamanan Informasi', 'deskripsi' => 'Prinsip dan praktik keamanan informasi dan sistem komputer'],
            ['nama_kategori' => 'Cloud Computing', 'deskripsi' => 'Komputasi awan dan layanan infrastruktur berbasis cloud'],
            ['nama_kategori' => 'Data Mining', 'deskripsi' => 'Teknik ekstraksi pola dan pengetahuan dari data berukuran besar'],
            ['nama_kategori' => 'Business Intelligence', 'deskripsi' => 'Analisis data untuk mendukung pengambilan keputusan bisnis'],
            ['nama_kategori' => 'Artificial Intelligence', 'deskripsi' => 'Kecerdasan buatan dan sistem cerdas'],
            ['nama_kategori' => 'Machine Learning', 'deskripsi' => 'Pembelajaran mesin dan pengembangan model prediktif'],
            ['nama_kategori' => 'UI/UX Design', 'deskripsi' => 'Perancangan antarmuka dan pengalaman pengguna'],
            ['nama_kategori' => 'Manajemen Proyek SI', 'deskripsi' => 'Manajemen proyek sistem informasi menggunakan kerangka kerja industri'],
        ];

        foreach ($categories as $cat) {
            KategoriMateri::create($cat);
        }
    }
}
