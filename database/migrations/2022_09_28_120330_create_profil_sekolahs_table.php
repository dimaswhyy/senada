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
        Schema::create('profil_sekolahs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_unit');
            $table->string('nis');
            $table->string('npsn');
            $table->string('nss');
            $table->string('telepon_sekolah');
            $table->string('hp_sekolah');
            $table->string('email_sekolah');
            $table->string('instagram_sekolah')->nullable();
            $table->string('facebook_sekolah')->nullable();
            $table->string('youtube_sekolah')->nullable();
            $table->string('website_sekolah')->nullable();
            $table->longText('visi_sekolah')->nullable();
            $table->longText('misi_sekolah')->nullable();
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
        Schema::dropIfExists('profil_sekolahs');
    }
};
