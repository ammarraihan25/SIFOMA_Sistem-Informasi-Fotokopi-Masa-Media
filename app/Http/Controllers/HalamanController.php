<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;

class HalamanController extends Controller
{
    public function tentangKami()
    {
        $pengaturan = Pengaturan::pluck('value', 'key');
        return view('public.tentang-kami', compact('pengaturan'));
    }

    public function kontak()
    {
        $pengaturan = Pengaturan::pluck('value', 'key');
        return view('public.kontak', compact('pengaturan'));
    }
}
