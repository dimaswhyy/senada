<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'logo_yayasan',
        'nama_yayasan',
        'alamat_yayasan',
        'telepon_yayasan',
        'hp_yayasan',
        'email_yayasan',
        'instagram_yayasan',
        'facebook_yayasan',
        'youtube_yayasan',
        'sejarah_yayasan',
        'visi_yayasan',
        'misi_yayasan'
    ];
}
