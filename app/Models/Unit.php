<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public $incrementing = false;

    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_yayasan',
        'logo_sekolah',
        'nama_sekolah',
        'unit',
        'alamat_sekolah',
        'daerah_sekolah'
    ];

}
