<?php

namespace App\Http\Controllers\Backend\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\UnitAccount;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
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

            $data = Siswa::where('id_unit_account','=',Auth::User()->id)->latest()->get();

            return datatables::of($data)
                    ->addIndexColumn()
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('nama_siswa'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['nama_siswa'], $request->get('nama_siswa')) ? true : false;
                            });
                        }

                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                if (Str::contains(Str::lower($row['nama_siswa']), Str::lower($request->get('search')))){
                                    return true;
                                }else if (Str::contains(Str::lower($row['nis']), Str::lower($request->get('search')))) {
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
                          <a class="dropdown-item" href='.route("siswa.edit", $row->id).'><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                          <form action="' . route('siswa.destroy', $row->id) . '" method="POST">' . csrf_field() . method_field("DELETE") . '<button type="submit" class="btn btn-light" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini ?\')"><i class="bx bx-trash me-1"></i> Hapus</button></form>
                        </div>
                        </div>';
                        $btn = $dropBtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.senada.tatausaha.data_siswa.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $getUnitAccount = UnitAccount::all();
        return view('backend.senada.tatausaha.data_siswa.add', compact('getUnitAccount'));
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
            'nik'     => 'required',
            'tempat_lahir'     => 'required',
            'tanggal_lahir'     => 'required',
            'agama'     => 'required',
            'kewarganegaraan'     => 'required',
            'alamat'     => 'required',
            'rt'     => 'required',
            'rw'     => 'required',
            'kelurahan'     => 'required',
            'kecamatan'     => 'required',
            'kotkab'     => 'required',
            'kode_pos'     => 'required',
            'jenis_tinggal'     => 'required',
            'transportasi'     => 'required',
            'hp'     => 'required',
            'email'     => 'required',
            'password'     => 'required',
            'keterangan'     => 'required',
            'role_id'   => 'required'
        ]);

        if($request->file("profil_siswa") == ""){
            $siswas = Siswa::create([
                'id'    => Str::uuid(),
                'id_unit'     => $request->id_unit,
                'id_unit_account'     => $request->id_unit_account,
                'name'     => $request->name,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'nik'     => $request->nik,
                'nis'     => $request->nis,
                'nisn'     => $request->nisn,
                'tempat_lahir'     => $request->tempat_lahir,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'agama'     => $request->agama,
                'kewarganegaraan'     => $request->kewarganegaraan,
                'alamat'     => $request->alamat,
                'rt'     => $request->rt,
                'rw'     => $request->rw,
                'kelurahan'     => $request->kelurahan,
                'kecamatan'     => $request->kecamatan,
                'kotkab'     => $request->kotkab,
                'kode_pos'     => $request->kode_pos,
                'jenis_tinggal'     => $request->jenis_tinggal,
                'transportasi'     => $request->transportasi,
                'telepon'     => $request->telepon,
                'hp'     => $request->hp,
                'asal_sekolah'     => $request->asal_sekolah,
                'berkebutuhan_khusus'     => $request->berkebutuhan_khusus,
                'nama_ayah'     => $request->nama_ayah,
                'tanggal_lahir_ayah'     => $request->tanggal_lahir_ayah,
                'jenjang_pendidikan_ayah'     => $request->jenjang_pendidikan_ayah,
                'pekerjaan_ayah'     => $request->pekerjaan_ayah,
                'penghasilan_ayah'     => $request->penghasilan_ayah,
                'nik_ayah'     => $request->nik_ayah,
                'berkebutuhan_khusus_ayah'     => $request->berkebutuhan_khusus_ayah,
                'nama_ibu'     => $request->nama_ibu,
                'tanggal_lahir_ibu'     => $request->tanggal_lahir_ibu,
                'jenjang_pendidikan_ibu'     => $request->jenjang_pendidikan_ibu,
                'pekerjaan_ibu'     => $request->pekerjaan_ibu,
                'penghasilan_ibu'     => $request->penghasilan_ibu,
                'nik_ibu'     => $request->nik_ibu,
                'berkebutuhan_khusus_ibu'     => $request->berkebutuhan_khusus_ibu,
                'penerima_kip'     => $request->penerima_kip,
                'nomor_kip'     => $request->nomor_kip,
                'nama_kip'     => $request->nama_kip,
                'nomor_kks'     => $request->nomor_kks,
                'no_akta_lahir'     => $request->no_akta_lahir,
                'layak_pip'     => $request->layak_pip,
                'alasan_pip'     => $request->alasan_pip,
                'kebutuhan_khusus'     => $request->kebutuhan_khusus,
                'anak_ke'     => $request->anak_ke,
                'lintang'     => $request->lintang,
                'bujur'     => $request->bujur,
                'berat_badan'     => $request->berat_badan,
                'tinggi_badan'     => $request->tinggi_badan,
                'jumlah_saudara'     => $request->jumlah_saudara,
                'jarak_rumah'     => $request->jarak_rumah,
                'email'     => $request->email,
                'password'     => Hash::make($request->password),
                'keterangan'     => $request->keterangan,
                'role_id'     => $request->role_id
            ]);

        }else{
            $profilSiswa = $request->file('profil_siswa');
            $profilSiswa->storeAs('public/profil_siswa', $profilSiswa->hashName());

            $siswas = Siswa::create([
                'id'    => Str::uuid(),
                'id_unit'     => $request->id_unit,
                'id_unit_account'     => $request->id_unit_account,
                'name'     => $request->name,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'nik'     => $request->nik,
                'nis'     => $request->nis,
                'nisn'     => $request->nisn,
                'tempat_lahir'     => $request->tempat_lahir,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'agama'     => $request->agama,
                'kewarganegaraan'     => $request->kewarganegaraan,
                'alamat'     => $request->alamat,
                'rt'     => $request->rt,
                'rw'     => $request->rw,
                'kelurahan'     => $request->kelurahan,
                'kecamatan'     => $request->kecamatan,
                'kotkab'     => $request->kotkab,
                'kode_pos'     => $request->kode_pos,
                'jenis_tinggal'     => $request->jenis_tinggal,
                'transportasi'     => $request->transportasi,
                'telepon'     => $request->telepon,
                'hp'     => $request->hp,
                'asal_sekolah'     => $request->asal_sekolah,
                'berkebutuhan_khusus'     => $request->berkebutuhan_khusus,
                'nama_ayah'     => $request->nama_ayah,
                'tanggal_lahir_ayah'     => $request->tanggal_lahir_ayah,
                'jenjang_pendidikan_ayah'     => $request->jenjang_pendidikan_ayah,
                'pekerjaan_ayah'     => $request->pekerjaan_ayah,
                'penghasilan_ayah'     => $request->penghasilan_ayah,
                'nik_ayah'     => $request->nik_ayah,
                'berkebutuhan_khusus_ayah'     => $request->berkebutuhan_khusus_ayah,
                'nama_ibu'     => $request->nama_ibu,
                'tanggal_lahir_ibu'     => $request->tanggal_lahir_ibu,
                'jenjang_pendidikan_ibu'     => $request->jenjang_pendidikan_ibu,
                'pekerjaan_ibu'     => $request->pekerjaan_ibu,
                'penghasilan_ibu'     => $request->penghasilan_ibu,
                'nik_ibu'     => $request->nik_ibu,
                'berkebutuhan_khusus_ibu'     => $request->berkebutuhan_khusus_ibu,
                'penerima_kip'     => $request->penerima_kip,
                'nomor_kip'     => $request->nomor_kip,
                'nama_kip'     => $request->nama_kip,
                'nomor_kks'     => $request->nomor_kks,
                'no_akta_lahir'     => $request->no_akta_lahir,
                'layak_pip'     => $request->layak_pip,
                'alasan_pip'     => $request->alasan_pip,
                'kebutuhan_khusus'     => $request->kebutuhan_khusus,
                'anak_ke'     => $request->anak_ke,
                'lintang'     => $request->lintang,
                'bujur'     => $request->bujur,
                'berat_badan'     => $request->berat_badan,
                'tinggi_badan'     => $request->tinggi_badan,
                'jumlah_saudara'     => $request->jumlah_saudara,
                'jarak_rumah'     => $request->jarak_rumah,
                'email'     => $request->email,
                'password'     => Hash::make($request->password),
                'profil_siswa'     => $profilSiswa->hashName(),
                'keterangan'     => $request->keterangan,
                'role_id'     => $request->role_id
            ]);
        }

        if($siswas){
            //redirect dengan pesan sukses
            return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('siswa.add')->with(['error' => 'Data Gagal Disimpan!']);
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
        $siswas = Siswa::find($id);
        return view('backend.senada.tatausaha.data_siswa.edit', compact('siswas'));
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
        $siswas = Siswa::findOrFail($id);

        if($request->file("profil_siswa") == ""){
            if($request->password == ""){
                $siswas->update([
                    'id_unit_account'     => $request->id_unit_account,
                    'name'     => $request->name,
                    'jenis_kelamin'     => $request->jenis_kelamin,
                    'nik'     => $request->nik,
                    'nis'     => $request->nis,
                    'nisn'     => $request->nisn,
                    'tempat_lahir'     => $request->tempat_lahir,
                    'tanggal_lahir'     => $request->tanggal_lahir,
                    'agama'     => $request->agama,
                    'kewarganegaraan'     => $request->kewarganegaraan,
                    'alamat'     => $request->alamat,
                    'rt'     => $request->rt,
                    'rw'     => $request->rw,
                    'kelurahan'     => $request->kelurahan,
                    'kecamatan'     => $request->kecamatan,
                    'kotkab'     => $request->kotkab,
                    'kode_pos'     => $request->kode_pos,
                    'jenis_tinggal'     => $request->jenis_tinggal,
                    'transportasi'     => $request->transportasi,
                    'telepon'     => $request->telepon,
                    'hp'     => $request->hp,
                    'asal_sekolah'     => $request->asal_sekolah,
                    'berkebutuhan_khusus'     => $request->berkebutuhan_khusus,
                    'nama_ayah'     => $request->nama_ayah,
                    'tanggal_lahir_ayah'     => $request->tanggal_lahir_ayah,
                    'jenjang_pendidikan_ayah'     => $request->jenjang_pendidikan_ayah,
                    'pekerjaan_ayah'     => $request->pekerjaan_ayah,
                    'penghasilan_ayah'     => $request->penghasilan_ayah,
                    'nik_ayah'     => $request->nik_ayah,
                    'berkebutuhan_khusus_ayah'     => $request->berkebutuhan_khusus_ayah,
                    'nama_ibu'     => $request->nama_ibu,
                    'tanggal_lahir_ibu'     => $request->tanggal_lahir_ibu,
                    'jenjang_pendidikan_ibu'     => $request->jenjang_pendidikan_ibu,
                    'pekerjaan_ibu'     => $request->pekerjaan_ibu,
                    'penghasilan_ibu'     => $request->penghasilan_ibu,
                    'nik_ibu'     => $request->nik_ibu,
                    'berkebutuhan_khusus_ibu'     => $request->berkebutuhan_khusus_ibu,
                    'penerima_kip'     => $request->penerima_kip,
                    'nomor_kip'     => $request->nomor_kip,
                    'nama_kip'     => $request->nama_kip,
                    'nomor_kks'     => $request->nomor_kks,
                    'no_akta_lahir'     => $request->no_akta_lahir,
                    'layak_pip'     => $request->layak_pip,
                    'alasan_pip'     => $request->alasan_pip,
                    'kebutuhan_khusus'     => $request->kebutuhan_khusus,
                    'anak_ke'     => $request->anak_ke,
                    'lintang'     => $request->lintang,
                    'bujur'     => $request->bujur,
                    'berat_badan'     => $request->berat_badan,
                    'tinggi_badan'     => $request->tinggi_badan,
                    'jumlah_saudara'     => $request->jumlah_saudara,
                    'jarak_rumah'     => $request->jarak_rumah,
                    'email'     => $request->email,
                    'keterangan'     => $request->keterangan,
                    'role_id'     => $request->role_id
                ]);
            }else{
                $siswas->update([
                    'id_unit_account'     => $request->id_unit_account,
                    'name'     => $request->name,
                    'jenis_kelamin'     => $request->jenis_kelamin,
                    'nik'     => $request->nik,
                    'nis'     => $request->nis,
                    'nisn'     => $request->nisn,
                    'tempat_lahir'     => $request->tempat_lahir,
                    'tanggal_lahir'     => $request->tanggal_lahir,
                    'agama'     => $request->agama,
                    'kewarganegaraan'     => $request->kewarganegaraan,
                    'alamat'     => $request->alamat,
                    'rt'     => $request->rt,
                    'rw'     => $request->rw,
                    'kelurahan'     => $request->kelurahan,
                    'kecamatan'     => $request->kecamatan,
                    'kotkab'     => $request->kotkab,
                    'kode_pos'     => $request->kode_pos,
                    'jenis_tinggal'     => $request->jenis_tinggal,
                    'transportasi'     => $request->transportasi,
                    'telepon'     => $request->telepon,
                    'hp'     => $request->hp,
                    'asal_sekolah'     => $request->asal_sekolah,
                    'berkebutuhan_khusus'     => $request->berkebutuhan_khusus,
                    'nama_ayah'     => $request->nama_ayah,
                    'tanggal_lahir_ayah'     => $request->tanggal_lahir_ayah,
                    'jenjang_pendidikan_ayah'     => $request->jenjang_pendidikan_ayah,
                    'pekerjaan_ayah'     => $request->pekerjaan_ayah,
                    'penghasilan_ayah'     => $request->penghasilan_ayah,
                    'nik_ayah'     => $request->nik_ayah,
                    'berkebutuhan_khusus_ayah'     => $request->berkebutuhan_khusus_ayah,
                    'nama_ibu'     => $request->nama_ibu,
                    'tanggal_lahir_ibu'     => $request->tanggal_lahir_ibu,
                    'jenjang_pendidikan_ibu'     => $request->jenjang_pendidikan_ibu,
                    'pekerjaan_ibu'     => $request->pekerjaan_ibu,
                    'penghasilan_ibu'     => $request->penghasilan_ibu,
                    'nik_ibu'     => $request->nik_ibu,
                    'berkebutuhan_khusus_ibu'     => $request->berkebutuhan_khusus_ibu,
                    'penerima_kip'     => $request->penerima_kip,
                    'nomor_kip'     => $request->nomor_kip,
                    'nama_kip'     => $request->nama_kip,
                    'nomor_kks'     => $request->nomor_kks,
                    'no_akta_lahir'     => $request->no_akta_lahir,
                    'layak_pip'     => $request->layak_pip,
                    'alasan_pip'     => $request->alasan_pip,
                    'kebutuhan_khusus'     => $request->kebutuhan_khusus,
                    'anak_ke'     => $request->anak_ke,
                    'lintang'     => $request->lintang,
                    'bujur'     => $request->bujur,
                    'berat_badan'     => $request->berat_badan,
                    'tinggi_badan'     => $request->tinggi_badan,
                    'jumlah_saudara'     => $request->jumlah_saudara,
                    'jarak_rumah'     => $request->jarak_rumah,
                    'email'     => $request->email,
                    'password'     => Hash::make($request->password),
                    'keterangan'     => $request->keterangan,
                    'role_id'     => $request->role_id
                ]);
            }
        }else{
            Storage::disk('local')->delete('public/profil_siswa/'.$siswas->profil_siswa);

            $profilSiswa = $request->file('profil_siswa');
            $profilSiswa->storeAs('public/profil_siswa', $profilSiswa->hashName());

            $siswas->update([
                'id_unit_account'     => $request->id_unit_account,
                'name'     => $request->name,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'nik'     => $request->nik,
                'nis'     => $request->nis,
                'nisn'     => $request->nisn,
                'tempat_lahir'     => $request->tempat_lahir,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'agama'     => $request->agama,
                'kewarganegaraan'     => $request->kewarganegaraan,
                'alamat'     => $request->alamat,
                'rt'     => $request->rt,
                'rw'     => $request->rw,
                'kelurahan'     => $request->kelurahan,
                'kecamatan'     => $request->kecamatan,
                'kotkab'     => $request->kotkab,
                'kode_pos'     => $request->kode_pos,
                'jenis_tinggal'     => $request->jenis_tinggal,
                'transportasi'     => $request->transportasi,
                'telepon'     => $request->telepon,
                'hp'     => $request->hp,
                'asal_sekolah'     => $request->asal_sekolah,
                'berkebutuhan_khusus'     => $request->berkebutuhan_khusus,
                'nama_ayah'     => $request->nama_ayah,
                'tanggal_lahir_ayah'     => $request->tanggal_lahir_ayah,
                'jenjang_pendidikan_ayah'     => $request->jenjang_pendidikan_ayah,
                'pekerjaan_ayah'     => $request->pekerjaan_ayah,
                'penghasilan_ayah'     => $request->penghasilan_ayah,
                'nik_ayah'     => $request->nik_ayah,
                'berkebutuhan_khusus_ayah'     => $request->berkebutuhan_khusus_ayah,
                'nama_ibu'     => $request->nama_ibu,
                'tanggal_lahir_ibu'     => $request->tanggal_lahir_ibu,
                'jenjang_pendidikan_ibu'     => $request->jenjang_pendidikan_ibu,
                'pekerjaan_ibu'     => $request->pekerjaan_ibu,
                'penghasilan_ibu'     => $request->penghasilan_ibu,
                'nik_ibu'     => $request->nik_ibu,
                'berkebutuhan_khusus_ibu'     => $request->berkebutuhan_khusus_ibu,
                'penerima_kip'     => $request->penerima_kip,
                'nomor_kip'     => $request->nomor_kip,
                'nama_kip'     => $request->nama_kip,
                'nomor_kks'     => $request->nomor_kks,
                'no_akta_lahir'     => $request->no_akta_lahir,
                'layak_pip'     => $request->layak_pip,
                'alasan_pip'     => $request->alasan_pip,
                'kebutuhan_khusus'     => $request->kebutuhan_khusus,
                'anak_ke'     => $request->anak_ke,
                'lintang'     => $request->lintang,
                'bujur'     => $request->bujur,
                'berat_badan'     => $request->berat_badan,
                'tinggi_badan'     => $request->tinggi_badan,
                'jumlah_saudara'     => $request->jumlah_saudara,
                'jarak_rumah'     => $request->jarak_rumah,
                'email'     => $request->email,
                'profil_siswa'     => $profilSiswa->hashName(),
                'keterangan'     => $request->keterangan,
                'role_id'     => $request->role_id
            ]);
        }

        if($siswas){
            //redirect dengan pesan sukses
            return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('siswa.edit')->with(['error' => 'Data Gagal Disimpan!']);
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
        $siswas = Siswa::findOrFail($id);
        if($siswas->profil_siswa!="null"){
            Storage::disk('local')->delete('public/profil_siswa'.$siswas->profil_siswa);
        }
        $siswas->delete();

        if($siswas){
            //redirect dengan pesan sukses
        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
        return redirect()->route('siswa.edit')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
