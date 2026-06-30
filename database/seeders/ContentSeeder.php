<?php

namespace Database\Seeders;

use App\Models\Materi;
use App\Models\Quiz;
use App\Models\Soal;
use App\Models\PilihanJawaban;
use App\Models\User;
use App\Models\TingkatKesulitan;
use App\Models\KategoriMateri;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    private array $gurus = [];
    private array $tingkatMap = [];
    private array $kategoriMap = [];

    public function run(): void
    {
        $this->gurus = User::where('role', 'guru')->pluck('id_user')->values()->toArray();
        $this->tingkatMap = TingkatKesulitan::pluck('id_tingkat', 'nama_tingkat')->toArray();
        $this->kategoriMap = KategoriMateri::pluck('id_kategori_materi', 'nama_kategori')->toArray();

        $filePdf = 'materi/contoh_materi.pdf';

        foreach ($this->contentData() as $categoryName => $materials) {
            $idKategori = $this->kategoriMap[$categoryName] ?? null;
            if (!$idKategori) continue;

            foreach ($materials as $matData) {
                $materi = $this->createMateri($matData, $idKategori, $filePdf);
                foreach ($matData['quiz'] as $quizData) {
                    $this->createQuizWithSoal($materi, $quizData);
                }
            }
        }
    }

    private function createMateri(array $data, int $idKategori, string $filePdf): Materi
    {
        return Materi::create([
            'id_guru' => $this->gurus[$data['guru']],
            'id_tingkat' => $this->tingkatMap[$data['tingkat']],
            'id_kategori_materi' => $idKategori,
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'],
            'file_materi' => $filePdf,
            'thumbnail' => $data['thumbnail'] ?? null,
            'is_published' => true,
        ]);
    }

    private function createQuizWithSoal(Materi $materi, array $data): void
    {
        $quiz = Quiz::create([
            'id_materi' => $materi->id_materi,
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'],
            'durasi_menit' => $data['durasi'],
        ]);

        foreach ($data['soal'] as $soalData) {
            $soal = Soal::create([
                'id_quiz' => $quiz->id_quiz,
                'pertanyaan' => $soalData['pertanyaan'],
            ]);

            PilihanJawaban::create([
                'id_soal' => $soal->id_soal,
                'jawaban' => $soalData['jawaban'] . '',
                'is_correct' => true,
            ]);

            foreach ($soalData['pengecoh'] as $pengecoh) {
                PilihanJawaban::create([
                    'id_soal' => $soal->id_soal,
                    'jawaban' => $pengecoh,
                    'is_correct' => false,
                ]);
            }
        }
    }

    private function contentData(): array
    {
        return [

            // ================================================================
            // MATEMATIKA
            // ================================================================
            'Matematika' => [
                [
                    'judul' => 'Operasi Bilangan Bulat',
                    'deskripsi' => 'Mempelajari operasi hitung bilangan bulat meliputi penjumlahan, pengurangan, perkalian, dan pembagian.',
                    'tingkat' => 'Dasar',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Operasi Bilangan Bulat',
                        'deskripsi' => 'Uji pemahaman tentang operasi hitung pada bilangan bulat.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Hasil dari 15 + (-8) adalah...',
                                'jawaban' => '7',
                                'pengecoh' => ['-7', '23', '-23'],
                            ],
                            [
                                'pertanyaan' => 'Hasil dari -12 × 5 adalah...',
                                'jawaban' => '-60',
                                'pengecoh' => ['60', '-17', '17'],
                            ],
                            [
                                'pertanyaan' => 'Pada garis bilangan, bilangan bulat negatif terletak di sebelah... angka nol.',
                                'jawaban' => 'Kiri',
                                'pengecoh' => ['Kanan', 'Atas', 'Bawah'],
                            ],
                            [
                                'pertanyaan' => 'Hasil dari 24 ÷ (-6) adalah...',
                                'jawaban' => '-4',
                                'pengecoh' => ['4', '-18', '18'],
                            ],
                            [
                                'pertanyaan' => 'Sifat komutatif pada penjumlahan bilangan bulat ditunjukkan oleh...',
                                'jawaban' => 'a + b = b + a',
                                'pengecoh' => ['a + 0 = a', '(a + b) + c = a + (b + c)', 'a × (b + c) = (a × b) + (a × c)'],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Pecahan',
                    'deskripsi' => 'Memahami konsep pecahan, operasi hitung pecahan, dan penggunaannya dalam kehidupan sehari-hari.',
                    'tingkat' => 'Dasar',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Pecahan',
                        'deskripsi' => 'Uji pemahaman tentang pecahan dan operasinya.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Pecahan 3/4 jika diubah ke bentuk desimal menjadi...',
                                'jawaban' => '0,75',
                                'pengecoh' => ['0,25', '0,50', '0,80'],
                            ],
                            [
                                'pertanyaan' => 'Hasil dari 1/2 + 2/3 adalah...',
                                'jawaban' => '7/6',
                                'pengecoh' => ['3/5', '3/6', '7/5'],
                            ],
                            [
                                'pertanyaan' => 'Bentuk pecahan paling sederhana dari 8/12 adalah...',
                                'jawaban' => '2/3',
                                'pengecoh' => ['4/6', '3/4', '1/2'],
                            ],
                            [
                                'pertanyaan' => 'Pecahan senilai dengan 2/5 adalah...',
                                'jawaban' => '4/10',
                                'pengecoh' => ['3/6', '5/15', '1/3'],
                            ],
                            [
                                'pertanyaan' => '25% jika ditulis dalam bentuk pecahan adalah...',
                                'jawaban' => '1/4',
                                'pengecoh' => ['1/2', '3/4', '2/5'],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Persamaan Linear',
                    'deskripsi' => 'Mempelajari persamaan linear satu variabel dan cara penyelesaiannya dalam matematika.',
                    'tingkat' => 'Menengah',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Persamaan Linear',
                        'deskripsi' => 'Evaluasi pemahaman tentang persamaan linear satu variabel.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Penyelesaian dari persamaan 2x + 5 = 13 adalah...',
                                'jawaban' => 'x = 4',
                                'pengecoh' => ['x = 3', 'x = 5', 'x = 6'],
                            ],
                            [
                                'pertanyaan' => 'Jika 3(x - 2) = 12, maka nilai x adalah...',
                                'jawaban' => '6',
                                'pengecoh' => ['4', '5', '7'],
                            ],
                            [
                                'pertanyaan' => 'Himpunan penyelesaian dari 2x + 3 = x + 7 adalah...',
                                'jawaban' => '{4}',
                                'pengecoh' => ['{3}', '{5}', '{2}'],
                            ],
                            [
                                'pertanyaan' => 'Jika 4x - 8 = 2x + 6, maka nilai x adalah...',
                                'jawaban' => '7',
                                'pengecoh' => ['5', '6', '8'],
                            ],
                            [
                                'pertanyaan' => 'Ciri utama persamaan linear satu variabel adalah...',
                                'jawaban' => 'Pangkat tertinggi variabel adalah 1',
                                'pengecoh' => ['Memiliki dua variabel berbeda', 'Pangkat tertinggi variabel adalah 2', 'Tidak memiliki variabel'],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Bangun Datar',
                    'deskripsi' => 'Mengenal bangun datar, rumus luas dan keliling, serta sifat-sifatnya.',
                    'tingkat' => 'Dasar',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Bangun Datar',
                        'deskripsi' => 'Uji pemahaman tentang bangun datar dan rumus-rumusnya.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Luas persegi panjang dengan panjang 8 cm dan lebar 5 cm adalah...',
                                'jawaban' => '40 cm\u00b2',
                                'pengecoh' => ['13 cm\u00b2', '26 cm\u00b2', '45 cm\u00b2'],
                            ],
                            [
                                'pertanyaan' => 'Rumus luas lingkaran adalah...',
                                'jawaban' => '\u03c0 \u00d7 r\u00b2',
                                'pengecoh' => ['\u03c0 \u00d7 d', '2 \u00d7 \u03c0 \u00d7 r', '\u03c0 \u00d7 r'],
                            ],
                            [
                                'pertanyaan' => 'Keliling segitiga dengan sisi 3 cm, 4 cm, dan 5 cm adalah...',
                                'jawaban' => '12 cm',
                                'pengecoh' => ['7 cm', '15 cm', '10 cm'],
                            ],
                            [
                                'pertanyaan' => 'Bangun datar yang memiliki empat sisi sama panjang dan empat sudut siku-siku adalah...',
                                'jawaban' => 'Persegi',
                                'pengecoh' => ['Persegi panjang', 'Belah ketupat', 'Jajar genjang'],
                            ],
                            [
                                'pertanyaan' => 'Luas segitiga dengan alas 10 cm dan tinggi 6 cm adalah...',
                                'jawaban' => '30 cm\u00b2',
                                'pengecoh' => ['60 cm\u00b2', '16 cm\u00b2', '20 cm\u00b2'],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // BAHASA INDONESIA
            // ================================================================
            'Bahasa Indonesia' => [
                [
                    'judul' => 'Teks Deskripsi',
                    'deskripsi' => 'Mempelajari teks deskripsi, struktur, ciri kebahasaan, dan cara menulis deskripsi yang baik.',
                    'tingkat' => 'Dasar',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Teks Deskripsi',
                        'deskripsi' => 'Uji pemahaman tentang teks deskripsi dalam bahasa Indonesia.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Teks deskripsi adalah teks yang...',
                                'jawaban' => 'Menggambarkan suatu objek secara rinci dan jelas',
                                'pengecoh' => ['Menjelaskan langkah-langkah melakukan sesuatu', 'Menceritakan kejadian berdasarkan urutan waktu', 'Mengungkapkan pendapat tentang suatu isu'],
                            ],
                            [
                                'pertanyaan' => 'Berdasarkan pilihan berikut, yang termasuk contoh teks deskripsi adalah...',
                                'jawaban' => 'Pantai Parangtritis memiliki pasir putih yang lembut dan ombak yang indah',
                                'pengecoh' => ['Pertama, siapkan alat dan bahan yang diperlukan', 'Pada hari Minggu, Andi pergi ke pasar', 'Menurut saya, kebijakan ini perlu dikaji ulang'],
                            ],
                            [
                                'pertanyaan' => 'Kata yang sering digunakan dalam teks deskripsi untuk membuat pembaca seolah melihat, mendengar, atau merasakan adalah...',
                                'jawaban' => 'Kata sifat',
                                'pengecoh' => ['Kata kerja', 'Kata bilangan', 'Kata tanya'],
                            ],
                            [
                                'pertanyaan' => 'Struktur teks deskripsi terdiri dari...',
                                'jawaban' => 'Identifikasi dan deskripsi',
                                'pengecoh' => ['Orientasi, komplikasi, resolusi', 'Pernyataan umum, urutan sebab-akibat', 'Tesis, argumen, kesimpulan'],
                            ],
                            [
                                'pertanyaan' => 'Berikut ini yang termasuk kalimat deskripsi adalah...',
                                'jawaban' => 'Wajahnya bulat dengan kulit sawo matang dan senyum yang ramah',
                                'pengecoh' => ['Belilah produk ini sekarang juga', 'Jika kamu rajin, kamu akan sukses', 'Siapa nama guru matematika kalian'],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Teks Prosedur',
                    'deskripsi' => 'Mempelajari teks prosedur, ciri kebahasaan, struktur, dan cara menyusun langkah-langkah yang runtut.',
                    'tingkat' => 'Menengah',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Teks Prosedur',
                        'deskripsi' => 'Evaluasi pemahaman tentang teks prosedur dalam bahasa Indonesia.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Tujuan teks prosedur adalah...',
                                'jawaban' => 'Memberikan petunjuk cara melakukan sesuatu secara bertahap',
                                'pengecoh' => ['Menceritakan pengalaman pribadi', 'Membujuk pembaca untuk melakukan sesuatu', 'Mendeskripsikan suatu objek'],
                            ],
                            [
                                'pertanyaan' => 'Ciri kebahasaan teks prosedur adalah banyak menggunakan...',
                                'jawaban' => 'Kata perintah (imperatif)',
                                'pengecoh' => ['Kata tanya', 'Kata seru', 'Kata ganti orang pertama'],
                            ],
                            [
                                'pertanyaan' => 'Berdasarkan pilihan berikut, yang termasuk contoh teks prosedur adalah...',
                                'jawaban' => 'Cara membuat nasi goreng',
                                'pengecoh' => ['Liburan ke Bali', 'Pentingnya pendidikan', 'Deskripsi tentang kucing'],
                            ],
                            [
                                'pertanyaan' => 'Struktur teks prosedur terdiri dari...',
                                'jawaban' => 'Tujuan, alat/bahan, langkah-langkah',
                                'pengecoh' => ['Pembuka, isi, penutup', 'Tesis, argumen, kesimpulan', 'Abstrak, orientasi, koda'],
                            ],
                            [
                                'pertanyaan' => '"Aduk adonan hingga merata!" Kalimat tersebut termasuk jenis kalimat...',
                                'jawaban' => 'Imperatif',
                                'pengecoh' => ['Deklaratif', 'Interogatif', 'Eksklamatif'],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Kalimat Efektif',
                    'deskripsi' => 'Memahami prinsip kalimat efektif: kesepadanan, kehematan, kesejajaran, dan ketepatan dalam penulisan.',
                    'tingkat' => 'Menengah',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Kalimat Efektif',
                        'deskripsi' => 'Uji pemahaman tentang kalimat efektif dalam bahasa Indonesia.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Kalimat efektif adalah kalimat yang...',
                                'jawaban' => 'Jelas, ringkas, dan mudah dipahami',
                                'pengecoh' => ['Panjang dan menggunakan banyak kata', 'Mengandung kata-kata ilmiah', 'Hanya terdiri dari satu kata'],
                            ],
                            [
                                'pertanyaan' => '"Para siswa-siswa sedang belajar di kelas." Perbaikan kalimat tersebut agar efektif adalah...',
                                'jawaban' => 'Para siswa sedang belajar di kelas',
                                'pengecoh' => ['Para siswa-siswa sedang belajar', 'Siswa-siswa sedang belajar di kelas', 'Para siswa-siswa belajar sedang di kelas'],
                            ],
                            [
                                'pertanyaan' => 'Kalimat "Buku itu dibaca oleh Andi" termasuk kalimat...',
                                'jawaban' => 'Pasif',
                                'pengecoh' => ['Aktif', 'Tanya', 'Perintah'],
                            ],
                            [
                                'pertanyaan' => '"Karena dia sakit, maka ia tidak masuk sekolah." Kalimat tersebut tidak efektif karena...',
                                'jawaban' => 'Penggunaan kata "karena" dan "maka" secara berlebihan',
                                'pengecoh' => ['Tidak memiliki subjek', 'Tidak memiliki predikat', 'Terlalu pendek'],
                            ],
                            [
                                'pertanyaan' => 'Prinsip yang harus diperhatikan dalam kalimat efektif adalah...',
                                'jawaban' => 'Kehematan, kesepadanan, dan kesejajaran',
                                'pengecoh' => ['Panjang, rumit, dan detail', 'Banyak kata sifat', 'Menggunakan istilah asing'],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // BAHASA INGGRIS
            // ================================================================
            'Bahasa Inggris' => [
                [
                    'judul' => 'Greetings',
                    'deskripsi' => 'Mempelajari ungkapan sapaan dan perpisahan dalam bahasa Inggris untuk komunikasi sehari-hari.',
                    'tingkat' => 'Dasar',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Greetings',
                        'deskripsi' => 'Uji pemahaman tentang ungkapan sapaan dalam bahasa Inggris.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => '"Good morning" biasanya diucapkan pada waktu...',
                                'jawaban' => 'Pagi hari',
                                'pengecoh' => ['Siang hari', 'Sore hari', 'Malam hari'],
                            ],
                            [
                                'pertanyaan' => 'Respon yang tepat untuk "How are you?" adalah...',
                                'jawaban' => 'I\'m fine, thank you',
                                'pengecoh' => ['Goodbye', 'Nice to meet you', 'See you later'],
                            ],
                            [
                                'pertanyaan' => '"Good evening" diucapkan pada waktu...',
                                'jawaban' => 'Sore/malam hari',
                                'pengecoh' => ['Pagi hari', 'Siang hari', 'Tengah malam'],
                            ],
                            [
                                'pertanyaan' => 'Ungkapan perpisahan yang benar adalah...',
                                'jawaban' => 'See you later',
                                'pengecoh' => ['How do you do?', 'What is your name?', 'Where are you from?'],
                            ],
                            [
                                'pertanyaan' => '"Nice to meet you" diucapkan ketika...',
                                'jawaban' => 'Bertemu seseorang untuk pertama kali',
                                'pengecoh' => ['Akan pergi meninggalkan seseorang', 'Seseorang sedang sakit', 'Seseorang berulang tahun'],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Simple Present Tense',
                    'deskripsi' => 'Memahami penggunaan Simple Present Tense untuk menyatakan kebiasaan, fakta umum, dan jadwal.',
                    'tingkat' => 'Menengah',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Simple Present Tense',
                        'deskripsi' => 'Evaluasi pemahaman tentang Simple Present Tense dalam bahasa Inggris.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Simple Present Tense digunakan untuk menyatakan...',
                                'jawaban' => 'Kebiasaan atau fakta umum',
                                'pengecoh' => ['Kejadian yang sedang berlangsung', 'Kejadian yang sudah selesai', 'Rencana di masa depan'],
                            ],
                            [
                                'pertanyaan' => 'She ___ to school every day.',
                                'jawaban' => 'goes',
                                'pengecoh' => ['go', 'going', 'went'],
                            ],
                            [
                                'pertanyaan' => 'They ___ not like spicy food.',
                                'jawaban' => 'do',
                                'pengecoh' => ['does', 'are', 'is'],
                            ],
                            [
                                'pertanyaan' => 'My father ___ a teacher.',
                                'jawaban' => 'is',
                                'pengecoh' => ['are', 'am', 'be'],
                            ],
                            [
                                'pertanyaan' => 'Bentuk negatif dari "He reads a book" adalah...',
                                'jawaban' => 'He does not read a book',
                                'pengecoh' => ['He is not read a book', 'He do not read a book', 'He not reads a book'],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Descriptive Text',
                    'deskripsi' => 'Mempelajari descriptive text, struktur identification dan description, serta kata sifat yang digunakan.',
                    'tingkat' => 'Menengah',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Descriptive Text',
                        'deskripsi' => 'Uji pemahaman tentang descriptive text dalam bahasa Inggris.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Tujuan dari descriptive text adalah...',
                                'jawaban' => 'Menggambarkan suatu orang, tempat, atau benda secara detail',
                                'pengecoh' => ['Menceritakan suatu peristiwa', 'Memberikan petunjuk melakukan sesuatu', 'Membujuk pembaca melakukan sesuatu'],
                            ],
                            [
                                'pertanyaan' => 'Struktur descriptive text terdiri dari...',
                                'jawaban' => 'Identification dan description',
                                'pengecoh' => ['Orientation, events, reorientation', 'Goal, materials, steps', 'Thesis, arguments, conclusion'],
                            ],
                            [
                                'pertanyaan' => '"My cat has soft white fur and bright green eyes." Kalimat tersebut termasuk bagian...',
                                'jawaban' => 'Description',
                                'pengecoh' => ['Identification', 'Orientation', 'Resolution'],
                            ],
                            [
                                'pertanyaan' => 'Berdasarkan pilihan berikut, yang termasuk kata sifat (adjective) adalah...',
                                'jawaban' => 'Beautiful',
                                'pengecoh' => ['Run', 'Quickly', 'And'],
                            ],
                            [
                                'pertanyaan' => '"Borobudur is a magnificent Buddhist temple." Kata "magnificent" berarti...',
                                'jawaban' => 'Megah',
                                'pengecoh' => ['Kecil', 'Tua', 'Baru'],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // IPA
            // ================================================================
            'IPA' => [
                [
                    'judul' => 'Sistem Tata Surya',
                    'deskripsi' => 'Mempelajari susunan tata surya, planet-planet, dan karakteristiknya dalam sistem galaksi Bima Sakti.',
                    'tingkat' => 'Dasar',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Sistem Tata Surya',
                        'deskripsi' => 'Uji pemahaman tentang sistem tata surya dan planet-planet.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Planet terdekat dengan Matahari adalah...',
                                'jawaban' => 'Merkurius',
                                'pengecoh' => ['Venus', 'Bumi', 'Mars'],
                            ],
                            [
                                'pertanyaan' => 'Planet terbesar dalam tata surya adalah...',
                                'jawaban' => 'Jupiter',
                                'pengecoh' => ['Saturnus', 'Neptunus', 'Uranus'],
                            ],
                            [
                                'pertanyaan' => 'Bumi melakukan revolusi mengelilingi Matahari selama...',
                                'jawaban' => '365 hari',
                                'pengecoh' => ['24 jam', '30 hari', '7 hari'],
                            ],
                            [
                                'pertanyaan' => 'Satelit alami Bumi adalah...',
                                'jawaban' => 'Bulan',
                                'pengecoh' => ['Mars', 'Matahari', 'Bintang'],
                            ],
                            [
                                'pertanyaan' => 'Planet yang dikenal sebagai "bintang fajar" atau "bintang senja" adalah...',
                                'jawaban' => 'Venus',
                                'pengecoh' => ['Merkurius', 'Jupiter', 'Saturnus'],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Fotosintesis',
                    'deskripsi' => 'Memahami proses fotosintesis pada tumbuhan, peran klorofil, dan hasil yang dihasilkan.',
                    'tingkat' => 'Menengah',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Fotosintesis',
                        'deskripsi' => 'Evaluasi pemahaman tentang proses fotosintesis pada tumbuhan.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Fotosintesis adalah proses pembuatan makanan pada tumbuhan yang memerlukan...',
                                'jawaban' => 'Cahaya matahari, air, dan karbon dioksida',
                                'pengecoh' => ['Air, tanah, dan oksigen', 'Cahaya matahari, tanah, dan nitrogen', 'Air, gula, dan klorofil'],
                            ],
                            [
                                'pertanyaan' => 'Fungsi klorofil dalam fotosintesis adalah...',
                                'jawaban' => 'Menyerap energi cahaya matahari',
                                'pengecoh' => ['Menyerap air dari tanah', 'Menghasilkan karbon dioksida', 'Menyimpan cadangan makanan'],
                            ],
                            [
                                'pertanyaan' => 'Fotosintesis terjadi di bagian tumbuhan yang disebut...',
                                'jawaban' => 'Daun',
                                'pengecoh' => ['Akar', 'Batang', 'Bunga'],
                            ],
                            [
                                'pertanyaan' => 'Hasil utama dari fotosintesis adalah...',
                                'jawaban' => 'Glukosa dan oksigen',
                                'pengecoh' => ['Air dan karbon dioksida', 'Protein dan lemak', 'Vitamin dan mineral'],
                            ],
                            [
                                'pertanyaan' => 'Gas yang diserap tumbuhan selama fotosintesis adalah...',
                                'jawaban' => 'Karbon dioksida',
                                'pengecoh' => ['Oksigen', 'Nitrogen', 'Hidrogen'],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Gaya dan Gerak',
                    'deskripsi' => 'Mempelajari konsep gaya, hukum Newton, dan pengaruh gaya terhadap gerak benda.',
                    'tingkat' => 'Menengah',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Gaya dan Gerak',
                        'deskripsi' => 'Uji pemahaman tentang konsep gaya dan gerak dalam fisika.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Gaya adalah...',
                                'jawaban' => 'Tarikan atau dorongan yang dapat menyebabkan benda bergerak atau berubah bentuk',
                                'pengecoh' => ['Ukuran seberapa cepat benda bergerak', 'Massa suatu benda', 'Jarak yang ditempuh benda'],
                            ],
                            [
                                'pertanyaan' => 'Hukum Newton I menyatakan bahwa benda akan mempertahankan keadaan diam atau gerak lurus beraturan jika...',
                                'jawaban' => 'Tidak ada gaya yang bekerja padanya',
                                'pengecoh' => ['Gaya yang bekerja besar', 'Benda dalam keadaan diam', 'Benda bergerak cepat'],
                            ],
                            [
                                'pertanyaan' => 'Gaya gesek memiliki sifat...',
                                'jawaban' => 'Menghambat gerakan benda',
                                'pengecoh' => ['Mempercepat gerakan benda', 'Mengubah massa benda', 'Menghilangkan gravitasi'],
                            ],
                            [
                                'pertanyaan' => 'Rumus gaya menurut Hukum Newton II adalah...',
                                'jawaban' => 'F = m \u00d7 a',
                                'pengecoh' => ['F = m / a', 'F = a / m', 'F = m + a'],
                            ],
                            [
                                'pertanyaan' => 'Benda yang jatuh ke bawah karena pengaruh...',
                                'jawaban' => 'Gaya gravitasi',
                                'pengecoh' => ['Gaya gesek', 'Gaya pegas', 'Gaya magnet'],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Organ Pernapasan',
                    'deskripsi' => 'Mengenal organ-organ pernapasan pada manusia dan fungsinya dalam proses respirasi.',
                    'tingkat' => 'Dasar',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Organ Pernapasan',
                        'deskripsi' => 'Uji pemahaman tentang sistem pernapasan pada manusia.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Organ pernapasan pada manusia yang berfungsi sebagai tempat pertukaran gas adalah...',
                                'jawaban' => 'Alveolus',
                                'pengecoh' => ['Bronkus', 'Trakea', 'Laring'],
                            ],
                            [
                                'pertanyaan' => 'Proses menghirup udara disebut...',
                                'jawaban' => 'Inspirasi',
                                'pengecoh' => ['Ekspirasi', 'Respirasi', 'Transpirasi'],
                            ],
                            [
                                'pertanyaan' => 'Udara masuk ke tubuh melalui...',
                                'jawaban' => 'Hidung',
                                'pengecoh' => ['Mulut', 'Telinga', 'Mata'],
                            ],
                            [
                                'pertanyaan' => 'Diafragma berperan dalam pernapasan dengan cara...',
                                'jawaban' => 'Mengatur volume rongga dada',
                                'pengecoh' => ['Menyaring udara kotor', 'Menghangatkan udara', 'Memproduksi lendir'],
                            ],
                            [
                                'pertanyaan' => 'Organ yang menghubungkan rongga mulut dengan paru-paru adalah...',
                                'jawaban' => 'Trakea',
                                'pengecoh' => ['Esofagus', 'Lambung', 'Hati'],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // IPS
            // ================================================================
            'IPS' => [
                [
                    'judul' => 'Kerajaan Hindu-Buddha',
                    'deskripsi' => 'Mempelajari kerajaan-kerajaan Hindu-Buddha di Indonesia, peninggalan, dan pengaruhnya terhadap kebudayaan.',
                    'tingkat' => 'Menengah',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Kerajaan Hindu-Buddha',
                        'deskripsi' => 'Evaluasi pemahaman tentang kerajaan Hindu-Buddha di Indonesia.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Kerajaan Hindu tertua di Indonesia adalah...',
                                'jawaban' => 'Kutai',
                                'pengecoh' => ['Sriwijaya', 'Majapahit', 'Mataram Kuno'],
                            ],
                            [
                                'pertanyaan' => 'Candi Borobudur merupakan peninggalan kerajaan...',
                                'jawaban' => 'Mataram Kuno',
                                'pengecoh' => ['Majapahit', 'Sriwijaya', 'Kutai'],
                            ],
                            [
                                'pertanyaan' => 'Kerajaan Sriwijaya mencapai puncak kejayaan di daerah...',
                                'jawaban' => 'Palembang',
                                'pengecoh' => ['Jawa Tengah', 'Kalimantan Timur', 'Sulawesi Selatan'],
                            ],
                            [
                                'pertanyaan' => 'Prasasti Yupa ditemukan di Kerajaan Kutai dan ditulis menggunakan huruf...',
                                'jawaban' => 'Pallawa',
                                'pengecoh' => ['Jawa Kuno', 'Arab', 'Latin'],
                            ],
                            [
                                'pertanyaan' => 'Raja terkenal dari Kerajaan Majapahit adalah...',
                                'jawaban' => 'Hayam Wuruk',
                                'pengecoh' => ['Purnawarman', 'Mulawarman', 'Balaputradewa'],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Interaksi Sosial',
                    'deskripsi' => 'Memahami pengertian interaksi sosial, syarat, dan bentuk-bentuk interaksi dalam kehidupan masyarakat.',
                    'tingkat' => 'Dasar',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Interaksi Sosial',
                        'deskripsi' => 'Uji pemahaman tentang interaksi sosial dalam masyarakat.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Interaksi sosial adalah...',
                                'jawaban' => 'Hubungan timbal balik antara individu atau kelompok',
                                'pengecoh' => ['Kegiatan ekonomi masyarakat', 'Proses belajar di sekolah', 'Komunikasi melalui media sosial'],
                            ],
                            [
                                'pertanyaan' => 'Syarat terjadinya interaksi sosial adalah...',
                                'jawaban' => 'Kontak sosial dan komunikasi',
                                'pengecoh' => ['Kesamaan usia dan jenis kelamin', 'Tempat yang sama dan waktu bersamaan', 'Pendidikan dan pekerjaan'],
                            ],
                            [
                                'pertanyaan' => 'Akomodasi adalah bentuk interaksi sosial yang bertujuan...',
                                'jawaban' => 'Menyelesaikan pertentangan atau konflik',
                                'pengecoh' => ['Meningkatkan persaingan', 'Menghindari kontak sosial', 'Memperkuat perbedaan'],
                            ],
                            [
                                'pertanyaan' => 'Contoh interaksi sosial asosiatif adalah...',
                                'jawaban' => 'Kerjasama antar anggota kelompok',
                                'pengecoh' => ['Pertandingan sepak bola antar sekolah', 'Demonstrasi menuntut hak', 'Perdebatan dalam diskusi'],
                            ],
                            [
                                'pertanyaan' => 'Kontak sosial primer terjadi secara...',
                                'jawaban' => 'Langsung bertatap muka',
                                'pengecoh' => ['Melalui telepon', 'Lewat surat elektronik', 'Menggunakan media sosial'],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Kegiatan Ekonomi',
                    'deskripsi' => 'Mempelajari kegiatan produksi, distribusi, dan konsumsi serta peran pelaku ekonomi dalam masyarakat.',
                    'tingkat' => 'Menengah',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Kegiatan Ekonomi',
                        'deskripsi' => 'Evaluasi pemahaman tentang kegiatan ekonomi dan pelakunya.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Kegiatan ekonomi terdiri dari...',
                                'jawaban' => 'Produksi, distribusi, dan konsumsi',
                                'pengecoh' => ['Jual, beli, dan sewa', 'Impor, ekspor, dan transit', 'Tabungan, investasi, dan kredit'],
                            ],
                            [
                                'pertanyaan' => 'Kegiatan menghasilkan barang atau jasa disebut...',
                                'jawaban' => 'Produksi',
                                'pengecoh' => ['Distribusi', 'Konsumsi', 'Retribusi'],
                            ],
                            [
                                'pertanyaan' => 'Orang atau perusahaan yang menyalurkan barang dari produsen ke konsumen disebut...',
                                'jawaban' => 'Distributor',
                                'pengecoh' => ['Konsumen', 'Produsen', 'Kreator'],
                            ],
                            [
                                'pertanyaan' => 'Contoh kegiatan konsumsi adalah...',
                                'jawaban' => 'Membeli nasi di warung',
                                'pengecoh' => ['Membuat kerajinan tangan', 'Mengangkut sayuran ke pasar', 'Menanam padi di sawah'],
                            ],
                            [
                                'pertanyaan' => 'Motif ekonomi yang mendorong seseorang melakukan kegiatan ekonomi adalah...',
                                'jawaban' => 'Kebutuhan dan keinginan',
                                'pengecoh' => ['Kewajiban sosial', 'Tekanan pemerintah', 'Ajaran agama'],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // PENDIDIKAN PANCASILA
            // ================================================================
            'Pendidikan Pancasila' => [
                [
                    'judul' => 'Nilai-Nilai Pancasila',
                    'deskripsi' => 'Mempelajari Pancasila sebagai dasar negara, nilai-nilai setiap sila, dan pengamalannya dalam kehidupan.',
                    'tingkat' => 'Dasar',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Nilai-Nilai Pancasila',
                        'deskripsi' => 'Uji pemahaman tentang Pancasila dan nilai-nilainya.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Pancasila sebagai dasar negara Indonesia terdiri dari... sila.',
                                'jawaban' => '5',
                                'pengecoh' => ['3', '4', '6'],
                            ],
                            [
                                'pertanyaan' => 'Sila pertama Pancasila berbunyi...',
                                'jawaban' => 'Ketuhanan Yang Maha Esa',
                                'pengecoh' => ['Kemanusiaan yang Adil dan Beradab', 'Persatuan Indonesia', 'Keadilan Sosial bagi Seluruh Rakyat Indonesia'],
                            ],
                            [
                                'pertanyaan' => 'Lambang sila ke-2 Pancasila adalah...',
                                'jawaban' => 'Rantai',
                                'pengecoh' => ['Bintang', 'Pohon beringin', 'Padi dan kapas'],
                            ],
                            [
                                'pertanyaan' => 'Nilai yang terkandung dalam sila "Persatuan Indonesia" adalah...',
                                'jawaban' => 'Cinta tanah air dan bangsa',
                                'pengecoh' => ['Percaya kepada Tuhan', 'Menghormati hak asasi manusia', 'Musyawarah dalam mengambil keputusan'],
                            ],
                            [
                                'pertanyaan' => 'Pengamalan sila ke-4 Pancasila dalam kehidupan sehari-hari adalah...',
                                'jawaban' => 'Bermusyawarah untuk mencapai mufakat',
                                'pengecoh' => ['Beribadah sesuai agama masing-masing', 'Membela kebenaran dan keadilan', 'Menjaga kerukunan antar suku'],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Hak dan Kewajiban',
                    'deskripsi' => 'Memahami pengertian hak dan kewajiban, keseimbangan keduanya, serta contoh dalam kehidupan sehari-hari.',
                    'tingkat' => 'Dasar',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Hak dan Kewajiban',
                        'deskripsi' => 'Uji pemahaman tentang hak dan kewajiban warga negara.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Hak adalah...',
                                'jawaban' => 'Sesuatu yang harus diterima atau dimiliki',
                                'pengecoh' => ['Sesuatu yang harus dilaksanakan', 'Aturan yang harus dipatuhi', 'Larangan yang harus dihindari'],
                            ],
                            [
                                'pertanyaan' => 'Contoh kewajiban siswa di sekolah adalah...',
                                'jawaban' => 'Mengerjakan tugas yang diberikan guru',
                                'pengecoh' => ['Mendapatkan nilai yang baik', 'Menggunakan fasilitas sekolah', 'Mendapatkan buku pelajaran'],
                            ],
                            [
                                'pertanyaan' => 'Setiap warga negara berhak mendapatkan...',
                                'jawaban' => 'Pendidikan yang layak',
                                'pengecoh' => ['Hukuman yang setimpal', 'Pekerjaan tanpa syarat', 'Kekuasaan yang tidak terbatas'],
                            ],
                            [
                                'pertanyaan' => 'Kewajiban warga negara terhadap negara antara lain...',
                                'jawaban' => 'Membayar pajak tepat waktu',
                                'pengecoh' => ['Menerima bantuan sosial', 'Memilih pemimpin daerah', 'Menggunakan fasilitas umum'],
                            ],
                            [
                                'pertanyaan' => 'Hubungan antara hak dan kewajiban bersifat...',
                                'jawaban' => 'Seimbang dan saling melengkapi',
                                'pengecoh' => ['Hak lebih penting dari kewajiban', 'Kewajiban lebih penting dari hak', 'Tidak ada hubungan sama sekali'],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // INFORMATIKA
            // ================================================================
            'Informatika' => [
                [
                    'judul' => 'Algoritma Dasar',
                    'deskripsi' => 'Mempelajari konsep algoritma, struktur dasarnya, dan representasi algoritma menggunakan flowchart.',
                    'tingkat' => 'Menengah',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Algoritma Dasar',
                        'deskripsi' => 'Uji pemahaman tentang konsep dasar algoritma.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Algoritma adalah...',
                                'jawaban' => 'Langkah-langkah terstruktur untuk menyelesaikan masalah',
                                'pengecoh' => ['Bahasa pemrograman komputer', 'Perangkat keras untuk komputasi', 'Aplikasi pengolah data'],
                            ],
                            [
                                'pertanyaan' => 'Struktur dasar algoritma terdiri dari...',
                                'jawaban' => 'Urutan, percabangan, dan perulangan',
                                'pengecoh' => ['Input, proses, output', 'Variabel, konstanta, dan tipe data', 'Deklarasi, inisialisasi, dan terminasi'],
                            ],
                            [
                                'pertanyaan' => 'Simbol yang digunakan untuk memulai dan mengakhiri flowchart adalah...',
                                'jawaban' => 'Oval',
                                'pengecoh' => ['Persegi panjang', 'Belah ketupat', 'Jajar genjang'],
                            ],
                            [
                                'pertanyaan' => 'Percabangan dalam algoritma digunakan untuk...',
                                'jawaban' => 'Mengambil keputusan berdasarkan kondisi tertentu',
                                'pengecoh' => ['Mengulang langkah beberapa kali', 'Menyimpan data sementara', 'Menampilkan hasil ke pengguna'],
                            ],
                            [
                                'pertanyaan' => 'Pseudocode adalah...',
                                'jawaban' => 'Deskripsi algoritma menggunakan bahasa manusia yang mirip kode',
                                'pengecoh' => ['Kode program yang siap dijalankan', 'Diagram alir proses', 'Bahasa pemrograman tingkat rendah'],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Internet dan Keamanan Digital',
                    'deskripsi' => 'Mempelajari konsep internet, cara kerja jaringan, dan praktik keamanan digital untuk melindungi data.',
                    'tingkat' => 'Menengah',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Internet dan Keamanan Digital',
                        'deskripsi' => 'Evaluasi pemahaman tentang internet dan keamanan digital.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Internet adalah...',
                                'jawaban' => 'Jaringan komputer global yang saling terhubung',
                                'pengecoh' => ['Aplikasi untuk mengirim pesan', 'Perangkat keras untuk browsing', 'Program pengolah data'],
                            ],
                            [
                                'pertanyaan' => 'Berdasarkan pilihan berikut, yang merupakan contoh browser adalah...',
                                'jawaban' => 'Google Chrome',
                                'pengecoh' => ['Microsoft Word', 'Adobe Photoshop', 'Windows Explorer'],
                            ],
                            [
                                'pertanyaan' => 'Tujuan utama keamanan digital adalah...',
                                'jawaban' => 'Melindungi data dan privasi pengguna',
                                'pengecoh' => ['Mempercepat koneksi internet', 'Menambah kapasitas penyimpanan', 'Menyediakan konten hiburan'],
                            ],
                            [
                                'pertanyaan' => 'Tindakan yang termasuk menjaga keamanan digital adalah...',
                                'jawaban' => 'Membuat password yang kuat dan unik',
                                'pengecoh' => ['Membagikan password ke teman', 'Mengunduh file dari sumber tidak dikenal', 'Menggunakan jaringan WiFi publik tanpa VPN'],
                            ],
                            [
                                'pertanyaan' => 'Phishing adalah...',
                                'jawaban' => 'Upaya penipuan untuk mendapatkan informasi sensitif pengguna',
                                'pengecoh' => ['Virus yang merusak sistem komputer', 'Teknik mempercepat koneksi internet', 'Aplikasi untuk mengamankan data'],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // SENI BUDAYA
            // ================================================================
            'Seni Budaya' => [
                [
                    'judul' => 'Seni Rupa',
                    'deskripsi' => 'Mengenal seni rupa, unsur-unsurnya, jenis karya seni rupa dua dan tiga dimensi, serta teknik berkarya.',
                    'tingkat' => 'Dasar',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Seni Rupa',
                        'deskripsi' => 'Uji pemahaman tentang seni rupa dan unsur-unsurnya.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Seni rupa adalah cabang seni yang menghasilkan karya dengan bentuk...',
                                'jawaban' => 'Visual yang dapat dilihat dan diraba',
                                'pengecoh' => ['Suara yang dapat didengar', 'Gerakan tubuh', 'Kata-kata yang indah'],
                            ],
                            [
                                'pertanyaan' => 'Berdasarkan pilihan berikut, yang termasuk contoh seni rupa dua dimensi adalah...',
                                'jawaban' => 'Lukisan',
                                'pengecoh' => ['Patung', 'Keramik', 'Kursi ukir'],
                            ],
                            [
                                'pertanyaan' => 'Warna primer terdiri dari...',
                                'jawaban' => 'Merah, kuning, biru',
                                'pengecoh' => ['Hijau, ungu, oranye', 'Putih, hitam, abu-abu', 'Merah, putih, biru'],
                            ],
                            [
                                'pertanyaan' => 'Teknik melukis dengan menggunakan cat air di atas kertas disebut...',
                                'jawaban' => 'Aquarel',
                                'pengecoh' => ['Akrilik', 'Pastel', 'Mozaik'],
                            ],
                            [
                                'pertanyaan' => 'Unsur seni rupa yang paling dasar adalah...',
                                'jawaban' => 'Titik',
                                'pengecoh' => ['Garis', 'Bidang', 'Warna'],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // PJOK
            // ================================================================
            'PJOK' => [
                [
                    'judul' => 'Permainan Bola Besar',
                    'deskripsi' => 'Mempelajari permainan bola besar seperti sepak bola, bola basket, dan bola voli beserta aturan dasarnya.',
                    'tingkat' => 'Dasar',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Permainan Bola Besar',
                        'deskripsi' => 'Uji pemahaman tentang permainan bola besar dalam olahraga.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Berdasarkan pilihan berikut, yang termasuk permainan bola besar adalah...',
                                'jawaban' => 'Sepak bola',
                                'pengecoh' => ['Bulu tangkis', 'Tenis meja', 'Golf'],
                            ],
                            [
                                'pertanyaan' => 'Jumlah pemain dalam satu tim sepak bola adalah...',
                                'jawaban' => '11 orang',
                                'pengecoh' => ['5 orang', '7 orang', '9 orang'],
                            ],
                            [
                                'pertanyaan' => 'Dalam permainan bola basket, memasukkan bola ke ring lawan disebut...',
                                'jawaban' => 'Shooting',
                                'pengecoh' => ['Dribbling', 'Passing', 'Rebound'],
                            ],
                            [
                                'pertanyaan' => 'Induk organisasi sepak bola internasional adalah...',
                                'jawaban' => 'FIFA',
                                'pengecoh' => ['FIBA', 'PSSI', 'IAAF'],
                            ],
                            [
                                'pertanyaan' => 'Pukulan pertama untuk memulai permainan bola voli disebut...',
                                'jawaban' => 'Servis',
                                'pengecoh' => ['Smash', 'Block', 'Dribbling'],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // AGAMA
            // ================================================================
            'Agama' => [
                [
                    'judul' => 'Nilai-Nilai Kejujuran',
                    'deskripsi' => 'Mempelajari nilai kejujuran sebagai akhlak mulia, manfaatnya, dan penerapannya dalam kehidupan sehari-hari.',
                    'tingkat' => 'Dasar',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Nilai-Nilai Kejujuran',
                        'deskripsi' => 'Uji pemahaman tentang nilai kejujuran dalam ajaran agama.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Jujur secara bahasa berarti...',
                                'jawaban' => 'Berkata sesuai dengan kenyataan',
                                'pengecoh' => ['Berkata dengan suara keras', 'Berbicara dengan sopan', 'Menyembunyikan kesalahan'],
                            ],
                            [
                                'pertanyaan' => 'Manfaat berperilaku jujur dalam kehidupan sehari-hari adalah...',
                                'jawaban' => 'Mendapatkan kepercayaan dari orang lain',
                                'pengecoh' => ['Dihindari oleh teman-teman', 'Mendapatkan keuntungan materi', 'Bebas melakukan kesalahan'],
                            ],
                            [
                                'pertanyaan' => 'Berdasarkan pilihan berikut, yang termasuk contoh perilaku jujur adalah...',
                                'jawaban' => 'Mengembalikan uang kembalian yang lebih',
                                'pengecoh' => ['Menyontek saat ulangan', 'Menutupi kesalahan sendiri', 'Berkata bohong kepada orang tua'],
                            ],
                            [
                                'pertanyaan' => 'Lawan dari sifat jujur adalah...',
                                'jawaban' => 'Bohong atau dusta',
                                'pengecoh' => ['Malas', 'Sombong', 'Kikir'],
                            ],
                            [
                                'pertanyaan' => 'Dalam ajaran agama, orang yang jujur termasuk golongan orang yang...',
                                'jawaban' => 'Beriman dan saleh',
                                'pengecoh' => ['Kaya raya', 'Berkuasa', 'Terkenal'],
                            ],
                        ],
                    ]],
                ],
            ],
        ];
    }
}
