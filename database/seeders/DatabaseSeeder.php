<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Jenjang;
use App\Models\KategoriMateri;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\Soal;
use App\Models\PilihanJawaban;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin SIPINTER',
            'email' => 'admin@sipinter.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $guru1 = User::create([
            'name' => 'Guru Budi',
            'email' => 'guru1@sipinter.test',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        $guru2 = User::create([
            'name' => 'Guru Siti',
            'email' => 'guru2@sipinter.test',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        $guru = [$guru1, $guru2];

        $siswaNames = ['Andi', 'Bunga', 'Citra', 'Doni', 'Eka'];
        foreach ($siswaNames as $name) {
            User::create([
                'name' => $name,
                'email' => strtolower($name) . '@sipinter.test',
                'password' => bcrypt('password'),
                'role' => 'siswa',
            ]);
        }

        $sd = Jenjang::create(['nama_jenjang' => 'SD']);
        $smp = Jenjang::create(['nama_jenjang' => 'SMP']);
        $sma = Jenjang::create(['nama_jenjang' => 'SMA']);
        $jenjang = [$sd, $smp, $sma];

        $mtk = KategoriMateri::create(['nama_kategori' => 'Matematika']);
        $bind = KategoriMateri::create(['nama_kategori' => 'Bahasa Indonesia']);
        $ipa = KategoriMateri::create(['nama_kategori' => 'IPA']);
        $ips = KategoriMateri::create(['nama_kategori' => 'IPS']);
        $bing = KategoriMateri::create(['nama_kategori' => 'Bahasa Inggris']);
        $kategori = [$mtk, $bind, $ipa, $ips, $bing];

        foreach ($guru as $pengajar) {
            for ($i = 1; $i <= 2; $i++) {
                $materi = Materi::create([
                    'id_guru' => $pengajar->id_user,
                    'id_jenjang' => collect($jenjang)->random()->id_jenjang,
                    'id_kategori_materi' => collect($kategori)->random()->id_kategori_materi,
                    'judul' => 'Materi ' . fake()->words(2, true),
                    'deskripsi' => fake()->paragraph(),
                    'file_materi' => null,
                    'thumbnail' => null,
                    'is_published' => true,
                ]);

                $quiz = Quiz::create([
                    'id_materi' => $materi->id_materi,
                    'judul' => 'Quiz ' . $materi->judul,
                    'deskripsi' => fake()->sentence(),
                    'durasi_menit' => 15,
                ]);

                for ($j = 1; $j <= 5; $j++) {
                    $soal = Soal::create([
                        'id_quiz' => $quiz->id_quiz,
                        'pertanyaan' => "Pertanyaan nomor $j tentang " . $materi->judul . "?",
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
        }
    }
}
