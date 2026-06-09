<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\PesananItem;
use App\Models\Layanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::with('items.layanan');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('cari')) {
            $search = $request->cari;
            $query->where(function ($q) use ($search) {
                $q->where('kode_pesanan', 'like', '%' . $search . '%')
                    ->orWhere('nama_pelanggan', 'like', '%' . $search . '%')
                    ->orWhere('no_telepon', 'like', '%' . $search . '%');
            });
        }

        $pesanans = $query->latest()->paginate(15);

        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function create()
    {
        $layanans = Layanan::with('kategori')->where('is_active', true)->orderBy('kategori_layanan_id')->get();
        $kodePesanan = Pesanan::generateKode();

        return view('admin.pesanan.create', compact('layanans', 'kodePesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'catatan' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.layanan_id' => 'required|exists:layanans,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.keterangan' => 'nullable|string',
        ]);

        $totalBiaya = 0;
        $itemsData = [];

        foreach ($request->items as $item) {
            $layanan = Layanan::findOrFail($item['layanan_id']);
            $subtotal = $layanan->harga * $item['jumlah'];
            $totalBiaya += $subtotal;

            $itemsData[] = [
                'layanan_id' => $item['layanan_id'],
                'jumlah' => $item['jumlah'],
                'keterangan' => $item['keterangan'] ?? null,
                'harga_satuan' => $layanan->harga,
                'subtotal' => $subtotal,
            ];
        }

        $pesanan = Pesanan::create([
            'kode_pesanan' => Pesanan::generateKode(),
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_telepon' => $request->no_telepon,
            'catatan' => $request->catatan,
            'status' => 'antre',
            'total_biaya' => $totalBiaya,
        ]);

        foreach ($itemsData as $itemData) {
            $pesanan->items()->create($itemData);
        }

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan ' . $pesanan->kode_pesanan . ' berhasil dibuat.');
    }

    public function show(Pesanan $pesanan)
    {
        $pesanan->load('items.layanan');
        return view('admin.pesanan.show', compact('pesanan'));
    }

    public function edit(Pesanan $pesanan)
    {
        $pesanan->load('items.layanan');
        $layanans = Layanan::with('kategori')->where('is_active', true)->orderBy('kategori_layanan_id')->get();

        return view('admin.pesanan.edit', compact('pesanan', 'layanans'));
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'catatan' => 'nullable|string',
            'status' => 'required|in:antre,proses,selesai,diambil',
            'items' => 'required|array|min:1',
            'items.*.layanan_id' => 'required|exists:layanans,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.keterangan' => 'nullable|string',
        ]);

        $totalBiaya = 0;
        $itemsData = [];

        foreach ($request->items as $item) {
            $layanan = Layanan::findOrFail($item['layanan_id']);
            $subtotal = $layanan->harga * $item['jumlah'];
            $totalBiaya += $subtotal;

            $itemsData[] = [
                'layanan_id' => $item['layanan_id'],
                'jumlah' => $item['jumlah'],
                'keterangan' => $item['keterangan'] ?? null,
                'harga_satuan' => $layanan->harga,
                'subtotal' => $subtotal,
            ];
        }

        $pesanan->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_telepon' => $request->no_telepon,
            'catatan' => $request->catatan,
            'status' => $request->status,
            'total_biaya' => $totalBiaya,
        ]);

        $pesanan->items()->delete();
        foreach ($itemsData as $itemData) {
            $pesanan->items()->create($itemData);
        }

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan ' . $pesanan->kode_pesanan . ' berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate(['status' => 'required|in:antre,proses,selesai,diambil']);
        $pesanan->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan ' . $pesanan->kode_pesanan . ' berhasil diubah menjadi "' . $pesanan->status_label . '".');
    }

    public function destroy(Pesanan $pesanan)
    {
        $kode = $pesanan->kode_pesanan;
        $pesanan->items()->delete();
        $pesanan->delete();

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan ' . $kode . ' berhasil dihapus.');
    }
}
