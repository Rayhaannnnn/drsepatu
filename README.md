# Dr. Sepatu - Shoes Cleaning Service Web App

Aplikasi web manajemen jasa cuci sepatu berbasis Laravel.

## 🚀 Panduan Menjalankan Project (Untuk Teman / Collaborator)

Ikuti langkah-langkah di bawah ini setelah melakukan `git clone`:

### 1. Clone Repository
```bash
git clone https://github.com/Rayhaannnnn/drsepatu.git
cd drsepatu
```

### 2. Install Dependency PHP (Composer) & Node.js
```bash
composer install
npm install
```

### 3. Konfigurasi Environment (.env)
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Lalu buat application key:
```bash
php artisan key:generate
```

### 4. Database
Proyek ini menggunakan **SQLite** dan file database sudah tersedia di `database/database.sqlite` (lengkap dengan data awal). Tidak perlu setup database server terpisah.

*(Opsional: Jika ingin me-reset database dan mengulang data awal)*
```bash
php artisan migrate:fresh --seed
```

### 5. Jalankan Aplikasi
Buka dua tab terminal atau jalankan perintah berikut:

Terminal 1 (Laravel Server):
```bash
php artisan serve
```

Terminal 2 (Vite / Frontend Assets):
```bash
npm run dev
```

Buka browser dan akses: `http://127.0.0.1:8000`

---

## 🔑 Akun Default untuk Login

| Role | Email | Password |
|---|---|---|
| **Admin** | `admin@drsepatu.com` | `12345` |
| **Customer Demo** | `customer@drsepatu.com` | `password` |
