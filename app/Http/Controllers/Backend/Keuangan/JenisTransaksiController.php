<?php

namespace App\Http\Controllers\Backend\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\JenisTransaksi;
use App\Models\RombonganBelajar;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class JenisTransaksiController extends Controller
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

            $data = JenisTransaksi::where('jenis_transaksis.id_unit','=',Auth::User()->id_unit)->leftjoin('rombongan_belajars', 'jenis_transaksis.id_rombel', '=', 'rombongan_belajars.id')->select('jenis_transaksis.id', 'rombongan_belajars.rombongan_belajar', 'jenis_transaksis.jenis_transaksi', 'jenis_transaksis.biaya_transaksi', 'jenis_transaksis.created_at')->latest()->get();

            return datatables::of($data)
                    ->addIndexColumn()
                    ->filter(function ($instance) use ($request) {

                        if (!empty($request->get('jenis_transaksi'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['jenis_transaksi'], $request->get('jenis_transaksi')) ? true : false;
                            });
                        }

                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {


                                if (Str::contains(Str::lower($row['jenis_transaksi']), Str::lower($request->get('search')))){
                                    return true;
                                }else if (Str::contains(Str::lower($row['jenis_transaksi']), Str::lower($request->get('search')))) {
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
                          <a class="dropdown-item" href='.route("jenistransaksi.edit", $row->id).'><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                          <form action="' . route('jenistransaksi.destroy', $row->id) . '" method="POST">' . csrf_field() . method_field("DELETE") . '<button type="submit" class="btn btn-light" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini ?\')"><i class="bx bx-trash me-1"></i> Hapus</button></form>
                        </div>
                        </div>';
                        $btn = $dropBtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.senada.keuangan.jenis_transaksi.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $getRombel = RombonganBelajar::where('id_unit','=',Auth::User()->id_unit)->latest()->get();
        return view('backend.senada.keuangan.jenis_transaksi.add', compact('getRombel'));
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
        $this->validate($request,[
            'id_unit_account'   => 'required',
            'id_unit' => 'required',
            'id_rombel' => 'required',
            'jenis_transaksi'     => 'required',
            'biaya_transaksi'     => 'required'
        ]);

        $jenises = JenisTransaksi::create([
            'id'    => Str::uuid(),
            'id_unit' => $request->id_unit,
            'id_unit_account'     => $request->id_unit_account,
            'id_rombel'     => $request->id_rombel,
            'jenis_transaksi'     => $request->jenis_transaksi,
            'biaya_transaksi'     => $request->biaya_transaksi
        ]);

        if($jenises){
            //redirect dengan pesan sukses
            return redirect()->route('jenistransaksi.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('jenistransaksi.add')->with(['error' => 'Data Gagal Disimpan!']);
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
        $jenises = JenisTransaksi::find($id);
        $getRombel = RombonganBelajar::where('id_unit','=',Auth::User()->id_unit)->latest()->get();
        return view('backend.senada.keuangan.jenis_transaksi.edit', compact('jenises', 'getRombel'));
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
        $jenises = JenisTransaksi::findOrFail($id);

        $jenises->update([
            'id_unit_account'     => $request->id_unit_account,
            'id_unit' => $request->id_unit,
            'id_rombel' => $request->id_rombel,
            'jenis_transaksi'     => $request->jenis_transaksi,
            'biaya_transaksi'     => $request->biaya_transaksi
        ]);

        if($jenises){
            //redirect dengan pesan sukses
            return redirect()->route('jenistransaksi.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('jenistransaksi.edit')->with(['error' => 'Data Gagal Disimpan!']);
        }
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
        $jenises = JenisTransaksi::findOrFail($id);

        $jenises->delete();
        if($jenises){
            //redirect dengan pesan sukses
        return redirect()->route('jenistransaksi.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
        return redirect()->route('jenistransaksi.edit')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
