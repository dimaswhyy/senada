<?php

namespace App\Http\Controllers\Backend\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use App\Models\Unit;
use App\Models\UnitAccount;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
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

            $data = ProfilSekolah::where('id_unit','=',Auth::User()->id_unit)->leftjoin('units', 'profil_sekolahs.id_unit', '=', 'units.id')->select(['profil_sekolahs.id','profil_sekolahs.id_unit', 'units.nama_sekolah', 'units.daerah_sekolah', 'profil_sekolahs.npsn', 'profil_sekolahs.created_at'])->latest()->get();

            return datatables::of($data)
                        ->addIndexColumn()
                        ->filter(function ($instance) use ($request) {
                            if (!empty($request->get('nama_sekolah'))) {
                                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                    return Str::contains($row['nama_sekolah'], $request->get('name')) ? true : false;
                                });
                            }

                            if (!empty($request->get('search'))) {
                                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                    if (Str::contains(Str::lower($row['nama_sekolah']), Str::lower($request->get('search')))){
                                        return true;
                                    }else if (Str::contains(Str::lower($row['npsn']), Str::lower($request->get('search')))) {
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
                            <a class="dropdown-item" href='.route("profilsekolah.edit", $row->id).'><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                            </div>
                            </div>';
                            $btn = $dropBtn;
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }
        $getProfil = ProfilSekolah::all();
        return view('backend.senada.tatausaha.profil.list', compact('getProfil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $getUnit = Unit::all();
        $getUnitAccount = UnitAccount::all();
        return view('backend.senada.tatausaha.profil.add', compact('getUnit', 'getUnitAccount'));
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
            'id_unit'     => 'required',
            'nis'     => 'required',
            'npsn'     => 'required',
            'nss'     => 'required',
            'telepon_sekolah'     => 'required',
            'email_sekolah'     => 'required'
        ]);

        $profilsekolahs = ProfilSekolah::create([
            'id'    => Str::uuid(),
            'id_unit_account'     => $request->id_unit_account,
            'id_unit'     => $request->id_unit,
            'nis'     => $request->nis,
            'npsn'     => $request->npsn,
            'nss'     => $request->nss,
            'telepon_sekolah'     => $request->telepon_sekolah,
            'email_sekolah'     => $request->email_sekolah,
            'instagram_sekolah'     => $request->instagram_sekolah,
            'facebook_sekolah'     => $request->facebook_sekolah,
            'youtube_sekolah'     => $request->youtube_sekolah,
            'website_sekolah'     => $request->website_sekolah,
            'visi_sekolah'     => $request->visi_sekolah,
            'misi_sekolah'     => $request->misi_sekolah
        ]);

        if($profilsekolahs){
            //redirect dengan pesan sukses
            return redirect()->route('profilsekolah.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('profilsekolah.add')->with(['error' => 'Data Gagal Disimpan!']);
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
        $profilsekolahs = ProfilSekolah::find($id);
        return view('backend.senada.tatausaha.profil.edit', compact('profilsekolahs'));
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
