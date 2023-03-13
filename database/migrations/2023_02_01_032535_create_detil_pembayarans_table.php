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
        Schema::create('detil_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi');
            $table->string('jenis_transaksi');
            $table->string('bulan_transaksi');
            $table->string('biaya_transaksi');
            $table->string('total_transaksi');
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
        Schema::dropIfExists('detil_pembayarans');
    }
};
