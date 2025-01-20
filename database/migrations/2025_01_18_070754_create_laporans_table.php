<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->sstring('total_pendapatan');
            $table->sstring('pemasukan');
            $table->sstring('pengeluaran');
            $table->date('tanggal');
            $table->string('keterangan');
            $table->string('kendala');
            $table->string('solusi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
