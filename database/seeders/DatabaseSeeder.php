<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Jenjang;
use App\Models\KategoriMateri;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\Soal;
use App\Models\PilihanJawaban;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@edugrow.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        $teachers = User::factory(3)->create([
            'role' => 'teacher'
        ]);

        $students = User::factory(10)->create([
            'role' => 'student'
        ]);



        /*
    |--------------------------------------------------------------------------
    | Jenjang
    |--------------------------------------------------------------------------
    */

        $sd = Jenjang::create([
            'nama_jenjang' => 'SD'
        ]);

        $smp = Jenjang::create([
            'nama_jenjang' => 'SMP'
        ]);

        $sma = Jenjang::create([
            'nama_jenjang' => 'SMA'
        ]);



        /*
    |--------------------------------------------------------------------------
    | Kategori
    |--------------------------------------------------------------------------
    */

        $ipa = KategoriMateri::create([
            'nama_kategori' => 'IPA'
        ]);

        $matematika = KategoriMateri::create([
            'nama_kategori' => 'Matematika'
        ]);

        $bahasa = KategoriMateri::create([
            'nama_kategori' => 'Bahasa Indonesia'
        ]);



        /*
    |--------------------------------------------------------------------------
    | Materi
    |--------------------------------------------------------------------------
    */

        foreach ($teachers as $teacher) {

            for ($i = 1; $i <= 2; $i++) {

                $materi = Materi::create([

                    'id_teacher' => $teacher->id_user,

                    'id_jenjang' => collect([
                        $sd->id_jenjang,
                        $smp->id_jenjang,
                        $sma->id_jenjang
                    ])->random(),

                    'id_kategori_materi' => collect([
                        $ipa->id_kategori_materi,
                        $matematika->id_kategori_materi,
                        $bahasa->id_kategori_materi
                    ])->random(),

                    'judul' => "Materi $i",

                    'deskripsi' => fake()->sentence(),

                    'file_materi' => null,

                    'thumbnail' => null,

                    'is_published' => true

                ]);



                /*
            |--------------------------------------------------------------------------
            | Quiz
            |--------------------------------------------------------------------------
            */

                $quiz = Quiz::create([

                    'id_materi' => $materi->id_materi,

                    'judul' => 'Quiz ' . $materi->judul,

                    'deskripsi' => fake()->sentence(),

                    'durasi_menit' => 15

                ]);



                /*
            |--------------------------------------------------------------------------
            | Soal
            |--------------------------------------------------------------------------
            */

                for ($j = 1; $j <= 5; $j++) {

                    $soal = Soal::create([

                        'id_quiz' => $quiz->id_quiz,

                        'pertanyaan' =>
                        "Pertanyaan nomor $j ?"

                    ]);


                    for ($k = 1; $k <= 4; $k++) {

                        PilihanJawaban::create([

                            'id_soal' => $soal->id_soal,

                            'jawaban' =>
                            "Pilihan $k",

                            'is_correct' =>
                            $k == 1

                        ]);
                    }
                }
            }
        }
    }
}
