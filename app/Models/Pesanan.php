<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'pesanan';

    /**
     * Atribut yang dapat diisi secara massal
     */
    protected $fillable = [
        'user_id',
        'nomor_pesanan',
        'total_harga',
        'status',
        'alamat_pengiriman',
        'telepon_penerima',
        'nama_penerima',
        'metode_pembayaran',
        'bukti_pembayaran',
        'tanggal_pembayaran',
        'tanggal_konfirmasi',
        'catatan',
    ];

    /**
     * Casting atribut
     */
    protected $casts = [
        'tanggal_pembayaran' => 'datetime',
        'tanggal_konfirmasi' => 'datetime',
        'total_harga' => 'decimal:2',
    ];

    /**
     * Relasi: Pesanan milik satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Pesanan memiliki banyak detail pesanan
     */
    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }

    /**
     * Scope: Filter berdasarkan status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope: Pesanan terbaru
     */
    public function scopeTerbaru($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Helper: Generate nomor pesanan unik
     */
    public static function generateNomorPesanan()
    {
        $prefix = 'INV';
        $date = date('Ymd');
        $random = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        return $prefix . '/' . $date . '/' . $random;
    }

    /**
     * Helper: Cek apakah pesanan bisa dibatalkan
     */
    public function bisDibatalkan()
    {
        return in_array($this->status, ['menunggu_pembayaran', 'dibayar']);
    }

    /**
     * Helper: Cek apakah pesanan sudah selesai
     */
    public function sudahSelesai()
    {
        return in_array($this->status, ['selesai', 'dibatalkan']);
    }
}
