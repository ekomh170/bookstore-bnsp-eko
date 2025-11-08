<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    /**
     * Tampilkan list buku
     */
    public function index(Request $request)
    {
        $query = Buku::with('kategori');

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Search
        if ($request->filled('search')) {
            $query->cari($request->search);
        }

        $buku = $query->latest()->paginate(12);
        $kategori = KategoriBuku::orderBy('nama_kategori')->get();

        return view('admin.buku.index', compact('buku', 'kategori'));
    }

    /**
     * Form tambah buku
     */
    public function create()
    {
        $kategori = KategoriBuku::orderBy('nama_kategori')->get();
        return view('admin.buku.create', compact('kategori'));
    }

    /**
     * Simpan buku baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori_buku,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'isbn' => 'required|string|max:20|unique:buku,isbn',
            'jumlah_halaman' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
            'bahasa' => 'required|string|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'harga' => 'required|numeric|min:0',
            'berat' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih',
            'judul.required' => 'Judul buku wajib diisi',
            'isbn.unique' => 'ISBN sudah terdaftar',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('buku', 'public');
        }

        $validated['slug'] = Str::slug($validated['judul']);

        Buku::create($validated);

        return redirect()
            ->route('admin.buku.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Detail buku
     */
    public function show(Buku $buku)
    {
        $buku->load('kategori', 'detailPesanan.pesanan');
        return view('admin.buku.show', compact('buku'));
    }

    /**
     * Form edit buku
     */
    public function edit(Buku $buku)
    {
        $kategori = KategoriBuku::orderBy('nama_kategori')->get();
        return view('admin.buku.edit', compact('buku', 'kategori'));
    }

    /**
     * Update buku
     */
    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori_buku,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'isbn' => 'required|string|max:20|unique:buku,isbn,' . $buku->id,
            'jumlah_halaman' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
            'bahasa' => 'required|string|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'harga' => 'required|numeric|min:0',
            'berat' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($buku->gambar) {
                Storage::disk('public')->delete($buku->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('buku', 'public');
        }

        $validated['slug'] = Str::slug($validated['judul']);

        $buku->update($validated);

        return redirect()
            ->route('admin.buku.index')
            ->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Hapus buku
     */
    public function destroy(Buku $buku)
    {
        // Cek apakah buku ada di pesanan
        if ($buku->detailPesanan()->count() > 0) {
            return redirect()
                ->route('admin.buku.index')
                ->with('error', 'Buku tidak dapat dihapus karena sudah ada di pesanan!');
        }

        // Hapus gambar
        if ($buku->gambar) {
            Storage::disk('public')->delete($buku->gambar);
        }

        $buku->delete();

        return redirect()
            ->route('admin.buku.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}
