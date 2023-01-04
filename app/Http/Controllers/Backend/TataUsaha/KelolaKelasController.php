<?php

namespace App\Http\Controllers\Backend\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapping;
use App\Models\Siswa;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class KelolaKelasController extends Controller
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

            $data = Kelas::where('kelas.id_unit','=',Auth::User()->id_unit)->leftjoin('siswas', 'kelas.id_siswa', '=', 'siswas.id')->leftjoin('mappings', 'kelas.id_kelas', '=', 'mappings.id')->select('kelas.id', 'siswas.nis', 'siswas.name', 'mappings.kelas', 'siswas.keterangan', 'kelas.created_at')->latest()->get();

            return datatables::of($data)
                    ->addIndexColumn()
                    ->filter(function ($instance) use ($request) {

                        if ($request->get('id_kelas')) {
                            $instance->where('kelas.id_kelas', $request->get('id_kelas'));
                        }

                        if (!empty($request->get('kelas'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['kelas'], $request->get('kelas')) ? true : false;
                            });
                        }

                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {


                                if (Str::contains(Str::lower($row['kelas']), Str::lower($request->get('search')))){
                                    return true;
                                }else if (Str::contains(Str::lower($row['kelas']), Str::lower($request->get('search')))) {
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
                          <a class="dropdown-item" href='.route("mapping.edit", $row->id).'><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                          <form action="' . route('mapping.destroy', $row->id) . '" method="POST">' . csrf_field() . method_field("DELETE") . '<button type="submit" class="btn btn-light" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini ?\')"><i class="bx bx-trash me-1"></i> Hapus</button></form>
                        </div>
                        </div>';
                        $btn = $dropBtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $getKelas = Mapping::where('id_unit','=',Auth::User()->id_unit)->get();
        return view('backend.senada.tatausaha.kelola_kelas.list', compact('getKelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $getSiswa = Siswa::where('id_unit','=',Auth::User()->id_unit)->get();
        $getMapping = Mapping::where('id_unit','=',Auth::User()->id_unit)->get();
        return view('backend.senada.tatausaha.kelola_kelas.add', compact('getMapping', 'getSiswa'));
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
            'id_siswa'     => 'required',
            'id_kelas'     => 'required'
        ]);

        $kelases = Kelas::create([
            'id'    => Str::uuid(),
            'id_unit' => $request->id_unit,
            'id_unit_account'     => $request->id_unit_account,
            'id_siswa'     => $request->id_siswa,
            'id_kelas'     => $request->id_kelas
        ]);

        if($kelases){
            //redirect dengan pesan sukses
            return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('kelas.add')->with(['error' => 'Data Gagal Disimpan!']);
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
}
