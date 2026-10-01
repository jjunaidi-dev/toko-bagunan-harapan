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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id(); // Primary Key (BIGINT AUTO_INCREMENT)
            $table->string('kode_barang', 50)->unique(); // Unique untuk kode barang (contoh: BRG-001)
            $table->string('nama_barang'); // Nama barang
            $table->string('satuan', 20); // Satuan barang (contoh: Pcs, Sak, Batang, KG, DUS)
            $table->decimal('harga_modal', 15, 2); // Harga Beli/Modal (max 999.999.999.999,99)
            $table->decimal('harga_jual', 15, 2);  // Harga Jual Eceran
            $table->decimal('harga_grosir', 15, 2)->nullable(); // Harga Grosir (opsional/bisa kosong)
            $table->timestamps(); // Created_at & Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};