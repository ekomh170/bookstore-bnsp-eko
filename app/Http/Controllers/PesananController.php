<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class PesananController
 *
 * Controller untuk mengelola pesanan user (checkout, upload bukti, cancel)
 * Semua method membutuhkan autentikasi
 *
 * @package App\Http\Controllers
 */
class PesananController extends Controller
{
    /**
     * Constructor - semua method butuh auth
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Daftar pesanan user
     *
     * Menampilkan daftar semua pesanan milik user yang sedang login
     * dengan pagination dan relasi detail pesanan
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $pesanan = $user->pesanan()
            ->with('detailPesanan.buku')
            ->terbaru()
            ->paginate(10);

        return view('pesanan.index', compact('pesanan'));
    }

    /**
     * Detail pesanan
     *
     * Menampilkan detail pesanan dengan validasi ownership
     *
     * @param Pesanan $pesanan
     * @return \Illuminate\View\View
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function show(Pesanan $pesanan)
    {
        // Pastikan pesanan milik user yang login
        if ($pesanan->user_id !== Auth::id()) {
            abort(403);
        }

        $pesanan->load('detailPesanan.buku');

        return view('pesanan.show', compact('pesanan'));
    }

    /**
     * Form checkout dari keranjang
     *
     * Menampilkan form checkout dengan data keranjang user
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function checkout()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $keranjang = $user->keranjang()->with('buku')->get();

        if ($keranjang->isEmpty()) {
            return redirect()
                ->route('keranjang.index')
                ->with('error', 'Keranjang belanja kosong!');
        }

        $total = $keranjang->sum('subtotal');

        return view('pesanan.checkout', compact('keranjang', 'total'));
    }

    /**
     * Proses checkout
     *
     * Membuat pesanan baru dari item di keranjang, validasi stok,
     * kurangi stok buku, dan hapus keranjang setelah berhasil
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $keranjang = $user->keranjang()->with('buku')->get();

        if ($keranjang->isEmpty()) {
            return redirect()
                ->route('keranjang.index')
                ->with('error', 'Keranjang belanja kosong!');
        }

        $validated = $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'telepon_penerima' => 'required|string|max:20',
            'alamat_pengiriman' => 'required|string',
            'metode_pembayaran' => 'required|in:transfer_bank,cod,e_wallet',
            'catatan' => 'nullable|string',
        ]);

        // Cek stok semua item
        foreach ($keranjang as $item) {
            if ($item->buku->stok < $item->jumlah) {
                return back()->with('error', "Stok buku '{$item->buku->judul}' tidak mencukupi!");
            }
        }

        DB::beginTransaction();
        try {
            // Hitung total
            $total_harga = $keranjang->sum('subtotal');

            // Buat pesanan
            $pesanan = Pesanan::create([
                'user_id' => $user->id,
                'nomor_pesanan' => Pesanan::generateNomorPesanan(),
                'total_harga' => $total_harga,
                'status' => 'menunggu_pembayaran',
                'nama_penerima' => $validated['nama_penerima'],
                'telepon_penerima' => $validated['telepon_penerima'],
                'alamat_pengiriman' => $validated['alamat_pengiriman'],
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'catatan' => $validated['catatan'] ?? null,
            ]);

            // Buat detail pesanan dan kurangi stok
            foreach ($keranjang as $item) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'buku_id' => $item->buku_id,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->harga_satuan,
                ]);

                // Kurangi stok buku
                $item->buku->decrement('stok', $item->jumlah);
            }

            // Hapus keranjang
            $user->keranjang()->delete();

            DB::commit();

            return redirect()
                ->route('pesanan.show', $pesanan)
                ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Upload bukti pembayaran
     *
     * User upload bukti pembayaran untuk pesanan yang statusnya menunggu_pembayaran
     *
     * @param Request $request
     * @param Pesanan $pesanan
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function uploadBukti(Request $request, Pesanan $pesanan)
    {
        // Pastikan pesanan milik user yang login
        if ($pesanan->user_id !== Auth::id()) {
            abort(403);
        }

        // Pastikan status masih menunggu_pembayaran
        if ($pesanan->status !== 'menunggu_pembayaran') {
            return back()->with('error', 'Pesanan tidak dalam status menunggu pembayaran!');
        }

        $validated = $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'bukti_pembayaran.required' => 'Bukti pembayaran wajib diupload',
            'bukti_pembayaran.image' => 'File harus berupa gambar',
            'bukti_pembayaran.max' => 'Ukuran file maksimal 2MB',
        ]);

        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $pesanan->update([
            'bukti_pembayaran' => $path,
            'tanggal_pembayaran' => now(),
            'status' => 'dibayar',
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diupload! Pesanan akan segera diproses.');
    }

    /**
     * Batalkan pesanan
     *
     * Membatalkan pesanan dan mengembalikan stok buku
     *
     * @param Pesanan $pesanan
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function cancel(Pesanan $pesanan)
    {
        // Pastikan pesanan milik user yang login
        if ($pesanan->user_id !== Auth::id()) {
            abort(403);
        }

        // Cek apakah bisa dibatalkan
        if (!$pesanan->bisDibatalkan()) {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan!');
        }

        DB::beginTransaction();
        try {
            // Kembalikan stok
            foreach ($pesanan->detailPesanan as $detail) {
                $detail->buku->increment('stok', $detail->jumlah);

                // Kurangi terjual jika ada
                if ($detail->buku->terjual >= $detail->jumlah) {
                    $detail->buku->decrement('terjual', $detail->jumlah);
                }
            }

            $pesanan->update(['status' => 'dibatalkan']);

            DB::commit();

            return back()->with('success', 'Pesanan berhasil dibatalkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
