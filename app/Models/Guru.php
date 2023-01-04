<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Guru extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $incrementing = false;

    protected $table="gurus";
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
        'nip',
        'niy',
        'pangkat_golongan',
        'pangkat_tmt',
        'jabatan_guru',
        'jabatan_tmt',
        'masa_kerja_tahun',
        'masa_kerja_bulan',
        'pendidikan_nama',
        'pendidikan_tahun_lulus',
        'pendidikan_fakultas',
        'pendidikan_tahun_lulus',
        'tempat_lahir',
        'tanggal_lahir',
        'tanggal_mulai_kerja',
        'nrg',
        'nuptk',
        'email',
        'password',
        'profil_guru',
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
