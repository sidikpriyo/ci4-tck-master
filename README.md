# Master Aplikasi CodeIgniter 4

Repositori ini adalah setup master aplikasi untuk kebutuhan pembuatan aplikasi di Fakultas Kedokteran, Kesehatan Masyarakat, dan Keperawatan Universitas Gadjah Mada.

## Daftar Isi

- [Installation](#installation)
- [Configuration](#configuration)
- [Seeding the Database](#seeding-the-database)
- [Routes](#routes)
- [Templates](#templates)
- [Auth](#auth)

## Installation

Langkah-langkah untuk menginstal proyek Anda.

1. Clone repositori ini:

   ```sh
   git clone https://github.com/sidikpriyo/ci4-tck-master.git
   cd project
   ```

2. Install dependencies dengan Composer:

   ```sh
   composer install
   ```

3. Salin `.env.example` ke `.env` dan sesuaikan pengaturannya:

   ```sh
   cp .env.example .env
   ```

4. Buat kunci enkripsi aplikasi:
   ```sh
   php spark key:generate
   ```

## Configuration

Lakukan konfigurasi file .env. Atur konfigirasi database dan konfigurasi environment.

- **Database**: Pastikan Anda telah mengatur koneksi database di file `.env`:
  ```
  database.default.hostname = localhost
  database.default.database = yourdatabase
  database.default.username = yourusername
  database.default.password = yourpassword
  database.default.DBDriver = MySQLi
  ```

## Seeding the Database

Langkah-langkah untuk menjalankan seeder dan mengisi database dengan data awal:

1. Melakukan migrasi database:

   ```sh
   php spark migrate --all
   ```

2. Jalankan Database Seeder:

   ```sh
   php spark db:seed DatabaseSeeder
   ```

3. Jalankan aplikasi:

   ```sh
   php spark serve
   ```

4. Opsional: menjalankan aplikasi menggunakan ip:
   ```sh
   php spark serve --host *your_ip_address* --port 8000
   ```

## Routes

Daftar semua rute yang tersedia di aplikasi Anda.

```php
$routes->get('/dashboard', 'Home::index');
$routes->resource('auth-groups', ['controller' => 'AuthGroupController']);
$routes->resource('auth-permissions', ['controller' => 'AuthPermissionController']);
$routes->resource('users', ['controller' => 'UserController']);
```
