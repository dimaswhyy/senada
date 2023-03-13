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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_unit');
            $table->string('id_unit_account');
            $table->string('id_rombel');
            $table->string('id_kelas');
            $table->string('id_siswa');
            $table->date('tanggal_transaksi');
            $table->string('no_transaksi');
            $table->string('jenis_transaksi');
            $table->string('bulan_transaksi');
            $table->string('biaya_transaksi');
            $table->string('total_transaksi');
            $table->string('keterangan');
            $table->longText('bukti_transfer');
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
        Schema::dropIfExists('pembayarans');
    }
};
