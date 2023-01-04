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
        Schema::create('siswas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_unit');
            $table->string('id_unit_account');
            $table->string('name');
            $table->string('jenis_kelamin');
            $table->string('nik');
            $table->string('nis')->nullable();
            $table->string('nisn')->nullable();
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('agama');
            $table->string('kewarganegaraan');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kotkab');
            $table->string('kode_pos');
            $table->string('jenis_tinggal');
            $table->string('transportasi');
            $table->string('telepon')->nullable();
            $table->string('hp');
            $table->string('asal_sekolah')->nullable();
            $table->string('berkebutuhan_khusus')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('tanggal_lahir_ayah')->nullable();
            $table->string('jenjang_pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('nik_ayah')->nullable();
            $table->string('berkebutuhan_khusus_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('tanggal_lahir_ibu')->nullable();
            $table->string('jenjang_pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->string('berkebutuhan_khusus_ibu')->nullable();
            $table->string('penerima_kip')->nullable();
            $table->string('nomor_kip')->nullable();
            $table->string('nama_kip')->nullable();
            $table->string('nomor_kks')->nullable();
            $table->string('no_akta_lahir')->nullable();
            $table->string('layak_pip')->nullable();
            $table->string('alasan_pip')->nullable();
            $table->string('kebutuhan_khusus')->nullable();
            $table->string('anak_ke')->nullable();
            $table->string('lintang')->nullable();
            $table->string('bujur')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('jumlah_saudara')->nullable();
            $table->string('jarak_rumah')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profil_siswa')->nullable();
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
        Schema::dropIfExists('siswas');
    }
};
