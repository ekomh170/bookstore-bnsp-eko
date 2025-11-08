<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriBuku;

class KategoriBukuSeeder extends Seeder
{
    /**
     * Seed data kategori buku
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama_kategori' => 'Pemrograman',
                'slug' => 'pemrograman',
                'deskripsi' => 'Buku-buku tentang pemrograman, coding, dan pengembangan software',
            ],
            [
                'nama_kategori' => 'Novel',
                'slug' => 'novel',
                'deskripsi' => 'Kumpulan novel fiksi dan non-fiksi dari berbagai penulis',
            ],
            [
                'nama_kategori' => 'Bisnis & Ekonomi',
                'slug' => 'bisnis-ekonomi',
                'deskripsi' => 'Buku tentang bisnis, ekonomi, keuangan, dan kewirausahaan',
            ],
            [
                'nama_kategori' => 'Sejarah',
                'slug' => 'sejarah',
                'deskripsi' => 'Buku sejarah Indonesia dan dunia',
            ],
            [
                'nama_kategori' => 'Agama & Spiritual',
                'slug' => 'agama-spiritual',
                'deskripsi' => 'Buku tentang agama, spiritual, dan pengembangan diri',
            ],
            [
                'nama_kategori' => 'Anak-anak',
                'slug' => 'anak-anak',
                'deskripsi' => 'Buku cerita dan edukasi untuk anak-anak',
            ],
            [
                'nama_kategori' => 'Komik & Manga',
                'slug' => 'komik-manga',
                'deskripsi' => 'Koleksi komik dan manga lokal maupun terjemahan',
            ],
            [
                'nama_kategori' => 'Pendidikan',
                'slug' => 'pendidikan',
                'deskripsi' => 'Buku pelajaran, referensi, dan buku pendidikan',
            ],
            [
                'nama_kategori' => 'Kesehatan',
                'slug' => 'kesehatan',
                'deskripsi' => 'Buku tentang kesehatan, nutrisi, dan gaya hidup sehat',
            ],
            [
                'nama_kategori' => 'Seni & Budaya',
                'slug' => 'seni-budaya',
                'deskripsi' => 'Buku tentang seni, musik, tari, dan budaya',
            ],
        ];

        foreach ($kategoris as $kategori) {
            KategoriBuku::create($kategori);
        }
    }
}
