<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::pluck('value', 'key');
        return view('admin.pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $fields = [
            'nama_toko', 'tagline', 'alamat', 'telepon', 'whatsapp', 'email',
            'jam_buka', 'jam_buka_detail', 'google_maps_embed',
            'deskripsi_singkat', 'sejarah',
            'keunggulan_1', 'keunggulan_1_desc',
            'keunggulan_2', 'keunggulan_2_desc',
            'keunggulan_3', 'keunggulan_3_desc',
            'instagram', 'facebook',
        ];

        foreach ($fields as $field) {
            Pengaturan::setValue($field, $request->input("pengaturan.{$field}"));
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}
