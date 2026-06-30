<?php

namespace Database\Seeders;

use App\Models\KategoriMateri;
use Illuminate\Database\Seeder;

class KategoriMateriSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama_kategori' => 'Matematika', 'deskripsi' => 'Ilmu tentang bilangan, bangun ruang, dan pola-pola logis'],
            ['nama_kategori' => 'Bahasa Indonesia', 'deskripsi' => 'Materi kebahasaan dan keterampilan berbahasa Indonesia yang baik dan benar'],
            ['nama_kategori' => 'Bahasa Inggris', 'deskripsi' => 'Pembelajaran bahasa Inggris sebagai bahasa asing, mencakup tata bahasa dan kosakata'],
            ['nama_kategori' => 'IPA', 'deskripsi' => 'Ilmu Pengetahuan Alam tentang fenomena alam dan makhluk hidup'],
            ['nama_kategori' => 'IPS', 'deskripsi' => 'Ilmu Pengetahuan Sosial tentang interaksi manusia, sejarah, dan kehidupan bermasyarakat'],
            ['nama_kategori' => 'Pendidikan Pancasila', 'deskripsi' => 'Pendidikan nilai-nilai Pancasila, kewarganegaraan, dan bela negara'],
            ['nama_kategori' => 'Informatika', 'deskripsi' => 'Ilmu tentang teknologi informasi, algoritma, dan pemrograman komputer'],
            ['nama_kategori' => 'Seni Budaya', 'deskripsi' => 'Pembelajaran seni rupa, seni musik, seni tari, dan apresiasi budaya'],
            ['nama_kategori' => 'PJOK', 'deskripsi' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan untuk kebugaran fisik'],
            ['nama_kategori' => 'Agama', 'deskripsi' => 'Pendidikan agama dan budi pekerti untuk pembentukan karakter mulia'],
        ];

        foreach ($categories as $cat) {
            KategoriMateri::create($cat);
        }
    }
}
