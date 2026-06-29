# SIPINTER

**Sistem Informasi Pendidikan Interaktif Berbasis Web untuk Mendukung Pendidikan Berkualitas**

SIPINTER merupakan aplikasi pembelajaran berbasis web yang memungkinkan guru mengelola materi dan kuis, siswa mempelajari materi dan mengerjakan kuis, serta orang tua memantau perkembangan belajar anak.

Aplikasi ini dikembangkan sebagai proyek **IT Bootcamp Kelompok 10**.

---

# Screenshots

![Landing Page](screenshots/Landing%20page.png)
![Login](screenshots/Login.png)
![Dashboard Siswa](screenshots/Dashboard%20siswa.png)
![Dashboard Guru](screenshots/Dashboard%20guru.png)

---

# ✨ Fitur Utama

## 👨‍💼 Admin

- Login dan logout
- Dashboard statistik aplikasi
- Mengelola pengguna (Admin, Guru, Siswa, Orang Tua)
- Mengelola tingkat kesulitan
- Mengelola kategori materi
- Mengelola seluruh materi
- Mengelola seluruh kuis
- Mengelola soal kuis
- Melihat laporan aktivitas siswa
- Mengelola profil akun

---

## 👨‍🏫 Guru

- Login dan logout
- Dashboard guru
- Membuat, mengubah, dan menghapus materi
- Upload file materi (PDF)
- Menambahkan kategori dan tingkat kesulitan pada materi
- Publish dan unpublish materi
- Membuat kuis
- Menambahkan soal beserta pilihan jawaban
- Melihat hasil pengerjaan kuis siswa
- Mengelola profil akun
- Menghapus akun sendiri
- Generate ringkasan materi menggunakan AI Gemini dari file PDF
- Generate kuis pilihan ganda menggunakan AI Gemini dari file PDF
- Memberikan instruksi tambahan (prompt) kepada AI saat membuat kuis
- Meninjau dan mengedit hasil AI sebelum dipublikasikan

---

## 👨‍🎓 Siswa

- Login dan logout
- Dashboard pembelajaran
- Melihat rekomendasi materi
- Melihat materi yang telah disimpan
- Menjelajahi materi berdasarkan guru
- Menyimpan materi ke daftar belajar
- Membaca materi pembelajaran
- Mengerjakan kuis
- Melihat skor dan peringkat bintang
- Melihat riwayat pengerjaan kuis
- Melihat progres pembelajaran
- Mengelola profil akun
- Mengunggah avatar

---

## 👨‍👩‍👧 Orang Tua

- Login dan logout
- Dashboard orang tua
- Menghubungkan akun anak menggunakan email dan password anak
- Melihat daftar anak yang terhubung
- Memantau progres belajar anak
- Melihat hasil kuis anak
- Mengelola profil akun
- Menghapus akun sendiri

---

# 🚀 Fitur Sistem

- Multi Role Authentication
- Dashboard berbeda sesuai role
- Upload file materi PDF
- Sistem publish materi
- Progress belajar siswa
- Quiz dengan penilaian otomatis
- Riwayat pengerjaan quiz
- Avatar pengguna
- Responsive Design
- Dark Mode (Admin Dashboard)
- DataTables untuk tabel admin
- Role-based Authorization menggunakan Laravel Gates & Policies
- Storage file menggunakan Laravel Storage
- Asset management menggunakan Vite
- AI-generated material summary menggunakan Google Gemini
- AI-generated multiple choice quiz dari materi PDF
- Prompt kustom untuk pembuatan kuis oleh guru
- Preview hasil AI sebelum disimpan

---

# 🛠️ Teknologi yang Digunakan

## Backend

- PHP 8.4+
- Laravel 12
- Laravel Eloquent ORM
- Laravel Authentication
- Laravel Gates & Policies
- Google Gemini API
- Laravel HTTP Client
- Smalot PDF Parser
- MySQL

## Frontend

- Blade Template Engine
- Bootstrap 5
- Tailwind CSS 4
- AdminLTE 4
- Alpine.js
- Bootstrap Icons
- DataTables
- OverlayScrollbars

## Build Tools

- Vite
- npm
- Composer

---

# ⚙️ Instalasi

## Clone Repository

```bash
git clone https://github.com/MIkhsanB546/SIPINTER.git

cd SIPINTER
```

---

## Install Dependency PHP

Dependency PHP akan menginstal package berikut secara otomatis:

- Laravel Framework
- Laravel Socialite
- DomPDF
- Smalot PDF Parser
- dan dependency lainnya

```bash
composer install
```

---

## Install Dependency Frontend

```bash
npm install
```

---

## Salin Environment

Linux / macOS

```bash
cp .env.example .env
```

Windows

```cmd
copy .env.example .env
```

---

## Generate Application Key

```bash
php artisan key:generate
```

---

## Konfigurasi Database

Edit file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306

DB_DATABASE=db_sipinter
DB_USERNAME=root
DB_PASSWORD=
```

## Konfigurasi Google OAuth (Opsional)

Jika ingin menggunakan fitur **Login dengan Google**, tambahkan konfigurasi berikut pada file `.env`:

```env
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URL=http://127.0.0.1:8000/auth/google/callback
```

### Membuat Google OAuth Client

1. Buka **Google Cloud Console**.
2. Buat project baru atau gunakan project yang sudah ada.
3. Aktifkan **Google Identity / OAuth API**.
4. Masuk ke **APIs & Services → Credentials**.
5. Pilih **Create Credentials → OAuth Client ID**.
6. Pilih tipe aplikasi **Web application**.
7. Tambahkan URL berikut:

**Authorized JavaScript Origins**

```text
http://127.0.0.1:8000
```

**Authorized Redirect URIs**

```text
http://127.0.0.1:8000/auth/google/callback
```

8. Salin **Client ID** dan **Client Secret** ke file `.env`.

> **Catatan:** Jika menggunakan domain lain (misalnya deployment atau ngrok), tambahkan domain tersebut ke **Authorized JavaScript Origins** dan **Authorized Redirect URIs**, lalu sesuaikan nilai `GOOGLE_REDIRECT_URL`.

## Konfigurasi Gemini AI

Fitur AI digunakan untuk:

- Membuat ringkasan materi secara otomatis dari file PDF
- Membuat kuis pilihan ganda berdasarkan isi materi PDF

Tambahkan konfigurasi berikut pada file `.env`:

```env
GEMINI_API_KEY=your-gemini-api-key
GEMINI_MODEL=gemini-2.5-flash
```

### Mendapatkan API Key Gemini

1. Buka Google AI Studio.
2. Login menggunakan akun Google.
3. Pilih **Get API Key**.
4. Buat API Key baru.
5. Salin API Key ke variabel `GEMINI_API_KEY`.

> Pastikan API Key memiliki akses ke model yang digunakan pada `GEMINI_MODEL`.

---

## Migrasi Database

```bash
php artisan migrate:fresh --seed
```

---

## Storage Link

```bash
php artisan storage:link
```

---

## Build Asset Frontend

```bash
npm run build
```

---

## Bersihkan Cache

```bash
php artisan optimize:clear
```

---

## Jalankan Aplikasi

```bash
php artisan serve
```

Akses aplikasi pada:

```
http://127.0.0.1:8000
```

---

# 🔄 Update Project

Jika sudah pernah meng-clone repository dan ingin mengambil perubahan terbaru:

## Ambil perubahan

```bash
git pull origin main
```

## Install dependency baru (jika ada)

```bash
composer install

npm install
```

## Jalankan migration baru (jika ada)

```bash
php artisan migrate
```

## Build ulang asset

```bash
npm run build
```

## Bersihkan cache

```bash
php artisan optimize:clear
```

## Jalankan aplikasi

```bash
php artisan serve
```

---

# 👥 Anggota Kelompok 10

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

# 📄 Lisensi

Proyek ini dikembangkan untuk keperluan akademik dan pembelajaran pada kegiatan **IT Bootcamp Kelompok 10**.
