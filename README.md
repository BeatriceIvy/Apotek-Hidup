# 💊 Apotek Hidup

**Apotek Hidup** adalah website e-commerce apotek berbasis **PHP Native dan MySQL** yang memungkinkan pengguna melihat katalog obat, mencari produk, mengelola keranjang, melakukan checkout, serta melihat riwayat transaksi. Sistem juga dilengkapi dengan **dashboard admin** untuk mengelola obat, pelanggan, transaksi, laporan penjualan, dan pesan dari pelanggan.

> Project ini dibuat sebagai project web development untuk mengimplementasikan konsep **full-stack web development**, CRUD, autentikasi, session, pengelolaan transaksi, dan database relasional.

---

## ✨ Fitur Utama

### 👤 Sisi Pengguna

- **Registrasi dan Login**
  - Membuat akun pengguna.
  - Login menggunakan email dan password.
  - Password disimpan menggunakan `password_hash()`.
  - Sistem session digunakan untuk mempertahankan status login.
  - Redirect kembali ke halaman checkout setelah login jika pengguna sebelumnya mencoba checkout.

- **Beranda**
  - Hero section dan informasi utama apotek.
  - Menampilkan produk terlaris.
  - Navigasi ke katalog produk, profil, riwayat transaksi, dan halaman kontak.
  - Keranjang belanja dapat dibuka langsung dari navigasi.

- **Katalog Produk**
  - Menampilkan seluruh obat yang tersedia.
  - Menampilkan nama obat, kategori, harga, stok, gambar, dan informasi produk.
  - Pencarian berdasarkan **nama obat atau kategori**.
  - Produk dapat ditambahkan ke keranjang.

- **Keranjang Belanja**
  - Menyimpan produk menggunakan PHP Session.
  - Menambah produk ke keranjang.
  - Mengatur jumlah produk.
  - Menghitung total belanja.
  - Keranjang terhubung langsung dengan proses checkout.

- **Checkout**
  - Ringkasan produk yang akan dibeli.
  - Input informasi penerima:
    - Nama
    - Nomor HP
    - Alamat
  - Pilihan metode pembayaran.
  - Menyediakan tampilan pembayaran melalui **QRIS** dan transfer bank.
  - Setelah checkout berhasil, data transaksi dan detail transaksi disimpan ke database.
  - Keranjang dikosongkan setelah checkout berhasil.

- **Riwayat Transaksi**
  - Pengguna dapat melihat transaksi miliknya.
  - Menampilkan status transaksi.
  - Pengguna dapat membuka detail setiap transaksi.
  - Detail transaksi menampilkan obat, harga, jumlah, dan informasi transaksi.

- **Profil**
  - Melihat informasi akun.
  - Mengubah informasi profil.
  - Mengubah foto profil.
  - Data profil diambil dari database berdasarkan session pengguna.

- **Lupa / Reset Password**
  - Halaman untuk memulai proses pemulihan password.
  - Password baru disimpan menggunakan hashing.

- **Hubungi Kami**
  - Pengguna dapat mengirim pesan kepada pihak apotek.
  - Data pesan menyimpan nama, email, nomor HP, subjek, isi pesan, dan status.

---

## 🛠️ Fitur Admin

### 📊 Dashboard

Dashboard admin menampilkan ringkasan data sistem:

- Total obat.
- Total transaksi.
- Total pelanggan.
- Total pendapatan.
- Jumlah transaksi hari ini.

Dashboard mengambil data secara langsung dari database sehingga informasi dapat berubah sesuai data transaksi terbaru.

### 💊 Manajemen Obat

Admin dapat melakukan operasi CRUD terhadap data obat:

- Menambahkan obat.
- Mengedit obat.
- Menghapus obat.
- Mengunggah gambar obat.
- Mengatur:
  - Nama obat
  - Kategori
  - Harga
  - Stok
  - Tanggal expired
  - Deskripsi
  - Gambar

### 👥 Manajemen Pelanggan

Admin dapat:

- Melihat daftar pelanggan.
- Mencari pelanggan berdasarkan nama atau nomor HP.
- Melihat detail pelanggan.
- Menambahkan pelanggan.
- Menghapus pelanggan.
- Melihat informasi nomor HP dan alamat.

### 🧾 Manajemen Transaksi

Admin dapat:

- Melihat seluruh transaksi.
- Melihat detail transaksi.
- Melihat status transaksi.
- Melihat daftar obat dalam transaksi.
- Menambahkan transaksi secara manual.
- Menghapus transaksi.
- Memantau transaksi berdasarkan status:
  - `pending`
  - `diproses`
  - `selesai`

Pada transaksi manual, sistem juga dapat mengurangi stok obat berdasarkan jumlah yang dimasukkan.

### 📈 Laporan Penjualan

Admin dapat membuat laporan berdasarkan rentang tanggal.

Informasi yang tersedia:

- Total transaksi.
- Total pendapatan.
- Total pelanggan.
- Total obat.
- Filter berdasarkan tanggal mulai dan tanggal akhir.
- Fitur cetak menggunakan `window.print()`.

### 💬 Manajemen Pesan

Admin dapat:

- Melihat pesan yang dikirim melalui halaman kontak.
- Membuka detail pesan.
- Menghapus pesan.

---

## 🔐 Autentikasi & Hak Akses

Sistem menggunakan **role-based access** sederhana:

```text
User
 ├── Beranda
 ├── Produk
 ├── Keranjang
 ├── Checkout
 ├── Profil
 └── Riwayat Transaksi

Admin
 ├── Dashboard
 ├── Data Obat
 ├── Transaksi
 ├── Pelanggan
 ├── Laporan
 └── Pesan
```

Session digunakan untuk menyimpan informasi seperti:

- Status login.
- ID user.
- Nama user.
- Email user.
- Role user.
- Isi keranjang belanja.

---

## 🧱 Teknologi yang Digunakan

| Teknologi | Penggunaan |
|---|---|
| **PHP Native** | Backend dan server-side processing |
| **MySQL** | Database |
| **HTML5** | Struktur halaman |
| **CSS3** | Styling dan responsive UI |
| **JavaScript** | Interaksi dan animasi halaman |
| **PHP Session** | Autentikasi dan shopping cart |
| **MySQLi** | Koneksi dan query database |
| **Font Awesome** | Icon UI |
| **Google Fonts – Poppins** | Typography |

Project ini **tidak menggunakan framework PHP seperti Laravel**, sehingga sebagian besar proses backend dibuat menggunakan PHP Native.

---

## 🏗️ Struktur Project

```text
Apotek Hidup/
│
├── admin/
│   ├── admin_contact.php
│   ├── contact_delete.php
│   ├── contact_detail.php
│   ├── dashboard.php
│   ├── data_obat.php
│   ├── data_pelanggan.php
│   ├── detail_pelanggan.php
│   ├── edit_obat.php
│   ├── hapus_obat.php
│   ├── laporan_penjualan.php
│   ├── tambah_obat.php
│   ├── tambah_pelanggan.php
│   ├── tambah_transaksi.php
│   ├── transaksi.php
│   └── transaksi_detail.php
│
├── assets/
│   ├── css/
│   ├── image/
│   └── js/
│
├── auth/
│   ├── cart_add.php
│   ├── cart_get.php
│   ├── checkout_process.php
│   ├── contact_process.php
│   ├── login_process.php
│   ├── logout.php
│   ├── lupa_password_process.php
│   ├── profile_update.php
│   ├── proses_obat.php
│   ├── proses_pelanggan.php
│   ├── reset_password_process.php
│   ├── signup_process.php
│   ├── transaksi_process.php
│   └── update_foto.php
│
├── config/
│   └── database.php
│
├── pages/
│   ├── checkout.php
│   ├── contact.php
│   ├── home.php
│   ├── login.php
│   ├── lupa_password.php
│   ├── produk.php
│   ├── profile.php
│   ├── reset_password.php
│   ├── riwayat_detail.php
│   ├── riwayat_transaksi.php
│   ├── signup.php
│   └── sukses.php
│
└── kalender.php
```

---

## 🗄️ Konsep Database

Database utama yang digunakan:

```text
db_apotekhidup
```

Beberapa entitas utama yang digunakan oleh aplikasi:

```text
users
 └── menyimpan akun pengguna dan role

obat
 └── menyimpan data obat

pelanggan
 └── menyimpan data pelanggan

transaksi
 └── menyimpan informasi utama transaksi

detail_transaksi
 └── menyimpan item/obat dalam setiap transaksi

contact
 └── menyimpan pesan dari pelanggan
```

Relasi transaksi secara konseptual:

```text
User
 │
 └─────────── Transaksi
                 │
                 └── Detail Transaksi
                         │
                         └── Obat
```

---

## 🔄 Alur Pembelian

```text
Pengguna
   │
   ▼
Melihat Produk
   │
   ▼
Mencari / Memilih Obat
   │
   ▼
Tambah ke Keranjang
   │
   ▼
Checkout
   │
   ├── Belum Login ──► Login ──► Kembali ke Checkout
   │
   ▼
Isi Data Pengiriman
   │
   ▼
Pilih Metode Pembayaran
   │
   ▼
Proses Checkout
   │
   ├── Simpan transaksi
   ├── Simpan detail transaksi
   └── Kosongkan keranjang
   │
   ▼
Transaksi Berhasil
   │
   ▼
Riwayat Transaksi
```

---

## 🔄 Alur Admin

```text
Login Admin
     │
     ▼
Dashboard
     │
     ├──► Data Obat
     │      ├── Tambah
     │      ├── Edit
     │      └── Hapus
     │
     ├──► Transaksi
     │      ├── Lihat
     │      ├── Detail
     │      ├── Tambah
     │      └── Hapus
     │
     ├──► Pelanggan
     │      ├── Cari
     │      ├── Detail
     │      └── Kelola
     │
     ├──► Laporan
     │      └── Filter tanggal & cetak
     │
     └──► Pesan
            ├── Detail
            └── Hapus
```

---

## ⭐ Kelebihan Project

### 1. Full CRUD

Project tidak hanya menampilkan data, tetapi sudah mencakup proses **Create, Read, Update, dan Delete**, terutama pada pengelolaan obat, pelanggan, transaksi, dan pesan.

### 2. Memiliki Sisi User dan Admin

Sistem memiliki dua sisi aplikasi dengan kebutuhan yang berbeda:

- **User:** fokus pada pembelian dan pengelolaan akun.
- **Admin:** fokus pada operasional dan pengelolaan data apotek.

### 3. Transaksi Terintegrasi Database

Proses checkout tidak berhenti pada tampilan UI. Data transaksi dan detail produk disimpan ke database sehingga dapat ditampilkan kembali pada halaman riwayat maupun panel admin.

### 4. Session-Based Shopping Cart

Keranjang belanja menggunakan PHP Session sehingga pengguna dapat menambahkan produk sebelum melakukan checkout tanpa harus langsung membuat transaksi.

### 5. Dashboard Berbasis Data

Dashboard admin menghitung statistik langsung dari database, seperti jumlah obat, transaksi, pelanggan, dan pendapatan.

### 6. Laporan dengan Filter Periode

Admin dapat menentukan rentang tanggal untuk melihat jumlah transaksi dan pendapatan pada periode tertentu.

### 7. Responsive & Interactive UI

Frontend menggunakan CSS terpisah dan JavaScript untuk memberikan pengalaman pengguna yang lebih interaktif, termasuk navigasi, keranjang, animasi, dan elemen UI lainnya.

### 8. Password Hashing

Password pengguna tidak disimpan dalam bentuk plain text. Sistem menggunakan:

```php
password_hash()
```

dan proses login melakukan verifikasi menggunakan:

```php
password_verify()
```

---

## 🚀 Cara Menjalankan

### 1. Persyaratan

Pastikan sudah tersedia:

- XAMPP
- Apache
- MySQL
- PHP
- Browser modern

### 2. Clone / Salin Project

Letakkan folder project ke:

```text
C:\xampp\htdocs\
```

Contoh:

```text
C:\xampp\htdocs\Apotek Hidup\
```

### 3. Jalankan XAMPP

Aktifkan:

```text
Apache
MySQL
```

### 4. Buat Database

Buka **phpMyAdmin**, kemudian buat database:

```text
db_apotekhidup
```

> Project ini membutuhkan tabel `users`, `obat`, `pelanggan`, `transaksi`, `detail_transaksi`, dan `contact` sesuai struktur query yang digunakan oleh aplikasi.

### 5. Konfigurasi Database

File koneksi berada di:

```text
config/database.php
```

Konfigurasi default project:

```php
$conn = new mysqli(
    "localhost",
    "root",
    "",
    "db_apotekhidup"
);
```

Sesuaikan username, password, dan nama database jika konfigurasi MySQL kamu berbeda.

### 6. Jalankan Website

Buka:

```text
http://localhost/Apotek%20Hidup/pages/home.php
```

atau sesuaikan URL dengan nama folder project di `htdocs`.

---

## 📌 Catatan Pengembangan

Project ini dibuat menggunakan PHP Native sehingga struktur aplikasi masih bersifat sederhana dan cocok sebagai project pembelajaran maupun portfolio.

Beberapa area yang dapat dikembangkan lebih lanjut:

- Migrasi backend ke Laravel atau framework modern.
- Menggunakan `.env` untuk konfigurasi database.
- Menambahkan CSRF protection.
- Meningkatkan validasi dan sanitasi seluruh input.
- Menggunakan prepared statements secara konsisten pada seluruh query.
- Menambahkan pagination pada katalog, pelanggan, dan transaksi.
- Menambahkan sistem notifikasi transaksi.
- Integrasi payment gateway.
- Menambahkan stok otomatis yang lebih robust saat pembatalan transaksi.
- Menambahkan export laporan ke PDF/Excel.
- Menambahkan sistem status transaksi yang lebih lengkap.
- Memisahkan konfigurasi dan business logic agar struktur aplikasi lebih scalable.

---

## 🎯 Tujuan Project

Apotek Hidup dikembangkan untuk menunjukkan implementasi nyata dari beberapa konsep web development, antara lain:

- Frontend development.
- Backend development.
- Database management.
- Authentication & authorization.
- CRUD.
- Session management.
- Shopping cart.
- Checkout & transaction processing.
- File upload.
- Search/filter.
- Dashboard administration.
- Reporting.

---

## 👨‍💻 Role

**Full-Stack Web Developer**

Project ini mencakup pengembangan sisi frontend dan backend, termasuk pembuatan UI, koneksi database, autentikasi, shopping cart, proses checkout, transaksi, serta dashboard administrasi.

---

## 📄 License

Project ini dibuat untuk keperluan pembelajaran, portfolio, dan pengembangan web.

---

**Apotek Hidup — Sistem E-Commerce Apotek Berbasis PHP Native & MySQL**
