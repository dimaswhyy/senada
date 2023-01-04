<?php

namespace App\Http\Controllers\Backend\Yayasan;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\Unit;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UnitController extends Controller
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

            $data = Unit::latest()->get();

            return datatables::of($data)
                    ->addIndexColumn()
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('nama_sekolah'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['nama_sekolah'], $request->get('nama_sekolah')) ? true : false;
                            });
                        }

                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                if (Str::contains(Str::lower($row['nama_sekolah']), Str::lower($request->get('search')))){
                                    return true;
                                }else if (Str::contains(Str::lower($row['daerah_sekolah']), Str::lower($request->get('search')))) {
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
                          <a class="dropdown-item" href='.route("unit.edit", $row->id).'><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                          <form action="' . route('unit.destroy', $row->id) . '" method="POST">' . csrf_field() . method_field("DELETE") . '<button type="submit" class="btn btn-light" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini ?\')"><i class="bx bx-trash me-1"></i> Hapus</button></form>
                        </div>
                        </div>';
                        $btn = $dropBtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('backend.senada.yayasan.unit.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $profils = Profil::all();
        return view('backend.senada.yayasan.unit.add', compact('profils'));
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
            'id_yayasan'     => 'required',
            'nama_sekolah'     => 'required',
            'unit'     => 'required',
            'alamat_sekolah'     => 'required',
            'daerah_sekolah'     => 'required'

        ]);

        if($request->file("logo_sekolah") == ""){
            $units = Unit::create([
                'id'    => Str::uuid(),
                'id_yayasan'     => $request->id_yayasan,
                'nama_sekolah'     => $request->nama_sekolah,
                'unit'     => $request->unit,
                'alamat_sekolah'     => $request->alamat_sekolah,
                'daerah_sekolah'     => $request->daerah_sekolah
            ]);
        }else{
            $logoSekolah = $request->file('logo_sekolah');
            $logoSekolah->storeAs('public/logo_sekolah', $logoSekolah->hashName());

            $units = Unit::create([
                'id'    => Str::uuid(),
                'id_yayasan'     => $request->id_yayasan,
                'logo_sekolah'     => $logoSekolah->hashName(),
                'nama_sekolah'     => $request->nama_sekolah,
                'unit'     => $request->unit,
                'alamat_sekolah'     => $request->alamat_sekolah,
                'daerah_sekolah'     => $request->daerah_sekolah
            ]);
        }

        if($units){
            //redirect dengan pesan sukses
            return redirect()->route('unit.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('unit.add')->with(['error' => 'Data Gagal Disimpan!']);
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
        $units = Unit::find($id);
        return view('backend.senada.yayasan.unit.edit', compact('units'));
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
        $units = Unit::findOrFail($id);

        if($request->file("logo_sekolah") == ""){

            $units->update([
                'id_yayasan'     => $request->id_yayasan,
                'nama_sekolah'     => $request->nama_sekolah,
                'unit'     => $request->unit,
                'alamat_sekolah'     => $request->alamat_sekolah,
                'daerah_sekolah'     => $request->daerah_sekolah
            ]);
        }else{
            Storage::disk('local')->delete('public/logo_sekolah/'.$units->logo_sekolah);

            $logoSekolah = $request->file('logo_sekolah');
            $logoSekolah->storeAs('public/logo_sekolah', $logoSekolah->hashName());

            $units->update([
                'id_yayasan'     => $request->id_yayasan,
                'logo_sekolah'     => $logoSekolah->hashName(),
                'nama_sekolah'     => $request->nama_sekolah,
                'unit'     => $request->unit,
                'alamat_sekolah'     => $request->alamat_sekolah,
                'daerah_sekolah'     => $request->daerah_sekolah
            ]);
        }

        if($units){
            //redirect dengan pesan sukses
            return redirect()->route('unit.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('unit.edit')->with(['error' => 'Data Gagal Disimpan!']);
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
        $units = Unit::findOrFail($id);
        if($units->logo_sekolah!="null"){
            Storage::disk('local')->delete('public/logo_sekolah'.$units->logo_sekolah);
        }
        $units->delete();

        if($units){
            //redirect dengan pesan sukses
        return redirect()->route('unit.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
        return redirect()->route('unit.edit')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
