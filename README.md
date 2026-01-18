<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# Sistem Akademik Kampus (Laravel + Sanctum + Blade + TailwindCSS)

Selamat datang di repository **Sistem Akademik Kampus**, sebuah project belajar saya yang dibuat dengan Laravel 12.  

> Mohon dimaklumi, ini masih tahap belajar. Masih banyak hal yang bisa diperbaiki dan dikembangkan. 😊

---

## Deskripsi

Website ini bertujuan untuk **mengelola data mahasiswa dan dosen** di kampus. Fitur-fitur utama meliputi:

- **Login & Logout** menggunakan Laravel Sanctum (session-based auth)
- **Dashboard** interaktif dengan statistik mahasiswa & dosen
- **CRUD Mahasiswa & Dosen** (hanya untuk admin)
- Tampilan frontend dengan **Blade + TailwindCSS**  
- Responsif dan modern untuk desktop & mobile

---

## Screenshot

### Halaman Login
![Login Page](https://github.com/HariisDermawan/Sistem-Informasi-Akademik-RestApi/blob/main/public/img/log.png)

### Dashboard
![Dashboard](https://github.com/HariisDermawan/Sistem-Informasi-Akademik-RestApi/blob/main/public/img/dash.png)

---

---

## Instalasi & Jalankan Aplikasi (All-in-One)

Ikuti langkah berikut untuk setup project dari awal sampai siap digunakan:

1. **Clone repository & masuk ke folder**

```bash
git clone https://github.com/username/sistem-akademik-kampus.git
cd sistem-akademik-kampus
---
Install dependencies :

composer install
npm install
npm run dev

Setup environment (.env)

cp .env.example .env
# Sesuaikan konfigurasi database:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=
# DB_USERNAME=
# DB_PASSWORD=
php artisan key:generate


Migrasi database & seed

php artisan migrate
# php artisan db:seed   (jika ingin data dummy)

php artisan serve






