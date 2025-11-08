<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesanKontak extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'pesan_kontak';

    /**
     * Atribut yang dapat diisi secara massal
     */
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'subjek',
        'pesan',
        'sudah_dibaca',
    ];

    /**
     * Casting atribut
     */
    protected $casts = [
        'sudah_dibaca' => 'boolean',
    ];

    /**
     * Relasi: Pesan kontak milik satu user (nullable)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
