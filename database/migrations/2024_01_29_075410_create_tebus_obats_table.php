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
        Schema::create('tebus_obats', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->foreignId('pasien_id');
            $table->enum('status', ['terkirim','diproses', 'selesai', 'lunas'])->default('terkirim');
            $table->foreign('pasien_id')->references('id')->on('pasien');
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
        Schema::dropIfExists('tebus_obats');
    }
};
