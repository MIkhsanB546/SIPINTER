# SIPINTAR

**Sistem Informasi Pendidikan Interaktif Berbasis Web untuk Mendukung Pendidikan Berkualitas**

SIPINTAR merupakan aplikasi pembelajaran berbasis web yang memungkinkan guru untuk mengelola materi dan kuis, serta membantu siswa mempelajari materi, mengerjakan kuis, dan memantau perkembangan belajar mereka.

Aplikasi ini dikembangkan sebagai proyek **IT Bootcamp Kelompok 10**.

---

## ✨ Fitur Utama

### Admin

- Login dan logout
- Mengelola data pengguna
- Mengelola data jenjang pendidikan
- Mengelola kategori materi
- Melihat statistik penggunaan aplikasi

### Guru

- Registrasi dan login
- Membuat, mengubah, dan menghapus materi pembelajaran
- Membuat kuis untuk setiap materi
- Menambahkan soal dan pilihan jawaban
- Melihat hasil pengerjaan kuis siswa

### Siswa

- Registrasi dan login
- Melihat materi pembelajaran
- Mengerjakan kuis
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
git clone <url-repository>
cd sipintar
```

Install dependency

```bash
composer install
```

Salin file environment

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Konfigurasikan database pada file `.env`

```env
DB_DATABASE=db_sipintar
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migrasi dan seeder

```bash
php artisan migrate:fresh --seed
```

Buat symbolic link storage

```bash
php artisan storage:link
```

Jalankan server

```bash
php artisan serve
```

Aplikasi dapat diakses melalui

```text
http://localhost:8000
```

---

## 👥 Anggota Kelompok 10

- 19240557 — Muhammad Fariz Kurnia Rizq
- 19241155 — Muhammad Rafi Robbani
- 19240817 — Ghiffari Nasrallah Zein
- 19241212 — Khalid Aflaha
- 19240452 — Muhammad Ikhsan Basuki
- 19240350 — Rafi Ibnu Kautsar
- 19241055 — Nazwa Nur Rochman
- 19241094 — Annisa Rahmadania
- 19242262 — Mohamad Yoga Ramadhan

---

## 📄 Lisensi

Proyek ini dikembangkan untuk keperluan akademik dan pembelajaran pada kegiatan IT Bootcamp.
