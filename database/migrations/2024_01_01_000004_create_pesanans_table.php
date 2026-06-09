<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan')->unique();
            $table->string('nama_pelanggan');
            $table->string('no_telepon')->nullable();
            $table->text('catatan')->nullable();
            $table->enum('status', ['antre', 'proses', 'selesai', 'diambil'])->default('antre');
            $table->decimal('total_biaya', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
