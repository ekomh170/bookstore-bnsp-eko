<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keranjang extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'keranjang';

    /**
     * Atribut yang dapat diisi secara massal
     */
    protected $fillable = [
        'user_id',
        'buku_id',
        'jumlah',
        'harga_satuan',
    ];

    /**
     * Relasi: Keranjang milik satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Keranjang berisi satu buku
     */
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    /**
     * Accessor: Hitung subtotal
     */
    public function getSubtotalAttribute()
    {
        return $this->jumlah * $this->harga_satuan;
    }
}
