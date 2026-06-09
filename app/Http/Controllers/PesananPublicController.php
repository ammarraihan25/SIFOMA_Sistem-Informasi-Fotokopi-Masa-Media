<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananPublicController extends Controller
{
    public function index()
    {
        return view('public.cek-pesanan');
    }

    public function cek(Request $request)
    {
        $request->validate([
            'kode_pesanan' => 'required|string',
        ]);

        $pesanan = Pesanan::with('items.layanan')->where('kode_pesanan', strtoupper($request->kode_pesanan))->first();

        if (!$pesanan) {
            return back()->with('error', 'Pesanan dengan kode "' . $request->kode_pesanan . '" tidak ditemukan. Pastikan kode pesanan sudah benar.')->withInput();
        }

        return view('public.hasil-pesanan', compact('pesanan'));
    }

    /**
     * API endpoint for AJAX order check
     */
    public function cekApi(Request $request)
    {
        $pesanan = Pesanan::with('items.layanan')->where('kode_pesanan', strtoupper($request->kode))->first();

        if (!$pesanan) {
            return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'kode_pesanan' => $pesanan->kode_pesanan,
                'nama_pelanggan' => $pesanan->nama_pelanggan,
                'status' => $pesanan->status,
                'status_label' => $pesanan->status_label,
                'total_biaya' => number_format($pesanan->total_biaya, 0, ',', '.'),
                'tanggal' => $pesanan->created_at->format('d M Y H:i'),
                'items' => $pesanan->items->map(function ($item) {
                    return [
                        'layanan' => $item->layanan->nama ?? '-',
                        'jumlah' => $item->jumlah,
                        'satuan' => $item->layanan->satuan ?? '-',
                        'harga_satuan' => number_format($item->harga_satuan, 0, ',', '.'),
                        'subtotal' => number_format($item->subtotal, 0, ',', '.'),
                        'keterangan' => $item->keterangan,
                    ];
                }),
            ],
        ]);
    }
}
