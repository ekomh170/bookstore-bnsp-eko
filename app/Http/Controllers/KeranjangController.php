<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class KeranjangController
 *
 * Controller untuk mengelola keranjang belanja user
 * Semua method membutuhkan autentikasi
 *
 * @package App\Http\Controllers
 */
class KeranjangController extends Controller
{
    /**
     * Constructor - semua method butuh auth
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan keranjang belanja
     *
     * Menampilkan daftar item di keranjang user dengan total harga
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $keranjang = $user->keranjang()->with('buku.kategori')->get();
        $total = $keranjang->sum('subtotal');

        return view('keranjang.index', compact('keranjang', 'total'));
    }

    /**
     * Tambah item ke keranjang
     *
     * Menambahkan buku ke keranjang atau update jumlah jika sudah ada
     * dengan validasi stok
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $buku = Buku::findOrFail($validated['buku_id']);

        // Cek stok
        if ($buku->stok < $validated['jumlah']) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        // Cek apakah buku sudah ada di keranjang
        $keranjang = Keranjang::where('user_id', Auth::id())
            ->where('buku_id', $buku->id)
            ->first();

        if ($keranjang) {
            // Update jumlah
            $jumlah_baru = $keranjang->jumlah + $validated['jumlah'];

            // Cek stok lagi
            if ($buku->stok < $jumlah_baru) {
                return back()->with('error', 'Stok tidak mencukupi!');
            }

            $keranjang->update([
                'jumlah' => $jumlah_baru,
            ]);
        } else {
            // Buat item keranjang baru
            Keranjang::create([
                'user_id' => Auth::id(),
                'buku_id' => $buku->id,
                'jumlah' => $validated['jumlah'],
                'harga_satuan' => $buku->harga,
            ]);
        }

        return back()->with('success', 'Buku berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update jumlah item di keranjang
     *
     * Mengubah jumlah item dengan validasi stok dan ownership
     *
     * @param Request $request
     * @param Keranjang $keranjang
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function update(Request $request, Keranjang $keranjang)
    {
        // Pastikan keranjang milik user yang login
        if ($keranjang->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        // Cek stok
        if ($keranjang->buku->stok < $validated['jumlah']) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $keranjang->update($validated);

        return back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    /**
     * Hapus item dari keranjang
     *
     * Menghapus item dari keranjang dengan validasi ownership
     *
     * @param Keranjang $keranjang
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function destroy(Keranjang $keranjang)
    {
        // Pastikan keranjang milik user yang login
        if ($keranjang->user_id !== Auth::id()) {
            abort(403);
        }

        $keranjang->delete();

        return back()->with('success', 'Item berhasil dihapus dari keranjang!');
    }
}
