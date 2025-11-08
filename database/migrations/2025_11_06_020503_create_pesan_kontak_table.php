<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel pesan_kontak untuk menyimpan pesan dari user ke admin
     */
    public function up(): void
    {
        Schema::create('pesan_kontak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Relasi ke user (nullable untuk guest)
            $table->string('nama', 150); // Nama pengirim
            $table->string('email', 150); // Email pengirim
            $table->string('subjek', 200); // Subjek pesan
            $table->text('pesan'); // Isi pesan
            $table->boolean('sudah_dibaca')->default(false); // Status sudah dibaca admin
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Menghapus tabel pesan_kontak
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan_kontak');
    }
};
