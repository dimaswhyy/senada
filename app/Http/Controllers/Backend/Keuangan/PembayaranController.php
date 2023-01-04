<?php

namespace App\Http\Controllers\Backend\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\JenisTransaksi;
use App\Models\Kelas;
use App\Models\RombonganBelajar;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('backend.senada.keuangan.pembayaran.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $getKelas = Kelas::orderby('kelas','asc')->leftjoin('mappings', 'kelas.id_kelas', '=', 'mappings.id')->select('mappings.id','mappings.kelas')->get();
        $getJenis = JenisTransaksi::where('id_unit','=',Auth::User()->id_unit)->latest()->get();
        $getRombel = RombonganBelajar::where('id_unit','=',Auth::User()->id_unit)->latest()->get();
        return view('backend.senada.keuangan.pembayaran.add', compact('getKelas', 'getJenis', 'getRombel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }

    public function fetchSiswa(Request $request){
        $getSiswa['kelas'] = Kelas::orderby('name','asc')->leftjoin('siswas', 'kelas.id_siswa', '=', 'siswas.id')->select('siswas.id','siswas.name')->where('id_kelas', $request)->get();

        return response()->json($getSiswa);
    }
}
