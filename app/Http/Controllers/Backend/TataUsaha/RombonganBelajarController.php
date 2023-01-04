<?php

namespace App\Http\Controllers\Backend\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\RombonganBelajar;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RombonganBelajarController extends Controller
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

            $data = RombonganBelajar::where('rombongan_belajars.id_unit','=',Auth::User()->id_unit)->latest()->get();


            return datatables::of($data)
                    ->addIndexColumn()
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('rombongan_belajar'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['rombongan_belajar'], $request->get('rombongan_belajar')) ? true : false;
                            });
                        }

                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                if (Str::contains(Str::lower($row['rombongan_belajar']), Str::lower($request->get('search')))){
                                    return true;
                                }else if (Str::contains(Str::lower($row['rombongan_belajar']), Str::lower($request->get('search')))) {
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
                          <a class="dropdown-item" href='.route("rombel.edit", $row->id).'><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                          <form action="' . route('rombel.destroy', $row->id) . '" method="POST">' . csrf_field() . method_field("DELETE") . '<button type="submit" class="btn btn-light" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini ?\')"><i class="bx bx-trash me-1"></i> Hapus</button></form>
                        </div>
                        </div>';
                        $btn = $dropBtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.senada.tatausaha.rombongan_belajar.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.senada.tatausaha.rombongan_belajar.add');
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
            'rombongan_belajar'     => 'required'
        ]);

        $rombels = RombonganBelajar::create([
            'id'    => Str::uuid(),
            'id_unit' => $request->id_unit,
            'id_unit_account'     => $request->id_unit_account,
            'rombongan_belajar'     => $request->rombongan_belajar
        ]);

        if($rombels){
            //redirect dengan pesan sukses
            return redirect()->route('rombel.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('rombel.add')->with(['error' => 'Data Gagal Disimpan!']);
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
        $rombels = RombonganBelajar::find($id);
        return view('backend.senada.tatausaha.rombongan_belajar.edit', compact('rombels'));
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
        $rombels = RombonganBelajar::findOrFail($id);

        $rombels->update([
            'id_unit_account'     => $request->id_unit_account,
            'id_unit' => $request->id_unit,
            'rombongan_belajar'     => $request->rombongan_belajar
        ]);

        if($rombels){
            //redirect dengan pesan sukses
            return redirect()->route('rombel.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('rombel.edit')->with(['error' => 'Data Gagal Disimpan!']);
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
        $rombels = RombonganBelajar::findOrFail($id);
        $rombels->delete();

        if($rombels){
            //redirect dengan pesan sukses
        return redirect()->route('rombel.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
        return redirect()->route('rombel.edit')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
