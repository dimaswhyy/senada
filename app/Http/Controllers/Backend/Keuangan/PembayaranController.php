<?php

namespace App\Http\Controllers\Backend\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\DetilPembayaran;
use App\Models\JenisTransaksi;
use App\Models\Kelas;
use App\Models\Mapping;
use App\Models\Pembayaran;
use App\Models\RombonganBelajar;
use App\Models\Unit;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
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

            $data = Pembayaran::where('pembayarans.id_unit','=',Auth::User()->id_unit)->leftjoin('siswas', 'pembayarans.id_siswa', '=', 'siswas.id')->leftjoin('mappings', 'pembayarans.id_kelas', '=', 'mappings.id')->select('pembayarans.id', 'siswas.name', 'mappings.kelas', 'pembayarans.tanggal_transaksi', 'pembayarans.jenis_transaksi', 'pembayarans.bulan_transaksi', 'pembayarans.keterangan', 'pembayarans.*', 'pembayarans.created_at')->latest()->get();


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
                    ->addColumn('action', function($row){
                        $dropBtn ='<div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href='.route("pembayaran.edit", $row->id).'><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                          <form action="' . route('pembayaran.destroy', $row->id) . '" method="POST">' . csrf_field() . method_field("DELETE") . '<button type="submit" class="btn btn-light" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini ?\')"><i class="bx bx-trash me-1"></i> Hapus</button></form>
                        </div>
                        </div>';
                        $btn = $dropBtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

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
        $idUnit = $request->id_unit;
        $Units = Unit::find($idUnit);
        $nameUNT="";
        if($Units->unit == 'TK'){
            $nameUNT = 'TK';
        }elseif($Units->unit == 'SD'){
            $nameUNT = 'SD';
        }elseif($Units->unit == 'Pesantren Putra'){
            $nameUNT = 'PA';
        }elseif($Units->unit == 'Pesantren Putri'){
            $nameUNT = 'PI';
        }elseif($Units->unit == 'Day Care'){
            $nameUNT = 'DC';
        }else{
            $nameUNT = 'PD';
        }

        $nameREG="";
        if($Units->daerah_sekolah == 'Bener Meriah'){
            $nameREG = 'BMH';
        }elseif($Units->daerah_sekolah == 'Takengon'){
            $nameREG = 'TKG';
        }else{
            $nameREG = 'JKT';
        }
        $tanggal = date('ymd');
        $no = "0000";
        $id = Pembayaran::max('id');
        if($id == null){
            $notransaksi = $nameUNT . "-" . $nameREG . $tanggal . "0001";

        }else{
            // dd("masuk");
            // dd($notransaksi);
            $dataterakhir = Pembayaran::where('id',$id)->first();
            $nourut = $dataterakhir->no_transaksi;
            // dd($nourut);
            $cektanggal = substr($nourut, 6, 6);
            $hasil_urut = $tanggal . $no;
            // dd($nourut);
            // dd("hasil urut : ",$hasil_urut," cek tanggal : ",$cektanggal," Tanggal :",$tanggal);
            if ($tanggal == $cektanggal) {
                $no_urut = substr($nourut, 6, 10);
                $no_urut_int = (int)$no_urut;
                // dd($no_urut_int);
                $hasil = $no_urut_int + 1;
                // dd($hasil);
            } else {
                $hasil = $hasil_urut + 1;
            }
            // dd($hasil);
            $notransaksi = $nameUNT . "-" . $nameREG . $hasil;
        }
        // dd($notransaksi);

        $dataJT = $request->jenis_transaksi;
        $dataBT = $request->transaksi_bulan;
        $dataBiT = $request->biaya;
        $total = count($dataJT);

        for ($i=1; $i<=$total; $i++){
            $pembayarans = Pembayaran::create([
                'id'    => Str::uuid(),
                'id_unit' => $request->id_unit,
                'id_unit_account'     => $request->id_unit_account,
                'id_rombel' => $request->id_rombel,
                'id_kelas' => $request->id_kelas,
                'id_siswa' => $request->id_siswa,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'no_transaksi' => $notransaksi,
                'jenis_transaksi' => $dataJT[$i],
                'bulan_transaksi' => $dataBT[$i],
                'biaya_transaksi' => $dataBiT[$i],
                'total_transaksi' => $request->total,
                'keterangan' => $request->keterangan,
                'bukti_transfer'     => null
            ]);
        }


        // $this->validate($request,[
        //     // 'id_unit_account'   => 'required',
        //     // 'id_unit' => 'required',
        //     // 'id_rombel' => 'required',
        //     // 'id_kelas' => 'required',
        //     // 'id_siswa' => 'required',
        //     // 'tanggal_transaksi' => 'required',
        //     // 'jenis_transaksi' => 'required',
        //     // 'bulan_transaksi' => 'required',
        //     // 'biaya_transaksi' => 'required',
        //     // 'total_transaksi' => 'required',
        //     // 'keterangan' => 'required'
        // ]);
        // $pembayarans = Pembayaran::create([
        //         'id'                 => Str::uuid(),
        //         'id_unit'            => $request->id_unit,
        //         'id_unit_account'    => $request->id_unit_account,
        //         'id_rombel'          => $request->id_rombel,
        //         'id_kelas'           => $request->id_kelas,
        //         'id_siswa'           => $request->id_siswa,
        //         'tanggal_transaksi'  => $request->tanggal_transaksi,
        //         'no_transaksi'       => $notransaksi,
        //         'jenis_transaksi'    => $dataJT,
        //         'bulan_transaksi'    => $dataBT,
        //         'biaya_transaksi'    => $dataBiT,
        //         'total_transaksi'    => $request->total,
        //         'keterangan'         => $request->keterangan,
        //         'bukti_transfer'     => null
        //     ]);
        //     $arrayRequest = $request->jenis_transaksi;
        //     $jenistransaksi = $request->jenis_transaksi;
        //     $transaksibulan = $request->transaksi_bulan;
        //     $biaya = $request->biaya;
        //     $jumlah = count($arrayRequest);

        //     //for each create for array to database
        //     for($i = 1; $i <= $jumlah; $i++){
        //         DetilPembayaran::create([
        //             'no_transaksi'=>$notransaksi,
        //             'jenis_transaksi'    => $jenistransaksi[$i],
        //             'bulan_transaksi'    => $transaksibulan[$i],
        //             'biaya_transaksi'    => $biaya[$i],
        //             'total_transaksi' => 0,
        //         ]);
        //     }

        if($pembayarans){
            //redirect dengan pesan sukses
            return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Disimpan!'])
            ->question('Are you sure?','You won\'t be able to revert this!')
            ->showConfirmButton('Yes! Delete it', '#3085d6')
            ->showCancelButton('Cancel', '#aaa')->reverseButtons();;
        }else{
            //redirect dengan pesan error
            return redirect()->route('pembayaran.add')->with(['error' => 'Data Gagal Disimpan!']);
        }
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

    public function fetch(Request $request)
    {
        $select =  $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = Kelas::where($select, $value)
        ->groupBy($dependent)
        ->get();

        $output = '<select value="">Pilih Siswa'.ucfirst($dependent).'</option>';
        foreach($data as $row)
        {
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        $output;
    }

    public function getSiswaList($id)
    {
        $listSiswa = Kelas::where('id_kelas', $id)->leftjoin('siswas', 'kelas.id_siswa', '=', 'siswas.id')->select('kelas.id', 'kelas.id_siswa', 'siswas.name','kelas.created_at')->get();
        return response()->json($listSiswa);
    }

    public function getClassList($id)
    {
        $listClass = Mapping::where('id_rombel',$id)->get();
        return response()->json($listClass);
    }

    public function getJenisTransaksiList($id)
    {
        $listJenis = JenisTransaksi::where('id_rombel',$id)->get();
        return response()->json($listJenis);
    }
}
