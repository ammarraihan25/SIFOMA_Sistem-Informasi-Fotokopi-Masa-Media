<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriLayanan;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = KategoriLayanan::orderBy('urutan')->get();

        $query = Layanan::with('kategori');

        if ($request->filled('kategori')) {
            $query->where('kategori_layanan_id', $request->kategori);
        }

        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }

        $layanans = $query->orderBy('kategori_layanan_id')->orderBy('nama')->paginate(20);

        return view('admin.layanan.index', compact('layanans', 'kategoris'));
    }

    public function create()
    {
        $kategoris = KategoriLayanan::orderBy('urutan')->get();
        return view('admin.layanan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_layanan_id' => 'required|exists:kategori_layanans,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:50',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        Layanan::create($validated);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        $kategoris = KategoriLayanan::orderBy('urutan')->get();
        return view('admin.layanan.edit', compact('layanan', 'kategoris'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $validated = $request->validate([
            'kategori_layanan_id' => 'required|exists:kategori_layanans,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:50',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $layanan->update($validated);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }

    // ===== KATEGORI MANAGEMENT =====

    public function kategoriIndex()
    {
        $kategoris = KategoriLayanan::withCount('layanans')->orderBy('urutan')->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function kategoriCreate()
    {
        return view('admin.kategori.create');
    }

    public function kategoriStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['nama']);
        $validated['urutan'] = $validated['urutan'] ?? 0;

        KategoriLayanan::create($validated);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function kategoriEdit(KategoriLayanan $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function kategoriUpdate(Request $request, KategoriLayanan $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['nama']);
        $validated['urutan'] = $validated['urutan'] ?? 0;

        $kategori->update($validated);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function kategoriDestroy(KategoriLayanan $kategori)
    {
        if ($kategori->layanans()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki layanan.');
        }

        $kategori->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
