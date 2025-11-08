<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel keranjang untuk menyimpan item yang akan dibeli user
     */
    public function up(): void
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke user
            $table->foreignId('buku_id')->constrained('buku')->onDelete('cascade'); // Relasi ke buku
            $table->integer('jumlah')->default(1); // Jumlah buku di keranjang
            $table->decimal('harga_satuan', 10, 2); // Harga saat ditambahkan ke keranjang
            $table->timestamps(); // created_at dan updated_at

            // Constraint: Satu user hanya bisa punya satu item buku yang sama di keranjang
            $table->unique(['user_id', 'buku_id']);
        });
    }

    /**
     * Menghapus tabel keranjang
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
