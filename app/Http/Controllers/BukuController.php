<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Daftar semua buku dengan filter dan search
     */
    public function index(Request $request)
    {
        $query = Buku::with('kategori')->aktif();

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Search
        if ($request->filled('search')) {
            $query->cari($request->search);
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        switch ($sort) {
            case 'terlaris':
                $query->orderBy('terjual', 'desc');
                break;
            case 'termurah':
                $query->orderBy('harga', 'asc');
                break;
            case 'termahal':
                $query->orderBy('harga', 'desc');
                break;
            default:
                $query->latest();
        }

        $buku = $query->paginate(12);
        $kategori = KategoriBuku::orderBy('nama_kategori')->get();

        return view('buku.index', compact('buku', 'kategori'));
    }

    /**
     * Detail buku
     */
    public function show(Buku $buku)
    {
        // Pastikan buku aktif
        if (!$buku->is_active) {
            abort(404);
        }

        $buku->load('kategori');

        // Buku terkait (kategori sama)
        $buku_terkait = Buku::with('kategori')
            ->where('kategori_id', $buku->kategori_id)
            ->where('id', '!=', $buku->id)
            ->aktif()
            ->limit(4)
            ->get();

        return view('buku.show', compact('buku', 'buku_terkait'));
    }
}
