<?php

namespace App\Http\Controllers\Backend\Yayasan;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\UnitAccount;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UnitAccountController extends Controller
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

            $data = UnitAccount::join('units', 'unit_accounts.id_unit', '=', 'units.id')->select('unit_accounts.id','unit_accounts.id_unit','unit_accounts.name',
             'unit_accounts.email', 'units.nama_sekolah', 'units.daerah_sekolah','unit_accounts.*', 'unit_accounts.created_at')->latest()->get();

            return datatables::of($data)
                    ->addIndexColumn()
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('name'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['name'], $request->get('name')) ? true : false;
                            });
                        }

                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))){
                                    return true;
                                }else if (Str::contains(Str::lower($row['nama_sekolah']), Str::lower($request->get('search')))) {
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
                          <a class="dropdown-item" href='.route("unitaccount.edit", $row->id).'><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                          <form action="' . route('unitaccount.destroy', $row->id) . '" method="POST">' . csrf_field() . method_field("DELETE") . '<button type="submit" class="btn btn-light" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini ?\')"><i class="bx bx-trash me-1"></i> Hapus</button></form>
                        </div>
                        </div>';
                        $btn = $dropBtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.senada.yayasan.unit_account.list');
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
        return view('backend.senada.yayasan.unit_account.add', compact('getUnit'));
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
            'id_unit'     => 'required',
            'name'     => 'required',
            'jenis_kelamin'     => 'required',
            'telepon'     => 'required',
            'email'     => 'required',
            'password'     => 'required',
            'role_id'     => 'required'

        ]);

        if($request->file("profil_unit_account") == ""){
            $unitaccounts = UnitAccount::create([
                'id'    => Str::uuid(),
                'id_unit'     => $request->id_unit,
                'name'     => $request->name,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'telepon'     => $request->telepon,
                'email'     => $request->email,
                'password'     => Hash::make($request->password),
                'role_id'     => $request->role_id
            ]);

        }else{
            $profilUnitAccount = $request->file('profil_unit_account');
            $profilUnitAccount->storeAs('public/profil_unit_account', $profilUnitAccount->hashName());

            $unitaccounts = UnitAccount::create([
                'id'    => Str::uuid(),
                'id_unit'     => $request->id_unit,
                'profil_unit_account'     => $profilUnitAccount->hashName(),
                'name'     => $request->name,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'telepon'     => $request->telepon,
                'email'     => $request->email,
                'password'     => Hash::make($request->password),
                'role_id'     => $request->role_id
            ]);
        }

        if($unitaccounts){
            //redirect dengan pesan sukses
            return redirect()->route('unitaccount.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('unitaccount.add')->with(['error' => 'Data Gagal Disimpan!']);
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
        $getUnit = Unit::all();
        $unitaccounts = UnitAccount::find($id);
        return view('backend.senada.yayasan.unit_account.edit', compact('unitaccounts', 'getUnit'));
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
        $unitaccounts = UnitAccount::findOrFail($id);

        if($request->file("profil_unit_account") == ""){
            if($request->password == ""){
                $unitaccounts->update([
                    'id_unit'     => $request->id_unit,
                    'name'     => $request->name,
                    'jenis_kelamin'     => $request->jenis_kelamin,
                    'telepon'     => $request->telepon,
                    'email'     => $request->email,
                    'role_id'   => $request->role_id
                ]);
            }else{
                $unitaccounts->update([
                    'id_unit'     => $request->id_unit,
                    'name'     => $request->name,
                    'jenis_kelamin'     => $request->jenis_kelamin,
                    'telepon'     => $request->telepon,
                    'email'     => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id'   => $request->role_id
                ]);
            }
        }else{
            Storage::disk('local')->delete('public/profil_unit_account/'.$unitaccounts->profil_unit_account);

            $profilUnitAccount = $request->file('profil_unit_account');
            $profilUnitAccount->storeAs('public/profil_unit_account', $profilUnitAccount->hashName());

            $unitaccounts->update([
                'id_unit'     => $request->id_unit,
                'profil_unit_account'     => $profilUnitAccount->hashName(),
                'name'     => $request->name,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'telepon'     => $request->telepon,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'role_id'   => $request->role_id
            ]);
        }

        if($unitaccounts){
            //redirect dengan pesan sukses
            return redirect()->route('unitaccount.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('unitaccount.edit')->with(['error' => 'Data Gagal Disimpan!']);
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
        $unitaccounts = UnitAccount::findOrFail($id);
        if($unitaccounts->profil_unit_account!="null"){
            Storage::disk('local')->delete('public/logo_sekolah'.$unitaccounts->profil_unit_account);
        }
        $unitaccounts->delete();

        if($unitaccounts){
            //redirect dengan pesan sukses
        return redirect()->route('unitaccount.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
        return redirect()->route('unitaccount.edit')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
