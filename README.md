# Sistem Informasi Akademik (SIAKAD) Terpadu

Sebuah aplikasi **Sistem Informasi Akademik (SIAKAD)** komprehensif yang dibangun menggunakan **Laravel** dan **Filament Admin Panel v3**. Sistem ini didesain agar sangat dinamis dalam mengelola data akademik dari tingkat sekolah (SMP/SMA) hingga jenjang yang lebih tinggi, dilengkapi dengan Dashboard analitik, access control multi-role, navigasi Bahasa Indonesia, serta modul akademik dan keuangan.

---

## Fitur Utama

1. **Dashboard Statistik**: Widget grafis intuitif (Bar Chart Distribusi Siswa, Doughnut Chart Pembayaran SPP, dan Kartu Statistik KBM).
2. **Hak Akses (Multi-Role)**: Sistem pengelolaan wewenang (RBAC) dengan _Spatie Permission_ & _Filament Shield_ yang otomatis menghilangkan/menampilkan menu berdasarkan jabatan (Super Admin, Kepsek, Guru, TU, dll).
3. **Manajemen Sistem & Kelembagaan**: Pengaturan Institusi Utama & Identitas Sekolah.
4. **Data Master**: Manajemen Tahun Akademik, Semester, Fakultas/Divisi (Jurusan), & Program Studi.
5. **Data Pengguna**: Manajemen Profil Guru/Dosen dan Siswa/Mahasiswa berserta relasi Akun Login-nya.
6. **Akademik & Kurikulum**: Manajemen Rombongan Belajar (Rombel), Ruang Kelas, Daftar Mata Pelajaran, & Jadwal Pelajaran Aktif.
7. **Perkuliahan & KBM (Kegiatan Belajar Mengajar)**: Proses Pendaftaran (KRS/Enrollment massal ke Ruang Kelas), Kehadiran/Presensi Guru ke Siswa, Sistem Penilaian, dan Rekap Rapor Akhir.
8. **Keuangan & Administrasi**: Modul *Billing* (Tagihan SPP/Uang Gedung) lengkap dengan detail *Invoice* dan persentase Pembayaran (Lunas/Belum Lunas).

## Stack Teknologi

- [Laravel 11.x](https://laravel.com/) (Backend Framework)
- [Filament v3](https://filamentphp.com/) (Admin Panel Canggih & TALL Stack)
- Database SQL (PostgreSQL / MySQL)
- Plugin [Spatie Permission](https://spatie.be/docs/laravel-permission) & [Filament Shield](https://github.com/bezhanSalleh/filament-shield) (Keamanan RBAC)

---

## Panduan Instalasi (Development Lokal)

Ikuti langkah-langkah di bawah ini untuk memulai *SIAKAD* di mesin (komputer) Anda.

### Kloning Repository & Instalasi Vendor
Pastikan Anda memiliki *PHP >= 8.2* dan *Composer*. Buka terminal lalu jalankan:
```bash
git clone https://github.com/username-anda/siakad.git
cd siakad
composer install
```

### Konfigurasi Environment (`.env`)
Salin file `.env.example` ke dalam `.env` lalu hasilkan kunci aplikasi:
```bash
cp .env.example .env
php artisan key:generate
```
Sesuaikan konfigurasi koneksi database Anda di dalam file `.env`:
```env
DB_CONNECTION=mysql # Atau pgsql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siakad_db
DB_USERNAME=root
DB_PASSWORD=
```

### Migrasi Database & *Seeding* Dummy Data (SMA)
Sistem ini telah dilengkapi dengan Generator (*Seeder*) Database khusus skenario **SMA (SmaSeeder)** (Total lebih dari 120 Siswa, 15 Guru, Puluhan Mata Pelajaran, serta simulasi Tagihan SPP).

Jalankan perintah ini **secara berurutan**:
```bash
php artisan migrate:fresh --seed
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=TestAccountsSeeder
```
*(Catatan: Langkah di atas akan menyiapkan seluruh hak akses (Permissions) secara tuntas serta mengaitkannya ke Data Pengguna percobaan).*

### Bersihkan Cache & Menjalankan Server
Bersihkan chace bawaan proyek agar terjemahan Label dan Form Dropdown Filament berjalan sebagaimana mestinya:
```bash
php artisan optimize:clear
php artisan serve
```

Aplikasi beserta Panel Admin Anda sekarang siap diakses di:
**[http://localhost:8000/admin](http://localhost:8000/admin)**

---

## Akun Login Uji Coba

Dashboard *SIAKAD* secara dinamis akan langsung memangkas menu yang tidak berhak diakses (Contoh: Siswa tidak akan bisa melihat Widget Laporan Statistik SPP atau menghapus jadwal, Guru hanya diberi akses Input Nilai dan Absen Kelasnya sendiri, dst). 

Gunakan akun Dummy di bawah ini dengan **Password Seragam: `password`**.

| Akses (Role) | Email Login | Hak Akses Utama (Otorisasi) |
| :--- | :--- | :--- |
| **Super Admin** | `admin@admin.com` | Membuka dan mengendalikan semua modul (180+ Permissions). |
| **Kepala Sekolah** | `kepsek@sman1.sch.id` | *View-Only* di semua sistem & Melihat Laporan Analitik + Grafik (*Charts*). |
| **Guru** | `guru@sman1.sch.id` | Hanya akses Ruang Kelas, Profil Siswa, Jadwal, Absensi, & Nilai. |
| **Wali Kelas** | `walikelas@sman1.sch.id` | Guru + Akses mengontrol anggota Rombel binaannya dan Mengubah Profil Anak. |
| **Tata Usaha** | `tu@sman1.sch.id` | Admin Manajemen Keuangan SPP, Tagihan Siswa, dan Data Profil Inti. |
| **Siswa / Pelajar** | `siswa@sman1.sch.id` | Tampilan Paling Terbatas: Hanya melihat Jadwal Kelasnya sendiri, Kehadiran, Nilai Rapor, dan Tagihan (Tanpa Widget). |

