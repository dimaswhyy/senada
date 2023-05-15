<?php

namespace App\Http\Controllers\Backend\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\JenisTransaksi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = Pembayaran::where('pembayarans.id_unit','=',Auth::User()->id_unit)->leftjoin('siswas', 'pembayarans.id_siswa', '=', 'siswas.id')->leftjoin('mappings', 'pembayarans.id_kelas', '=', 'mappings.id')->select('pembayarans.id', 'pembayarans.no_transaksi', 'siswas.name', 'mappings.kelas', 'pembayarans.tanggal_transaksi', 'pembayarans.jenis_transaksi', 'pembayarans.bulan_transaksi', 'pembayarans.tahun_transaksi', 'pembayarans.keterangan', 'pembayarans.*', 'pembayarans.created_at')->latest()->get();


            return datatables::of($data)
                    ->addIndexColumn()
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('siswas.name'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['siswas.name'], $request->get('siswas.name')) ? true : false;
                            });
                        }

                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                if (Str::contains(Str::lower($row['mappings.kelas']), Str::lower($request->get('search')))){
                                    return true;
                                }else if (Str::contains(Str::lower($row['bulan_transaksi']), Str::lower($request->get('search')))) {
                                    return true;
                                }

                                return false;
                            });
                        }

                    })
                    // ->addColumn('action', function($row){
                    //     $dropBtn ='<div class="dropdown">
                    //     <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                    //     <div class="dropdown-menu">
                    //       <a class="dropdown-item" href='.route("pembayaran.invoice", $row->id).'><i class="bx bx-printer me-1"></i> Cetak</a>
                    //       <form action="' . route('pembayaran.destroy', $row->id) . '" method="POST">' . csrf_field() . method_field("DELETE") . '<button type="submit" class="btn btn-light" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini ?\')"><i class="bx bx-trash me-1"></i> Hapus</button></form>
                    //     </div>
                    //     </div>';
                    //     $btn = $dropBtn;
                    //     return $btn;
                    // })
                    // ->rawColumns(['action'])
                    ->make(true);
        }

        return view('backend.senada.keuangan.laporan.list');
    }

    public function cetakForm()
    {
        $data = Pembayaran::where('pembayarans.id_unit','=',Auth::User()->id_unit)->leftjoin('siswas', 'pembayarans.id_siswa', '=', 'siswas.id')->leftjoin('mappings', 'pembayarans.id_kelas', '=', 'mappings.id')->select('pembayarans.id', 'pembayarans.no_transaksi', 'siswas.name', 'mappings.kelas', 'pembayarans.tanggal_transaksi', 'pembayarans.jenis_transaksi', 'pembayarans.bulan_transaksi', 'pembayarans.tahun_transaksi', 'pembayarans.keterangan', 'pembayarans.*', 'pembayarans.created_at')->latest()->get();

        $getJenis = JenisTransaksi::where('id_unit','=',Auth::User()->id_unit)->latest()->get();

        return view('backend.senada.keuangan.laporan.form', compact('data', 'getJenis'));
    }

    public function cetakJenis(Request $request)
    {
        $cari = $request->jenisPrint;
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;
        $tanggalAwalFormat=Carbon::parse($tanggalAwal)->format('Y-m-d')." 00:00:00";
        $tanggalAkhirFormat=Carbon::parse($tanggalAkhir)->format('Y-m-d')." 23:59:59";
        // dd($test);
        if ($cari == "Pilih Semua") {
            $cetakKategori = Pembayaran::all();
            $pdf = PDF::loadview('', compact('cetakKategori')); // arahkan preview laporan
            return $pdf->download(''); //Nama File Saat di Download
        } else {

            $cetakKategori = Pembayaran::whereHas('getzis', function ($query) use ($cari) {

                $query->where('nama_kampanye', $cari);
            })->whereBetween('created_at', [$tanggalAwalFormat, $tanggalAkhirFormat])->get();
            // dd($cetakKategori);
            // dd($cetakKategori);

            // $cetak_kategori = Transaksi::all()->whereBetween('merchant_id',[$kategoriPrint])->last()->get();
            $pdf = PDF::loadview('', compact('cetakKategori')); // arahkan preview cetak laporan
            return $pdf->download('laporan-transaksi-pdf.pdf'); // nama file saat di download
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
