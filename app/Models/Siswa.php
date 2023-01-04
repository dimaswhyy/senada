<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $incrementing = false;

    protected $table="siswas";
    protected $primaryKey="id";

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_unit',
        'id_unit_account',
        'name',
        'jenis_kelamin',
        'nik',
        'nis',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'kewarganegaraan',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kotkab',
        'kode_pos',
        'jenis_tinggal',
        'transportasi',
        'telepon',
        'hp',
        'asal_sekolah',
        'berkebutuhan_khusus',
        'nama_ayah',
        'tanggal_lahir_ayah',
        'jenjang_pendidikan_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'nik_ayah',
        'berkebutuhan_khusus_ayah',
        'nama_ibu',
        'tanggal_lahir_ibu',
        'jenjang_pendidikan_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'nik_ibu',
        'berkebutuhan_khusus_ibu',
        'penerima_kip',
        'nomor_kip',
        'nama_kip',
        'nomor_kks',
        'no_akta_lahir',
        'layak_pip',
        'alasan_pip',
        'kebutuhan_khusus',
        'anak_ke',
        'lintang',
        'bujur',
        'berat_badan',
        'tinggi_badan',
        'jumlah_saudara',
        'jarak_rumah',
        'email',
        'password',
        'profil_siswa',
        'keterangan',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
