<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed data user (admin dan user biasa)
     */
    public function run(): void
    {
        // Admin utama
        User::create([
            'name' => 'Admin BookStore',
            'email' => 'admin@bookstore.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'telepon' => '081234567890',
            'alamat' => 'Jl. Raya Bandung No. 123, Bandung, Jawa Barat',
        ]);

        // User biasa - Eko
        User::create([
            'name' => 'Eko Mulyanto',
            'email' => 'eko@gmail.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'telepon' => '082345678901',
            'alamat' => 'Jl. Merdeka No. 45, Jakarta Selatan, DKI Jakarta',
        ]);

        // User biasa - Budi
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'telepon' => '083456789012',
            'alamat' => 'Jl. Ahmad Yani No. 78, Surabaya, Jawa Timur',
        ]);

        // User biasa - Siti
        User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@gmail.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'telepon' => '084567890123',
            'alamat' => 'Jl. Pahlawan No. 12, Yogyakarta, DI Yogyakarta',
        ]);

        // User biasa - Andi
        User::create([
            'name' => 'Andi Wijaya',
            'email' => 'andi@gmail.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'telepon' => '085678901234',
            'alamat' => 'Jl. Gatot Subroto No. 56, Medan, Sumatera Utara',
        ]);
    }
}
