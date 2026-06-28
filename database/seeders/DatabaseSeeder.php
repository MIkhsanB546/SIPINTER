<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TingkatKesulitan;
use App\Models\KategoriMateri;
use App\Models\Materi;
use App\Models\MateriSiswa;
use App\Models\Quiz;
use App\Models\Soal;
use App\Models\PilihanJawaban;
use App\Models\QuizAttempt;
use App\Models\JawabanSiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================================
        // ADMIN
        // ============================================================
        User::create([
            'name' => 'Admin SIPINTER',
            'email' => 'admin@sipinter.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // ============================================================
        // GURU (3 teachers)
        // ============================================================
        $guru1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'guru1@sipinter.test',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        $guru2 = User::create([
            'name' => 'Siti Rahayu',
            'email' => 'guru2@sipinter.test',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        $guru3 = User::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'guru3@sipinter.test',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        $gurus = [$guru1, $guru2, $guru3];

        // ============================================================
        // SISWA (15 students)
        // ============================================================
        $siswaNames = [
            'Andi', 'Bunga', 'Citra', 'Doni', 'Eka',
            'Farhan', 'Gita', 'Hadi', 'Intan', 'Joko',
            'Kiki', 'Lina', 'Mila', 'Nando', 'Ocha',
        ];
        $siswas = [];
        foreach ($siswaNames as $name) {
            $siswas[] = User::create([
                'name' => $name,
                'email' => strtolower($name) . '@sipinter.test',
                'password' => bcrypt('password'),
                'role' => 'siswa',
            ]);
        }

        // ============================================================
        // ORANG TUA (5 parents)
        // ============================================================
        $ortuNames = [
            ['name' => 'Parent Andi', 'email' => 'parent_andi@sipinter.test'],
            ['name' => 'Parent Bunga', 'email' => 'parent_bunga@sipinter.test'],
            ['name' => 'Parent Citra', 'email' => 'parent_citra@sipinter.test'],
            ['name' => 'Parent Doni', 'email' => 'parent_doni@sipinter.test'],
            ['name' => 'Parent Eka', 'email' => 'parent_eka@sipinter.test'],
        ];
        $parents = [];
        foreach ($ortuNames as $o) {
            $parents[] = User::create([
                'name' => $o['name'],
                'email' => $o['email'],
                'password' => bcrypt('password'),
                'role' => 'orang_tua',
            ]);
        }

        // Link parents to students (each parent gets 3 children)
        foreach ($parents as $i => $parent) {
            for ($j = 0; $j < 3; $j++) {
                $siswaIndex = ($i * 3 + $j) % count($siswas);
                DB::table('orang_tua_siswa')->insert([
                    'id_orang_tua' => $parent->id_user,
                    'id_siswa' => $siswas[$siswaIndex]->id_user,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // ============================================================
        // TINGKAT KESULITAN (3 levels)
        // ============================================================
        $dasar = TingkatKesulitan::create(['nama_tingkat' => 'Dasar']);
        $menengah = TingkatKesulitan::create(['nama_tingkat' => 'Menengah']);
        $lanjutan = TingkatKesulitan::create(['nama_tingkat' => 'Lanjutan']);
        $tingkatList = [$dasar, $menengah, $lanjutan];

        // ============================================================
        // KATEGORI MATERI (10 categories)
        // ============================================================
        $kategoriNames = [
            'Matematika', 'Bahasa Indonesia', 'IPA', 'IPS', 'Bahasa Inggris',
            'Seni Budaya', 'PJOK', 'PKN', 'Agama', 'Informatika',
        ];
        $kategoris = [];
        foreach ($kategoriNames as $name) {
            $kategoris[] = KategoriMateri::create(['nama_kategori' => $name]);
        }

        // ============================================================
        // MATERI (20 materials)
        // ============================================================
        $materiList = [];
        $materiData = [
            ['judul' => 'Pengertian Bilangan', 'deskripsi' => 'Mempelajari konsep bilangan dan operasi dasarnya.'],
            ['judul' => 'Tata Bahasa Dasar', 'deskripsi' => 'Pengenalan struktur kalimat dan tanda baca.'],
            ['judul' => 'Pengenalan Makhluk Hidup', 'deskripsi' => 'Klasifikasi dasar makhluk hidup di sekitar kita.'],
            ['judul' => 'Keragaman Budaya Indonesia', 'deskripsi' => 'Mengenal suku, bahasa, dan adat istiadat Indonesia.'],
            ['judul' => 'Vocabulary Sehari-hari', 'deskripsi' => 'Kosakata bahasa Inggris untuk situasi sehari-hari.'],
            ['judul' => 'Aljabar Linear', 'deskripsi' => 'Persamaan linear, matriks, dan vektor.'],
            ['judul' => 'Menulis Paragraf', 'deskripsi' => 'Teknik menulis paragraf yang baik dan benar.'],
            ['judul' => 'Sistem Tata Surya', 'deskripsi' => 'Mengenal planet, bintang, dan benda langit lainnya.'],
            ['judul' => 'Peta dan Globe', 'deskripsi' => 'Cara membaca peta dan memahami globe.'],
            ['judul' => 'Grammar Dasar', 'deskripsi' => 'Tenses dasar dan struktur kalimat bahasa Inggris.'],
            ['judul' => 'Geometri Dasar', 'deskripsi' => 'Bangun datar, bangun ruang, dan rumus keliling luas.'],
            ['judul' => 'Puisi dan Pantun', 'deskripsi' => 'Mengenal jenis-jenis puisi dan pantun.'],
            ['judul' => 'Fotosintesis', 'deskripsi' => 'Proses fotosintesis pada tumbuhan.'],
            ['judul' => 'Perekonomian Indonesia', 'deskripsi' => 'Sistem ekonomi dan pelaku ekonomi di Indonesia.'],
            ['judul' => 'Reading Comprehension', 'deskripsi' => 'Teknik membaca dan memahami teks bahasa Inggris.'],
            ['judul' => 'Kalkulus Dasar', 'deskripsi' => 'Limit, turunan, dan integral dasar.'],
            ['judul' => 'Teknik Presentasi', 'deskripsi' => 'Cara membuat dan menyampaikan presentasi yang efektif.'],
            ['judul' => 'Ekosistem dan Lingkungan', 'deskripsi' => 'Hubungan makhluk hidup dengan lingkungannya.'],
            ['judul' => 'Sejarah Kemerdekaan', 'deskripsi' => 'Perjuangan kemerdekaan Indonesia.'],
            ['judul' => 'Pemrograman Dasar', 'deskripsi' => 'Logika pemrograman dan algoritma dasar.'],
        ];

        foreach ($materiData as $i => $md) {
            $guru = $gurus[$i % 3];
            $tingkat = $tingkatList[$i % 3];
            $kategori = $kategoris[$i % 10];

            $materi = Materi::create([
                'id_guru' => $guru->id_user,
                'id_tingkat' => $tingkat->id_tingkat,
                'id_kategori_materi' => $kategori->id_kategori_materi,
                'judul' => $md['judul'],
                'deskripsi' => $md['deskripsi'],
                'file_materi' => null,
                'thumbnail' => null,
                'is_published' => true,
            ]);
            $materiList[] = $materi;

            // Create 1 quiz per materi
            $quiz = Quiz::create([
                'id_materi' => $materi->id_materi,
                'judul' => 'Quiz ' . $md['judul'],
                'deskripsi' => 'Uji pemahaman tentang ' . $md['judul'],
                'durasi_menit' => 15,
            ]);

            // Create 5 soal per quiz
            for ($j = 1; $j <= 5; $j++) {
                $soal = Soal::create([
                    'id_quiz' => $quiz->id_quiz,
                    'pertanyaan' => $md['judul'] . " - Soal nomor $j?",
                ]);

                PilihanJawaban::create([
                    'id_soal' => $soal->id_soal,
                    'jawaban' => "Jawaban benar untuk soal $j",
                    'is_correct' => true,
                ]);

                for ($k = 2; $k <= 4; $k++) {
                    PilihanJawaban::create([
                        'id_soal' => $soal->id_soal,
                        'jawaban' => "Pilihan $k untuk soal $j",
                        'is_correct' => false,
                    ]);
                }
            }
        }

        // ============================================================
        // MATERI SISWA: Some materials saved/learning/completed
        // ============================================================
        foreach ($siswas as $siswa) {
            // Each student saves 3-8 random materials
            $numSaved = rand(3, 8);
            $savedMateri = collect($materiList)->random($numSaved);

            foreach ($savedMateri as $materi) {
                $status = match (rand(1, 3)) {
                    1 => 'saved',
                    2 => 'learning',
                    3 => 'completed',
                };

                $progress = match ($status) {
                    'saved' => 0,
                    'learning' => rand(10, 90),
                    'completed' => 100,
                };

                $startedAt = match ($status) {
                    'saved' => null,
                    'learning' => now()->subDays(rand(1, 14)),
                    'completed' => now()->subDays(rand(15, 30)),
                };

                $completedAt = $status === 'completed' ? now()->subDays(rand(1, 14)) : null;

                MateriSiswa::create([
                    'id_siswa' => $siswa->id_user,
                    'id_materi' => $materi->id_materi,
                    'status' => $status,
                    'progress' => $progress,
                    'started_at' => $startedAt,
                    'completed_at' => $completedAt,
                ]);

                // For learning/completed materials, create quiz attempts
                if ($status !== 'saved') {
                    $quiz = $materi->quiz->first();
                    if ($quiz) {
                        $jumlahSoal = $quiz->soal->count();
                        $jumlahBenar = $status === 'completed' ? $jumlahSoal : rand(1, $jumlahSoal - 1);
                        $skorPersen = round(($jumlahBenar / $jumlahSoal) * 100, 2);

                        $bintang = match (true) {
                            $skorPersen >= 80 => 3,
                            $skorPersen >= 60 => 2,
                            $skorPersen >= 40 => 1,
                            default => 0,
                        };

                        $attempt = QuizAttempt::create([
                            'id_siswa' => $siswa->id_user,
                            'id_quiz' => $quiz->id_quiz,
                            'skor_persen' => $skorPersen,
                            'bintang' => $bintang,
                            'tanggal_pengerjaan' => $startedAt ?? now(),
                            'attempt_ke' => 1,
                        ]);

                        // Record jawaban
                        foreach ($quiz->soal as $soal) {
                            $correctAnswer = $soal->pilihanJawaban()->where('is_correct', true)->first();
                            JawabanSiswa::create([
                                'id_quiz_attempt' => $attempt->id_quiz_attempt,
                                'id_soal' => $soal->id_soal,
                                'id_pilihan_jawaban' => $correctAnswer->id_pilihan_jawaban,
                                'is_correct' => true,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
