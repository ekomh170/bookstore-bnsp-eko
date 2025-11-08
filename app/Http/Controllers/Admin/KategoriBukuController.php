<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriBukuController extends Controller
{
    /**
     * Tampilkan list kategori buku
     */
    public function index()
    {
        $kategori = KategoriBuku::withCount('buku')
            ->latest()
            ->paginate(10);

        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Form tambah kategori
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_buku,nama_kategori',
            'deskripsi' => 'nullable|string',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.unique' => 'Nama kategori sudah ada',
        ]);

        $validated['slug'] = Str::slug($validated['nama_kategori']);

        KategoriBuku::create($validated);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Form edit kategori
     */
    public function edit(KategoriBuku $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, KategoriBuku $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_buku,nama_kategori,' . $kategori->id,
            'deskripsi' => 'nullable|string',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.unique' => 'Nama kategori sudah ada',
        ]);

        $validated['slug'] = Str::slug($validated['nama_kategori']);

        $kategori->update($validated);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori
     */
    public function destroy(KategoriBuku $kategori)
    {
        // Cek apakah kategori masih memiliki buku
        if ($kategori->buku()->count() > 0) {
            return redirect()
                ->route('admin.kategori.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki buku!');
        }

        $kategori->delete();

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
