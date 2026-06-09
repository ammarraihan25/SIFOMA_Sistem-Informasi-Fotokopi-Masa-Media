<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Layanan extends Model
{
    protected $fillable = ['kategori_layanan_id', 'nama', 'deskripsi', 'harga', 'satuan', 'is_active'];

    protected $casts = [
        'harga' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriLayanan::class, 'kategori_layanan_id');
    }
}
