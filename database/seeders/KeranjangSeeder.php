<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Keranjang;

class KeranjangSeeder extends Seeder
{
    /**
     * Seed data keranjang belanja
     * Simulasi beberapa user yang sedang belanja (masih di keranjang)
     */
    public function run(): void
    {
        // Keranjang Siti - sedang belanja 3 buku
        Keranjang::create([
            'user_id' => 4, // Siti
            'buku_id' => 8, // Strategi Bisnis Digital di Era 4.0
            'jumlah' => 1,
            'harga_satuan' => 98000,
        ]);

        Keranjang::create([
            'user_id' => 4, // Siti
            'buku_id' => 13, // Si Juki: Kumpulan Strip Komik
            'jumlah' => 2,
            'harga_satuan' => 75000,
        ]);

        Keranjang::create([
            'user_id' => 4, // Siti
            'buku_id' => 6, // Perahu Kertas
            'jumlah' => 1,
            'harga_satuan' => 92000,
        ]);

        // Keranjang Andi - sedang belanja 2 buku
        Keranjang::create([
            'user_id' => 5, // Andi
            'buku_id' => 9, // Sejarah Indonesia Modern
            'jumlah' => 1,
            'harga_satuan' => 175000,
        ]);

        Keranjang::create([
            'user_id' => 5, // Andi
            'buku_id' => 10, // Jejak Langkah Pahlawan Indonesia
            'jumlah' => 1,
            'harga_satuan' => 110000,
        ]);

        // Keranjang Budi - baru mulai belanja 1 buku
        Keranjang::create([
            'user_id' => 3, // Budi
            'buku_id' => 15, // Kamus Bahasa Indonesia Lengkap
            'jumlah' => 1,
            'harga_satuan' => 185000,
        ]);

        Keranjang::create([
            'user_id' => 3, // Budi
            'buku_id' => 1, // Pemrograman Web dengan Laravel
            'jumlah' => 1,
            'harga_satuan' => 125000,
        ]);
    }
}
