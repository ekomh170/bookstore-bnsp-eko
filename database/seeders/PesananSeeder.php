<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Buku;

class PesananSeeder extends Seeder
{
    /**
     * Seed data pesanan dan detail pesanan
     * Simulasi pesanan dari berbagai user dengan status yang berbeda
     */
    public function run(): void
    {
        // Pesanan 1: User Eko - Status Selesai
        $pesanan1 = Pesanan::create([
            'user_id' => 2, // Eko
            'nomor_pesanan' => 'INV/20241101/0001',
            'total_harga' => 309000,
            'status' => 'selesai',
            'alamat_pengiriman' => 'Jl. Merdeka No. 45, Jakarta Selatan, DKI Jakarta',
            'telepon_penerima' => '082345678901',
            'nama_penerima' => 'Eko Mulyanto',
            'metode_pembayaran' => 'transfer_bank',
            'bukti_pembayaran' => null,
            'tanggal_pembayaran' => now()->subDays(10),
            'tanggal_konfirmasi' => now()->subDays(9),
            'catatan' => 'Mohon dikirim pagi hari',
            'created_at' => now()->subDays(10),
        ]);

        // Detail pesanan 1
        DetailPesanan::create([
            'pesanan_id' => $pesanan1->id,
            'buku_id' => 1, // Pemrograman Web dengan Laravel
            'jumlah' => 2,
            'harga_satuan' => 125000,
            'subtotal' => 250000,
        ]);

        DetailPesanan::create([
            'pesanan_id' => $pesanan1->id,
            'buku_id' => 11, // Dongeng Anak Nusantara
            'jumlah' => 1,
            'harga_satuan' => 65000,
            'subtotal' => 65000,
        ]);

        // Update stok buku
        Buku::find(1)->decrement('stok', 2);
        Buku::find(1)->increment('terjual', 2);
        Buku::find(11)->decrement('stok', 1);
        Buku::find(11)->increment('terjual', 1);

        // Pesanan 2: User Budi - Status Dikirim
        $pesanan2 = Pesanan::create([
            'user_id' => 3, // Budi
            'nomor_pesanan' => 'INV/20241103/0002',
            'total_harga' => 197000,
            'status' => 'dikirim',
            'alamat_pengiriman' => 'Jl. Ahmad Yani No. 78, Surabaya, Jawa Timur',
            'telepon_penerima' => '083456789012',
            'nama_penerima' => 'Budi Santoso',
            'metode_pembayaran' => 'transfer_bank',
            'bukti_pembayaran' => null,
            'tanggal_pembayaran' => now()->subDays(5),
            'tanggal_konfirmasi' => now()->subDays(4),
            'catatan' => null,
            'created_at' => now()->subDays(5),
        ]);

        DetailPesanan::create([
            'pesanan_id' => $pesanan2->id,
            'buku_id' => 4, // Laskar Pelangi
            'jumlah' => 1,
            'harga_satuan' => 89000,
            'subtotal' => 89000,
        ]);

        DetailPesanan::create([
            'pesanan_id' => $pesanan2->id,
            'buku_id' => 7, // Rich Dad Poor Dad
            'jumlah' => 1,
            'harga_satuan' => 115000,
            'subtotal' => 115000,
        ]);

        Buku::find(4)->decrement('stok', 1);
        Buku::find(4)->increment('terjual', 1);
        Buku::find(7)->decrement('stok', 1);
        Buku::find(7)->increment('terjual', 1);

        // Pesanan 3: User Siti - Status Diproses
        $pesanan3 = Pesanan::create([
            'user_id' => 4, // Siti
            'nomor_pesanan' => 'INV/20241104/0003',
            'total_harga' => 220000,
            'status' => 'diproses',
            'alamat_pengiriman' => 'Jl. Pahlawan No. 12, Yogyakarta, DI Yogyakarta',
            'telepon_penerima' => '084567890123',
            'nama_penerima' => 'Siti Nurhaliza',
            'metode_pembayaran' => 'e_wallet',
            'bukti_pembayaran' => null,
            'tanggal_pembayaran' => now()->subDays(3),
            'tanggal_konfirmasi' => now()->subDays(2),
            'catatan' => 'Tolong packing rapi, ini untuk hadiah',
            'created_at' => now()->subDays(3),
        ]);

        DetailPesanan::create([
            'pesanan_id' => $pesanan3->id,
            'buku_id' => 5, // Bumi Manusia
            'jumlah' => 2,
            'harga_satuan' => 105000,
            'subtotal' => 210000,
        ]);

        DetailPesanan::create([
            'pesanan_id' => $pesanan3->id,
            'buku_id' => 12, // Petualangan Si Kancil
            'jumlah' => 1,
            'harga_satuan' => 55000,
            'subtotal' => 55000,
        ]);

        Buku::find(5)->decrement('stok', 2);
        Buku::find(5)->increment('terjual', 2);
        Buku::find(12)->decrement('stok', 1);
        Buku::find(12)->increment('terjual', 1);

        // Pesanan 4: User Andi - Status Dibayar (menunggu diproses admin)
        $pesanan4 = Pesanan::create([
            'user_id' => 5, // Andi
            'nomor_pesanan' => 'INV/20241105/0004',
            'total_harga' => 280000,
            'status' => 'dibayar',
            'alamat_pengiriman' => 'Jl. Gatot Subroto No. 56, Medan, Sumatera Utara',
            'telepon_penerima' => '085678901234',
            'nama_penerima' => 'Andi Wijaya',
            'metode_pembayaran' => 'transfer_bank',
            'bukti_pembayaran' => 'bukti_transfer_andi.jpg',
            'tanggal_pembayaran' => now()->subDays(1),
            'tanggal_konfirmasi' => null, // Belum dikonfirmasi admin
            'catatan' => null,
            'created_at' => now()->subDays(1),
        ]);

        DetailPesanan::create([
            'pesanan_id' => $pesanan4->id,
            'buku_id' => 3, // Mahir PHP 8 dan MySQL
            'jumlah' => 1,
            'harga_satuan' => 135000,
            'subtotal' => 135000,
        ]);

        DetailPesanan::create([
            'pesanan_id' => $pesanan4->id,
            'buku_id' => 14, // Panduan Belajar Matematika SMA
            'jumlah' => 1,
            'harga_satuan' => 145000,
            'subtotal' => 145000,
        ]);

        Buku::find(3)->decrement('stok', 1);
        Buku::find(14)->decrement('stok', 1);

        // Pesanan 5: User Eko - Status Menunggu Pembayaran
        $pesanan5 = Pesanan::create([
            'user_id' => 2, // Eko
            'nomor_pesanan' => 'INV/20241106/0005',
            'total_harga' => 183000,
            'status' => 'menunggu_pembayaran',
            'alamat_pengiriman' => 'Jl. Merdeka No. 45, Jakarta Selatan, DKI Jakarta',
            'telepon_penerima' => '082345678901',
            'nama_penerima' => null,
            'metode_pembayaran' => 'transfer_bank',
            'bukti_pembayaran' => null,
            'tanggal_pembayaran' => null,
            'tanggal_konfirmasi' => null,
            'catatan' => 'Akan transfer hari ini',
            'created_at' => now(),
        ]);

        DetailPesanan::create([
            'pesanan_id' => $pesanan5->id,
            'buku_id' => 2, // Belajar JavaScript dari Nol
            'jumlah' => 1,
            'harga_satuan' => 95000,
            'subtotal' => 95000,
        ]);

        DetailPesanan::create([
            'pesanan_id' => $pesanan5->id,
            'buku_id' => 11, // Dongeng Anak Nusantara
            'jumlah' => 1,
            'harga_satuan' => 65000,
            'subtotal' => 65000,
        ]);

        DetailPesanan::create([
            'pesanan_id' => $pesanan5->id,
            'buku_id' => 16, // Hidup Sehat Cara Rasulullah
            'jumlah' => 1,
            'harga_satuan' => 98000,
            'subtotal' => 98000,
        ]);

        // Pesanan 6: User Budi - Status Dibatalkan
        $pesanan6 = Pesanan::create([
            'user_id' => 3, // Budi
            'nomor_pesanan' => 'INV/20241102/0006',
            'total_harga' => 128000,
            'status' => 'dibatalkan',
            'alamat_pengiriman' => 'Jl. Ahmad Yani No. 78, Surabaya, Jawa Timur',
            'telepon_penerima' => '083456789012',
            'nama_penerima' => 'Budi Santoso',
            'metode_pembayaran' => 'cod',
            'bukti_pembayaran' => null,
            'tanggal_pembayaran' => null,
            'tanggal_konfirmasi' => null,
            'catatan' => 'Maaf, batalkan pesanan. Salah pesan',
            'created_at' => now()->subDays(7),
        ]);

        DetailPesanan::create([
            'pesanan_id' => $pesanan6->id,
            'buku_id' => 17, // Kesenian Tradisional Indonesia
            'jumlah' => 1,
            'harga_satuan' => 128000,
            'subtotal' => 128000,
        ]);
    }
}
