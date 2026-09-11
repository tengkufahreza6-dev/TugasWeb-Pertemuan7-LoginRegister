# Tugas Web Pertemuan 7 - Native PHP Authentication System (JSON Storage)

Proyek ini merupakan sistem autentikasi pengguna (**Login & Register**) berbasis **PHP Native** tanpa database SQL, menggunakan berkas **`users.json`** sebagai media penyimpanan data persisten. Antarmuka dikembangkan dengan pendekatan **Dark Glassmorphism** yang responsif dan terintegrasi dengan standar keamanan backend modern.

---

## 🔑 Akun Demo Pengujian

Untuk pengujian cepat tanpa registrasi ulang, dapat menggunakan kredensial bawaan pada `users.json`:
- **Email:** `tester@gmail.com`
- **Password:** `tester123`

---

## 📷 Tangkapan Layar Antarmuka

| Halaman Login | Halaman Registrasi |
| :---: | :---: |
| ![Login Page](ss-login.png) | ![Register Page](ss-register.png) |

| Halaman Dashboard | Halaman Edit Profil |
| :---: | :---: |
| ![Dashboard Page](ss-dashboard.png) | ![Edit Profile Page](ss-edit-profile.png) |

---

## 📌 Pemenuhan 10 Syarat Utama & Fitur Bonus

| No | Syarat Tugas (Requirements) | Status & Implementasi Kode |
| :-: | :--- | :--- |
| **1** | Form registrasi dengan validasi | **Selesai** (Validasi nama, email, dan password di `register.php`) |
| **2** | Validasi email dengan `filter_var()` | **Selesai** (Menggunakan `FILTER_VALIDATE_EMAIL` di `register.php`) |
| **3** | Password di-hash dengan `password_hash()` | **Selesai** (Enkripsi standar BCRYPT sebelum disalin ke `users.json`) |
| **4** | Data disimpan di file JSON | **Selesai** (Penyimpanan data persisten pada `users.json`) |
| **5** | Cek duplikasi email saat registrasi | **Selesai** (Fungsi `findUserByEmail()` pada `functions.php`) |
| **6** | Sistem login dengan session | **Selesai** (Pengelolaan variabel `$_SESSION` pada `login.php`) |
| **7** | Dashboard terproteksi (redirect jika belum login) | **Selesai** (Fungsi `checkAuth()` memblokir akses tanpa sesi) |
| **8** | Logout functionality (`session_destroy`) | **Selesai** (Pembersihan sesi dan cookie pada `logout.php`) |
| **9** | Sanitasi input dengan `htmlspecialchars()` | **Selesai** (Pencegahan serangan XSS lewat `sanitizeInput()`) |
| **10**| Pesan error & sukses yang jelas | **Selesai** (Notifikasi alert visual berwarna yang informatif) |

---

## 🛡️ Detail Fitur Utama & Keamanan Backend

1. **Validasi & Sanitasi Input (XSS Protection):**
   Seluruh masukan formulir disanitasi menggunakan `htmlspecialchars()` untuk mencegah serangan *Cross-Site Scripting* (XSS) serta divalidasi menggunakan `filter_var()` untuk format email.

2. **Enkripsi Password (Bcrypt Hash):**
   Password pengguna dienkripsi secara aman menggunakan `password_hash()` (standar BCRYPT) sebelum disimpan ke `users.json`. Tidak ada password yang tersimpan dalam bentuk teks mentah (*plain text*).

3. **Pengecekan Duplikasi Email:**
   Sistem secara otomatis memeriksa ketersediaan email saat registrasi akun baru untuk mencegah pendaftaran ganda.

4. **Manajemen Sesi & Proteksi Halaman:**
   Menggunakan `session_start()` untuk mengelola sesi login. Halaman `dashboard.php` terproteksi penuh; akses tanpa sesi aktif akan otomatis di-redirect ke `login.php`.

5. **Logout & Session Destruction:**
   Fitur logout (`logout.php`) menghancurkan seluruh data sesi via `session_destroy()` dan membersihkan cookie autentikasi.

6. **Fitur Bonus (Remember Me, Edit Profile & UI Polish):**
   - **Remember Me:** Menggunakan *Secure Cookie* berdurasi 7 hari.
   - **Edit Profile:** Pengguna terautentikasi dapat memperbarui nama dan password mereka pada `edit-profile.php`.
   - **UI Glassmorphism & Custom Favicon:** Antarmuka bertema keamanan cyber dengan logo tab browser khusus (`🔐`).

---

## 🛠️ Teknologi yang Digunakan

- **PHP Native** — Session Management, File I/O JSON, Password Hashing, dan Sanitasi Data.
- **JSON (`users.json`)** — Storage Data Berbasis Berkas.
- **HTML5 & CSS3** — Custom Dark Glassmorphism, CSS Grid/Flexbox, dan Animasi.
- **Font Awesome 6 & Google Fonts (Inter)** — Ikonografi dan tipografi.

---

## 👤 Informasi Mahasiswa

- **Nama:** Tengku Fahreza
- **NIM:** 4252550005
- **Kelas:** PSIK 25B
- **Program Studi:** S1 Ilmu Komputer
- **Mata Kuliah:** Pemrograman Web
- **Instansi:** Universitas Negeri Medan (UNIMED)