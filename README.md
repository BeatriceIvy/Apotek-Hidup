# 🌿 Apotek Hidup - Sistem Informasi Katalog & Edukasi Tanaman Obat

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](http://makeapullrequest.com)
[![Build Status](https://img.shields.io/badge/build-passing-brightgreen.svg)](https://github.com/)
[![Python](https://img.shields.io/badge/Python-3.10%2B-blue.svg)](https://www.python.org/)
[![Node.js](https://img.shields.io/badge/Node.js-18%2B-green.svg)](https://nodejs.org/)

**Apotek Hidup** adalah platform digital berbasis web/mobile yang dirancang untuk menyediakan informasi komprehensif mengenai keanekaragaman tanaman obat herbal tradisional di Indonesia. Aplikasi ini membantu masyarakat mengenali jenis tanaman obat, kandungan senyawa aktif, khasiat kesehatan, hingga cara pengolahan herbal yang aman dan berkhasiat.

---

## 📑 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Struktur Proyek](#-struktur-proyek)
- [Prasyarat Sistem](#-prasyarat-sistem)
- [Panduan Instalasi & Jalankan Proyek](#-panduan-instalasi--jalankan-proyek)
- [Konfigurasi Environment](#-konfigurasi-environment)
- [Panduan Penggunaan API](#-panduan-penggunaan-api)
- [Panduan Git Workflow](#-panduan-git-workflow)
- [Kontribusi](#-kontribusi)
- [Lisensi](#-lisensi)

---

## ✨ Fitur Utama

- 🔍 **Katalog & Pencarian Cerdas**: Pencarian tanaman obat berdasarkan nama awam, nama latin, atau khasiat penyakit (misal: jahe, temulawak, hipertensi).
- 🧬 **Detail Kandungan & Khasiat**: Informasi terverifikasi mengenai senyawa aktif, efek farmakologis, dan takaran penggunaan yang aman.
- 🍵 **Resep & Cara Pengolahan**: Petunjuk pembuatan jamu, seduhan, dan ramuan tradisional step-by-step.
- 🔖 **Bookmark & Favorit**: Simpan daftar tanaman obat pilihan untuk akses cepat tanpa koneksi internet (offline support).
- 🏷️ **Kategori Berdasarkan Gejala/Penyakit**: Filtrasi intuitif untuk menemukan herbal sesuai keluhan kesehatan.
- 📱 **Desain Responsif**: Tampilan yang optimal untuk perangkat seluler, tablet, maupun desktop.
- 🔒 **Sistem Manajemen Konten (Admin Dashboard)**: Kelola data tanaman, verifikasi artikel herbal, dan manajemen pengguna.

---

## 🛠️ Teknologi yang Digunakan

### Frontend
- **HTML5 & CSS3 / Tailwind CSS** - Styling responsif dan modern.
- **JavaScript (ES6+) / React.js / Vue.js** - Antarmuka pengguna yang interaktif.

### Backend
- **Node.js (Express.js)** / **Python (Flask / FastAPI)** - Restful API & logika bisnis.
- **ORM / Database Access**: Prisma / SQLAlchemy / Sequelize.

### Database
- **PostgreSQL / SQLite / MongoDB** - Menyimpan data tanaman, kategori, dan interaksi pengguna.

### Version Control & Deployment
- **Git & GitHub** - Manajemen versi repositori.
- **Docker** - Kontainerisasi aplikasi.

---

## 📁 Struktur Proyek

```text
Apotek-Hidup/
├── .git/                      # Repositori Git & riwayat commit
├── public/                    # Aset statis (gambar tanaman, ikon, favicon)
│   ├── images/
│   │   └── plants/            # Galeri foto tanaman obat
│   └── favicon.ico
├── src/                       # Kode sumber utama
│   ├── config/                # Konfigurasi aplikasi & database
│   ├── controllers/           # Logika pemrosesan permintaan (API Controllers)
│   ├── middleware/            # Middleware autentikasi & validasi
│   ├── models/                # Skema & model database (Plant, Category, User)
│   ├── routes/                # Endpoint routing (web & API)
│   ├── services/              # Logika bisnis & integrasi data
│   ├── utils/                 # Helper functions & validator
│   └── views/                 # Template/Komponen antarmuka pengguna
├── .env.example               # Template variabel lingkungan
├── .gitignore                 # Daftar berkas yang diabaikan Git
├── Dockerfile                 # Konfigurasi kontainerisasi
├── package.json               # Dependensi & skrip Node.js (atau requirements.txt)
├── README.md                  # Dokumentasi utama proyek
└── server.js                  # Entry point aplikasi
