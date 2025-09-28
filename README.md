<p align="center">
    <a href="#" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/H4ntz-M4d/project-file-archive/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://github.com/H4ntz-M4d/project-file-archive">
        <img src="https://img.shields.io/github/stars/H4ntz-M4d/project-file-archive" alt="Stars">
    </a>
    <a href="https://github.com/H4ntz-M4d/project-file-archive">
        <img src="https://img.shields.io/github/forks/H4ntz-M4d/project-file-archive" alt="Forks">
    </a>
    <a href="https://opensource.org/licenses/MIT">
        <img src="https://img.shields.io/badge/license-MIT-green" alt="License">
    </a>
</p>

---

# 📁 Project File Archive

**Project File Archive** adalah aplikasi manajemen arsip berbasis **Laravel** yang memungkinkan pengguna untuk menyimpan, mengelola, dan mencari arsip file atau surat dengan mudah.
Aplikasi ini mendukung deployment berbasis **Docker** maupun **lingkungan PHP lokal** seperti XAMPP.

---

## 🎯 Tujuan Proyek

* Mempermudah pengarsipan dokumen secara digital.
* Memberikan antarmuka yang sederhana dan mudah digunakan.
* Memastikan arsip tetap rapi, terstruktur, dan mudah diakses.
* Mendukung dua metode deployment: **Docker** dan **native Laravel (XAMPP)**.

---

## 🚀 Fitur Utama

* Upload dan manajemen file arsip.
* Pencarian arsip berdasarkan metadata.
* Manajemen kategori arsip.
* Unduh dan hapus arsip.
* Database siap pakai dengan file `db-arsip-surat.sql`.
* Dukungan containerisasi melalui `docker-compose.yml`.

---

## 🧩 Struktur Direktori

Struktur utama proyek ini:

```
project-file-archive/
│
├── app/                # Core logic aplikasi Laravel
├── bootstrap/
├── config/             # File konfigurasi Laravel
├── database/
│   └── migrations/     # File migrasi database
├── public/             # Root public web server
├── resources/
│   ├── views/          # Blade templates
│   └── js/             # File frontend (JS/Vite)
├── routes/             # Routing aplikasi
├── storage/            # File yang di-generate oleh Laravel
├── tests/              # Unit & Feature tests
│
├── docker-compose.yml  # Docker configuration
├── composer.json
├── .env.example
└── db-arsip-surat.sql  # Contoh database arsip
```

---

## 🛠 Persiapan Awal

1. Clone repository:

   ```bash
   git clone https://github.com/H4ntz-M4d/project-file-archive.git
   cd project-file-archive
   ```

2. Salin file `.env.example` menjadi `.env`:

   ```bash
   cp .env.example .env
   ```

3. Install dependencies PHP menggunakan Composer:

   ```bash
   composer install
   ```

4. Sesuaikan konfigurasi `.env`:

   ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db-arsip-surat
    DB_USERNAME=ince
    DB_PASSWORD=
   ```
   *(optional: sesuaikan env dengan yang ada di dalam docker-compose.yml jika ingin menggunakan docker)*

5. Generate application key:

   ```bash
   php artisan key:generate
   ```

---

## 🐳 Menjalankan dengan Docker

Proyek ini sudah memiliki konfigurasi **Docker** untuk memudahkan pengaturan lingkungan development.

1. Pastikan **Docker** dan **Docker Compose** sudah terinstal.

2. Jalankan container:

   ```bash
   docker-compose up -d
   ```

3. Cek daftar container yang berjalan:

   ```bash
   docker ps
   ```

4. Masuk ke container Laravel:

   ```bash
   docker exec -it arsip-surat-laravel bash
   ```

5. Jalankan migrasi database (opsional, jika tidak menggunakan `db-arsip-surat.sql`) dan jangan lupa jalankan agar bisa upload file storage link:

   ```bash
   php artisan key:generate (jika belum dilakukan pembuatan key di awal setelah composer install)
   php artisan migrate
   php artisan storage:link
   ```

6. Akses aplikasi di browser melalui:

   ```
   http://localhost:5005
   ```

   *(port bisa berbeda, sesuaikan dengan konfigurasi di `docker-compose.yml`)*

---

## 💻 Menjalankan Tanpa Docker (XAMPP / PHP Lokal)

1. Pastikan **XAMPP**, **PHP**, dan **Composer** sudah terinstal.
2. Letakkan folder proyek atau clone di dalam folder `htdocs` (misalnya: `C:\xampp\htdocs\project-file-archive`).
3. Buat database baru melalui **phpMyAdmin**.
4. Import file SQL `db-arsip-surat.sql` yang ada di root proyek.
5. Sesuaikan konfigurasi `.env`:

   ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db-arsip-surat
    DB_USERNAME=ince
    DB_PASSWORD=
   ```
6. Jalankan perintah berikut di terminal:

   ```bash
   composer install
   php artisan key:generate
   php artisan migrate (opsional, jika tidak menggunakan `db-arsip-surat.sql`)
   php artisan storage:link
   php artisan serve
   ```
7. Buka aplikasi di browser:

   ```
   http://localhost:8000
   ```

---

## 📷 Screenshot

| Halaman      | Tampilan                                      |
| ------------ | --------------------------------------------  |
| View Arsip   | ![View Arsip](docs/screenshots/dashboard.png) |
| Tambah Arsip | ![Tambah Arsip](docs/screenshots/upload.png)  |
| Daftar Arsip | ![Daftar Arsip](docs/screenshots/list.png)    |


---

## ⚙️ Tips & Catatan Tambahan

* Pastikan folder `storage` dan `bootstrap/cache` memiliki permission write:

  ```bash
  chmod -R 775 storage bootstrap/cache
  ```
* Jika ada error cache, jalankan:

  ```bash
  php artisan config:clear
  php artisan cache:clear
  php artisan route:clear
  ```

---

## 📜 License

Proyek ini dirilis dengan lisensi [MIT](https://opensource.org/licenses/MIT).
