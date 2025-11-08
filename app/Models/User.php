<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pesanan> $pesanan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PesanKontak> $pesanKontak
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Keranjang> $keranjang
 * @method \Illuminate\Database\Eloquent\Relations\HasMany pesanan()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany pesanKontak()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany keranjang()
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi secara massal
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'telepon',
        'alamat',
    ];

    /**
     * Atribut yang disembunyikan saat serialisasi
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi: User memiliki banyak pesanan
     */
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }

    /**
     * Relasi: User memiliki banyak pesan kontak
     */
    public function pesanKontak()
    {
        return $this->hasMany(PesanKontak::class);
    }

    /**
     * Relasi: User memiliki banyak item di keranjang
     */
    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    /**
     * Helper: Cek apakah user adalah admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Helper: Hitung total item di keranjang
     */
    public function totalItemKeranjang()
    {
        return $this->keranjang()->sum('jumlah');
    }

    /**
     * Helper: Hitung total harga keranjang
     */
    public function totalHargaKeranjang()
    {
        return $this->keranjang()
            ->join('buku', 'keranjang.buku_id', '=', 'buku.id')
            ->selectRaw('SUM(keranjang.jumlah * keranjang.harga_satuan) as total')
            ->value('total') ?? 0;
    }
}
