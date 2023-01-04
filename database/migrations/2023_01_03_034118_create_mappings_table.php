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
        Schema::create('mappings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_unit');
            $table->string('id_unit_account');
            $table->string('id_rombel'); //Untuk Rombongan Belajar
            $table->string('kelas');
            $table->string('id_guru'); //Untuk Wali Kelas
            $table->string('keterangan');
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
        Schema::dropIfExists('mappings');
    }
};
