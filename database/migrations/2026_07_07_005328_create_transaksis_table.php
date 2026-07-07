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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            // Relasi
            $table->unsignedBigInteger('anggota_id');
            $table->unsignedBigInteger('buku_id');

            // Tanggal
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->date('tanggal_dikembalikan')->nullable();

            // Status
            $table->enum('status', [
                'Dipinjam',
                'Dikembalikan'
            ])->default('Dipinjam');

            $table->timestamps();

            // Foreign Key
            $table->foreign('anggota_id')
                  ->references('id')
                  ->on('anggota')
                  ->onDelete('cascade');

            $table->foreign('buku_id')
                  ->references('id')
                  ->on('buku')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};