<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel buku
     */
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_buku')->onDelete('cascade'); // Relasi ke kategori

            // Informasi dasar buku
            $table->string('judul', 200); // Judul buku
            $table->string('penulis', 150); // Nama penulis
            $table->string('penerbit', 150); // Nama penerbit
            $table->year('tahun_terbit'); // Tahun terbit (gunakan year type)
            $table->string('isbn', 50)->unique(); // ISBN buku (unique identifier)
            $table->integer('jumlah_halaman'); // Jumlah halaman buku
            $table->text('deskripsi')->nullable(); // Deskripsi lengkap buku
            $table->string('bahasa', 50)->default('Indonesia'); // Bahasa buku

            // Gambar dan media
            $table->string('gambar')->nullable(); // Path gambar cover buku

            // Informasi harga dan stok
            $table->decimal('harga', 10, 2); // Harga jual buku
            $table->decimal('berat', 8, 2)->default(0); // Berat buku dalam gram (untuk ongkir)
            $table->integer('stok')->default(0); // Stok tersedia

            // Status dan metadata
            $table->boolean('is_active')->default(true); // Apakah buku masih dijual
            $table->integer('terjual')->default(0); // Jumlah buku yang sudah terjual (untuk statistik)

            $table->timestamps(); // created_at dan updated_at

            // Index untuk pencarian yang lebih cepat
            $table->index('judul');
            $table->index('penulis');
            $table->index(['kategori_id', 'is_active']);
        });
    }

    /**
     * Menghapus tabel buku
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
