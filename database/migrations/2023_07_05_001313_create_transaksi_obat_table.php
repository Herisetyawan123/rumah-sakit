<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_obat', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->decimal('harga_saat_ini')->default(0);
            $table->unsignedBigInteger('pasien_id');
            $table->enum('status_pembayaran',['pending','menunggu konfirmasi','lunas','ditolak'])->default('pending');
            $table->enum('status_pengambilan',['diambil','sedang diambil', 'pending','diterima','sedang diantarkan'])->default('pending');
            $table->enum('status_proses', ['diproses', 'selesai'])->default('diproses');
            $table->enum('metode_pembayaran', ['cod', 'transfer'])->default('transfer');
            $table->string('image');
            $table->timestamps();
            $table->foreign('pasien_id')
            ->references('id')
            ->on('pasien')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_obat');
    }
};
