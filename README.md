# 📚 Bookstore BNSP - Eko Haryono

Aplikasi toko buku online berbasis web yang dibangun dengan Laravel 12 dan Bootstrap 5 untuk ujian sertifikasi BNSP (Badan Nasional Sertifikasi Profesi).

![Laravel](https://img.shields.io/badge/Laravel-12.0-red?style=flat&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2-blue?style=flat&logo=php)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple?style=flat&logo=bootstrap)
![License](https://img.shields.io/badge/License-MIT-green?style=flat)

---

## 📖 Tentang Aplikasi

Bookstore BNSP adalah aplikasi e-commerce untuk toko buku yang menyediakan fitur lengkap untuk:
- **User (Pelanggan)**: Browse buku, keranjang belanja, checkout, upload bukti pembayaran, tracking pesanan
- **Admin**: Dashboard statistik, CRUD buku & kategori, manajemen pesanan & user, kelola pesan kontak

Aplikasi ini mengimplementasikan konsep MVC (Model-View-Controller), authentication & authorization, CRUD operations, file upload, dan transaction management.

---

## ✨ Fitur Utama

### 👤 Fitur User (Pelanggan)
- ✅ Registrasi dan Login
- ✅ Browse katalog buku dengan filter & search
- ✅ Detail buku lengkap (cover, deskripsi, harga, stok)
- ✅ Tambah buku ke keranjang belanja
- ✅ Checkout dengan form pengiriman
- ✅ Upload bukti pembayaran (Transfer/COD/E-Wallet)
- ✅ Tracking status pesanan
- ✅ Batalkan pesanan (jika belum diproses)
- ✅ Kirim pesan ke admin via form kontak

### 👨‍💼 Fitur Admin
- ✅ Dashboard dengan statistik real-time
- ✅ CRUD Kategori Buku (Create, Read, Update, Delete)
- ✅ CRUD Buku dengan upload cover gambar
- ✅ Manajemen User (lihat daftar dan detail)
- ✅ Manajemen Pesanan (update status, konfirmasi pembayaran)
- ✅ Kelola Pesan Kontak dari pelanggan
- ✅ Filter, search, dan pagination di semua tabel

### 🔐 Keamanan
- ✅ Authentication dengan Laravel Breeze
- ✅ Role-based Authorization (Admin/User)
- ✅ Middleware untuk proteksi route
- ✅ CSRF Protection
- ✅ Password Hashing (bcrypt)
- ✅ SQL Injection Prevention (Eloquent ORM)
- ✅ File Upload Validation

---

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 12.0** - PHP Framework
- **PHP 8.2** - Programming Language
- **MySQL** - Database
- **Eloquent ORM** - Database Query Builder

### Frontend
- **Bootstrap 5.3.2** - CSS Framework
- **Material Design Icons** - Icon Library
- **Blade Template Engine** - View Layer
- **Vite** - Asset Bundler

### Tools & Libraries
- **Laravel Vite Plugin** - Asset Management
- **Faker** - Dummy Data Generator
- **PHPUnit** - Testing Framework

---

## 📁 Struktur Database

### Tabel Utama:
1. **users** - Data user (admin & pelanggan)
2. **kategori_buku** - Kategori buku (Fiksi, Non-Fiksi, dll)
3. **buku** - Data buku (judul, penulis, harga, stok, cover)
4. **keranjang** - Item di keranjang belanja user
5. **pesanan** - Data pesanan (order header)
6. **detail_pesanan** - Detail item pesanan (order lines)
7. **pesan_kontak** - Pesan dari user ke admin

### Relasi:
- User **has many** Pesanan, Keranjang, PesanKontak
- KategoriBuku **has many** Buku
- Buku **belongs to** KategoriBuku
- Pesanan **has many** DetailPesanan
- Pesanan **belongs to** User

---

## 👥 Login Credentials

Setelah seeding, gunakan akun berikut:

### Admin
- **Email:** admin@bookstore.com
- **Password:** admin123

### User (Pelanggan)
- **Email:** eko@gmail.com
- **Password:** user123

---

## 🔄 Flow Aplikasi

### User Flow (Pembelian)
1. User register/login
2. Browse katalog buku
3. Tambah buku ke keranjang
4. Checkout (isi data pengiriman)
5. Upload bukti pembayaran
6. Admin konfirmasi pembayaran
7. Admin update status pesanan (Diproses → Dikirim → Selesai)

### Admin Flow (Manajemen)
1. Admin login
2. Lihat dashboard statistik
3. Kelola buku & kategori (CRUD)
4. Kelola pesanan (update status, konfirmasi pembayaran)
5. Lihat daftar user dan detail pesanan
6. Baca dan balas pesan kontak

## 📝 API Endpoints

### Public Routes (6)
- `GET /` - Homepage
- `GET /about` - About Us
- `GET /kontak` - Contact Page
- `POST /kontak` - Send Contact Message
- `GET /buku` - Browse Books
- `GET /buku/{slug}` - Book Detail

### Auth Routes (3)
- `GET /login` - Login Page
- `POST /login` - Process Login
- `GET /register` - Register Page
- `POST /register` - Process Register
- `POST /logout` - Logout

### User Routes (10) - Requires Auth
- `GET /keranjang` - View Cart
- `POST /keranjang` - Add to Cart
- `PATCH /keranjang/{id}` - Update Cart Item
- `DELETE /keranjang/{id}` - Remove from Cart
- `GET /checkout` - Checkout Page
- `POST /checkout` - Process Order
- `GET /pesanan` - My Orders
- `GET /pesanan/{id}` - Order Detail
- `POST /pesanan/{id}/upload-bukti` - Upload Payment Proof
- `POST /pesanan/{id}/cancel` - Cancel Order

### Admin Routes (24) - Requires Auth + Admin Role
- `GET /admin` - Dashboard
- `Resource /admin/kategori` - Kategori CRUD (7 routes)
- `Resource /admin/buku` - Buku CRUD (7 routes)
- `GET /admin/user` - User List
- `GET /admin/user/{id}` - User Detail
- `GET /admin/pesanan` - Order List
- `GET /admin/pesanan/{id}` - Order Detail
- `PATCH /admin/pesanan/{id}/status` - Update Order Status
- `POST /admin/pesanan/{id}/konfirmasi` - Confirm Payment
- `GET /admin/pesan` - Messages List
- `GET /admin/pesan/{id}` - Message Detail
- `DELETE /admin/pesan/{id}` - Delete Message

**Total: 43 Routes**

---

## 🤝 Kontribusi

Aplikasi ini dibuat untuk keperluan ujian sertifikasi BNSP. Kontribusi dan saran sangat diterima!

---

## 🙏 Acknowledgments

- [Laravel Framework](https://laravel.com) - PHP Framework terbaik
- [Bootstrap](https://getbootstrap.com) - CSS Framework
- [Material Icons](https://fonts.google.com/icons) - Icon Library
- BNSP - Badan Nasional Sertifikasi Profesi Indonesia

---

**⭐ Jika aplikasi ini bermanfaat, berikan star di GitHub!**

**📚 Happy Coding & Good Luck for BNSP Certification! 🎓**
