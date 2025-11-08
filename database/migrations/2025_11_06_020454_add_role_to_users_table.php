<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom role ke tabel users
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom role: admin atau user (default: user)
            $table->enum('role', ['admin', 'user'])->default('user')->after('email');
            // Tambah kolom tambahan untuk user
            $table->string('telepon', 20)->nullable()->after('role');
            $table->text('alamat')->nullable()->after('telepon');
        });
    }

    /**
     * Menghapus kolom yang ditambahkan
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom yang ditambahkan
            $table->dropColumn(['role', 'telepon', 'alamat']);
        });
    }
};
