<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'buku';

    /**
     * Atribut yang dapat diisi secara massal
     */
    protected $fillable = [
        'kategori_id',
        'judul',
        'slug',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'jumlah_halaman',
        'deskripsi',
        'bahasa',
        'gambar',
        'harga',
        'berat',
        'stok',
        'is_active',
        'terjual',
    ];

    /**
     * Casting atribut
     */
    protected $casts = [
        'is_active' => 'boolean',
        'harga' => 'decimal:2',
        'berat' => 'decimal:2',
    ];

    /**
     * Relasi: Buku milik satu kategori
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_id');
    }

    /**
     * Relasi: Buku ada di banyak detail pesanan
     */
    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }

    /**
     * Relasi: Buku ada di banyak keranjang
     */
    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    /**
     * Scope: Hanya buku yang aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Hanya buku yang tersedia (stok > 0)
     */
    public function scopeTersedia($query)
    {
        return $query->where('stok', '>', 0);
    }

    /**
     * Scope: Pencarian buku
     */
    public function scopeCari($query, $keyword)
    {
        return $query->where(function($q) use ($keyword) {
            $q->where('judul', 'like', "%{$keyword}%")
              ->orWhere('penulis', 'like', "%{$keyword}%")
              ->orWhere('penerbit', 'like', "%{$keyword}%")
              ->orWhere('isbn', 'like', "%{$keyword}%");
        });
    }

    /**
     * Helper: Cek apakah buku tersedia
     */
    public function isTersedia()
    {
        return $this->is_active && $this->stok > 0;
    }
}
