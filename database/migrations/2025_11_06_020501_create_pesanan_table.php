<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel pesanan
     */
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke user
            $table->string('nomor_pesanan', 50)->unique(); // Nomor unik pesanan (auto-generate)
            $table->decimal('total_harga', 12, 2); // Total harga pesanan

            // Status pesanan sesuai flow: menunggu -> dibayar -> diproses -> dikirim -> selesai
            $table->enum('status', [
                'menunggu_pembayaran', // Pesanan dibuat, menunggu konfirmasi pembayaran
                'dibayar',             // User sudah bayar (Payment at Delivery - bayar sebelum dikirim)
                'diproses',            // Admin sedang memproses pesanan
                'dikirim',             // Pesanan sedang dikirim
                'selesai',             // Pesanan selesai diterima
                'dibatalkan'           // Pesanan dibatalkan
            ])->default('menunggu_pembayaran');

            // Detail pengiriman
            $table->text('alamat_pengiriman'); // Alamat lengkap pengiriman
            $table->string('telepon_penerima', 20); // Nomor telepon penerima
            $table->string('nama_penerima', 150)->nullable(); // Nama penerima jika beda dengan user

            // Detail pembayaran (Payment at Delivery)
            $table->enum('metode_pembayaran', ['transfer_bank', 'cod', 'e_wallet'])->default('transfer_bank'); // Metode pembayaran
            $table->string('bukti_pembayaran')->nullable(); // Path file bukti pembayaran (jika transfer)
            $table->timestamp('tanggal_pembayaran')->nullable(); // Tanggal user melakukan pembayaran
            $table->timestamp('tanggal_konfirmasi')->nullable(); // Tanggal admin konfirmasi pembayaran

            $table->text('catatan')->nullable(); // Catatan tambahan dari user
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Menghapus tabel pesanan
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
