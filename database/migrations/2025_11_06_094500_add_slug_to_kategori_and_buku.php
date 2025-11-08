<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom slug ke tabel kategori_buku dan buku
     */
    public function up(): void
    {
        // Tambah slug di kategori_buku
        Schema::table('kategori_buku', function (Blueprint $table) {
            $table->string('slug', 100)->after('nama_kategori')->nullable();
        });

        // Tambah slug di buku jika belum ada
        if (!Schema::hasColumn('buku', 'slug')) {
            Schema::table('buku', function (Blueprint $table) {
                $table->string('slug', 255)->after('judul')->nullable();
            });
        }
    }

    /**
     * Menghapus kolom slug
     */
    public function down(): void
    {
        Schema::table('kategori_buku', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('buku', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
