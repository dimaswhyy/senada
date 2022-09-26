<?php

namespace App\Http\Controllers\Backend\Yayasan;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

            $data = Profil::latest()->get();

            return datatables::of($data)
                    ->addIndexColumn()
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('email'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['email'], $request->get('email')) ? true : false;
                            });
                        }

                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                if (Str::contains(Str::lower($row['email_yayasan']), Str::lower($request->get('search')))){
                                    return true;
                                }else if (Str::contains(Str::lower($row['nama_yayasan']), Str::lower($request->get('search')))) {
                                    return true;
                                }

                                return false;
                            });
                        }

                    })
                    ->addColumn('action', function($row){
                            // $btn = '<a href="javascript:void(0)" class="delete btn btn-primary btn-sm"><i class="bx bx-search-alt" ></i></i></i></a>';
                            $btn = '<a href='.route("profilyayasan.edit", $row->id).' class="edit btn btn-warning btn-sm"><i class="bx bx-message-square-edit"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.senada.yayasan.profil.list');
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
        $profilyayasans = Profil::find($id);
        return view('backend.senada.yayasan.profil.edit', compact('profilyayasans'));
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
        $profilyayasans = Profil::findOrFail($id);

        if($request->file("logo_yayasan") == ""){

            $profilyayasans->update([
                'nama_yayasan'     => $request->nama_yayasan,
                'alamat_yayasan'     => $request->alamat_yayasan,
                'telepon_yayasan'     => $request->telepon_yayasan,
                'hp_yayasan'     => $request->hp_yayasan,
                'email_yayasan'     => $request->email_yayasan,
                'instagram_yayasan'     => $request->instagram_yayasan,
                'facebook_yayasan'     => $request->facebook_yayasan,
                'youtube_yayasan'     => $request->youtube_yayasan,
                'sejarah_yayasan'     => $request->sejarah_yayasan,
                'visi_yayasan'     => $request->visi_yayasan,
                'misi_yayasan'     => $request->misi_yayasan
            ]);
        }else{
            Storage::disk('local')->delete('public/logo_yayasan/'.$profilyayasans->logo_yayasan);

            $logoyayasan = $request->file('logo_yayasan');
            $logoyayasan->storeAs('public/logo_yayasan', $logoyayasan->hashName());

            $profilyayasans->update([
                'logo_yayasan'      => $logoyayasan->hashName(),
                'nama_yayasan'     => $request->nama_yayasan,
                'alamat_yayasan'     => $request->alamat_yayasan,
                'telepon_yayasan'     => $request->telepon_yayasan,
                'hp_yayasan'     => $request->hp_yayasan,
                'email_yayasan'     => $request->email_yayasan,
                'instagram_yayasan'     => $request->instagram_yayasan,
                'facebook_yayasan'     => $request->facebook_yayasan,
                'youtube_yayasan'     => $request->youtube_yayasan,
                'sejarah_yayasan'     => $request->sejarah_yayasan,
                'visi_yayasan'     => $request->visi_yayasan,
                'misi_yayasan'     => $request->misi_yayasan
            ]);
        }

        if($profilyayasans){
            //redirect dengan pesan sukses
            return redirect()->route('profilyayasan.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('profilyayasan.edit')->with(['error' => 'Data Gagal Disimpan!']);
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
    }
}
