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
        'id_kelas',
        'nama_siswa',
        'tanggal_transaksi',
        'no_transaksi',
        'jenis_transaksi',
        'transaksi_bulan',
        'total_transaksi',
        'deskripsi_transaksi',
        'keterangan',
        'bukti_transfer'
    ];
}
