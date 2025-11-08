<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Buku;
use App\Models\Pesanan;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard admin dengan statistik
     */
    public function index()
    {
        // Statistik untuk dashboard
        $stats = [
            'total_user' => User::where('role', 'user')->count(),
            'total_buku' => Buku::count(),
            'total_pesanan' => Pesanan::count(),
            'total_pendapatan' => Pesanan::whereIn('status', ['selesai', 'dikirim', 'diproses'])
                ->sum('total_harga'),
            'pesanan_baru' => Pesanan::where('status', 'menunggu_pembayaran')->count(),
            'pesan_belum_dibaca' => PesanKontak::where('sudah_dibaca', false)->count(),
        ];

        // Pesanan terbaru
        $pesanan_terbaru = Pesanan::with('user')
            ->terbaru()
            ->limit(5)
            ->get();

        // Buku terlaris
        $buku_terlaris = Buku::orderBy('terjual', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'pesanan_terbaru', 'buku_terlaris'));
    }
}
