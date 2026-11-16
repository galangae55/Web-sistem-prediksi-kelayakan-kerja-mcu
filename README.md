# Sistem Informasi & Prediksi Kelayakan Medis Kerja (Occupational Health MCU)

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Database](https://img.shields.io/badge/Database-SQLite%20%7C%20PostgreSQL-336791?style=for-the-badge&logo=postgresql&logoColor=white)
![Status](https://img.shields.io/badge/Status-Production_Ready-success?style=for-the-badge)

**Sistem Prediksi Kelayakan Medis Kerja MCU** adalah portal klinis dan manajemen pemeriksaan kesehatan tenaga kerja (*Occupational Health & Medical Check-Up Management System*). Platform ini mengintegrasikan alur registrasi pasien, penjadwalan check-up, pencatatan rekam medis komprehensif (vital signs, hematologi, profil lipid, fungsi hati/ginjal, urine lengkap), hingga estimasi status kebugaran kerja (*Fit to Work Evaluation*) dan rekomendasi dokter spesialis okupasi.

---

## 📸 Dokumentasi Antarmuka & Tangkapan Layar

### 1. Dashboard Eksekutif & Analitik Pasien
Visualisasi grafik kunjungan check-up pasien secara harian, tren bulanan 12 bulan terakhir, serta proyeksi tahunan berbasis Chart.js.
![Dashboard Analytics](file:///d:/CV/portfolio-assets/09-web-mcu-laravel/mcu_portal_dashboard_analytics.png)

### 2. Manajemen Pasien & Rekam Medis
Tabel data induk pasien tenaga kerja dengan informasi demografis, nomor identitas, riwayat kontak, dan dokter penanggung jawab.
![Data Pasien](file:///d:/CV/portfolio-assets/09-web-mcu-laravel/mcu_portal_pasien_table.png)

### 3. Rekam Medis Klinis & Parameter Laboratorium
Pencatatan menyeluruh parameter kesehatan mencakup data fisik, indeks massa tubuh (BMI), kategori tekanan darah, riwayat penyakit kardiovaskular/paru, serta hasil uji laboratorium darah dan urine.
![Hasil Pemeriksaan](file:///d:/CV/portfolio-assets/09-web-mcu-laravel/mcu_portal_hasil_pemeriksaan.png)

### 4. Penjadwalan Pemeriksaan Dokter & Tenaga Medis
Monitoring antrean jadwal pemeriksaan medis harian dengan integrasi status penugasan perawat dan dokter pemeriksa.
![Jadwal Pemeriksaan](file:///d:/CV/portfolio-assets/09-web-mcu-laravel/mcu_portal_jadwal_pemeriksaan.png)

### 5. Gerbang Masuk Petugas Medis
Antarmuka autentikasi pengguna dengan verifikasi peran keamanan multi-level.
![Login Form](file:///d:/CV/portfolio-assets/09-web-mcu-laravel/mcu_portal_login.png)

---

## 🩺 Kategori Evaluasi Kebugaran Medis Kerja

Sistem mengklasifikasikan kondisi kesehatan tenaga kerja sesuai pedoman baku kedokteran okupasi:

| Kategori Evaluasi | Definisi Klinis |
| :--- | :--- |
| **Fit to Work** | Kondisi fisik dan laboratorium normal, mampu menjalankan tugas tanpa batasan medis. |
| **Fit with Note** | Kondisi kesehatan memadai untuk bekerja dengan catatan pemantauan berkala (misal: hipertensi ringan terkontrol). |
| **Fit with Restriction** | Mampu bekerja dengan penyesuaian lingkungan kerja atau pembatasan beban fisik tertentu. |
| **Temporary Unfit** | Kebugaran kerja ditangguhkan sementara waktu hingga pemulihan medis atau terapi tercapai. |
| **Unfit to Work** | Kondisi medis permanen yang tidak memenuhi syarat keselamatan kerja pada bidang yang dituju. |

---

## 🌟 Modul & Fitur Unggulan

| Modul | Deskripsi Fungsi |
| :--- | :--- |
| **Patient Registration** | Pendaftaran data calon karyawan / tenaga kerja beserta verifikasi NIK dan alokasi dokter pemeriksa. |
| **Clinical Records (MCU)** | Input 60+ parameter klinis meliputi spirometri, audiometri, rontgen thorax, treadmill EKG, fungsi hepar (SGOT/SGPT), dan fungsi ginjal (BUN/kreatinin). |
| **Medical Fit Prediction** | Perhitungan prediktif status kebugaran kerja berdasarkan parameter kesehatan vital dan faktor risiko pekerjaan. |
| **Doctor Validation & Recommendation** | Modul persetujuan hasil oleh dokter penanggung jawab beserta rekomendasi tindakan korektif dan resep klinis. |
| **Role-Based Access Control** | Pemisahan hak akses ketat antara Administrator, Dokter Penilai, dan Perawat Pemeriksa. |

---

## 🛠️ Arsitektur & Teknologi

- **Backend Framework**: Laravel 11.x (MVC Architecture)
- **Language**: PHP 8.2+
- **Database Engine**: Multi-driver support (SQLite portable zero-config & PostgreSQL untuk skala enterprise)
- **Frontend & Styling**: Blade Templating, Tailwind CSS, Bootstrap 4, Font Awesome 6, SweetAlert2, Chart.js
- **Document Export**: Barryvdh DomPDF untuk penerbitan laporan hasil MCU digital

---

## 🚀 Panduan Menjalankan Sistem

### 1. Pemasangan Dependensi
```bash
cd d:/CV/Web-sistem-prediksi-kelayakan-kerja-mcu
composer install
```

### 2. Konfigurasi Database (.env)
Aplikasi mendukung driver SQLite (bawaan portable) maupun PostgreSQL:
```ini
APP_NAME="Sistem Prediksi Kelayakan Kerja MCU"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8003

# Konfigurasi SQLite (Default Portable)
DB_CONNECTION=sqlite
```

### 3. Migrasi & Database Seeder
Jalankan migrasi dan seeder data lengkap:
```bash
# Pastikan database sqlite tersedia
touch database/database.sqlite

# Migrasi bersih beserta data klinis & rekam medis awal
php artisan migrate:fresh --seed --force
```

### 4. Menjalankan Server Lokal
```bash
php artisan serve --port=8003
```
Buka peramban web pada alamat: **`http://localhost:8003`**

---

## 🔑 Kredensial Akun Pemeriksa & Administrator

| Role | Username | Password | Deskripsi Tugas |
| :--- | :--- | :--- | :--- |
| **Administrator** | `rudi.prasetyo` | `admin123` | Manajemen akun dokter, perawat, rekapitulasi data pasien. |
| **Dokter** | `andi.kusuma` | `dokter123` | Validasi rekam medis, approval hasil prediksi, penerbitan rekomendasi klinis. |
| **Perawat** | `ayu.lestari` | `password123` | Registrasi pasien, entri rekam medis fisik, dan penginputan data laboratorium. |

---

## 📁 Struktur Direktori Utama

```
Web-sistem-prediksi-kelayakan-kerja-mcu/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # HasilPemeriksaanController, PasienController, LoginController, dll
│   │   └── Middleware/      # AdminMiddleware, DokMinMiddleware, UsersMiddleware
│   └── Models/              # HasilPemeriksaan, Pasien, PrediksiHasilPemeriksaan, RekomendasiMedis, Users
├── database/
│   ├── migrations/          # 9 migrasi skema tabel klinis & pemeriksaan
│   └── seeders/             # DatabaseSeeder komprehensif (Users, Pasien, Rekam Medis, Prediksi)
├── resources/
│   ├── views/               # Antarmuka Blade (dashboard, pasien, hasil-pemeriksaan, jadwal)
│   └── css/ & js/           # Aset visual pendukung
├── routes/
│   └── web.php              # Routing lengkap sistem pemeriksaan
└── portfolio-assets/        # Dokumentasi visual terkurasi
```

---

*Occupational Health MCU System — Standardizing workforce medical fitness evaluations with precision and integrity.*
