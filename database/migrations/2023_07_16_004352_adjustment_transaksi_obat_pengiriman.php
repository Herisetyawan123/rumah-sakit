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
        Schema::table('transaksi_obat', function (Blueprint $table) {
            $table->enum('jenis_pengambilan',['diambil','diantar'])->after('status_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi_obat', function (Blueprint $table) {
            $table->dropColumn('jenis_pengambilan');
            $table->dropColumn('alamat');
        });
    }
};
