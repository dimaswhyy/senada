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
        Schema::create('gurus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_unit');
            $table->string('id_unit_account');
            $table->string('name');
            $table->string('jenis_kelamin');
            $table->string('nip');
            $table->string('niy');
            $table->string('pangkat_golongan')->nullable();
            $table->string('pangkat_tmt')->nullable();
            $table->string('jabatan_guru')->nullable();
            $table->string('jabatan_tmt')->nullable();
            $table->string('masa_kerja_tahun')->nullable();
            $table->string('masa_kerja_bulan')->nullable();
            $table->string('pendidikan_nama')->nullable();
            $table->string('pendidikan_tahun_lulus')->nullable();
            $table->string('pendidikan_fakultas')->nullable();
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('tanggal_mulai_kerja')->nullable();
            $table->string('nrg')->nullable();
            $table->string('nuptk')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profil_guru')->nullable();
            $table->string('keterangan');
            $table->string('role_id');
            $table->rememberToken();
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
        Schema::dropIfExists('gurus');
    }
};
