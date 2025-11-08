<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PesanKontak;

class PesanKontakSeeder extends Seeder
{
    /**
     * Seed data pesan kontak dari customer ke admin
     * Kombinasi dari user terdaftar dan guest
     */
    public function run(): void
    {
        // Pesan dari Eko (user terdaftar) - sudah dibaca
        PesanKontak::create([
            'user_id' => 2, // Eko
            'nama' => 'Eko Mulyanto',
            'email' => 'eko@gmail.com',
            'subjek' => 'Pertanyaan tentang pengiriman',
            'pesan' => 'Halo admin, saya ingin menanyakan estimasi waktu pengiriman untuk wilayah Jakarta Selatan. Berapa lama biasanya paket sampai setelah dikirim? Terima kasih.',
            'sudah_dibaca' => true,
            'created_at' => now()->subDays(3),
        ]);

        // Pesan dari guest - belum dibaca
        PesanKontak::create([
            'user_id' => null,
            'nama' => 'Dewi Kusuma',
            'email' => 'dewi.kusuma@yahoo.com',
            'subjek' => 'Ketersediaan buku langka',
            'pesan' => 'Selamat siang, saya mencari buku "Tetralogi Pulau Buru" karya Pramoedya. Apakah tersedia? Bagaimana cara memesannya jika tidak ada di website? Mohon informasinya. Salam.',
            'sudah_dibaca' => false,
            'created_at' => now()->subHours(5),
        ]);

        // Pesan dari Budi (user terdaftar) - sudah dibaca
        PesanKontak::create([
            'user_id' => 3, // Budi
            'nama' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'subjek' => 'Komplain pesanan',
            'pesan' => 'Permisi admin, pesanan saya nomor INV/20250106/0002 sudah sampai tapi buku yang satu mengalami kerusakan pada sampul. Bagaimana proses untuk penukaran atau retur? Terima kasih.',
            'sudah_dibaca' => true,
            'created_at' => now()->subDays(1),
        ]);

        // Pesan dari guest - sudah dibaca
        PesanKontak::create([
            'user_id' => null,
            'nama' => 'Rina Maharani',
            'email' => 'rina.maharani@gmail.com',
            'subjek' => 'Tanya cara pembayaran',
            'pesan' => 'Halo, saya tertarik membeli beberapa buku di toko online ini. Untuk metode pembayaran apa saja yang tersedia? Apakah bisa COD untuk wilayah Bandung? Mohon penjelasannya.',
            'sudah_dibaca' => true,
            'created_at' => now()->subDays(5),
        ]);

        // Pesan dari Siti (user terdaftar) - belum dibaca
        PesanKontak::create([
            'user_id' => 4, // Siti
            'nama' => 'Siti Nurhaliza',
            'email' => 'siti@gmail.com',
            'subjek' => 'Request buku baru',
            'pesan' => 'Admin yang baik, saya ingin request buku "Filosofi Teras" karya Henry Manampiring dan "The Subtle Art of Not Giving a F*ck" versi terjemahan Indonesia. Apakah bisa dicarikan? Saya siap pre-order.',
            'sudah_dibaca' => false,
            'created_at' => now()->subHours(8),
        ]);

        // Pesan dari guest - belum dibaca
        PesanKontak::create([
            'user_id' => null,
            'nama' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi45@outlook.com',
            'subjek' => 'Info promo dan diskon',
            'pesan' => 'Selamat pagi, apakah ada program membership atau diskon khusus untuk pembelian dalam jumlah banyak? Saya tertarik membeli untuk keperluan perpustakaan sekolah. Mohon informasi detailnya ya.',
            'sudah_dibaca' => false,
            'created_at' => now()->subHours(2),
        ]);

        // Pesan dari Andi (user terdaftar) - sudah dibaca
        PesanKontak::create([
            'user_id' => 5, // Andi
            'nama' => 'Andi Wijaya',
            'email' => 'andi@gmail.com',
            'subjek' => 'Masalah login akun',
            'pesan' => 'Halo admin, saya mengalami kesulitan login ke akun saya. Saya sudah coba reset password tapi email verifikasi tidak masuk. Bisa tolong dibantu? Username saya: andi@gmail.com.',
            'sudah_dibaca' => true,
            'created_at' => now()->subDays(2),
        ]);

        // Pesan dari guest - sudah dibaca
        PesanKontak::create([
            'user_id' => null,
            'nama' => 'Lestari Putri',
            'email' => 'lestari.putri@gmail.com',
            'subjek' => 'Apresiasi pelayanan',
            'pesan' => 'Terima kasih banyak untuk pelayanan yang cepat dan ramah! Buku yang saya pesan sampai dengan cepat dan kondisi sempurna. Packing juga rapi. Sukses terus untuk BookStore!',
            'sudah_dibaca' => true,
            'created_at' => now()->subDays(4),
        ]);
    }
}
