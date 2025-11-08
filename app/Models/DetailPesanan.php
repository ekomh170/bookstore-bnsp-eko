<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPesanan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'detail_pesanan';

    /**
     * Atribut yang dapat diisi secara massal
     */
    protected $fillable = [
        'pesanan_id',
        'buku_id',
        'jumlah',
        'harga_satuan',
        'subtotal',
    ];

    /**
     * Casting atribut
     */
    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /**
     * Relasi: Detail pesanan milik satu pesanan
     */
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    /**
     * Relasi: Detail pesanan milik satu buku
     */
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    /**
     * Event: Hitung subtotal otomatis sebelum save
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($detailPesanan) {
            $detailPesanan->subtotal = $detailPesanan->jumlah * $detailPesanan->harga_satuan;
        });

        static::updating(function ($detailPesanan) {
            $detailPesanan->subtotal = $detailPesanan->jumlah * $detailPesanan->harga_satuan;
        });
    }
}
