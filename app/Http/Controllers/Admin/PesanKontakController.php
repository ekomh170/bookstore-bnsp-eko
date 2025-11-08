<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class PesanKontakController extends Controller
{
    /**
     * Tampilkan list pesan kontak
     */
    public function index(Request $request)
    {
        $query = PesanKontak::with('user');

        // Filter berdasarkan status baca
        if ($request->filled('sudah_dibaca')) {
            $query->where('sudah_dibaca', $request->sudah_dibaca === '1');
        }

        $pesan = $query->latest()->paginate(15);

        // Hitung pesan belum dibaca
        $belum_dibaca = PesanKontak::where('sudah_dibaca', false)->count();

        return view('admin.pesan.index', compact('pesan', 'belum_dibaca'));
    }

    /**
     * Detail dan tandai sudah dibaca
     */
    public function show(PesanKontak $pesan)
    {
        // Tandai sudah dibaca
        if (!$pesan->sudah_dibaca) {
            $pesan->update(['sudah_dibaca' => true]);
        }

        return view('admin.pesan.show', compact('pesan'));
    }

    /**
     * Hapus pesan
     */
    public function destroy(PesanKontak $pesan)
    {
        $pesan->delete();

        return redirect()
            ->route('admin.pesan.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }
}
