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
        Schema::create('arsip_surats', function (Blueprint $table) {
            $table->id('id_arsip_surat');
            $table->string('nomor_surat')->nullable()->unique();
            $table->foreignId('id_kategori')->constrained('kategoris','id_kategori')->onDelete('cascade');
            $table->string('judul')->nullable();
            $table->dateTime('waktu_pengarsipan')->nullable();
            $table->string('berkas')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_surats');
    }
};
