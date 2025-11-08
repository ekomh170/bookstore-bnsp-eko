<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PesananController extends Controller
{
    /**
     * Tampilkan list pesanan
     */
    public function index(Request $request)
    {
        $query = Pesanan::with('user');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->status($request->status);
        }

        // Search berdasarkan nomor pesanan atau nama user
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_pesanan', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $pesanan = $query->terbaru()->paginate(15);

        return view('admin.pesanan.index', compact('pesanan'));
    }

    /**
     * Detail pesanan
     */
    public function show(Pesanan $pesanan)
    {
        $pesanan->load(['user', 'detailPesanan.buku']);
        return view('admin.pesanan.show', compact('pesanan'));
    }

    /**
     * Update status pesanan
     */
    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu_pembayaran,dibayar,diproses,dikirim,selesai,dibatalkan',
        ]);

        // Validasi status transition
        $allowedTransitions = [
            'menunggu_pembayaran' => ['dibayar', 'dibatalkan'],
            'dibayar' => ['diproses', 'dibatalkan'],
            'diproses' => ['dikirim', 'dibatalkan'],
            'dikirim' => ['selesai'],
            'selesai' => [],
            'dibatalkan' => [],
        ];

        $currentStatus = $pesanan->status;
        $newStatus = $validated['status'];

        if (!in_array($newStatus, $allowedTransitions[$currentStatus])) {
            return back()->with('error', 'Perubahan status tidak diizinkan!');
        }

        // Update status
        $pesanan->status = $newStatus;

        // Set tanggal konfirmasi jika status menjadi 'diproses'
        if ($newStatus === 'diproses' && !$pesanan->tanggal_konfirmasi) {
            $pesanan->tanggal_konfirmasi = now();
        }

        $pesanan->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    /**
     * Konfirmasi pembayaran
     */
    public function konfirmasiPembayaran(Request $request, Pesanan $pesanan)
    {
        if ($pesanan->status !== 'dibayar') {
            return back()->with('error', 'Pesanan belum dalam status dibayar!');
        }

        $pesanan->update([
            'status' => 'diproses',
            'tanggal_konfirmasi' => now(),
        ]);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}
