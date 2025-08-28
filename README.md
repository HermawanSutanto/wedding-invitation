# NikahYuk - Aplikasi Pembuat Undangan Pernikahan Digital

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![PHP Version](https://img.shields.io/badge/php-%3E%3D8.1-8892BF.svg)
![Laravel Version](https://img.shields.io/badge/laravel-v10.x-FF2D20.svg)

NikahYuk adalah sebuah aplikasi web yang dibangun menggunakan Laravel untuk memungkinkan pengguna membuat, mengelola, dan membagikan undangan pernikahan digital yang indah dan interaktif.

## ✨ Fitur Utama

-   **Otentikasi Pengguna**: Sistem registrasi dan login yang aman dengan dua level pengguna: **Admin** dan **Customer**.
-   **Manajemen Template (Admin)**: Admin dapat menambah, melihat, dan menghapus desain template undangan.
-   **Manajemen Undangan (Customer)**: Pengguna dapat membuat undangan baru berdasarkan template, mengedit semua detail melalui form multi-tab yang canggih, dan mengelola beberapa undangan.
-   **Form Edit Interaktif**:
    -   **Tabbed Interface**: Pengelolaan data yang terorganisir (Info Utama, Acara, Kisah Cinta, Galeri, Amplop Digital).
    -   **Upload Gambar**: Upload gambar dengan _live preview_ dan kompresi otomatis.
    -   **Drag & Drop**: Mengubah urutan "Kisah Cinta" dengan mudah menggunakan _drag and drop_.
    -   **Manajemen Relasi**: Menambah, mengedit, dan menghapus item terkait (Acara, Kisah, Galeri, Amplop) secara dinamis.
-   **Tampilan Undangan Publik**: Halaman undangan publik yang dinamis dan sepenuhnya responsif, dihasilkan dari data yang dimasukkan oleh pengguna.
-   **Fitur Interaktif untuk Tamu**:
    -   Sistem RSVP / Buku Tamu yang fungsional dengan penyimpanan data ke database.
    -   Countdown acara, galeri foto, peta lokasi, dan tombol "salin rekening".

## 💻 Tumpukan Teknologi (Tech Stack)

-   **Backend**: Laravel 10, PHP 8.1+
-   **Frontend**: Blade, Tailwind CSS, Alpine.js
-   **Database**: MySQL (atau database lain yang kompatibel dengan Laravel)
-   **Library Tambahan**:
    -   **Intervention Image**: Untuk pemrosesan dan kompresi gambar.
    -   **@alpinejs/sort**: Untuk fungsionalitas _drag-and-drop_.

## 🚀 Panduan Instalasi

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan lokal.

1.  **Clone Repositori**

    ```bash
    git clone [URL_REPOSITORI_ANDA]
    cd nama-proyek
    ```

2.  **Install Dependensi PHP**

    ```bash
    composer install
    ```

3.  **Install Dependensi JavaScript**

    ```bash
    npm install
    ```

4.  **Siapkan File Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.

    ```bash
    cp .env.example .env
    ```

    Pastikan Anda mengisi variabel berikut di file `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Generate Kunci Aplikasi**

    ```bash
    php artisan key:generate
    ```

6.  **Jalankan Migrasi Database**
    Perintah ini akan membuat semua tabel yang dibutuhkan di database Anda.

    ```bash
    php artisan migrate:fresh
    ```

7.  **Buat Symbolic Link**
    Ini penting agar file gambar yang diunggah dari _storage_ bisa diakses secara publik.

    ```bash
    php artisan storage:link
    ```

8.  **Compile Aset Frontend**
    Jalankan server pengembangan Vite. Biarkan terminal ini tetap berjalan.

    ```bash
    npm run dev
    ```

9.  **Jalankan Server Lokal**
    Buka terminal baru dan jalankan server Laravel.
    ```bash
    php artisan serve
    ```
    Aplikasi Anda sekarang bisa diakses di `http://127.0.0.1:8000`.

## 📝 Cara Penggunaan

1.  **Registrasi Akun**: Daftar sebagai pengguna baru. Secara default, Anda akan mendapatkan _role_ **customer**.
2.  **Menjadi Admin**: Untuk mengakses fitur admin (seperti Kelola Template), ubah nilai kolom `role` untuk pengguna Anda dari `customer` menjadi `admin` secara manual di database.
3.  **Mulai Membuat**:
    -   Sebagai **Admin**, pergi ke "Kelola Template" untuk menambahkan template baru.
    -   Sebagai **Customer**, pergi ke "Undangan Saya" -> "+ Buat Undangan Baru" untuk memilih template dan mulai membuat undangan.

## 📄 Lisensi

Proyek ini berada di bawah Lisensi MIT.

---
