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
        Schema::create('resep_n_diagnosa', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('dokter_id');
            $table->decimal('tarif');
            $table->text('resep');
            $table->text('diagnosa');
            $table->timestamps();

            $table->foreign('pasien_id')
            ->references('id')
            ->on('pasien')
            ->onDelete('cascade');

            $table->foreign('dokter_id')
            ->references('id')
            ->on('dokter')
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
        Schema::dropIfExists('resep_n_diagnosa');
    }
};
