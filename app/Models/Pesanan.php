<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    protected $fillable = ['kode_pesanan', 'nama_pelanggan', 'no_telepon', 'catatan', 'status', 'total_biaya'];

    protected $casts = [
        'total_biaya' => 'decimal:2',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(PesananItem::class);
    }

    /**
     * Generate kode pesanan otomatis: MM-YYYYMMDD-XXXX
     */
    public static function generateKode(): string
    {
        $prefix = 'MM-' . date('Ymd') . '-';
        $lastOrder = static::where('kode_pesanan', 'like', $prefix . '%')
            ->orderBy('kode_pesanan', 'desc')
            ->first();

        if ($lastOrder) {
            $lastNumber = (int) substr($lastOrder->kode_pesanan, -4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'antre' => 'Antre',
            'proses' => 'Sedang Diproses',
            'selesai' => 'Selesai',
            'diambil' => 'Sudah Diambil',
            default => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'antre' => 'warning',
            'proses' => 'info',
            'selesai' => 'success',
            'diambil' => 'secondary',
            default => 'secondary',
        };
    }
}
