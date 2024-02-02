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
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->string('no_pesanan');
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('dokter_id');
            $table->unsignedBigInteger('bank_id');
            $table->string('no_telepon');
            $table->date('tanggal_pesanan');
            $table->enum('status_pembayaran',['pending','menunggu konfirmasi','lunas','ditolak'])->default('pending');
            $table->enum('status_konsultasi',['belum konsultasi','selesai'])->default('belum konsultasi');
            $table->timestamps();

            $table->foreign('pasien_id')
            ->references('id')
            ->on('pasien')
            ->onDelete('cascade');

            $table->foreign('dokter_id')
            ->references('id')
            ->on('dokter')
            ->onDelete('cascade');

            $table->foreign('bank_id')
            ->references('id')
            ->on('banks')
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
        Schema::dropIfExists('konsultasi');
    }
};
