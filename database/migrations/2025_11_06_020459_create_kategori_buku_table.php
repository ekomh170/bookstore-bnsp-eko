<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel kategori_buku
     */
    public function up(): void
    {
        Schema::create('kategori_buku', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori', 100); // Nama kategori buku
            $table->text('deskripsi')->nullable(); // Deskripsi kategori
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Menghapus tabel kategori_buku
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_buku');
    }
};
