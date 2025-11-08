<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriBuku extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'kategori_buku';

    /**
     * Atribut yang dapat diisi secara massal
     */
    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
    ];

    /**
     * Relasi: Kategori memiliki banyak buku
     */
    public function buku()
    {
        return $this->hasMany(Buku::class, 'kategori_id');
    }
}
