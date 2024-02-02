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
        Schema::create('detail_transaksi_obat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_obat_id');
            // $table->integer('jumlah');
            $table->string('tinggi')->nullable();
            $table->string('berat')->nullable();
            $table->string('riwayat_alergi')->nullable();
            $table->string('alamat')->nullable();
            $table->string('detail_lokasi')->nullable();
            $table->timestamps();

            $table->foreign('transaksi_obat_id')
                ->references('id')
                ->on('transaksi_obat')
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
        Schema::dropIfExists('detail_transaksi_obat');
    }
};
