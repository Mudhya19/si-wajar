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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('masakan_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama_menu');
            $table->enum('jenis_menu',['minuman', 'makanan']); // pilih jenis menu kalau salah satu dipilih, maka yang aktif yang di pilih dari 2 field makanan dan minuman
            $table->text('photo')->nullable();
            $table->string('satuan')->nullable();
            $table->enum('status',['tersedia', 'tidak tersedia']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
