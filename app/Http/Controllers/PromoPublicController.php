<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Portofolio;

class PromoPublicController extends Controller
{
    public function index()
    {
        $promos = Promo::active()->latest()->get();
        $portofolios = Portofolio::active()->latest()->get();

        return view('public.promo', compact('promos', 'portofolios'));
    }
}
