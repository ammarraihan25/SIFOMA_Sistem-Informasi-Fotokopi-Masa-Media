<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'gambar', 'diskon_persen', 'tanggal_mulai', 'tanggal_selesai', 'is_active'];

    protected $casts = [
        'diskon_persen' => 'decimal:2',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('tanggal_selesai')
                    ->orWhere('tanggal_selesai', '>=', now()->toDateString());
            });
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->tanggal_selesai && $this->tanggal_selesai->isPast();
    }
}
