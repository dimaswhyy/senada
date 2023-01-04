<?php

namespace App\Http\Controllers\Backend\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\JenisTransaksi;
use Illuminate\Http\Request;

class APIDataPembayaranController extends Controller
{
    //
    public function findIdJenis(Request $request)
    {
        $data = JenisTransaksi::select('biaya_transaksi', 'id')->where('id_jenis', $request->id)->take(100)->get();
        return response()->json($data);
    }
}
