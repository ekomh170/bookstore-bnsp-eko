<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed database aplikasi BookStore BNSP
     *
     * Urutan seeding penting karena ada foreign key constraint:
     * 1. User (untuk admin dan user biasa)
     * 2. KategoriBuku (parent dari buku)
     * 3. Buku (butuh kategori_id)
     * 4. Pesanan (butuh user_id dan buku_id)
     * 5. Keranjang (butuh user_id dan buku_id)
     * 6. PesanKontak (butuh user_id optional)
     */
    public function run(): void
    {
        // Panggil seeder sesuai urutan dependency
        $this->call([
            UserSeeder::class,          // Seed user (admin & user biasa)
            KategoriBukuSeeder::class,  // Seed kategori buku
            BukuSeeder::class,          // Seed data buku
            PesananSeeder::class,       // Seed pesanan & detail pesanan
            KeranjangSeeder::class,     // Seed keranjang belanja aktif
            PesanKontakSeeder::class,   // Seed pesan kontak dari customer
        ]);

        // Info untuk developer
        $this->command->info('✅ Seeding completed successfully!');
        $this->command->info('');
        $this->command->info('📊 Data yang berhasil di-seed:');
        $this->command->info('   - 5 Users (1 Admin + 4 User biasa)');
        $this->command->info('   - 10 Kategori Buku');
        $this->command->info('   - 20 Buku dari berbagai kategori');
        $this->command->info('   - 6 Pesanan dengan berbagai status');
        $this->command->info('   - 7 Item di Keranjang Belanja');
        $this->command->info('   - 8 Pesan Kontak (user & guest)');
        $this->command->info('');
        $this->command->info('🔐 Login Credentials:');
        $this->command->info('   Admin: admin@bookstore.com / admin123');
        $this->command->info('   User:  eko@gmail.com / user123');
        $this->command->info('');
    }
}
