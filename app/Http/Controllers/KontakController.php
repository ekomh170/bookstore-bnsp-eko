<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontakController extends Controller
{
    /**
     * Halaman form kontak
     */
    public function index()
    {
        return view('kontak');
    }

    /**
     * Kirim pesan kontak
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'subjek.required' => 'Subjek wajib diisi',
            'pesan.required' => 'Pesan wajib diisi',
        ]);

        // Tambahkan user_id jika user login
        $validated['user_id'] = Auth::id();
        $validated['sudah_dibaca'] = false;

        PesanKontak::create($validated);

        return redirect()
            ->route('kontak')
            ->with('success', 'Terima kasih! Pesan Anda telah terkirim. Kami akan segera merespons.');
    }
}
