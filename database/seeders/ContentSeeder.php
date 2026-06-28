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
                'jawaban' => $soalData['jawaban'] . ' (v)',
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
            // BASIS DATA
            // ================================================================
            'Basis Data' => [
                [
                    'judul' => 'Pengenalan Basis Data',
                    'deskripsi' => 'Mempelajari konsep dasar basis data, DBMS, serta komponen dan keuntungan penggunaannya.',
                    'tingkat' => 'Dasar',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Pengenalan Basis Data',
                        'deskripsi' => 'Uji pemahaman tentang konsep dasar basis data.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Apa yang dimaksud dengan basis data?',
                                'jawaban' => 'Kumpulan data terorganisir yang disimpan secara elektronik',
                                'pengecoh' => [
                                    'Aplikasi untuk mengedit dokumen teks',
                                    'Sistem operasi yang digunakan pada komputer',
                                    'Perangkat keras untuk menyimpan file digital',
                                ],
                            ],
                            [
                                'pertanyaan' => 'DBMS merupakan singkatan dari...',
                                'jawaban' => 'Database Management System',
                                'pengecoh' => [
                                    'Data Backup Management System',
                                    'Digital Base Management System',
                                    'Database Maintenance Service',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Berikut ini yang termasuk contoh DBMS adalah...',
                                'jawaban' => 'MySQL',
                                'pengecoh' => [
                                    'Microsoft Word',
                                    'Adobe Photoshop',
                                    'Google Chrome',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Keuntungan utama penggunaan basis data dibandingkan penyimpanan file biasa adalah...',
                                'jawaban' => 'Mengurangi redundansi dan inkonsistensi data',
                                'pengecoh' => [
                                    'Memperlambat akses data',
                                    'Data mudah hilang saat listrik padam',
                                    'Kapasitas penyimpanan menjadi terbatas',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Komponen utama dalam sistem basis data meliputi...',
                                'jawaban' => 'Data, perangkat lunak DBMS, perangkat keras, dan pengguna',
                                'pengecoh' => [
                                    'Hanya data dan perangkat keras saja',
                                    'Browser, server, dan koneksi internet',
                                    'Program aplikasi, sistem operasi, dan driver',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Entity Relationship Diagram',
                    'deskripsi' => 'Memahami konsep ERD sebagai alat pemodelan data konseptual dalam perancangan basis data.',
                    'tingkat' => 'Dasar',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Entity Relationship Diagram',
                        'deskripsi' => 'Evaluasi pemahaman tentang ERD dan komponennya.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'ERD merupakan singkatan dari...',
                                'jawaban' => 'Entity Relationship Diagram',
                                'pengecoh' => [
                                    'Electronic Resource Database',
                                    'Entity Resolution Diagram',
                                    'Extended Relational Data',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Dalam ERD, simbol persegi panjang digunakan untuk menggambarkan...',
                                'jawaban' => 'Entitas',
                                'pengecoh' => [
                                    'Atribut',
                                    'Relasi',
                                    'Primary key',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Relasi one-to-many pada ERD berarti...',
                                'jawaban' => 'Satu entitas berhubungan dengan banyak entitas lain',
                                'pengecoh' => [
                                    'Banyak entitas berhubungan dengan satu entitas lain',
                                    'Satu entitas hanya berhubungan dengan satu entitas lain',
                                    'Entitas tidak memiliki hubungan dengan entitas lain',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Simbol belah ketupat dalam ERD digunakan untuk merepresentasikan...',
                                'jawaban' => 'Relasi antar entitas',
                                'pengecoh' => [
                                    'Atribut kunci',
                                    'Entitas lemah',
                                    'Kardinalitas',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Atribut yang berfungsi sebagai identitas unik untuk setiap instance entitas disebut...',
                                'jawaban' => 'Primary key',
                                'pengecoh' => [
                                    'Foreign key',
                                    'Composite key',
                                    'Candidate key',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Primary Key dan Foreign Key',
                    'deskripsi' => 'Memahami konsep primary key, foreign key, serta perannya dalam menjaga integritas data relasional.',
                    'tingkat' => 'Dasar',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Primary Key dan Foreign Key',
                        'deskripsi' => 'Uji pemahaman tentang kunci dalam basis data relasional.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Fungsi PRIMARY KEY dalam sebuah tabel adalah...',
                                'jawaban' => 'Mengidentifikasi secara unik setiap baris data',
                                'pengecoh' => [
                                    'Menghubungkan dua tabel yang berbeda',
                                    'Menyimpan data dalam format terenkripsi',
                                    'Mempercepat proses backup database',
                                ],
                            ],
                            [
                                'pertanyaan' => 'FOREIGN KEY digunakan untuk...',
                                'jawaban' => 'Menghubungkan dua tabel melalui kolom referensi',
                                'pengecoh' => [
                                    'Membuat indeks pencarian',
                                    'Mengunci tabel agar tidak bisa dihapus',
                                    'Menyimpan data sementara',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Sebuah tabel dapat memiliki berapa PRIMARY KEY?',
                                'jawaban' => 'Hanya satu primary key dalam satu tabel',
                                'pengecoh' => [
                                    'Tidak terbatas jumlahnya',
                                    'Dua primary key harus ada',
                                    'Tergantung jumlah kolom dalam tabel',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Nilai pada kolom PRIMARY KEY harus bersifat...',
                                'jawaban' => 'Unik dan tidak boleh NULL',
                                'pengecoh' => [
                                    'Boleh duplicate asalkan tidak NULL',
                                    'Tidak unik tetapi harus terurut',
                                    'Boleh NULL dan boleh duplicate',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Integritas referensial pada foreign key memastikan bahwa...',
                                'jawaban' => 'Nilai foreign key harus sesuai dengan primary key yang direferensi',
                                'pengecoh' => [
                                    'Foreign key boleh berisi nilai sembarang',
                                    'Foreign key hanya bisa diisi angka',
                                    'Foreign key tidak boleh diubah setelah dibuat',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Normalisasi Database',
                    'deskripsi' => 'Mempelajari proses normalisasi untuk menghilangkan redundansi dan anomali data dalam basis data relasional.',
                    'tingkat' => 'Menengah',
                    'guru' => 1,
                    'quiz' => [
                        [
                            'judul' => 'Quiz Normalisasi Database',
                            'deskripsi' => 'Uji pemahaman tentang konsep normalisasi dan bentuk-bentuk normal.',
                            'durasi' => 15,
                            'soal' => [
                                [
                                    'pertanyaan' => 'Tujuan utama dari normalisasi database adalah...',
                                    'jawaban' => 'Mengurangi redundansi dan menghindari anomali data',
                                    'pengecoh' => [
                                        'Mempercepat koneksi jaringan',
                                        'Menambah kapasitas penyimpanan',
                                        'Meningkatkan keamanan data',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Syarat utama bentuk normal pertama (1NF) adalah...',
                                    'jawaban' => 'Setiap kolom harus bernilai atomik (tidak dapat dipecah lagi)',
                                    'pengecoh' => [
                                        'Tidak boleh ada kolom duplikat dalam tabel',
                                        'Semua kolom harus memiliki indeks',
                                        'Setiap tabel harus memiliki foreign key',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Bentuk normal kedua (2NF) terpenuhi jika...',
                                    'jawaban' => 'Telah memenuhi 1NF dan tidak ada ketergantungan parsial',
                                    'pengecoh' => [
                                        'Telah memenuhi 1NF dan semua kolom bernilai unik',
                                        'Telah memenuhi 1NF dan tidak ada data NULL',
                                        'Telah memenuhi 1NF dan memiliki primary key',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Bentuk normal ketiga (3NF) mensyaratkan...',
                                    'jawaban' => 'Telah memenuhi 2NF dan tidak ada ketergantungan transitif',
                                    'pengecoh' => [
                                        'Telah memenuhi 2NF dan semua kolom terisi',
                                        'Telah memenuhi 2NF dan tabel terpisah sepenuhnya',
                                        'Telah memenuhi 2NF dan memiliki foreign key',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Anomali yang dapat terjadi pada tabel yang tidak dinormalisasi adalah...',
                                    'jawaban' => 'Anomali insert, update, dan delete',
                                    'pengecoh' => [
                                        'Anomali backup dan restore',
                                        'Anomali indexing dan querying',
                                        'Anomali login dan autentikasi',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Redundansi data berarti...',
                                    'jawaban' => 'Data yang sama disimpan di banyak tempat secara tidak perlu',
                                    'pengecoh' => [
                                        'Data yang hilang akibat kegagalan sistem',
                                        'Data yang dienkripsi untuk keamanan',
                                        'Data yang diarsipkan secara berkala',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'judul' => 'Evaluasi Normalisasi Database',
                            'deskripsi' => 'Evaluasi lanjutan tentang normalisasi dan bentuk normal tingkat lanjut.',
                            'durasi' => 20,
                            'soal' => [
                                [
                                    'pertanyaan' => 'BCNF (Boyce-Codd Normal Form) adalah bentuk normal yang...',
                                    'jawaban' => 'Setiap determinan dalam tabel harus merupakan candidate key',
                                    'pengecoh' => [
                                        'Setiap kolom harus memiliki nilai unik',
                                        'Setiap tabel harus memiliki minimal tiga kolom',
                                        'Setiap foreign key harus terindeks',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Denormalisasi dilakukan dengan tujuan...',
                                    'jawaban' => 'Meningkatkan performa query dengan mengorbankan sebagian normalisasi',
                                    'pengecoh' => [
                                        'Mengurangi ukuran database secara drastis',
                                        'Menghilangkan semua foreign key dari tabel',
                                        'Mengubah semua tabel menjadi bentuk 1NF',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Functional dependency A → B berarti...',
                                    'jawaban' => 'Nilai A secara unik menentukan nilai B',
                                    'pengecoh' => [
                                        'Nilai B secara unik menentukan nilai A',
                                        'A dan B saling independen satu sama lain',
                                        'A dan B harus memiliki tipe data yang sama',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Yang dimaksud dengan candidate key adalah...',
                                    'jawaban' => 'Kumpulan minimal atribut yang dapat mengidentifikasi baris secara unik',
                                    'pengecoh' => [
                                        'Semua kolom dalam tabel tanpa terkecuali',
                                        'Kolom pertama dalam struktur tabel',
                                        'Foreign key yang merujuk ke tabel lain',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Ketergantungan transitif terjadi ketika...',
                                    'jawaban' => 'Atribut non-kunci bergantung pada atribut non-kunci lainnya',
                                    'pengecoh' => [
                                        'Atribut kunci bergantung pada atribut non-kunci',
                                        'Dua tabel saling merujuk satu sama lain',
                                        'Tidak ada primary key yang ditentukan dalam tabel',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],

            // ================================================================
            // SQL
            // ================================================================
            'SQL' => [
                [
                    'judul' => 'Perintah SELECT',
                    'deskripsi' => 'Mempelajari perintah SELECT untuk mengambil data dari tabel dalam basis data relasional.',
                    'tingkat' => 'Dasar',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Perintah SELECT',
                        'deskripsi' => 'Uji pemahaman tentang query SELECT dasar.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Perintah SQL yang digunakan untuk mengambil data dari tabel adalah...',
                                'jawaban' => 'SELECT',
                                'pengecoh' => [
                                    'INSERT',
                                    'UPDATE',
                                    'DELETE',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Untuk mengambil seluruh kolom dari sebuah tabel, perintah yang digunakan adalah...',
                                'jawaban' => 'SELECT * FROM nama_tabel',
                                'pengecoh' => [
                                    'SELECT ALL FROM nama_tabel',
                                    'SELECT COLUMNS FROM nama_tabel',
                                    'SELECT TOTAL FROM nama_tabel',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Klausa yang digunakan untuk memfilter hasil query SELECT adalah...',
                                'jawaban' => 'WHERE',
                                'pengecoh' => [
                                    'HAVING',
                                    'ORDER BY',
                                    'GROUP BY',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Untuk mengurutkan hasil query secara ascending digunakan perintah...',
                                'jawaban' => 'ORDER BY kolom ASC',
                                'pengecoh' => [
                                    'SORT BY kolom ASC',
                                    'ORDER BY kolom UP',
                                    'SORT BY kolom NAIK',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Fungsi agregat yang digunakan untuk menghitung jumlah baris adalah...',
                                'jawaban' => 'COUNT()',
                                'pengecoh' => [
                                    'SUM()',
                                    'TOTAL()',
                                    'NUMBER()',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'WHERE dan Filtering Data',
                    'deskripsi' => 'Mempelajari penggunaan klausa WHERE untuk menyaring data dengan berbagai kondisi.',
                    'tingkat' => 'Dasar',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz WHERE Clause',
                        'deskripsi' => 'Uji pemahaman tentang filtering data dengan WHERE.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Operator yang digunakan untuk membandingkan nilai dalam WHERE adalah...',
                                'jawaban' => '=, <, >, <=, >=, <>',
                                'pengecoh' => [
                                    'EQ, LT, GT, LE, GE, NE',
                                    '==, <<, >>, <<=, >>=, !=',
                                    'IS, LESS, GREATER, NOT',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Operator LIKE digunakan untuk...',
                                'jawaban' => 'Mencocokkan pola teks dalam kolom',
                                'pengecoh' => [
                                    'Membandingkan nilai numerik',
                                    'Menggabungkan dua kolom teks',
                                    'Menghitung panjang string',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Wildcard % pada operator LIKE berarti...',
                                'jawaban' => 'Mencocokkan nol atau lebih karakter',
                                'pengecoh' => [
                                    'Mencocokkan tepat satu karakter',
                                    'Mencocokkan karakter pertama saja',
                                    'Mencocokkan karakter terakhir saja',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Operator IN dalam SQL digunakan untuk...',
                                'jawaban' => 'Memeriksa apakah nilai termasuk dalam sekumpulan nilai',
                                'pengecoh' => [
                                    'Memeriksa apakah nilai berada dalam rentang angka',
                                    'Memeriksa apakah nilai tidak NULL',
                                    'Memeriksa apakah nilai mengandung substring',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Klausa WHERE dengan operator AND akan menghasilkan TRUE jika...',
                                'jawaban' => 'Semua kondisi bernilai TRUE',
                                'pengecoh' => [
                                    'Salah satu kondisi bernilai TRUE',
                                    'Semua kondisi bernilai FALSE',
                                    'Tidak ada kondisi yang dievaluasi',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'JOIN Antar Tabel',
                    'deskripsi' => 'Mempelajari berbagai jenis JOIN untuk menggabungkan data dari dua tabel atau lebih.',
                    'tingkat' => 'Menengah',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz SQL JOIN',
                        'deskripsi' => 'Evaluasi pemahaman tentang JOIN dalam SQL.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'INNER JOIN akan mengembalikan data ketika...',
                                'jawaban' => 'Terdapat kecocokan di kedua tabel yang di-join',
                                'pengecoh' => [
                                    'Data ada di tabel kiri meskipun tidak cocok',
                                    'Data ada di tabel kanan meskipun tidak cocok',
                                    'Semua data dari kedua tabel tanpa syarat',
                                ],
                            ],
                            [
                                'pertanyaan' => 'LEFT JOIN akan mengembalikan...',
                                'jawaban' => 'Semua data dari tabel kiri dan data yang cocok dari tabel kanan',
                                'pengecoh' => [
                                    'Semua data dari kedua tabel tanpa terkecuali',
                                    'Hanya data yang cocok dari kedua tabel',
                                    'Semua data dari tabel kanan dan data yang cocok dari tabel kiri',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perbedaan utama antara INNER JOIN dan LEFT JOIN adalah...',
                                'jawaban' => 'LEFT JOIN tetap menampilkan data tabel kiri meskipun tidak ada kecocokan',
                                'pengecoh' => [
                                    'INNER JOIN lebih cepat daripada LEFT JOIN',
                                    'LEFT JOIN hanya bisa digunakan pada tiga tabel',
                                    'INNER JOIN membutuhkan indeks sedangkan LEFT JOIN tidak',
                                ],
                            ],
                            [
                                'pertanyaan' => 'RIGHT JOIN hampir sama dengan LEFT JOIN, perbedaannya adalah...',
                                'jawaban' => 'RIGHT JOIN mengutamakan semua data dari tabel kanan',
                                'pengecoh' => [
                                    'RIGHT JOIN hanya bisa digunakan di MySQL',
                                    'RIGHT JOIN tidak memerlukan ON clause',
                                    'RIGHT JOIN menggabungkan tabel tanpa kondisi',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Syarat minimal yang harus ada dalam query JOIN adalah...',
                                'jawaban' => 'ON clause yang menentukan kolom penghubung antar tabel',
                                'pengecoh' => [
                                    'WHERE clause untuk memfilter hasil',
                                    'ORDER BY clause untuk mengurutkan',
                                    'GROUP BY clause untuk mengelompokkan',
                                ],
                            ],
                            [
                                'pertanyaan' => 'CROSS JOIN akan menghasilkan...',
                                'jawaban' => 'Semua kombinasi baris dari kedua tabel (produk kartesian)',
                                'pengecoh' => [
                                    'Hanya baris yang cocok dari kedua tabel',
                                    'Baris unik dari tabel pertama saja',
                                    'Baris yang tidak cocok dari kedua tabel',
                                ],
                            ],
                            [
                                'pertanyaan' => 'SELF JOIN digunakan ketika...',
                                'jawaban' => 'Sebuah tabel perlu di-join dengan dirinya sendiri',
                                'pengecoh' => [
                                    'Dua tabel identik digabungkan',
                                    'Tabel memiliki foreign key ke tabel lain',
                                    'Tidak ada kolom yang cocok antar tabel',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Subquery',
                    'deskripsi' => 'Mempelajari konsep subquery untuk membuat query bertingkat dalam SQL.',
                    'tingkat' => 'Lanjutan',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Evaluasi Subquery',
                        'deskripsi' => 'Uji pemahaman tentang subquery dan penggunaannya.',
                        'durasi' => 20,
                        'soal' => [
                            [
                                'pertanyaan' => 'Subquery adalah...',
                                'jawaban' => 'Query yang berada di dalam query utama dan dieksekusi terlebih dahulu',
                                'pengecoh' => [
                                    'Query yang berjalan secara paralel dengan query utama',
                                    'Query yang digunakan hanya untuk tabel temporary',
                                    'Query yang tidak mengembalikan hasil apapun',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Subquery yang mengembalikan satu baris dan satu kolom disebut...',
                                'jawaban' => 'Scalar subquery',
                                'pengecoh' => [
                                    'Row subquery',
                                    'Table subquery',
                                    'Correlated subquery',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Operator EXISTS dalam subquery digunakan untuk...',
                                'jawaban' => 'Memeriksa apakah subquery mengembalikan minimal satu baris',
                                'pengecoh' => [
                                    'Memeriksa apakah subquery gagal dieksekusi',
                                    'Memeriksa apakah subquery mengembalikan NULL',
                                    'Memeriksa apakah subquery memiliki kesalahan sintaks',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perbedaan utama subquery dengan JOIN adalah...',
                                'jawaban' => 'Subquery dapat digunakan di SELECT, WHERE, FROM, sedangkan JOIN hanya di FROM',
                                'pengecoh' => [
                                    'JOIN lebih lambat dari subquery dalam semua kondisi',
                                    'Subquery hanya bisa digunakan di MySQL',
                                    'JOIN tidak bisa menggabungkan lebih dari dua tabel',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Correlated subquery adalah subquery yang...',
                                'jawaban' => 'Bereferensi ke kolom dari query luar dan dieksekusi per baris',
                                'pengecoh' => [
                                    'Bereferensi ke tabel temporary',
                                    'Tidak bergantung pada query luar sama sekali',
                                    'Hanya dapat digunakan dalam SELECT clause',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Hasil subquery dengan operator IN adalah TRUE jika...',
                                'jawaban' => 'Nilai yang diuji cocok dengan salah satu nilai hasil subquery',
                                'pengecoh' => [
                                    'Nilai yang diuji tidak cocok dengan hasil subquery',
                                    'Subquery mengembalikan nilai NULL',
                                    'Subquery mengembalikan lebih dari satu kolom',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // MySQL
            // ================================================================
            'MySQL' => [
                [
                    'judul' => 'Instalasi dan Konfigurasi MySQL',
                    'deskripsi' => 'Langkah-langkah instalasi MySQL dan konfigurasi dasar untuk pengembangan aplikasi.',
                    'tingkat' => 'Dasar',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Instalasi MySQL',
                        'deskripsi' => 'Uji pemahaman tentang instalasi dan konfigurasi MySQL.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Port default yang digunakan MySQL adalah...',
                                'jawaban' => '3306',
                                'pengecoh' => [
                                    '8080',
                                    '5432',
                                    '27017',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perintah untuk masuk ke MySQL console adalah...',
                                'jawaban' => 'mysql -u root -p',
                                'pengecoh' => [
                                    'mysql connect root',
                                    'mysql start root',
                                    'mysql login root',
                                ],
                            ],
                            [
                                'pertanyaan' => 'File konfigurasi utama MySQL pada Linux adalah...',
                                'jawaban' => '/etc/mysql/my.cnf',
                                'pengecoh' => [
                                    '/etc/mysql/config.ini',
                                    '/var/lib/mysql/settings.cnf',
                                    '/usr/bin/mysql.conf',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perintah untuk membuat database baru di MySQL adalah...',
                                'jawaban' => 'CREATE DATABASE nama_database;',
                                'pengecoh' => [
                                    'NEW DATABASE nama_database;',
                                    'ADD DATABASE nama_database;',
                                    'BUILD DATABASE nama_database;',
                                ],
                            ],
                            [
                                'pertanyaan' => 'User default yang memiliki akses penuh ke MySQL setelah instalasi adalah...',
                                'jawaban' => 'root',
                                'pengecoh' => [
                                    'admin',
                                    'superuser',
                                    'system',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Optimasi Query MySQL',
                    'deskripsi' => 'Teknik optimasi query MySQL untuk meningkatkan performa aplikasi basis data.',
                    'tingkat' => 'Lanjutan',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Optimasi Query MySQL',
                        'deskripsi' => 'Evaluasi teknik optimasi query pada MySQL.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Perintah EXPLAIN dalam MySQL digunakan untuk...',
                                'jawaban' => 'Menampilkan rencana eksekusi query untuk analisis performa',
                                'pengecoh' => [
                                    'Menjalankan query secara paksa',
                                    'Menghapus query dari cache',
                                    'Mengubah rencana eksekusi secara otomatis',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Salah satu cara terbaik untuk mempercepat query SELECT adalah...',
                                'jawaban' => 'Menambahkan indeks pada kolom yang sering digunakan di WHERE',
                                'pengecoh' => [
                                    'Menambah jumlah kolom dalam tabel',
                                    'Menggunakan SELECT * untuk semua kebutuhan',
                                    'Menghapus semua foreign key',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Jenis indeks yang memungkinkan pencarian teks lengkap adalah...',
                                'jawaban' => 'FULLTEXT index',
                                'pengecoh' => [
                                    'UNIQUE index',
                                    'SPATIAL index',
                                    'PRIMARY index',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Query cache pada MySQL berfungsi untuk...',
                                'jawaban' => 'Menyimpan hasil query SELECT untuk digunakan kembali',
                                'pengecoh' => [
                                    'Menyimpan data sementara sebelum di-insert',
                                    'Mencadangkan database secara otomatis',
                                    'Mengenkripsi query yang dikirim ke server',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Penggunaan SELECT * sebaiknya dihindari karena...',
                                'jawaban' => 'Mengambil semua kolom yang mungkin tidak diperlukan, membebani memori',
                                'pengecoh' => [
                                    'Tidak didukung oleh MySQL versi terbaru',
                                    'Menyebabkan error pada query JOIN',
                                    'Hanya bisa digunakan satu kali dalam session',
                                ],
                            ],
                            [
                                'pertanyaan' => 'LIMIT clause dalam query berguna untuk...',
                                'jawaban' => 'Membatasi jumlah baris yang dikembalikan oleh query',
                                'pengecoh' => [
                                    'Membatasi panjang nilai kolom',
                                    'Membatasi jumlah tabel yang di-join',
                                    'Membatasi penggunaan memori query',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // NORMALISASI DATABASE
            // ================================================================
            'Normalisasi Database' => [
                [
                    'judul' => 'Bentuk Normal 1NF, 2NF, 3NF',
                    'deskripsi' => 'Pembahasan mendalam tentang bentuk normal pertama, kedua, dan ketiga dalam normalisasi database.',
                    'tingkat' => 'Menengah',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Bentuk Normal',
                        'deskripsi' => 'Uji pemahaman tentang 1NF, 2NF, dan 3NF.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Suatu tabel dikatakan memenuhi 1NF jika...',
                                'jawaban' => 'Setiap kolom berisi nilai atomik dan tidak ada grup berulang',
                                'pengecoh' => [
                                    'Tabel memiliki primary key',
                                    'Semua kolom bertipe string',
                                    'Tidak ada foreign key dalam tabel',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Ketergantungan parsial terjadi ketika...',
                                'jawaban' => 'Atribut non-kunci bergantung hanya pada sebagian dari primary key komposit',
                                'pengecoh' => [
                                    'Atribut kunci bergantung pada atribut non-kunci',
                                    'Semua atribut saling bergantung satu sama lain',
                                    'Tidak ada ketergantungan antar atribut sama sekali',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Sebuah tabel dengan primary key komposit (A, B) dan memiliki kolom C yang hanya bergantung pada A, maka tabel tersebut...',
                                'jawaban' => 'Telah memenuhi 1NF tetapi belum 2NF karena ada ketergantungan parsial',
                                'pengecoh' => [
                                    'Telah memenuhi 3NF karena tidak ada anomali',
                                    'Telah memenuhi 2NF karena memiliki primary key',
                                    'Belum memenuhi 1NF karena kolom C redundan',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Contoh ketergantungan transitif adalah...',
                                'jawaban' => 'Kolom kota bergantung pada kode_pos, dan kode_pos bergantung pada id_siswa',
                                'pengecoh' => [
                                    'Kolom nama bergantung pada id_siswa secara langsung',
                                    'Kolom umur dan tanggal_lahir saling melengkapi',
                                    'Tabel memiliki dua primary key yang berbeda',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Untuk menghilangkan ketergantungan transitif, langkah yang dilakukan adalah...',
                                'jawaban' => 'Memisahkan atribut yang memiliki ketergantungan transitif ke tabel baru',
                                'pengecoh' => [
                                    'Menambahkan primary key baru pada tabel',
                                    'Menggabungkan tabel dengan tabel lain',
                                    'Menghapus semua foreign key dari tabel',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Manfaat utama dari normalisasi hingga 3NF adalah...',
                                'jawaban' => 'Meminimalkan redundansi data dan menghindari anomali',
                                'pengecoh' => [
                                    'Mempercepat semua jenis query',
                                    'Mengurangi jumlah tabel dalam database',
                                    'Menghilangkan kebutuhan akan primary key',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // ERD
            // ================================================================
            'ERD' => [
                [
                    'judul' => 'Perancangan ERD',
                    'deskripsi' => 'Teknik perancangan Entity Relationship Diagram untuk pemodelan basis data yang baik.',
                    'tingkat' => 'Menengah',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Perancangan ERD',
                        'deskripsi' => 'Evaluasi kemampuan merancang ERD.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Langkah pertama dalam merancang ERD adalah...',
                                'jawaban' => 'Mengidentifikasi entitas yang terlibat dalam sistem',
                                'pengecoh' => [
                                    'Langsung membuat tabel di database',
                                    'Menentukan tipe data setiap kolom',
                                    'Mengisi data contoh ke dalam tabel',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Entitas lemah (weak entity) adalah entitas yang...',
                                'jawaban' => 'Tidak memiliki atribut kunci sendiri dan bergantung pada entitas induk',
                                'pengecoh' => [
                                    'Memiliki primary key sendiri yang unik',
                                    'Tidak memiliki relasi dengan entitas lain',
                                    'Hanya menyimpan data sementara',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Kardinalitas dalam ERD menggambarkan...',
                                'jawaban' => 'Jumlah hubungan maksimum antara entitas yang berelasi',
                                'pengecoh' => [
                                    'Jumlah atribut dalam sebuah entitas',
                                    'Panjang maksimum nilai dalam sebuah kolom',
                                    'Jumlah tabel yang ada dalam database',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Atribut multivalue dalam ERD digambarkan dengan...',
                                'jawaban' => 'Ellips dengan garis rangkap',
                                'pengecoh' => [
                                    'Ellips biasa dengan garis tunggal',
                                    'Persegi panjang dengan garis rangkap',
                                    'Belah ketupat dengan garis putus-putus',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Relasi many-to-many antara dua entitas biasanya diimplementasikan dalam tabel dengan...',
                                'jawaban' => 'Membuat tabel penghubung (junction table) baru',
                                'pengecoh' => [
                                    'Menambahkan foreign key di kedua tabel',
                                    'Menggabungkan kedua entitas menjadi satu tabel',
                                    'Menyimpan data relasi dalam file terpisah',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Notasi ERD yang menggunakan belah ketupat di dalam persegi untuk relasi subtype disebut...',
                                'jawaban' => 'Notasi Crow\'s Foot',
                                'pengecoh' => [
                                    'Notasi Chen',
                                    'Notasi UML',
                                    'Notasi Bachman',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // SISTEM INFORMASI
            // ================================================================
            'Sistem Informasi' => [
                [
                    'judul' => 'Konsep Sistem Informasi',
                    'deskripsi' => 'Pengertian, komponen, dan jenis-jenis sistem informasi dalam organisasi.',
                    'tingkat' => 'Dasar',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Konsep Sistem Informasi',
                        'deskripsi' => 'Uji pemahaman tentang konsep dasar sistem informasi.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Sistem informasi didefinisikan sebagai...',
                                'jawaban' => 'Kombinasi teknologi, prosedur, dan sumber daya untuk mengolah data menjadi informasi',
                                'pengecoh' => [
                                    'Kumpulan perangkat keras komputer saja',
                                    'Aplikasi untuk bermain game',
                                    'Jaringan internet yang menghubungkan komputer',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Komponen utama sistem informasi meliputi...',
                                'jawaban' => 'Input, proses, output, umpan balik, dan lingkungan',
                                'pengecoh' => [
                                    'Monitor, keyboard, mouse, dan printer',
                                    'HTML, CSS, JavaScript, dan PHP',
                                    'Database, server, dan browser saja',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Yang membedakan data dengan informasi adalah...',
                                'jawaban' => 'Informasi adalah data yang telah diolah dan memiliki makna bagi penerimanya',
                                'pengecoh' => [
                                    'Data bersifat digital sedangkan informasi bersifat analog',
                                    'Informasi adalah data mentah yang belum diolah',
                                    'Data dan informasi memiliki arti yang sama persis',
                                ],
                            ],
                            [
                                'pertanyaan' => 'TPS (Transaction Processing System) berfungsi untuk...',
                                'jawaban' => 'Memproses transaksi bisnis sehari-hari secara efisien',
                                'pengecoh' => [
                                    'Menganalisis data untuk pengambilan keputusan strategis',
                                    'Mengelola hubungan dengan pelanggan',
                                    'Merancang produk baru',
                                ],
                            ],
                            [
                                'pertanyaan' => 'DSS (Decision Support System) digunakan oleh...',
                                'jawaban' => 'Manajemen menengah untuk pengambilan keputusan semi-terstruktur',
                                'pengecoh' => [
                                    'Karyawan operasional untuk transaksi harian',
                                    'Top management untuk perencanaan strategis',
                                    'Pelanggan untuk melihat produk',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Analisis dan Perancangan Sistem Informasi',
                    'deskripsi' => 'Metode dan teknik dalam menganalisis kebutuhan serta merancang sistem informasi.',
                    'tingkat' => 'Menengah',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Evaluasi Analisis Sistem Informasi',
                        'deskripsi' => 'Uji pemahaman tentang analisis dan perancangan SI.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'SDLC merupakan singkatan dari...',
                                'jawaban' => 'Systems Development Life Cycle',
                                'pengecoh' => [
                                    'Software Design Life Cycle',
                                    'System Data Link Control',
                                    'Software Development Learning Center',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Tahap pertama dalam SDLC adalah...',
                                'jawaban' => 'Analisis kebutuhan (requirements analysis)',
                                'pengecoh' => [
                                    'Implementasi dan coding',
                                    'Pengujian sistem',
                                    'Pemeliharaan sistem',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Metode pengembangan sistem yang bersifat iteratif dan inkremental adalah...',
                                'jawaban' => 'Agile',
                                'pengecoh' => [
                                    'Waterfall',
                                    'V-Model',
                                    'Spiral',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Dokumen yang berisi kebutuhan sistem dari sudut pandang pengguna disebut...',
                                'jawaban' => 'SRS (Software Requirements Specification)',
                                'pengecoh' => [
                                    'SDD (Software Design Document)',
                                    'STD (Software Test Document)',
                                    'SAD (System Administration Document)',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Tujuan utama analisis sistem adalah...',
                                'jawaban' => 'Memahami kebutuhan pengguna dan masalah sistem yang ada',
                                'pengecoh' => [
                                    'Langsung membangun aplikasi',
                                    'Menentukan harga pengembangan sistem',
                                    'Memilih bahasa pemrograman yang akan digunakan',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Teknik pengumpulan kebutuhan yang melibatkan wawancara langsung dengan pengguna disebut...',
                                'jawaban' => 'Interview',
                                'pengecoh' => [
                                    'Observasi',
                                    'Kuesioner',
                                    'Studi dokumentasi',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // UML
            // ================================================================
            'UML' => [
                [
                    'judul' => 'Use Case Diagram',
                    'deskripsi' => 'Memahami Use Case Diagram sebagai alat pemodelan interaksi antara pengguna dan sistem.',
                    'tingkat' => 'Menengah',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Use Case Diagram',
                        'deskripsi' => 'Uji pemahaman tentang Use Case Diagram dalam UML.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Use Case Diagram digunakan untuk menggambarkan...',
                                'jawaban' => 'Interaksi antara aktor dengan sistem dari sudut pandang pengguna',
                                'pengecoh' => [
                                    'Struktur internal kelas dalam sistem',
                                    'Aliran data antar komponen sistem',
                                    'Urutan langkah dalam sebuah algoritma',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Simbol aktor dalam Use Case Diagram digambarkan sebagai...',
                                'jawaban' => 'Figur stickman (garis tongkat)',
                                'pengecoh' => [
                                    'Persegi panjang dengan label actor',
                                    'Ellips dengan teks di dalamnya',
                                    'Segitiga dengan icon user',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Relasi <<extends>> dalam Use Case berarti...',
                                'jawaban' => 'Use case tertentu memperluas perilaku use case lain dalam kondisi tertentu',
                                'pengecoh' => [
                                    'Use case merupakan bagian wajib dari use case lain',
                                    'Use case berjalan secara paralel dengan use case lain',
                                    'Use case tidak memiliki hubungan dengan use case lain',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Relasi <<includes>> menunjukkan bahwa...',
                                'jawaban' => 'Sebuah use case selalu menyertakan use case lain sebagai bagian dari prosesnya',
                                'pengecoh' => [
                                    'Use case dapat digantikan oleh use case lain',
                                    'Use case hanya berjalan sekali dalam satu waktu',
                                    'Use case tidak memerlukan aktor untuk menjalankannya',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Fungsi utama Use Case Diagram adalah...',
                                'jawaban' => 'Menangkap kebutuhan fungsional sistem dari perspektif pengguna',
                                'pengecoh' => [
                                    'Menampilkan struktur database sistem',
                                    'Menggambarkan arsitektur jaringan sistem',
                                    'Menunjukkan antarmuka pengguna secara detail',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Seorang aktor dalam Use Case Diagram dapat berupa...',
                                'jawaban' => 'Pengguna manusia atau sistem eksternal yang berinteraksi dengan sistem',
                                'pengecoh' => [
                                    'Hanya pengguna manusia yang terdaftar',
                                    'Hanya sistem operasi yang berjalan',
                                    'Hanya perangkat keras yang terhubung',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Class Diagram',
                    'deskripsi' => 'Memahami Class Diagram sebagai alat pemodelan struktur statis sistem berorientasi objek.',
                    'tingkat' => 'Menengah',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Class Diagram',
                        'deskripsi' => 'Evaluasi pemahaman tentang Class Diagram UML.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Class Diagram dalam UML menggambarkan...',
                                'jawaban' => 'Struktur statis sistem berupa kelas, atribut, metode, dan relasi antar kelas',
                                'pengecoh' => [
                                    'Urutan interaksi antar objek dalam waktu tertentu',
                                    'Aliran data antar komponen sistem',
                                    'Perilaku sistem saat merespon event',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Notasi + sebelum nama atribut dalam Class Diagram menunjukkan visibilitas...',
                                'jawaban' => 'Public',
                                'pengecoh' => [
                                    'Private',
                                    'Protected',
                                    'Package',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Relasi asosiasi dalam Class Diagram digambarkan dengan...',
                                'jawaban' => 'Garis lurus tanpa panah yang menghubungkan dua kelas',
                                'pengecoh' => [
                                    'Garis putus-putus dengan segitiga',
                                    'Garis dengan diamond di salah satu ujung',
                                    'Garis dengan panah tertutup',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Relasi inheritance (generalisasi) digambarkan dengan...',
                                'jawaban' => 'Garis dengan segitiga hollow di ujung kelas induk',
                                'pengecoh' => [
                                    'Garis dengan diamond penuh di ujung kelas anak',
                                    'Garis putus-putus dengan panah biasa',
                                    'Garis dengan lingkaran di kedua ujung',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Multiplisitas 1..* pada relasi Class Diagram berarti...',
                                'jawaban' => 'Satu objek dapat berhubungan dengan satu atau lebih objek lain',
                                'pengecoh' => [
                                    'Objek hanya dapat berhubungan dengan satu objek lain',
                                    'Objek tidak boleh berhubungan dengan objek lain',
                                    'Satu objek berhubungan dengan tepat satu objek lain',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Relasi komposisi (composition) ditandai dengan...',
                                'jawaban' => 'Diamond hitam (solid) di sisi kelas pemilik',
                                'pengecoh' => [
                                    'Diamond putih (hollow) di sisi kelas pemilik',
                                    'Panah dengan label <<compose>>',
                                    'Garis tebal di antara kedua kelas',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // FLOWCHART
            // ================================================================
            'Flowchart' => [
                [
                    'judul' => 'Flowchart dan Pseudocode',
                    'deskripsi' => 'Mempelajari flowchart sebagai representasi visual algoritma dan pseudocode sebagai deskripsi tekstual.',
                    'tingkat' => 'Dasar',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Flowchart',
                        'deskripsi' => 'Uji pemahaman tentang flowchart dan pseudocode.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Flowchart adalah...',
                                'jawaban' => 'Diagram yang merepresentasikan langkah-langkah algoritma secara visual',
                                'pengecoh' => [
                                    'Bahasa pemrograman tingkat tinggi',
                                    'Aplikasi untuk membuat diagram',
                                    'Database untuk menyimpan alur proses',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Simbol oval dalam flowchart digunakan untuk...',
                                'jawaban' => 'Start dan end (terminal)',
                                'pengecoh' => [
                                    'Proses atau perhitungan',
                                    'Pengambilan keputusan',
                                    'Input atau output data',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Simbol belah ketupat dalam flowchart merepresentasikan...',
                                'jawaban' => 'Pengambilan keputusan (decision)',
                                'pengecoh' => [
                                    'Proses yang dilakukan',
                                    'Input data dari pengguna',
                                    'Menampilkan output',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Pseudocode adalah...',
                                'jawaban' => 'Deskripsi algoritma menggunakan bahasa manusia yang terstruktur',
                                'pengecoh' => [
                                    'Kode program yang sudah bisa dijalankan',
                                    'Diagram alir dalam bentuk teks',
                                    'Bahasa pemrograman visual',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Struktur percabangan dalam flowchart digambarkan dengan...',
                                'jawaban' => 'Simbol decision dengan dua cabang keluar (true/false)',
                                'pengecoh' => [
                                    'Simbol proses berulang',
                                    'Simbol terminal dengan dua jalur',
                                    'Simbol input dengan cabang ganda',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // DFD
            // ================================================================
            'DFD' => [
                [
                    'judul' => 'Data Flow Diagram',
                    'deskripsi' => 'Memahami DFD sebagai alat pemodelan aliran data dalam sistem informasi.',
                    'tingkat' => 'Menengah',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Data Flow Diagram',
                        'deskripsi' => 'Uji pemahaman tentang DFD dan komponennya.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'DFD digunakan untuk menggambarkan...',
                                'jawaban' => 'Aliran data dalam sistem tanpa memperhatikan urutan waktu',
                                'pengecoh' => [
                                    'Urutan langkah dalam sebuah algoritma',
                                    'Struktur kelas dalam pemrograman OOP',
                                    'Antarmuka pengguna aplikasi',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Simbol lingkaran atau persegi panjang dengan sudut membulat dalam DFD merepresentasikan...',
                                'jawaban' => 'Proses (transformasi data)',
                                'pengecoh' => [
                                    'Entitas eksternal',
                                    'Penyimpanan data',
                                    'Aliran data',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Simbol garis panah dalam DFD menunjukkan...',
                                'jawaban' => 'Aliran data dari satu komponen ke komponen lain',
                                'pengecoh' => [
                                    'Aliran kontrol program',
                                    'Urutan eksekusi proses',
                                    'Hubungan hierarki antar proses',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Entitas eksternal dalam DFD adalah...',
                                'jawaban' => 'Sumber atau tujuan data di luar sistem yang dimodelkan',
                                'pengecoh' => [
                                    'Proses utama dalam sistem',
                                    'Database yang digunakan sistem',
                                    'Antarmuka pengguna sistem',
                                ],
                            ],
                            [
                                'pertanyaan' => 'DFD level 0 disebut juga...',
                                'jawaban' => 'Diagram konteks (context diagram)',
                                'pengecoh' => [
                                    'Diagram detail proses',
                                    'Diagram aliran fisik',
                                    'Diagram dekomposisi',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perbedaan utama DFD dengan flowchart adalah...',
                                'jawaban' => 'DFD fokus pada aliran data, flowchart fokus pada aliran kontrol',
                                'pengecoh' => [
                                    'DFD lebih sulit dipahami daripada flowchart',
                                    'DFD hanya digunakan untuk sistem besar',
                                    'DFD tidak memiliki simbol penyimpanan data',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // PEMROGRAMAN DASAR
            // ================================================================
            'Pemrograman Dasar' => [
                [
                    'judul' => 'Logika Pemrograman',
                    'deskripsi' => 'Mempelajari logika dasar pemrograman, operator, dan struktur kontrol.',
                    'tingkat' => 'Dasar',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Logika Pemrograman',
                        'deskripsi' => 'Uji pemahaman tentang logika dasar pemrograman.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Struktur kontrol yang digunakan untuk pengambilan keputusan adalah...',
                                'jawaban' => 'Percabangan (if-else)',
                                'pengecoh' => [
                                    'Perulangan (looping)',
                                    'Array',
                                    'Fungsi',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Operator logika AND akan menghasilkan TRUE jika...',
                                'jawaban' => 'Kedua operand bernilai TRUE',
                                'pengecoh' => [
                                    'Salah satu operand bernilai TRUE',
                                    'Kedua operand bernilai FALSE',
                                    'Salah satu operand bernilai FALSE',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perulangan yang menjalankan kode setidaknya satu kali meskipun kondisi awal salah adalah...',
                                'jawaban' => 'Do-while',
                                'pengecoh' => [
                                    'While',
                                    'For',
                                    'Foreach',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Variabel dalam pemrograman berfungsi untuk...',
                                'jawaban' => 'Menyimpan data yang dapat diubah selama program berjalan',
                                'pengecoh' => [
                                    'Menyimpan data permanen di hardisk',
                                    'Menampilkan output ke layar',
                                    'Mengimpor library eksternal',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Tipe data boolean hanya dapat menyimpan nilai...',
                                'jawaban' => 'True atau False',
                                'pengecoh' => [
                                    'Angka positif dan negatif',
                                    'Karakter dan string',
                                    'Bilangan bulat dan desimal',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Tipe Data dan Variabel',
                    'deskripsi' => 'Memahami berbagai tipe data dan cara penggunaan variabel dalam pemrograman.',
                    'tingkat' => 'Dasar',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Tipe Data',
                        'deskripsi' => 'Uji pemahaman tentang tipe data dan variabel.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Tipe data yang digunakan untuk menyimpan bilangan bulat adalah...',
                                'jawaban' => 'Integer',
                                'pengecoh' => [
                                    'Float',
                                    'String',
                                    'Boolean',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Tipe data string digunakan untuk menyimpan...',
                                'jawaban' => 'Kumpulan karakter teks',
                                'pengecoh' => [
                                    'Angka desimal',
                                    'Nilai benar atau salah',
                                    'Bilangan pecahan',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Deklarasi variabel yang benar dalam PHP adalah...',
                                'jawaban' => '$nama = "Budi";',
                                'pengecoh' => [
                                    'var nama = "Budi";',
                                    'nama = "Budi";',
                                    'string nama = "Budi";',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Konstanta dalam pemrograman adalah...',
                                'jawaban' => 'Variabel yang nilainya tidak dapat diubah setelah didefinisikan',
                                'pengecoh' => [
                                    'Variabel yang nilainya selalu berubah',
                                    'Tipe data khusus untuk angka',
                                    'Fungsi yang mengembalikan nilai tetap',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Casting tipe data dilakukan untuk...',
                                'jawaban' => 'Mengubah tipe data suatu variabel ke tipe data lain',
                                'pengecoh' => [
                                    'Menghapus variabel dari memori',
                                    'Menggandakan nilai variabel',
                                    'Membandingkan dua variabel',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // ALGORITMA
            // ================================================================
            'Algoritma' => [
                [
                    'judul' => 'Algoritma Sorting',
                    'deskripsi' => 'Mempelajari berbagai algoritma pengurutan data seperti bubble sort, quick sort, dan merge sort.',
                    'tingkat' => 'Menengah',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Algoritma Sorting',
                        'deskripsi' => 'Evaluasi pemahaman tentang algoritma pengurutan.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Algoritma sorting yang bekerja dengan membandingkan elemen bersebelahan dan menukarnya jika salah urut adalah...',
                                'jawaban' => 'Bubble Sort',
                                'pengecoh' => [
                                    'Quick Sort',
                                    'Merge Sort',
                                    'Selection Sort',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Kompleksitas waktu rata-rata Quick Sort adalah...',
                                'jawaban' => 'O(n log n)',
                                'pengecoh' => [
                                    'O(n)',
                                    'O(n²)',
                                    'O(log n)',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Algoritma sorting yang membagi array menjadi dua bagian, mengurutkan masing-masing, lalu menggabungkannya adalah...',
                                'jawaban' => 'Merge Sort',
                                'pengecoh' => [
                                    'Insertion Sort',
                                    'Selection Sort',
                                    'Bubble Sort',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Algoritma sorting yang memilih elemen terkecil dan menempatkannya di posisi awal secara berulang adalah...',
                                'jawaban' => 'Selection Sort',
                                'pengecoh' => [
                                    'Merge Sort',
                                    'Quick Sort',
                                    'Bubble Sort',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Worst case complexity dari Bubble Sort adalah...',
                                'jawaban' => 'O(n²)',
                                'pengecoh' => [
                                    'O(n)',
                                    'O(n log n)',
                                    'O(1)',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Algoritma sorting yang menggunakan teknik divide and conquer adalah...',
                                'jawaban' => 'Quick Sort dan Merge Sort',
                                'pengecoh' => [
                                    'Bubble Sort dan Selection Sort',
                                    'Insertion Sort dan Shell Sort',
                                    'Counting Sort dan Radix Sort',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Insertion Sort bekerja dengan cara...',
                                'jawaban' => 'Membangun array terurut dengan menyisipkan elemen satu per satu ke posisi yang tepat',
                                'pengecoh' => [
                                    'Menukar elemen secara acak hingga array terurut',
                                    'Membagi array menjadi bagian kecil lalu menggabungkannya',
                                    'Memilih pivot dan mempartisi array di sekitarnya',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Algoritma Searching',
                    'deskripsi' => 'Mempelajari algoritma pencarian data seperti linear search dan binary search.',
                    'tingkat' => 'Menengah',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Algoritma Searching',
                        'deskripsi' => 'Uji pemahaman tentang algoritma pencarian.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Linear search bekerja dengan cara...',
                                'jawaban' => 'Memeriksa setiap elemen secara berurutan dari awal hingga ditemukan',
                                'pengecoh' => [
                                    'Membagi array menjadi dua bagian setiap iterasi',
                                    'Mengurutkan data terlebih dahulu sebelum mencari',
                                    'Melompati beberapa elemen setiap iterasi',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Syarat utama agar binary search dapat digunakan adalah...',
                                'jawaban' => 'Data harus sudah terurut',
                                'pengecoh' => [
                                    'Data harus bertipe numerik',
                                    'Data tidak boleh mengandung nilai duplikat',
                                    'Data harus disimpan dalam linked list',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Kompleksitas waktu binary search adalah...',
                                'jawaban' => 'O(log n)',
                                'pengecoh' => [
                                    'O(n)',
                                    'O(n²)',
                                    'O(n log n)',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Jika data tidak terurut, algoritma pencarian yang tepat digunakan adalah...',
                                'jawaban' => 'Linear search',
                                'pengecoh' => [
                                    'Binary search',
                                    'Jump search',
                                    'Interpolation search',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Kompleksitas waktu linear search pada worst case adalah...',
                                'jawaban' => 'O(n)',
                                'pengecoh' => [
                                    'O(1)',
                                    'O(log n)',
                                    'O(n²)',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Binary search bekerja dengan prinsip...',
                                'jawaban' => 'Membagi array menjadi dua dan menentukan bagian yang mungkin berisi target',
                                'pengecoh' => [
                                    'Menggeser elemen satu per satu dari kiri ke kanan',
                                    'Mengubah data menjadi format lain sebelum mencari',
                                    'Mencari dari kedua ujung secara bersamaan',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // STRUKTUR DATA
            // ================================================================
            'Struktur Data' => [
                [
                    'judul' => 'Array dan Linked List',
                    'deskripsi' => 'Membandingkan array dan linked list sebagai struktur data linear serta kelebihan dan kekurangannya.',
                    'tingkat' => 'Menengah',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Array dan Linked List',
                        'deskripsi' => 'Evaluasi pemahaman tentang array dan linked list.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Array adalah struktur data yang...',
                                'jawaban' => 'Menyimpan elemen dengan tipe data sama dalam alokasi memori berurutan',
                                'pengecoh' => [
                                    'Menyimpan elemen dengan alamat memori yang tidak berurutan',
                                    'Hanya bisa menyimpan data bertipe string',
                                    'Tidak dapat diakses menggunakan indeks',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Keunggulan linked list dibanding array adalah...',
                                'jawaban' => 'Ukuran dapat berubah secara dinamis tanpa perlu realokasi memori',
                                'pengecoh' => [
                                    'Akses acak lebih cepat menggunakan indeks',
                                    'Menggunakan memori lebih sedikit',
                                    'Lebih mudah diimplementasikan dalam semua bahasa',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Singly linked list memiliki node dengan komponen...',
                                'jawaban' => 'Data dan pointer ke node berikutnya',
                                'pengecoh' => [
                                    'Data dan pointer ke node sebelumnya',
                                    'Hanya data tanpa pointer',
                                    'Dua pointer ke node sebelum dan sesudah',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Kompleksitas akses acak (random access) pada array adalah...',
                                'jawaban' => 'O(1)',
                                'pengecoh' => [
                                    'O(n)',
                                    'O(log n)',
                                    'O(n²)',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Pada linked list, penyisipan elemen di tengah memiliki kompleksitas...',
                                'jawaban' => 'O(n) untuk mencari posisi, O(1) untuk menyisipkan',
                                'pengecoh' => [
                                    'O(1) untuk mencari dan menyisipkan',
                                    'O(n²) untuk seluruh operasi',
                                    'O(log n) untuk mencari dan menyisipkan',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Doubly linked list memiliki keunggulan dibanding singly linked list yaitu...',
                                'jawaban' => 'Dapat melakukan traversal maju dan mundur',
                                'pengecoh' => [
                                    'Menggunakan memori lebih sedikit',
                                    'Hanya bisa menyimpan data angka',
                                    'Tidak memerlukan pointer sama sekali',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Stack dan Queue',
                    'deskripsi' => 'Mempelajari struktur data stack (tumpukan) dan queue (antrian) serta penerapannya.',
                    'tingkat' => 'Lanjutan',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Stack dan Queue',
                        'deskripsi' => 'Uji pemahaman tentang stack dan queue.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Prinsip kerja stack adalah...',
                                'jawaban' => 'LIFO (Last In First Out)',
                                'pengecoh' => [
                                    'FIFO (First In First Out)',
                                    'LILO (Last In Last Out)',
                                    'FILO (First In Last Out)',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Operasi untuk menambahkan elemen ke dalam stack disebut...',
                                'jawaban' => 'Push',
                                'pengecoh' => [
                                    'Pop',
                                    'Enqueue',
                                    'Dequeue',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Queue bekerja dengan prinsip...',
                                'jawaban' => 'FIFO (First In First Out)',
                                'pengecoh' => [
                                    'LIFO (Last In First Out)',
                                    'LILO (Last In Last Out)',
                                    'FILO (First In Last Out)',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Contoh penerapan stack dalam kehidupan nyata adalah...',
                                'jawaban' => 'Fitur undo pada editor teks',
                                'pengecoh' => [
                                    'Antrian di kasir supermarket',
                                    'Jadwal kereta api',
                                    'Daftar putar musik',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Operasi untuk menghapus elemen dari queue disebut...',
                                'jawaban' => 'Dequeue',
                                'pengecoh' => [
                                    'Push',
                                    'Pop',
                                    'Enqueue',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Priority queue adalah queue dimana...',
                                'jawaban' => 'Elemen diproses berdasarkan prioritas, bukan urutan masuk',
                                'pengecoh' => [
                                    'Semua elemen memiliki prioritas yang sama',
                                    'Hanya elemen dengan nilai tertinggi yang diproses',
                                    'Elemen diproses berdasarkan urutan abjad',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // HTML
            // ================================================================
            'HTML' => [
                [
                    'judul' => 'Dasar HTML',
                    'deskripsi' => 'Mempelajari struktur dasar HTML, tag, elemen, dan atribut untuk membuat halaman web.',
                    'tingkat' => 'Dasar',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Dasar HTML',
                        'deskripsi' => 'Uji pemahaman tentang HTML dasar.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'HTML merupakan singkatan dari...',
                                'jawaban' => 'HyperText Markup Language',
                                'pengecoh' => [
                                    'HyperText Machine Language',
                                    'High Tech Modern Language',
                                    'HyperTransfer Markup Language',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Tag HTML yang digunakan untuk heading utama adalah...',
                                'jawaban' => '<h1>',
                                'pengecoh' => [
                                    '<head>',
                                    '<header>',
                                    '<title>',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Atribut href digunakan pada tag...',
                                'jawaban' => '<a>',
                                'pengecoh' => [
                                    '<img>',
                                    '<link>',
                                    '<src>',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Tag <br> berfungsi untuk...',
                                'jawaban' => 'Membuat baris baru (line break)',
                                'pengecoh' => [
                                    'Membuat garis horizontal',
                                    'Menebalkan teks',
                                    'Membuat paragraf baru',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Deklarasi DOCTYPE yang benar untuk HTML5 adalah...',
                                'jawaban' => '<!DOCTYPE html>',
                                'pengecoh' => [
                                    '<!DOCTYPE HTML5>',
                                    '<DOCTYPE html5>',
                                    '<!DOCTYPE html PUBLIC>',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Form dan Tabel HTML',
                    'deskripsi' => 'Mempelajari pembuatan form interaktif dan tabel untuk menampilkan data dalam halaman web.',
                    'tingkat' => 'Dasar',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Form HTML',
                        'deskripsi' => 'Uji pemahaman tentang form dan tabel HTML.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Tag yang digunakan untuk membuat form dalam HTML adalah...',
                                'jawaban' => '<form>',
                                'pengecoh' => [
                                    '<input>',
                                    '<field>',
                                    '<submit>',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Atribut method pada form yang digunakan untuk mengirim data melalui URL adalah...',
                                'jawaban' => 'GET',
                                'pengecoh' => [
                                    'POST',
                                    'SEND',
                                    'PUT',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Tag <table> digunakan untuk...',
                                'jawaban' => 'Membuat tabel dalam halaman HTML',
                                'pengecoh' => [
                                    'Membuat daftar item',
                                    'Menata layout halaman',
                                    'Mengimpor data dari spreadsheet',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Tag untuk mendefinisikan baris dalam tabel adalah...',
                                'jawaban' => '<tr>',
                                'pengecoh' => [
                                    '<td>',
                                    '<th>',
                                    '<row>',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Atribut action pada form HTML berfungsi untuk...',
                                'jawaban' => 'Menentukan URL tujuan pengiriman data form',
                                'pengecoh' => [
                                    'Menentukan metode pengiriman data',
                                    'Menentukan jenis data yang dikirim',
                                    'Menentukan tampilan tombol submit',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // CSS
            // ================================================================
            'CSS' => [
                [
                    'judul' => 'CSS Styling Dasar',
                    'deskripsi' => 'Mempelajari dasar CSS untuk mempercantik tampilan halaman web.',
                    'tingkat' => 'Dasar',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz CSS Dasar',
                        'deskripsi' => 'Uji pemahaman tentang CSS dasar.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'CSS merupakan singkatan dari...',
                                'jawaban' => 'Cascading Style Sheets',
                                'pengecoh' => [
                                    'Computer Style System',
                                    'Creative Style Sheets',
                                    'Cascading System Style',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Properti CSS yang digunakan untuk mengubah warna teks adalah...',
                                'jawaban' => 'color',
                                'pengecoh' => [
                                    'background-color',
                                    'text-color',
                                    'font-color',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Cara menulis CSS secara inline adalah...',
                                'jawaban' => 'Menambahkan atribut style langsung pada elemen HTML',
                                'pengecoh' => [
                                    'Menggunakan tag <style> di dalam <head>',
                                    'Mengimpor file CSS eksternal',
                                    'Menggunakan JavaScript untuk mengatur style',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Properti CSS untuk mengatur jarak di luar elemen adalah...',
                                'jawaban' => 'margin',
                                'pengecoh' => [
                                    'padding',
                                    'border',
                                    'spacing',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Selector CSS .nama-kelas digunakan untuk menargetkan elemen berdasarkan...',
                                'jawaban' => 'Atribut class pada elemen',
                                'pengecoh' => [
                                    'Atribut id pada elemen',
                                    'Nama tag elemen',
                                    'Atribut name pada elemen',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Flexbox dan Grid',
                    'deskripsi' => 'Mempelajari layout modern menggunakan Flexbox dan CSS Grid untuk desain web responsif.',
                    'tingkat' => 'Menengah',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Flexbox dan Grid',
                        'deskripsi' => 'Evaluasi pemahaman tentang Flexbox dan CSS Grid.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Properti display yang digunakan untuk mengaktifkan Flexbox adalah...',
                                'jawaban' => 'display: flex;',
                                'pengecoh' => [
                                    'display: block;',
                                    'display: grid;',
                                    'display: inline;',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Properti justify-content: center pada flexbox berfungsi untuk...',
                                'jawaban' => 'Meratakan item secara horizontal di tengah container',
                                'pengecoh' => [
                                    'Meratakan item secara vertikal di tengah',
                                    'Membungkus item ke baris baru',
                                    'Mengubah urutan item',
                                ],
                            ],
                            [
                                'pertanyaan' => 'CSS Grid menggunakan properti... untuk mendefinisikan kolom',
                                'jawaban' => 'grid-template-columns',
                                'pengecoh' => [
                                    'grid-column',
                                    'grid-columns',
                                    'column-template',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perbedaan utama Flexbox dengan Grid adalah...',
                                'jawaban' => 'Flexbox untuk layout satu dimensi, Grid untuk dua dimensi',
                                'pengecoh' => [
                                    'Grid hanya untuk layout vertikal, Flexbox horizontal',
                                    'Flexbox lebih baru daripada Grid',
                                    'Grid tidak mendukung responsif',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Properti align-items: center pada flexbox akan...',
                                'jawaban' => 'Meratakan item secara vertikal di tengah container',
                                'pengecoh' => [
                                    'Meratakan item secara horizontal di tengah',
                                    'Mengatur jarak antar item',
                                    'Mengubah arah sumbu flex',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Unit fr dalam CSS Grid menunjukkan...',
                                'jawaban' => 'Fraction dari ruang yang tersedia',
                                'pengecoh' => [
                                    'Fixed ratio unit',
                                    'Font relative unit',
                                    'Frame resolution unit',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // JAVASCRIPT
            // ================================================================
            'JavaScript' => [
                [
                    'judul' => 'JavaScript Dasar',
                    'deskripsi' => 'Mempelajari sintaks dasar JavaScript, variabel, tipe data, dan fungsi.',
                    'tingkat' => 'Dasar',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz JavaScript Dasar',
                        'deskripsi' => 'Uji pemahaman tentang JavaScript dasar.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'JavaScript adalah bahasa pemrograman yang bersifat...',
                                'jawaban' => 'Interpreted, dynamic, dan client-side',
                                'pengecoh' => [
                                    'Compiled, static, dan server-side',
                                    'Interpreted, static, dan database-side',
                                    'Compiled, dynamic, dan network-side',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Keyword untuk mendeklarasikan variabel yang memiliki scope global atau fungsi adalah...',
                                'jawaban' => 'var',
                                'pengecoh' => [
                                    'let',
                                    'const',
                                    'int',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Fungsi alert() dalam JavaScript digunakan untuk...',
                                'jawaban' => 'Menampilkan kotak dialog pesan',
                                'pengecoh' => [
                                    'Mencetak output ke console',
                                    'Menulis teks ke halaman web',
                                    'Mengirim data ke server',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Tipe data undefined dalam JavaScript berarti...',
                                'jawaban' => 'Variabel telah dideklarasikan tetapi belum memiliki nilai',
                                'pengecoh' => [
                                    'Variabel tidak pernah dideklarasikan',
                                    'Nilai variabel adalah angka nol',
                                    'Variabel berisi string kosong',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Operator === dalam JavaScript digunakan untuk...',
                                'jawaban' => 'Membandingkan nilai dan tipe data secara ketat',
                                'pengecoh' => [
                                    'Membandingkan hanya nilai tanpa memperhatikan tipe',
                                    'Menggabungkan dua string',
                                    'Memberikan nilai default pada variabel',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'DOM Manipulation',
                    'deskripsi' => 'Mempelajari cara memanipulasi elemen HTML menggunakan JavaScript DOM API.',
                    'tingkat' => 'Menengah',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz DOM Manipulation',
                        'deskripsi' => 'Evaluasi pemahaman tentang manipulasi DOM dengan JavaScript.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'DOM merupakan singkatan dari...',
                                'jawaban' => 'Document Object Model',
                                'pengecoh' => [
                                    'Data Object Management',
                                    'Document Oriented Module',
                                    'Dynamic Object Mapping',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Method untuk memilih elemen berdasarkan id adalah...',
                                'jawaban' => 'document.getElementById()',
                                'pengecoh' => [
                                    'document.querySelector()',
                                    'document.getElementsByClass()',
                                    'document.selectElement()',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Properti untuk mengubah konten HTML dalam sebuah elemen adalah...',
                                'jawaban' => 'innerHTML',
                                'pengecoh' => [
                                    'innerText',
                                    'textContent',
                                    'outerHTML',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Method addEventListener() digunakan untuk...',
                                'jawaban' => 'Menambahkan event handler pada elemen',
                                'pengecoh' => [
                                    'Menghapus event handler dari elemen',
                                    'Memicu event secara manual',
                                    'Mendeteksi tipe event yang tersedia',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Untuk mengubah style CSS elemen melalui JavaScript, menggunakan properti...',
                                'jawaban' => 'element.style',
                                'pengecoh' => [
                                    'element.css',
                                    'element.class',
                                    'element.attribute',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Method createElement() digunakan untuk...',
                                'jawaban' => 'Membuat elemen HTML baru secara dinamis',
                                'pengecoh' => [
                                    'Menghapus elemen HTML yang ada',
                                    'Menyalin elemen HTML yang ada',
                                    'Mencari elemen HTML dalam dokumen',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // PHP
            // ================================================================
            'PHP' => [
                [
                    'judul' => 'Sintaks Dasar PHP',
                    'deskripsi' => 'Mempelajari sintaks dasar PHP, variabel, tipe data, dan struktur kontrol.',
                    'tingkat' => 'Dasar',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz PHP Dasar',
                        'deskripsi' => 'Uji pemahaman tentang sintaks dasar PHP.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'PHP merupakan singkatan dari...',
                                'jawaban' => 'PHP: Hypertext Preprocessor',
                                'pengecoh' => [
                                    'Personal Home Page',
                                    'Professional Hypertext Processor',
                                    'Programming Hypertext Protocol',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Tag pembuka untuk kode PHP adalah...',
                                'jawaban' => '<?php',
                                'pengecoh' => [
                                    '<?',
                                    '<script php>',
                                    '<%php',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Fungsi untuk mencetak output ke browser dalam PHP adalah...',
                                'jawaban' => 'echo',
                                'pengecoh' => [
                                    'print_r()',
                                    'var_dump()',
                                    'output()',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Karakter yang digunakan di depan nama variabel dalam PHP adalah...',
                                'jawaban' => '$ (dollar sign)',
                                'pengecoh' => [
                                    '@ (at sign)',
                                    '# (hash)',
                                    '& (ampersand)',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Array asosiatif dalam PHP adalah array yang...',
                                'jawaban' => 'Menggunakan key berupa string sebagai indeks',
                                'pengecoh' => [
                                    'Hanya bisa menyimpan data angka',
                                    'Key-nya selalu berupa angka',
                                    'Tidak dapat diubah setelah dibuat',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'OOP PHP',
                    'deskripsi' => 'Mempelajari konsep pemrograman berorientasi objek dalam PHP.',
                    'tingkat' => 'Menengah',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz OOP PHP',
                        'deskripsi' => 'Evaluasi pemahaman tentang OOP dalam PHP.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Class dalam OOP adalah...',
                                'jawaban' => 'Blueprint atau cetakan untuk menciptakan objek',
                                'pengecoh' => [
                                    'Instance nyata dari sebuah objek',
                                    'Fungsi khusus dalam pemrograman',
                                    'Tipe data primitif dalam PHP',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Keyword untuk membuat objek dari sebuah class adalah...',
                                'jawaban' => 'new',
                                'pengecoh' => [
                                    'create',
                                    'object',
                                    'instance',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Enkapsulasi dalam OOP berarti...',
                                'jawaban' => 'Menyembunyikan detail implementasi dan melindungi data',
                                'pengecoh' => [
                                    'Mewarisi properti dari class induk',
                                    'Mengimplementasikan banyak interface',
                                    'Menimpa method dari class induk',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Konstruktor dalam class PHP didefinisikan dengan method...',
                                'jawaban' => '__construct()',
                                'pengecoh' => [
                                    'constructor()',
                                    '__init()',
                                    'class()',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Inheritance memungkinkan sebuah class untuk...',
                                'jawaban' => 'Mewarisi properti dan method dari class lain',
                                'pengecoh' => [
                                    'Menyembunyikan method dari class lain',
                                    'Membuat instance dari class lain',
                                    'Menghapus class lain dari memori',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Keyword parent:: digunakan untuk...',
                                'jawaban' => 'Mengakses method atau properti dari class induk',
                                'pengecoh' => [
                                    'Membuat class induk baru',
                                    'Menghapus class induk',
                                    'Mendefinisikan class sebagai final',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // LARAVEL
            // ================================================================
            'Laravel' => [
                [
                    'judul' => 'Routing Laravel',
                    'deskripsi' => 'Mempelajari sistem routing pada Laravel untuk menangani permintaan HTTP.',
                    'tingkat' => 'Dasar',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Routing Laravel',
                        'deskripsi' => 'Uji pemahaman tentang routing di Laravel.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'File routing utama di Laravel terletak di...',
                                'jawaban' => 'routes/web.php',
                                'pengecoh' => [
                                    'app/Http/routes.php',
                                    'config/routes.php',
                                    'resources/routes/web.php',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Fungsi untuk mendefinisikan route dengan metode GET adalah...',
                                'jawaban' => 'Route::get()',
                                'pengecoh' => [
                                    'Route::post()',
                                    'Route::request()',
                                    'Route::fetch()',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Route parameter wajib di Laravel ditulis dengan kurung...',
                                'jawaban' => 'Curly braces {}',
                                'pengecoh' => [
                                    'Square brackets []',
                                    'Parentheses ()',
                                    'Angle brackets <>',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Method untuk mendefinisikan route yang merespon semua metode HTTP adalah...',
                                'jawaban' => 'Route::any()',
                                'pengecoh' => [
                                    'Route::all()',
                                    'Route::match()',
                                    'Route::every()',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Route::resource() secara otomatis membuat route untuk...',
                                'jawaban' => '7 method standar CRUD (index, create, store, show, edit, update, destroy)',
                                'pengecoh' => [
                                    '5 method dasar CRUD tanpa parameter',
                                    'Semua metode HTTP yang tersedia',
                                    'Hanya route GET dan POST saja',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Blade Template Engine',
                    'deskripsi' => 'Mempelajari Blade sebagai template engine Laravel untuk membuat tampilan yang dinamis dan reusable.',
                    'tingkat' => 'Menengah',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Blade Template',
                        'deskripsi' => 'Evaluasi pemahaman tentang Blade template engine.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Ekstensi file untuk Blade template adalah...',
                                'jawaban' => '.blade.php',
                                'pengecoh' => [
                                    '.blade.html',
                                    '.laravel.php',
                                    '.template.php',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Sintaks Blade untuk mencetak nilai yang sudah di-escape adalah...',
                                'jawaban' => '{{ $variable }}',
                                'pengecoh' => [
                                    '{!! $variable !!}',
                                    '<?= $variable ?>',
                                    '@{{ $variable }}',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Direktif @extends() dalam Blade berfungsi untuk...',
                                'jawaban' => 'Meng-extend layout induk dari halaman child',
                                'pengecoh' => [
                                    'Menyertakan file partial',
                                    'Mendefinisikan section dalam layout',
                                    'Mengimpor class PHP',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Direktif @section() dan @yield() digunakan untuk...',
                                'jawaban' => 'Mendefinisikan dan menampilkan bagian konten yang bisa diisi child view',
                                'pengecoh' => [
                                    'Mengatur keamanan output',
                                    'Mengelola session pengguna',
                                    'Membuat komponen UI reusable',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Direktif @foreach di Blade digunakan untuk...',
                                'jawaban' => 'Melakukan iterasi pada array atau collection',
                                'pengecoh' => [
                                    'Mendefinisikan perulangan while',
                                    'Mengeksekusi loop for biasa',
                                    'Mengecek kondisi if',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Untuk menampilkan data tanpa escaping HTML, digunakan sintaks...',
                                'jawaban' => '{!! $variable !!}',
                                'pengecoh' => [
                                    '{{ $variable }}',
                                    '@{{ $variable }}',
                                    '{{! $variable }}',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Eloquent ORM',
                    'deskripsi' => 'Mempelajari Eloquent ORM Laravel untuk interaksi basis data yang elegan.',
                    'tingkat' => 'Menengah',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Eloquent ORM',
                        'deskripsi' => 'Uji pemahaman tentang Eloquent ORM Laravel.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Eloquent ORM menggunakan pola arsitektur...',
                                'jawaban' => 'Active Record',
                                'pengecoh' => [
                                    'Data Mapper',
                                    'Repository Pattern',
                                    'Unit of Work',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Method all() pada model Eloquent digunakan untuk...',
                                'jawaban' => 'Mengambil semua record dari tabel terkait',
                                'pengecoh' => [
                                    'Menghapus semua record',
                                    'Membuat record baru',
                                    'Mengupdate semua record',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Relasi one-to-many didefinisikan menggunakan method...',
                                'jawaban' => 'hasMany()',
                                'pengecoh' => [
                                    'hasOne()',
                                    'belongsTo()',
                                    'belongsToMany()',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Method find() pada Eloquent digunakan untuk...',
                                'jawaban' => 'Mencari record berdasarkan primary key',
                                'pengecoh' => [
                                    'Mencari record berdasarkan kolom tertentu',
                                    'Mengambil semua record yang sudah dihapus',
                                    'Membuat query builder baru',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Untuk mengambil data dengan relasi secara eager loading, digunakan method...',
                                'jawaban' => 'with()',
                                'pengecoh' => [
                                    'load()',
                                    'join()',
                                    'include()',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Mass assignment protection pada Eloquent menggunakan properti...',
                                'jawaban' => '$fillable atau $guarded',
                                'pengecoh' => [
                                    '$protected atau $hidden',
                                    '$casts atau $dates',
                                    '$table atau $primaryKey',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Accessor dalam Eloquent digunakan untuk...',
                                'jawaban' => 'Mengubah nilai atribut saat diakses',
                                'pengecoh' => [
                                    'Mengubah nilai atribut saat disimpan',
                                    'Mendefinisikan relasi antar model',
                                    'Membuat query scope kustom',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Authentication Laravel',
                    'deskripsi' => 'Mempelajari sistem autentikasi Laravel termasuk login, register, dan middleware auth.',
                    'tingkat' => 'Lanjutan',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Evaluasi Authentication Laravel',
                        'deskripsi' => 'Evaluasi pemahaman tentang autentikasi di Laravel.',
                        'durasi' => 20,
                        'soal' => [
                            [
                                'pertanyaan' => 'Fasilitas autentikasi bawaan Laravel disediakan oleh package...',
                                'jawaban' => 'Laravel Breeze / Jetstream / Fortify',
                                'pengecoh' => [
                                    'Laravel Cashier',
                                    'Laravel Horizon',
                                    'Laravel Telescope',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Middleware yang digunakan untuk melindungi route agar hanya bisa diakses pengguna terautentikasi adalah...',
                                'jawaban' => 'auth',
                                'pengecoh' => [
                                    'guest',
                                    'verified',
                                    'throttle',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Method Auth::user() digunakan untuk...',
                                'jawaban' => 'Mendapatkan data pengguna yang sedang login',
                                'pengecoh' => [
                                    'Mendaftarkan pengguna baru',
                                    'Mengubah password pengguna',
                                    'Menghapus sesi pengguna',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Guard dalam sistem autentikasi Laravel berfungsi untuk...',
                                'jawaban' => 'Mendefinisikan bagaimana pengguna diautentikasi untuk setiap request',
                                'pengecoh' => [
                                    'Menyimpan password dalam bentuk hash',
                                    'Membatasi jumlah percobaan login',
                                    'Mengirim email verifikasi',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Hash::make() digunakan untuk...',
                                'jawaban' => 'Mengenkripsi password menggunakan algoritma bcrypt',
                                'pengecoh' => [
                                    'Mendekripsi password yang sudah di-hash',
                                    'Membandingkan password dengan hash',
                                    'Menghasilkan token acak untuk session',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Method attempt() pada Auth facade digunakan untuk...',
                                'jawaban' => 'Mencoba login dengan kredensial yang diberikan',
                                'pengecoh' => [
                                    'Mendaftarkan pengguna baru',
                                    'Mengirim email reset password',
                                    'Memverifikasi email pengguna',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Event logout pada Laravel dapat ditangani menggunakan...',
                                'jawaban' => 'Event Logout atau listener custom',
                                'pengecoh' => [
                                    'Middleware guest saja',
                                    'Hanya dengan menghapus session',
                                    'Tidak bisa ditangani oleh developer',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // REST API
            // ================================================================
            'REST API' => [
                [
                    'judul' => 'Konsep REST API',
                    'deskripsi' => 'Memahami prinsip dan konsep dasar RESTful API untuk komunikasi antar layanan.',
                    'tingkat' => 'Menengah',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Konsep REST API',
                        'deskripsi' => 'Uji pemahaman tentang konsep REST API.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'REST merupakan singkatan dari...',
                                'jawaban' => 'Representational State Transfer',
                                'pengecoh' => [
                                    'Remote State Transfer',
                                    'Representational System Technology',
                                    'Request and State Transfer',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Method HTTP yang digunakan untuk mengambil data adalah...',
                                'jawaban' => 'GET',
                                'pengecoh' => [
                                    'POST',
                                    'PUT',
                                    'DELETE',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Status code HTTP 404 berarti...',
                                'jawaban' => 'Resource tidak ditemukan',
                                'pengecoh' => [
                                    'Permintaan berhasil',
                                    'Server mengalami error internal',
                                    'Akses ditolak',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Method PUT dalam REST API digunakan untuk...',
                                'jawaban' => 'Memperbarui resource yang sudah ada secara keseluruhan',
                                'pengecoh' => [
                                    'Membuat resource baru',
                                    'Menghapus resource',
                                    'Mengambil data resource',
                                ],
                            ],
                            [
                                'pertanyaan' => 'REST API sebaiknya bersifat stateless, artinya...',
                                'jawaban' => 'Setiap request memuat semua informasi yang diperlukan tanpa bergantung pada request sebelumnya',
                                'pengecoh' => [
                                    'Server menyimpan session pengguna',
                                    'API hanya bisa diakses satu kali dalam satu waktu',
                                    'Data tidak pernah berubah setelah dibuat',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Format pertukaran data yang umum digunakan pada REST API adalah...',
                                'jawaban' => 'JSON dan XML',
                                'pengecoh' => [
                                    'CSV dan TSV',
                                    'PDF dan DOC',
                                    'MP3 dan MP4',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Implementasi REST API',
                    'deskripsi' => 'Praktik implementasi REST API menggunakan framework Laravel.',
                    'tingkat' => 'Lanjutan',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Implementasi REST API',
                        'deskripsi' => 'Evaluasi kemampuan implementasi REST API.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Di Laravel, route untuk API didefinisikan di file...',
                                'jawaban' => 'routes/api.php',
                                'pengecoh' => [
                                    'routes/web.php',
                                    'routes/rest.php',
                                    'app/Http/api.php',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Method response()->json() di Laravel digunakan untuk...',
                                'jawaban' => 'Mengembalikan response dalam format JSON',
                                'pengecoh' => [
                                    'Mengubah JSON menjadi array PHP',
                                    'Memvalidasi input JSON',
                                    'Mengirim request JSON ke API eksternal',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Rate limiting pada API bertujuan untuk...',
                                'jawaban' => 'Membatasi jumlah request dari klien dalam periode waktu tertentu',
                                'pengecoh' => [
                                    'Meningkatkan kecepatan response API',
                                    'Mengenkripsi data yang dikirim',
                                    'Mengubah format data secara otomatis',
                                ],
                            ],
                            [
                                'pertanyaan' => 'API Resource Controller di Laravel menyediakan method untuk...',
                                'jawaban' => 'Menangani operasi CRUD standar secara otomatis',
                                'pengecoh' => [
                                    'Hanya menangani operasi GET',
                                    'Mengelola autentikasi API',
                                    'Membuat dokumentasi API otomatis',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Bearer token dalam autentikasi API dikirim melalui header...',
                                'jawaban' => 'Authorization',
                                'pengecoh' => [
                                    'Authentication',
                                    'X-Auth-Token',
                                    'Token',
                                ],
                            ],
                            [
                                'pertanyaan' => 'CORS (Cross-Origin Resource Sharing) diperlukan ketika...',
                                'jawaban' => 'API diakses dari domain yang berbeda dengan domain API',
                                'pengecoh' => [
                                    'API hanya digunakan oleh aplikasi mobile',
                                    'API menggunakan protokol HTTPS',
                                    'API tidak memerlukan autentikasi',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Validasi request pada API Laravel dapat dilakukan menggunakan...',
                                'jawaban' => 'Form Request atau method validate()',
                                'pengecoh' => [
                                    'Middleware cors',
                                    'Blade template',
                                    'Eloquent mutator',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // JSON
            // ================================================================
            'JSON' => [
                [
                    'judul' => 'JSON Data Format',
                    'deskripsi' => 'Mempelajari JSON sebagai format pertukaran data yang ringan dan mudah dibaca.',
                    'tingkat' => 'Dasar',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz JSON',
                        'deskripsi' => 'Uji pemahaman tentang format data JSON.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'JSON merupakan singkatan dari...',
                                'jawaban' => 'JavaScript Object Notation',
                                'pengecoh' => [
                                    'Java Standard Object Network',
                                    'JavaScript Online Notation',
                                    'Java Serialized Object Node',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Struktur data JSON terdiri dari...',
                                'jawaban' => 'Key-value pairs dan array',
                                'pengecoh' => [
                                    'Hanya array satu dimensi',
                                    'Tag pembuka dan penutup seperti XML',
                                    'Baris perintah yang dieksekusi berurutan',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Tipe data yang didukung JSON adalah...',
                                'jawaban' => 'String, number, boolean, null, object, dan array',
                                'pengecoh' => [
                                    'String, integer, float, char, dan date',
                                    'Hanya string dan number saja',
                                    'String, array, function, dan class',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Fungsi PHP untuk mengubah array menjadi JSON adalah...',
                                'jawaban' => 'json_encode()',
                                'pengecoh' => [
                                    'json_decode()',
                                    'json_parse()',
                                    'json_serialize()',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Keunggulan JSON dibandingkan XML adalah...',
                                'jawaban' => 'Format lebih ringkas dan parsing lebih cepat',
                                'pengecoh' => [
                                    'JSON mendukung namespace',
                                    'JSON memiliki fitur komentar',
                                    'JSON dapat menyimpan file binary',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // GIT & GITHUB
            // ================================================================
            'Git & GitHub' => [
                [
                    'judul' => 'Dasar Git',
                    'deskripsi' => 'Mempelajari perintah dasar Git untuk version control dalam pengembangan perangkat lunak.',
                    'tingkat' => 'Dasar',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Dasar Git',
                        'deskripsi' => 'Uji pemahaman tentang Git dasar.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Git adalah...',
                                'jawaban' => 'Sistem version control terdistribusi untuk melacak perubahan kode',
                                'pengecoh' => [
                                    'Platform hosting kode berbasis cloud',
                                    'IDE untuk pengembangan web',
                                    'Database untuk menyimpan riwayat proyek',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perintah untuk menginisialisasi repository Git adalah...',
                                'jawaban' => 'git init',
                                'pengecoh' => [
                                    'git start',
                                    'git create',
                                    'git new',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perintah untuk menambahkan file ke staging area adalah...',
                                'jawaban' => 'git add',
                                'pengecoh' => [
                                    'git commit',
                                    'git push',
                                    'git stage',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perintah untuk menyimpan perubahan ke repository lokal adalah...',
                                'jawaban' => 'git commit',
                                'pengecoh' => [
                                    'git save',
                                    'git push',
                                    'git store',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perintah untuk melihat status file dalam repository adalah...',
                                'jawaban' => 'git status',
                                'pengecoh' => [
                                    'git log',
                                    'git check',
                                    'git list',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Branching dan Kolaborasi',
                    'deskripsi' => 'Mempelajari strategi branching dan kolaborasi tim menggunakan Git dan GitHub.',
                    'tingkat' => 'Menengah',
                    'guru' => 2,
                    'quiz' => [[
                        'judul' => 'Quiz Branching Git',
                        'deskripsi' => 'Evaluasi pemahaman tentang branching dan kolaborasi Git.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Perintah untuk membuat branch baru adalah...',
                                'jawaban' => 'git branch <nama-branch>',
                                'pengecoh' => [
                                    'git create-branch <nama>',
                                    'git new <nama-branch>',
                                    'git checkout-branch <nama>',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perintah untuk berpindah ke branch lain adalah...',
                                'jawaban' => 'git checkout <nama-branch>',
                                'pengecoh' => [
                                    'git switch-branch <nama>',
                                    'git move <nama-branch>',
                                    'git change <nama-branch>',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Pull request digunakan untuk...',
                                'jawaban' => 'Meminta review dan penggabungan kode ke branch utama',
                                'pengecoh' => [
                                    'Mengunduh repository dari GitHub',
                                    'Menyimpan perubahan lokal sementara',
                                    'Menghapus branch yang tidak digunakan',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Ketika terjadi conflict saat merge, langkah yang tepat adalah...',
                                'jawaban' => 'Menyelesaikan conflict secara manual, lalu commit hasilnya',
                                'pengecoh' => [
                                    'Menghapus repository dan clone ulang',
                                    'Menggunakan git force untuk menimpa conflict',
                                    'Membatalkan merge dan membuat branch baru',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perintah git merge digunakan untuk...',
                                'jawaban' => 'Menggabungkan perubahan dari satu branch ke branch lain',
                                'pengecoh' => [
                                    'Membandingkan dua branch',
                                    'Menghapus branch yang sudah di-merge',
                                    'Menyimpan perubahan sementara',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Stash dalam Git berguna ketika...',
                                'jawaban' => 'Ingin menyimpan perubahan sementara tanpa commit untuk mengerjakan hal lain',
                                'pengecoh' => [
                                    'Menghapus semua perubahan yang belum di-track',
                                    'Membuat backup repository ke server eksternal',
                                    'Menggabungkan dua repository yang berbeda',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // LINUX
            // ================================================================
            'Linux' => [
                [
                    'judul' => 'Perintah Dasar Linux',
                    'deskripsi' => 'Mempelajari perintah-perintah dasar Linux untuk navigasi dan manipulasi file.',
                    'tingkat' => 'Dasar',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Linux Dasar',
                        'deskripsi' => 'Uji pemahaman tentang perintah dasar Linux.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Perintah untuk menampilkan daftar file dalam direktori adalah...',
                                'jawaban' => 'ls',
                                'pengecoh' => [
                                    'dir',
                                    'list',
                                    'show',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perintah untuk berpindah direktori adalah...',
                                'jawaban' => 'cd',
                                'pengecoh' => [
                                    'mv',
                                    'chdir',
                                    'goto',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perintah untuk membuat direktori baru adalah...',
                                'jawaban' => 'mkdir',
                                'pengecoh' => [
                                    'createdir',
                                    'newdir',
                                    'md',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perintah untuk menyalin file adalah...',
                                'jawaban' => 'cp',
                                'pengecoh' => [
                                    'copy',
                                    'mv',
                                    'clone',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perintah untuk melihat isi file teks adalah...',
                                'jawaban' => 'cat',
                                'pengecoh' => [
                                    'show',
                                    'read',
                                    'print',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Linux File System',
                    'deskripsi' => 'Memahami struktur file system Linux dan manajemen izin file.',
                    'tingkat' => 'Menengah',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Linux File System',
                        'deskripsi' => 'Evaluasi pemahaman tentang file system Linux.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Direktori root pada Linux dilambangkan dengan...',
                                'jawaban' => '/',
                                'pengecoh' => [
                                    '~',
                                    'C:',
                                    '/root',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Home direktori pengguna disimpan di...',
                                'jawaban' => '/home/nama_pengguna',
                                'pengecoh' => [
                                    '/users/nama_pengguna',
                                    '/usr/nama_pengguna',
                                    '/root/nama_pengguna',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perintah chmod 755 memberikan izin...',
                                'jawaban' => 'rwxr-xr-x (owner full, group dan other read-execute)',
                                'pengecoh' => [
                                    'rwxrwxrwx (semua full akses)',
                                    'r--r--r-- (semua hanya read)',
                                    'rwx------ (hanya owner full akses)',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Direktori /etc pada Linux berisi...',
                                'jawaban' => 'File konfigurasi sistem',
                                'pengecoh' => [
                                    'File binary eksekusi program',
                                    'Log sistem dan aplikasi',
                                    'Data pengguna',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Perintah untuk mengubah kepemilikan file adalah...',
                                'jawaban' => 'chown',
                                'pengecoh' => [
                                    'chmod',
                                    'chgrp',
                                    'owner',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Mount point pada Linux adalah...',
                                'jawaban' => 'Direktori tempat file system atau perangkat dipasang',
                                'pengecoh' => [
                                    'Titik backup sistem',
                                    'Lokasi penyimpanan temporary',
                                    'Alamat IP server',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],

            // ================================================================
            // JARINGAN KOMPUTER
            // ================================================================
            'Jaringan Komputer' => [
                [
                    'judul' => 'Dasar Jaringan Komputer',
                    'deskripsi' => 'Mempelajari konsep dasar jaringan komputer, topologi, dan protokol.',
                    'tingkat' => 'Dasar',
                    'guru' => 2,
                    'quiz' => [
                        [
                            'judul' => 'Quiz Jaringan Komputer',
                            'deskripsi' => 'Uji pemahaman tentang dasar jaringan komputer.',
                            'durasi' => 15,
                            'soal' => [
                                [
                                    'pertanyaan' => 'Jaringan yang mencakup area geografis luas seperti antar kota atau negara disebut...',
                                    'jawaban' => 'WAN (Wide Area Network)',
                                    'pengecoh' => [
                                        'LAN (Local Area Network)',
                                        'MAN (Metropolitan Area Network)',
                                        'PAN (Personal Area Network)',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Perangkat yang digunakan untuk menghubungkan dua jaringan berbeda adalah...',
                                    'jawaban' => 'Router',
                                    'pengecoh' => [
                                        'Switch',
                                        'Hub',
                                        'Bridge',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Protokol yang digunakan untuk pengiriman email adalah...',
                                    'jawaban' => 'SMTP',
                                    'pengecoh' => [
                                        'FTP',
                                        'HTTP',
                                        'DNS',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Alamat IP versi 4 terdiri dari...',
                                    'jawaban' => '32 bit yang dibagi menjadi 4 oktet',
                                    'pengecoh' => [
                                        '16 bit yang dibagi menjadi 2 oktet',
                                        '64 bit yang dibagi menjadi 8 oktet',
                                        '128 bit yang dibagi menjadi 16 oktet',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Topologi jaringan dimana semua node terhubung ke satu kabel utama disebut...',
                                    'jawaban' => 'Topologi Bus',
                                    'pengecoh' => [
                                        'Topologi Star',
                                        'Topologi Ring',
                                        'Topologi Mesh',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'judul' => 'Evaluasi Jaringan Komputer',
                            'deskripsi' => 'Evaluasi lanjutan tentang konsep jaringan komputer.',
                            'durasi' => 20,
                            'soal' => [
                                [
                                    'pertanyaan' => 'OSI Layer terdiri dari berapa lapisan?',
                                    'jawaban' => '7 lapisan',
                                    'pengecoh' => [
                                        '4 lapisan',
                                        '5 lapisan',
                                        '6 lapisan',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'TCP berfungsi pada layer...',
                                    'jawaban' => 'Transport',
                                    'pengecoh' => [
                                        'Network',
                                        'Application',
                                        'Session',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Protokol DHCP berfungsi untuk...',
                                    'jawaban' => 'Memberikan alamat IP secara otomatis ke perangkat dalam jaringan',
                                    'pengecoh' => [
                                        'Menerjemahkan nama domain ke alamat IP',
                                        'Mengirim halaman web ke browser',
                                        'Mengamankan koneksi jaringan',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Subnet mask 255.255.255.0 menunjukkan jumlah host maksimal...',
                                    'jawaban' => '254 host',
                                    'pengecoh' => [
                                        '128 host',
                                        '512 host',
                                        '1024 host',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'Firewall dalam jaringan berfungsi untuk...',
                                    'jawaban' => 'Menyaring lalu lintas jaringan berdasarkan aturan keamanan',
                                    'pengecoh' => [
                                        'Mempercepat koneksi internet',
                                        'Menyimpan data cache jaringan',
                                        'Mendistribusikan beban jaringan',
                                    ],
                                ],
                                [
                                    'pertanyaan' => 'NAT (Network Address Translation) digunakan untuk...',
                                    'jawaban' => 'Menerjemahkan alamat IP privat ke IP publik',
                                    'pengecoh' => [
                                        'Mengenkripsi data dalam jaringan',
                                        'Membagi bandwidth secara merata',
                                        'Mendeteksi virus dalam paket data',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],

            // ================================================================
            // REKAYASA PERANGKAT LUNAK
            // ================================================================
            'Rekayasa Perangkat Lunak' => [
                [
                    'judul' => 'Metodologi Pengembangan Perangkat Lunak',
                    'deskripsi' => 'Mempelajari berbagai metodologi pengembangan perangkat lunak seperti Waterfall, Agile, dan Scrum.',
                    'tingkat' => 'Menengah',
                    'guru' => 0,
                    'quiz' => [[
                        'judul' => 'Quiz Metodologi RPL',
                        'deskripsi' => 'Uji pemahaman tentang metodologi pengembangan perangkat lunak.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Model pengembangan perangkat lunak yang bersifat linear dan berurutan adalah...',
                                'jawaban' => 'Waterfall',
                                'pengecoh' => [
                                    'Agile',
                                    'Scrum',
                                    'Prototype',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Sprint dalam metodologi Scrum berdurasi...',
                                'jawaban' => '1-4 minggu',
                                'pengecoh' => [
                                    '1-2 hari',
                                    '1-3 bulan',
                                    '6-12 bulan',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Product Owner dalam Scrum bertanggung jawab untuk...',
                                'jawaban' => 'Mengelola product backlog dan memprioritaskan fitur',
                                'pengecoh' => [
                                    'Memimpin tim pengembang',
                                    'Menguji kualitas perangkat lunak',
                                    'Menulis dokumentasi teknis',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Prinsip utama dalam Agile Manifesto adalah...',
                                'jawaban' => 'Individu dan interaksi lebih penting dari proses dan alat',
                                'pengecoh' => [
                                    'Dokumentasi yang lengkap lebih penting dari perangkat lunak berfungsi',
                                    'Kontrak negosiasi lebih penting dari kolaborasi pelanggan',
                                    'Mengikuti rencana lebih penting dari merespon perubahan',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Tahap pertama dalam model Waterfall adalah...',
                                'jawaban' => 'Analisis kebutuhan',
                                'pengecoh' => [
                                    'Desain sistem',
                                    'Implementasi',
                                    'Pengujian',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Daily stand-up dalam Scrum adalah...',
                                'jawaban' => 'Pertemuan singkat harian untuk membahas progres dan hambatan',
                                'pengecoh' => [
                                    'Pertemuan mingguan untuk evaluasi sprint',
                                    'Pertemuan awal proyek untuk perencanaan',
                                    'Pertemuan akhir sprint untuk retrospektif',
                                ],
                            ],
                        ],
                    ]],
                ],
                [
                    'judul' => 'Pengujian Perangkat Lunak',
                    'deskripsi' => 'Mempelajari jenis-jenis pengujian perangkat lunak untuk memastikan kualitas aplikasi.',
                    'tingkat' => 'Menengah',
                    'guru' => 1,
                    'quiz' => [[
                        'judul' => 'Quiz Pengujian Perangkat Lunak',
                        'deskripsi' => 'Evaluasi pemahaman tentang pengujian perangkat lunak.',
                        'durasi' => 15,
                        'soal' => [
                            [
                                'pertanyaan' => 'Unit testing bertujuan untuk...',
                                'jawaban' => 'Menguji unit atau komponen terkecil dari perangkat lunak secara terisolasi',
                                'pengecoh' => [
                                    'Menguji seluruh sistem secara end-to-end',
                                    'Menguji antarmuka pengguna',
                                    'Menguji performa aplikasi',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Pengujian yang dilakukan oleh pengguna akhir dalam lingkungan nyata disebut...',
                                'jawaban' => 'User Acceptance Testing (UAT)',
                                'pengecoh' => [
                                    'Integration Testing',
                                    'System Testing',
                                    'Regression Testing',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Black box testing berfokus pada...',
                                'jawaban' => 'Fungsionalitas sistem tanpa melihat kode internal',
                                'pengecoh' => [
                                    'Struktur kode dan logika internal',
                                    'Kinerja dan skalabilitas sistem',
                                    'Keamanan aplikasi',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Regression testing dilakukan untuk...',
                                'jawaban' => 'Memastikan perubahan baru tidak merusak fitur yang sudah ada',
                                'pengecoh' => [
                                    'Menguji sistem pada beban maksimal',
                                    'Menguji instalasi perangkat lunak',
                                    'Menguji kompatibilitas browser',
                                ],
                            ],
                            [
                                'pertanyaan' => 'TDD (Test Driven Development) adalah praktik dimana...',
                                'jawaban' => 'Test ditulis sebelum kode implementasi',
                                'pengecoh' => [
                                    'Kode ditulis sebelum test',
                                    'Test dan kode ditulis secara bersamaan',
                                    'Test ditulis setelah aplikasi selesai',
                                ],
                            ],
                            [
                                'pertanyaan' => 'Pengujian yang memeriksa bagaimana komponen bekerja sama disebut...',
                                'jawaban' => 'Integration Testing',
                                'pengecoh' => [
                                    'Unit Testing',
                                    'System Testing',
                                    'Alpha Testing',
                                ],
                            ],
                        ],
                    ]],
                ],
            ],
        ];
    }
}
