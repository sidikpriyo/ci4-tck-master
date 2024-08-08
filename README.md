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

```
| Method | Route                      | Handler                                                      | Before Filters | After Filters |
|--------|----------------------------|--------------------------------------------------------------|----------------|---------------|
| GET    | /                          | (Closure)                                                    |                |               |
| GET    | check                      | \App\Controllers\Home::tester                                | login          |               |
| GET    | dashboard                  | \App\Controllers\Home::index                                 | login          |               |
| GET    | auth-groups                | \App\Controllers\AuthGroupController::index                  | login          |               |
| GET    | auth-groups/new            | \App\Controllers\AuthGroupController::new                    | login          |               |
| GET    | auth-groups/(.*)/edit      | \App\Controllers\AuthGroupController::edit/$1                | login          |               |
| GET    | auth-groups/(.*)           | \App\Controllers\AuthGroupController::show/$1                | login          |               |
| GET    | auth-permissions           | \App\Controllers\AuthPermissionController::index             | login          |               |
| GET    | auth-permissions/new       | \App\Controllers\AuthPermissionController::new               | login          |               |
| GET    | auth-permissions/(.*)/edit | \App\Controllers\AuthPermissionController::edit/$1           | login          |               |
| GET    | auth-permissions/(.*)      | \App\Controllers\AuthPermissionController::show/$1           | login          |               |
| GET    | users                      | \App\Controllers\UserController::index                       | login          |               |
| GET    | users/new                  | \App\Controllers\UserController::new                         | login          |               |
| GET    | users/(.*)/edit            | \App\Controllers\UserController::edit/$1                     | login          |               |
| GET    | users/(.*)                 | \App\Controllers\UserController::show/$1                     | login          |               |
| GET    | login                      | \Myth\Auth\Controllers\AuthController::login                 |                |               |
| GET    | logout                     | \Myth\Auth\Controllers\AuthController::logout                |                |               |
| GET    | register                   | \Myth\Auth\Controllers\AuthController::register              |                |               |
| GET    | activate-account           | \Myth\Auth\Controllers\AuthController::activateAccount       |                |               |
| GET    | resend-activate-account    | \Myth\Auth\Controllers\AuthController::resendActivateAccount |                |               |
| GET    | forgot                     | \Myth\Auth\Controllers\AuthController::forgotPassword        |                |               |
| GET    | reset-password             | \Myth\Auth\Controllers\AuthController::resetPassword         |                |               |
| POST   | auth-groups                | \App\Controllers\AuthGroupController::create                 | login          |               |
| POST   | auth-permissions           | \App\Controllers\AuthPermissionController::create            | login          |               |
| POST   | users                      | \App\Controllers\UserController::create                      | login          |               |
| POST   | login                      | \Myth\Auth\Controllers\AuthController::attemptLogin          |                |               |
| POST   | register                   | \Myth\Auth\Controllers\AuthController::attemptRegister       |                |               |
| POST   | forgot                     | \Myth\Auth\Controllers\AuthController::attemptForgot         |                |               |
| POST   | reset-password             | \Myth\Auth\Controllers\AuthController::attemptReset          |                |               |
| PATCH  | auth-groups/(.*)           | \App\Controllers\AuthGroupController::update/$1              | login          |               |
| PATCH  | auth-permissions/(.*)      | \App\Controllers\AuthPermissionController::update/$1         | login          |               |
| PATCH  | users/(.*)                 | \App\Controllers\UserController::update/$1                   | login          |               |
| PUT    | auth-groups/(.*)           | \App\Controllers\AuthGroupController::update/$1              | login          |               |
| PUT    | auth-permissions/(.*)      | \App\Controllers\AuthPermissionController::update/$1         | login          |               |
| PUT    | users/(.*)                 | \App\Controllers\UserController::update/$1                   | login          |               |
| DELETE | auth-groups/(.*)           | \App\Controllers\AuthGroupController::delete/$1              | login          |               |
| DELETE | auth-permissions/(.*)      | \App\Controllers\AuthPermissionController::delete/$1         | login          |               |
| DELETE | users/(.*)                 | \App\Controllers\UserController::delete/$1                   | login          |               |

```

## Template

Lihat demo dan dokumentasi template yang digunakan :

1. Demo : [themewagon/kaiadmin-lite](https://themewagon.github.io/kaiadmin-lite/)
1. GitHub : [kaiadmin-lite](https://github.com/Hizrian/kaiadmin-lite)

## Auth

Lihat dokumentasi auth : [myAuth](https://github.com/lonnieezell/myth-auth)

```

```
