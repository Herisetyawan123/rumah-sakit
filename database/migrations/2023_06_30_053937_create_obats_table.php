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
        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->unsignedBigInteger("kategori_obat");
            $table->foreign("kategori_obat")->references("id")->on("kategori_obat")->onDelete("cascade");
            $table->integer("stok");
            $table->bigInteger("harga");
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
        Schema::dropIfExists('obat');
    }
};
