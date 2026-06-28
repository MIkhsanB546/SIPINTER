<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TingkatKesulitan;
use App\Models\MateriSiswa;
use App\Models\QuizAttempt;
use App\Models\JawabanSiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $guru1 = User::create(['name' => 'Budi Santoso', 'email' => 'guru1@sipinter.test', 'password' => bcrypt('password'), 'role' => 'guru']);
        $guru2 = User::create(['name' => 'Siti Rahayu', 'email' => 'guru2@sipinter.test', 'password' => bcrypt('password'), 'role' => 'guru']);
        $guru3 = User::create(['name' => 'Ahmad Fauzi', 'email' => 'guru3@sipinter.test', 'password' => bcrypt('password'), 'role' => 'guru']);
        $gurus = [$guru1, $guru2, $guru3];

        // ============================================================
        // SISWA (15 students)
        // ============================================================
        $siswaNames = ['Andi', 'Bunga', 'Citra', 'Doni', 'Eka', 'Farhan', 'Gita', 'Hadi', 'Intan', 'Joko', 'Kiki', 'Lina', 'Mila', 'Nando', 'Ocha'];
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
        $ortuData = [
            ['name' => 'Parent Andi', 'email' => 'parent_andi@sipinter.test'],
            ['name' => 'Parent Bunga', 'email' => 'parent_bunga@sipinter.test'],
            ['name' => 'Parent Citra', 'email' => 'parent_citra@sipinter.test'],
            ['name' => 'Parent Doni', 'email' => 'parent_doni@sipinter.test'],
            ['name' => 'Parent Eka', 'email' => 'parent_eka@sipinter.test'],
        ];
        $parents = [];
        foreach ($ortuData as $o) {
            $parents[] = User::create([
                'name' => $o['name'],
                'email' => $o['email'],
                'password' => bcrypt('password'),
                'role' => 'orang_tua',
            ]);
        }

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
        TingkatKesulitan::create(['nama_tingkat' => 'Dasar']);
        TingkatKesulitan::create(['nama_tingkat' => 'Menengah']);
        TingkatKesulitan::create(['nama_tingkat' => 'Lanjutan']);

        // ============================================================
        // Copy sample PDF to storage
        // ============================================================
        $sourcePdf = database_path('seeders/assets/contoh_materi.pdf');
        $destinationPdf = 'materi/contoh_materi.pdf';

        if (File::exists($sourcePdf)) {
            Storage::disk('public')->put($destinationPdf, File::get($sourcePdf));
        }

        // ============================================================
        // KATEGORI, MATERI, QUIZ, SOAL
        // ============================================================
        $this->call(KategoriMateriSeeder::class);
        $this->call(ContentSeeder::class);

        // ============================================================
        // MATERI SISWA & QUIZ ATTEMPTS
        // ============================================================
        $materiList = \App\Models\Materi::with('quiz.soal.pilihanJawaban')->get();

        foreach ($siswas as $siswa) {
            $numSaved = rand(3, 8);
            $savedMateri = $materiList->random($numSaved);

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

                if ($status !== 'saved') {
                    $quiz = $materi->quiz->first();
                    if ($quiz) {
                        $jumlahSoal = $quiz->soal->count();
                        $jumlahBenar = $status === 'completed' ? $jumlahSoal : rand(1, max(1, $jumlahSoal - 1));
                        $skorPersen = round(($jumlahBenar / max(1, $jumlahSoal)) * 100, 2);

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

                        foreach ($quiz->soal as $soal) {
                            $correctAnswer = $soal->pilihanJawaban()->where('is_correct', true)->first();
                            if ($correctAnswer) {
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
}
