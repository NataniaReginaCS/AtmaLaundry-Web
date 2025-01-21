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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_layanan')->constrained('layanans')->onDelete('cascade');
            $table->foreignId('id_kategori')->constrained('kategoris')->onDelete('cascade');
            $table->date('tgl_order');
            $table->date('tgl_selesai');
            $table->string('status_pesanan');
            $table->integer('total_bobot');
            $table->string('request');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
