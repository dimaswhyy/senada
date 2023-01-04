<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    public $incrementing = false;
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'id_unit_account',
        'id_unit',
        'nis',
        'npsn',
        'nss',
        'telepon_sekolah',
        'hp_sekolah',
        'email_sekolah',
        'instagram_sekolah',
        'facebook_sekolah',
        'youtube_sekolah',
        'visi_sekolah',
        'misi_sekolah'
    ];
}
