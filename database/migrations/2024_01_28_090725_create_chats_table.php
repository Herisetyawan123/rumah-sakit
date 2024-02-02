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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id');
            $table->foreign('pasien_id')->references('id')->on('pasien')->onDelete('cascade');
            $table->foreignId('kasir_id');
            $table->foreign('kasir_id')->references('id')->on('kasir')->onDelete('cascade');
            $table->enum('status', ['berlangsung', 'selesai']);
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
        Schema::dropIfExists('chats');
    }
};
