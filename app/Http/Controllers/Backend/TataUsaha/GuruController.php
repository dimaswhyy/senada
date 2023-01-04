<?php

namespace App\Http\Controllers\Backend\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\UnitAccount;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
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

            $data = Guru::where('id_unit','=',Auth::User()->id_unit)->latest()->get();

            return datatables::of($data)
                    ->addIndexColumn()
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('nama_guru'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['nama_guru'], $request->get('nama_guru')) ? true : false;
                            });
                        }

                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                if (Str::contains(Str::lower($row['nama_guru']), Str::lower($request->get('search')))){
                                    return true;
                                }else if (Str::contains(Str::lower($row['nip']), Str::lower($request->get('search')))) {
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
                          <a class="dropdown-item" href='.route("guru.edit", $row->id).'><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                          <form action="' . route('guru.destroy', $row->id) . '" method="POST">' . csrf_field() . method_field("DELETE") . '<button type="submit" class="btn btn-light" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini ?\')"><i class="bx bx-trash me-1"></i> Hapus</button></form>
                        </div>
                        </div>';
                        $btn = $dropBtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.senada.tatausaha.data_guru.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $getUnitAccount =UnitAccount::all();
        return view('backend.senada.tatausaha.data_guru.add', compact('getUnitAccount'));
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
            'id_unit_account'     => 'required',
            'id_unit'     => 'required',
            'name'     => 'required',
            'jenis_kelamin'     => 'required',
            'nip'     => 'required',
            'niy'     => 'required',
            'tempat_lahir'     => 'required',
            'tanggal_lahir'     => 'required',
            'email'     => 'required',
            'password'     => 'required',
            'keterangan'     => 'required',
            'role_id'   => 'required'
        ]);

        if($request->file("profil_guru") == ""){
            $gurus = Guru::create([
                'id'    => Str::uuid(),
                'id_unit'     => $request->id_unit,
                'id_unit_account'     => $request->id_unit_account,
                'name'     => $request->name,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'nip'     => $request->nip,
                'niy'     => $request->niy,
                'pangkat_golongan'     => $request->pangkat_golongan,
                'pangkat_tmt'     => $request->pangkat_tmt,
                'jabatan_guru'     => $request->jabatan_guru,
                'jabatan_tmt'     => $request->jabatan_tmt,
                'masa_kerja_tahun'     => $request->masa_kerja_tahun,
                'masa_kerja_bulan'     => $request->masa_kerja_bulan,
                'pendidikan_nama'     => $request->pendidikan_nama,
                'pendidikan_tahun_lulus'     => $request->pendidikan_tahun_lulus,
                'pendidikan_fakultas'     => $request->pendidikan_fakultas,
                'tempat_lahir'     => $request->tempat_lahir,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'tanggal_mulai_kerja'     => $request->tanggal_mulai_kerja,
                'nrg'     => $request->nrg,
                'nuptk'     => $request->nuptk,
                'email'     => $request->email,
                'password'     => Hash::make($request->password),
                'keterangan'     => $request->keterangan,
                'role_id'     => $request->role_id
            ]);

        }else{
            $profilGuru = $request->file('profil_guru');
            $profilGuru->storeAs('public/profil_guru', $profilGuru->hashName());

            $gurus = Guru::create([
                'id'    => Str::uuid(),
                'id_unit'     => $request->id_unit,
                'id_unit_account'     => $request->id_unit_account,
                'name'     => $request->name,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'nip'     => $request->nip,
                'niy'     => $request->niy,
                'pangkat_golongan'     => $request->pangkat_golongan,
                'pangkat_tmt'     => $request->pangkat_tmt,
                'jabatan_guru'     => $request->jabatan_guru,
                'jabatan_tmt'     => $request->jabatan_tmt,
                'masa_kerja_tahun'     => $request->masa_kerja_tahun,
                'masa_kerja_bulan'     => $request->masa_kerja_bulan,
                'pendidikan_nama'     => $request->pendidikan_nama,
                'pendidikan_tahun_lulus'     => $request->pendidikan_tahun_lulus,
                'pendidikan_fakultas'     => $request->pendidikan_fakultas,
                'tempat_lahir'     => $request->tempat_lahir,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'tanggal_mulai_kerja'     => $request->tanggal_mulai_kerja,
                'nrg'     => $request->nrg,
                'nuptk'     => $request->nuptk,
                'email'     => $request->email,
                'password'     => Hash::make($request->password),
                'profil_guru'     => $profilGuru->hashName(),
                'keterangan'     => $request->keterangan,
                'role_id'     => $request->role_id
            ]);
        }

        if($gurus){
            //redirect dengan pesan sukses
            return redirect()->route('guru.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('guru.add')->with(['error' => 'Data Gagal Disimpan!']);
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
        $gurus = Guru::find($id);
        return view('backend.senada.tatausaha.data_guru.edit', compact('gurus'));
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
        $gurus = Guru::findOrFail($id);

        if($request->file("profil_guru") == ""){
            if($request->password == ""){
                $gurus->update([
                'id_unit_account'     => $request->id_unit_account,
                'name'     => $request->name,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'nip'     => $request->nip,
                'niy'     => $request->niy,
                'pangkat_golongan'     => $request->pangkat_golongan,
                'pangkat_tmt'     => $request->pangkat_tmt,
                'jabatan_guru'     => $request->jabatan_guru,
                'jabatan_tmt'     => $request->jabatan_tmt,
                'masa_kerja_tahun'     => $request->masa_kerja_tahun,
                'masa_kerja_bulan'     => $request->masa_kerja_bulan,
                'pendidikan_nama'     => $request->pendidikan_nama,
                'pendidikan_tahun_lulus'     => $request->pendidikan_tahun_lulus,
                'pendidikan_fakultas'     => $request->pendidikan_fakultas,
                'tempat_lahir'     => $request->tempat_lahir,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'tanggal_mulai_kerja'     => $request->tanggal_mulai_kerja,
                'nrg'     => $request->nrg,
                'nuptk'     => $request->nuptk,
                'email'     => $request->email,
                'keterangan'     => $request->keterangan,
                'role_id'     => $request->role_id
                ]);
            }else{
                $gurus->update([
                'id_unit_account'     => $request->id_unit_account,
                'name'     => $request->name,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'nip'     => $request->nip,
                'niy'     => $request->niy,
                'pangkat_golongan'     => $request->pangkat_golongan,
                'pangkat_tmt'     => $request->pangkat_tmt,
                'jabatan_guru'     => $request->jabatan_guru,
                'jabatan_tmt'     => $request->jabatan_tmt,
                'masa_kerja_tahun'     => $request->masa_kerja_tahun,
                'masa_kerja_bulan'     => $request->masa_kerja_bulan,
                'pendidikan_nama'     => $request->pendidikan_nama,
                'pendidikan_tahun_lulus'     => $request->pendidikan_tahun_lulus,
                'pendidikan_fakultas'     => $request->pendidikan_fakultas,
                'tempat_lahir'     => $request->tempat_lahir,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'tanggal_mulai_kerja'     => $request->tanggal_mulai_kerja,
                'nrg'     => $request->nrg,
                'nuptk'     => $request->nuptk,
                'email'     => $request->email,
                'password'     => Hash::make($request->password),
                'keterangan'     => $request->keterangan,
                'role_id'     => $request->role_id
                ]);
            }
        }else{
            Storage::disk('local')->delete('public/profil_guru/'.$gurus->profil_guru);

            $profilGuru = $request->file('profil_guru');
            $profilGuru->storeAs('public/profil_guru', $profilGuru->hashName());

            $gurus->update([
                'id_unit_account'     => $request->id_unit_account,
                'name'     => $request->name,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'nip'     => $request->nip,
                'niy'     => $request->niy,
                'pangkat_golongan'     => $request->pangkat_golongan,
                'pangkat_tmt'     => $request->pangkat_tmt,
                'jabatan_guru'     => $request->jabatan_guru,
                'jabatan_tmt'     => $request->jabatan_tmt,
                'masa_kerja_tahun'     => $request->masa_kerja_tahun,
                'masa_kerja_bulan'     => $request->masa_kerja_bulan,
                'pendidikan_nama'     => $request->pendidikan_nama,
                'pendidikan_tahun_lulus'     => $request->pendidikan_tahun_lulus,
                'pendidikan_fakultas'     => $request->pendidikan_fakultas,
                'tempat_lahir'     => $request->tempat_lahir,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'tanggal_mulai_kerja'     => $request->tanggal_mulai_kerja,
                'nrg'     => $request->nrg,
                'nuptk'     => $request->nuptk,
                'email'     => $request->email,
                'profil_guru'     => $profilGuru->hashName(),
                'keterangan'     => $request->keterangan,
                'role_id'     => $request->role_id
            ]);
        }

        if($gurus){
            //redirect dengan pesan sukses
            return redirect()->route('guru.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('guru.edit')->with(['error' => 'Data Gagal Disimpan!']);
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
        $gurus = Guru::findOrFail($id);
        if($gurus->profil_guru!="null"){
            Storage::disk('local')->delete('public/profil_guru'.$gurus->profil_guru);
        }
        $gurus->delete();

        if($gurus){
            //redirect dengan pesan sukses
        return redirect()->route('guru.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
        return redirect()->route('guru.edit')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
