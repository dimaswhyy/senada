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
        Schema::create('profils', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->longText('logo_yayasan')->nullable();
            $table->string('nama_yayasan');
            $table->longText('alamat_yayasan');
            $table->string('telepon_yayasan');
            $table->string('hp_yayasan')->nullable();
            $table->string('email_yayasan');
            $table->string('instagram_yayasan')->nullable();
            $table->string('facebook_yayasan')->nullable();
            $table->string('youtube_yayasan')->nullable();
            $table->longText('sejarah_yayasan')->nullable();
            $table->longText('visi_yayasan')->nullable();
            $table->longText('misi_yayasan')->nullable();
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
        Schema::dropIfExists('profils');
    }
};
