# 🍽️ Amora Food - Management & Inventory System

Amora Food adalah aplikasi berbasis web yang dirancang untuk mengelola sistem kasir, inventaris barang (produk & stok), kategori produk, serta pelaporan transaksi keuangan secara real-time. Aplikasi ini dibangun untuk membantu pemilik usaha kuliner dalam mengotomatisasi pencatatan bisnis mereka dengan arsitektur yang bersih, aman, dan modular.

---

## 🚀 Fitur Utama Sistem

*   **🔐 Autentikasi Keamanan Ganda (Auth & Filters):** Dilengkapi dengan sistem login aman menggunakan `AuthFilter` untuk membatasi hak akses halaman admin dan publik.
*   **📦 Manajemen Produk & Multi-Kategori (CRUD):** Pengelolaan data produk yang dinamis beserta upload gambar otomatis, validasi format, dan relasi multi-kategori yang fleksibel.
*   **📈 Sinkronisasi Stok Otomatis:** Pencatatan arus stok masuk dan keluar secara akurat untuk meminimalisir kesalahan manual.
*   **📊 Laporan Penjualan & Transaksi:** Halaman dashboard interaktif yang menyajikan data statistik, serta fitur cetak laporan performa bisnis berkala.
*   **🛡️ Fitur Keamanan Bawaan:** Implementasi *Honeypot protection*, *Content Security Policy (CSP)*, *Cross-Origin Resource Sharing (CORS)*, dan penanganan *XSS/CSRF Prevention*.

---

## 🛠️ Tech Stack & Arsitektur

Aplikasi ini dikembangkan menggunakan kombinasi teknologi modern berskala enterprise untuk memastikan performa yang cepat dan struktur kode yang mudah dirawat:

*   **Backend Framework:** PHP 8.1+ / CodeIgniter 4 (MVC Architecture)
*   **Database & ORM:** MySQL / MariaDB (Menggunakan Migrations & Seeders untuk konsistensi skema)
*   **Frontend UI:** HTML5, CSS3 Custom Styling (`style.css`), JavaScript (Vanilla / Modern UI)
*   **Dependency Manager:** Composer (Pengelolaan pustaka pihak ketiga secara modular)
*   **Testing & Quality:** PHPUnit Configured (`phpunit.xml.dist`)

---

## 📂 Struktur Folder Sistem

Proyek ini mengikuti standar struktur **CodeIgniter 4** yang bersih dan terpisah secara modular antara logika bisnis, konfigurasi, dan tampilan publik:

```text
amora-food/
├── app/                        # Logika Utama Aplikasi (Core Application)
│   ├── Config/                 # Konfigurasi Global (Database, Security, Routes, Filters, dll)
│   ├── Controllers/            # Controller (Auth, Dashboard, Produk, Kategori, Stok, Laporan)
│   ├── Database/               # Database Migration & Seeders (InitialTables, KategoriTable, UserSeeder)
│   ├── Filters/                # Route Filters / Middleware (AuthFilter untuk proteksi session)
│   ├── Models/                 # Model Objek & Query Database (UserModel, ProdukModel, StokModel, KategoriModel)
│   └── Views/                  # Template UI / Tampilan (Auth, Dashboard, Produk, Kategori, Stok, Layout)
├── public/                     # Direktori Akses Publik
│   ├── css/                    # Custom Asset Stylesheet (style.css)
│   ├── uploads/                # Tempat Penyimpanan Gambar Produk yang Diunggah
│   └── index.php               # Front Controller Utama Aplikasi
├── tests/                      # Framework Testing Berbasis PHPUnit
├── .env                        # Konfigurasi Environment & Kredensial Database (Aman dari Git)
├── .gitignore                  # Pengaturan File Eksklusi Repositori
├── composer.json               # Dependensi Pustaka PHP
└── README.md                   # Dokumentasi Utama Repositori
```

---

## ⚙️ Cara Instalasi & Menjalankan Proyek

Ikuti langkah-langkah berikut untuk menjalankan proyek **Amora Food** di lingkungan lokal Anda:

### 1. Kloning Repositori
```bash
git clone https://github.com/username/amora-food.git
cd amora-food
```

### 2. Instalasi Dependensi Composer
Pastikan Anda sudah menginstal Composer di komputer Anda, lalu jalankan:
```bash
composer install
```

### 3. Konfigurasi Environment (`.env`)
Salin file `.env.example` atau buat file baru bernama `.env` di root folder, kemudian sesuaikan kredensial database Anda:
```env
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = amora_food
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.DBPrefix =
```

### 4. Jalankan Database Migration & Seeder
Aplikasi ini sudah dilengkapi dengan sistem migrasi otomatis untuk membuat tabel dan data pengguna awal (*seed*):
```bash
php spark migrate
php spark db:seed UserSeeder
```

### 5. Jalankan Server Lokal
Nyalakan server development bawaan CodeIgniter:
```bash
php spark serve
```
Buka browser Anda dan akses halaman url: `http://localhost:8080`

---

## 💡 Informasi Akun Login Bawaan (Seed Data)
Untuk keperluan uji coba pertama kali setelah menjalankan `UserSeeder`, Anda dapat menggunakan akun admin default berikut:
*   **Email/Username:** `admin@amorafood.com` *(atau sesuaikan dengan konfigurasi UserSeeder Anda)*
*   **Password:** `admin123`

---

## 👨‍💻 Kontribusi & Pengembangan
Proyek ini dibangun dengan komitmen tinggi terhadap **Clean Code** dan kerapian struktur basis data. Setiap modul seperti `Produk`, `Kategori`, dan `Stok` dipisahkan secara independen untuk memudahkan skalabilitas fitur di masa mendatang bagi tim pengembang software.
