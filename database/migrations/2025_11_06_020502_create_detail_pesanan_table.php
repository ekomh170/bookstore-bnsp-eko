<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel detail_pesanan
     */
    public function up(): void
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanan')->onDelete('cascade'); // Relasi ke pesanan
            $table->foreignId('buku_id')->constrained('buku')->onDelete('cascade'); // Relasi ke buku
            $table->integer('jumlah'); // Jumlah buku yang dipesan
            $table->decimal('harga_satuan', 10, 2); // Harga per buku saat pemesanan
            $table->decimal('subtotal', 12, 2); // Subtotal (jumlah x harga_satuan)
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Menghapus tabel detail_pesanan
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanan');
    }
};
