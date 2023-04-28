<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
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
        'id_unit',
        'id_unit_account',
        'id_rombel',
        'id_kelas',
        'id_siswa',
        'tanggal_transaksi',
        'no_transaksi',
        'jenis_transaksi',
        'bulan_transaksi',
        'tahun_transaksi',
        'biaya_transaksi',
        'total_transaksi',
        'keterangan',
        'bukti_transfer'
    ];
}
