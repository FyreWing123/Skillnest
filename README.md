# SkillNest

Platform jasa mahasiswa berbakat untuk membantu UMKM dan bisnis berkembang secara digital.

## Requirement

- PHP >= 8.2
- Composer
- Node.js >= 18 & npm
- MySQL
- XAMPP / Laragon / WAMP (atau MySQL server lainnya)

## Setup

### 1. Clone repository

```bash
git clone <url-repo> skillnest
cd skillnest
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Buat file `.env`

```bash
cp .env.example .env
```

### 4. Generate app key

```bash
php artisan key:generate
```

### 5. Buat database

Buat database MySQL bernama `skillnest`:

```sql
CREATE DATABASE skillnest CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Atau lewat phpMyAdmin: buat database baru dengan nama `skillnest`.

### 6. Sesuaikan `.env`

Buka file `.env`, sesuaikan bagian database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=skillnest
DB_USERNAME=root
DB_PASSWORD=        # isi jika MySQL kamu pakai password
```

### 7. Jalankan migrasi + seeder

```bash
php artisan migrate --seed
```

Perintah ini akan membuat semua tabel **dan** membuat 2 akun sample:

| Role       | Email                  | Password  |
|------------|------------------------|-----------|
| Mahasiswa  | mahasiswa@skillnest.id | password  |
| UMKM       | umkm@skillnest.id      | password  |

### 8. Jalankan aplikasi

Butuh **dua terminal** yang berjalan bersamaan:

**Terminal 1 — Laravel server:**
```bash
php artisan serve
```

**Terminal 2 — Vite (CSS/JS):**
```bash
npm run dev
```

Buka browser di `http://localhost:8000`

---

## Struktur Role

| Role       | Akses Dashboard          |
|------------|--------------------------|
| mahasiswa  | `/dashboard-mahasiswa`   |
| umkm       | `/dashboard-umkm`        |

Setelah login, redirect otomatis sesuai role masing-masing.
