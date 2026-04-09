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
    Schema::create('akun', function (Blueprint $table) {
        $table->id();
        $table->string('nama_akun');
        $table->string('kategori_game');
        $table->unsignedBigInteger('id_transaksi')->nullable();
        $table->integer('harga');
        $table->text('deskripsi')->nullable();
        $table->string('foto')->nullable();
        $table->enum('status', ['ready', 'booking', 'sold'])->default('ready');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun');
    }
};
