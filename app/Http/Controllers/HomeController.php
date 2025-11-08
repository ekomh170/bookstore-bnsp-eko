<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Halaman utama toko buku
     */
    public function index()
    {
        // Buku terbaru
        $buku_terbaru = Buku::with('kategori')
            ->aktif()
            ->latest()
            ->limit(8)
            ->get();

        // Buku terlaris
        $buku_terlaris = Buku::with('kategori')
            ->aktif()
            ->orderBy('terjual', 'desc')
            ->limit(8)
            ->get();

        // Kategori populer
        $kategori = KategoriBuku::withCount(['buku' => function ($query) {
            $query->aktif();
        }])
            ->having('buku_count', '>', 0)
            ->orderBy('buku_count', 'desc')
            ->limit(6)
            ->get();

        return view('home', compact('buku_terbaru', 'buku_terlaris', 'kategori'));
    }

    /**
     * Halaman About Us
     */
    public function about()
    {
        return view('about');
    }
}
