# SIPINTER

**Sistem Informasi Pendidikan Interaktif Berbasis Web untuk Mendukung Pendidikan Berkualitas**

SIPINTER merupakan aplikasi pembelajaran berbasis web yang memungkinkan guru mengelola materi dan kuis, serta membantu siswa mempelajari materi, mengerjakan kuis, dan memantau perkembangan belajar mereka.

Aplikasi ini dikembangkan sebagai proyek **IT Bootcamp Kelompok 10**.

---

## ✨ Fitur Utama

### 👨‍💼 Admin

- Login dan logout
- Mengelola pengguna
- Mengelola jenjang pendidikan
- Mengelola kategori materi
- Mengelola materi pembelajaran
- Mengelola kuis dan soal
- Melihat statistik penggunaan aplikasi
- Melihat laporan aktivitas siswa

### 👨‍🏫 Guru

- Login dan logout
- Membuat, mengubah, dan menghapus materi
- Mengunggah file materi
- Membuat kuis untuk materi
- Menambahkan soal dan pilihan jawaban
- Mempublikasikan materi
- Melihat hasil pengerjaan kuis siswa

### 👨‍🎓 Siswa

- Login dan logout
- Melihat materi yang dipublikasikan
- Mengerjakan kuis
- Mendapatkan skor dan bintang
- Melihat riwayat pengerjaan kuis
- Memantau progres pembelajaran

---

## 🛠️ Teknologi yang Digunakan

- PHP 8.2+
- Laravel 12
- MySQL
- Bootstrap 5
- Blade Template Engine
- Laravel Authentication
- Laravel Eloquent ORM

---

## 📂 Struktur Proyek

```text
app/
database/
public/
resources/
├── views/
│   ├── auth/
│   ├── dashboard/
│   ├── layouts/
│   └── student/
routes/
storage/
```

---

## ⚙️ Instalasi

Clone repository

```bash
git clone https://github.com/MIkhsanB546/SIPINTER.git
cd SIPINTER
```

Install dependency

```bash
composer install
```

Salin file environment

Linux/MacOS

```bash
cp .env.example .env
```

Windows

```cmd
copy .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Konfigurasikan database pada file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306

DB_DATABASE=db_sipinter
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migrasi dan seeder

```bash
php artisan migrate:fresh --seed
```

Buat symbolic link untuk penyimpanan file

```bash
php artisan storage:link
```

Jalankan server

```bash
php artisan serve
```

Akses aplikasi melalui:

```text
http://127.0.0.1:8000
```

---

## 👥 Anggota Kelompok 10

| NIM      | Nama                       |
| -------- | -------------------------- |
| 19240557 | Muhammad Fariz Kurnia Rizq |
| 19241155 | Muhammad Rafi Robbani      |
| 19240817 | Ghiffari Nasrallah Zein    |
| 19241212 | Khalid Aflaha              |
| 19240452 | Muhammad Ikhsan Basuki     |
| 19240350 | Rafi Ibnu Kautsar          |
| 19241055 | Nazwa Nur Rochman          |
| 19241094 | Annisa Rahmadania          |
| 19242262 | Mohamad Yoga Ramadhan      |

---

## 📄 Lisensi

Proyek ini dikembangkan untuk keperluan akademik dan pembelajaran pada kegiatan IT Bootcamp.
