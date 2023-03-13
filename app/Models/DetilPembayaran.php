<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetilPembayaran extends Model
{

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_transaksi',
        'jenis_transaksi',
        'bulan_transaksi',
        'biaya_transaksi',
        'total_transaksi'
    ];
}
