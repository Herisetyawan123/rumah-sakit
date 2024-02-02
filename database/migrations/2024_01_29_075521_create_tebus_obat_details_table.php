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
        Schema::create('tebus_obat_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tebus_obat_id');
            $table->foreign('tebus_obat_id')->references('id')->on('tebus_obats');
            $table->string('tinggi')->nullable();
            $table->string('berat')->nullable();
            $table->string('riwayat_alergi')->nullable();
            $table->string('alamat')->nullable();
            $table->string('detail_lokasi')->nullable();
            $table->enum('pengambilan', ['diantar', 'diambil']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tebus_obat_details');
    }
};
