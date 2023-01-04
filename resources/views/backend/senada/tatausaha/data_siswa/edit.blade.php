@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola / Data Siswa /</span> Ubah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Ubah Data Siswa</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('siswa.update', $siswas->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <input name="id_unit" class="form-control" id="id_unit" value="{{ auth()->user()->id_unit }}" readonly hidden>
                        <input name="id_unit_account" class="form-control" id="id_unit_account" value="{{ auth()->user()->id }}" readonly hidden>
                        <input name="role_id" class="form-control" id="role_id" value="6" readonly hidden>

                        <div>
                            <img src="{{ Storage::url('public/profil_siswa/') . $siswas->profil_siswa }}" class="rounded" style="width: 150px">
                        </div>
                        <div class="form-group mb-3">
                            <label>Foto Profil</label>
                            <div class="input-group col-xs-12">
                                <input type="file" class="form-control @error('profil_siswa') is-invalid @enderror" name="profil_siswa">
                                @error('profil_siswa')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="name">Nama Lengkap*</label>
                            <input name="name" class="form-control" id="name" value="{{ old('name', $siswas->name) }}" placeholder="Masukkan Nama Lengkap">
                            @error('name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email*</label>
                            <input name="email" class="form-control" id="email" value="{{ old('email', $siswas->email) }}"
                                placeholder="Masukkan Email">
                            @error('email')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-5">
                            <label for="password">Kata Sandi*</label>
                            <input name="password" class="form-control" id="password" value="{{ old('password', $siswas->password) }}"
                                placeholder="Masukkan Kata Sandi">
                            @error('password')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr class="my-5">

                        <h5 class="card-sub-header">Biodata Siswa</h5>

                        <div class="form-group mb-3">
                            <label for="nik">Nomor Induk Kependudukan*</label>
                            <input name="nik" class="form-control" id="nik" value="{{ old('nik', $siswas->nik) }}"
                                placeholder="Masukkan Nomor Induk Kependudukan">
                            @error('nik')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nis">Nomor Induk Siswa</label>
                            <input name="nis" class="form-control" id="nis" value="{{ old('nis', $siswas->nis) }}"
                                placeholder="Masukkan Nomor Induk Siswa">
                            @error('nis')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nisn">Nomor Induk Siswa Nasional</label>
                            <input name="nisn" class="form-control" id="nisn" value="{{ old('nisn', $siswas->nisn) }}"
                                placeholder="Masukkan Nomor Induk Siswa Nasional">
                            @error('nisn')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tempat_lahir">Tempat Lahir*</label>
                            <input name="tempat_lahir" class="form-control" id="tempat_lahir" value="{{ old('tempat_lahir', $siswas->tempat_lahir) }}"
                                placeholder="Masukkan Tempat Lahir">
                            @error('tempat_lahir')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_lahir">Tanggal Lahir*</label>
                            <input name="tanggal_lahir" class="form-control" type="date" value="{{ old('tanggal_lahir', $siswas->tanggal_lahir) }}" id="tanggal_lahir" />
                            @error('tamggal_mulai_kerja')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin*</label>
                            <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                @if ($siswas->jenis_kelamin == "NULL")
                                <option>- Pilih -</option>
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                                @elseif ($siswas->jenis_kelamin == "Laki-laki")
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                                @else
                                <option>Perempuan</option>
                                <option>Laki-laki</option>
                                @endif
                            </select>
                            @error('jenis_kelamin')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="agama">Agama*</label>
                            <input name="agama" class="form-control" id="agama" value="{{ old('agama', $siswas->agama) }}"
                                placeholder="Masukkan Agama">
                            @error('agama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="kewarganegaraan">Kewarganegaraan*</label>
                            <input name="kewarganegaraan" class="form-control" id="kewarganegaraan" value="{{ old('kewarganegaraan', $siswas->kewarganegaraan) }}"
                                placeholder="Masukkan Kewarganegaraan">
                            @error('kewarganegaraan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat">Alamat*</label>
                            <input name="alamat" class="form-control" id="alamat" value="{{ old('alamat', $siswas->alamat) }}"
                                placeholder="Masukkan Alamat">
                            @error('alamat')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="rt">Rukun Tetangga*</label>
                            <input name="rt" class="form-control" id="rt" value="{{ old('rt', $siswas->rt) }}"
                                placeholder="Masukkan Rukun Tetangga">
                            @error('rt')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="rw">Rukun Warga*</label>
                            <input name="rw" class="form-control" id="rw" value="{{ old('rw', $siswas->rw) }}"
                                placeholder="Masukkan Rukun Warga">
                            @error('rw')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="kelurahan">Kelurahan*</label>
                            <input name="kelurahan" class="form-control" id="kelurahan" value="{{ old('kelurahan', $siswas->kelurahan) }}"
                                placeholder="Masukkan Kelurahan">
                            @error('kelurahan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="kecamatan">Kecamatan*</label>
                            <input name="kecamatan" class="form-control" id="kecamatan" value="{{ old('kecamatan', $siswas->kecamatan) }}"
                                placeholder="Masukkan Kecamatan">
                            @error('kecamatan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="kotkab">Kota / Kabupaten*</label>
                            <input name="kotkab" class="form-control" id="kotkab" value="{{ old('kotkab', $siswas->kotkab) }}"
                                placeholder="Masukkan Kota / Kabupaten">
                            @error('kotkab')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="kode_pos">Kode Pos*</label>
                            <input name="kode_pos" class="form-control" id="kode_pos" value="{{ old('kode_pos', $siswas->kode_pos) }}"
                                placeholder="Masukkan Kode Pos">
                            @error('kode_pos')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenis_tinggal">Jenis Tinggal*</label>
                            <input name="jenis_tinggal" class="form-control" id="jenis_tinggal" value="{{ old('jenis_tinggal', $siswas->jenis_tinggal) }}"
                                placeholder="Masukkan Jenis Tinggal">
                            @error('jenis_tinggal')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="transportasi">Transportasi*</label>
                            <input name="transportasi" class="form-control" id="transportasi" value="{{ old('transportasi', $siswas->transportasi) }}"
                                placeholder="Masukkan Transportasi">
                            @error('transportasi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="telepon">Nomor Telepon</label>
                            <input name="telepon" class="form-control" id="telepon" value="{{ old('telepon', $siswas->telepon) }}"
                                placeholder="Masukkan Nomor Telepon">
                            @error('telepon')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="hp">Nomor Handphone*</label>
                            <input name="hp" class="form-control" id="hp" value="{{ old('hp', $siswas->hp) }}"
                                placeholder="Masukkan Nomor Handphone">
                            @error('pendidikan_nama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="asal_sekolah">Asal Sekolah</label>
                            <input name="asal_sekolah" class="form-control" id="asal_sekolah" value="{{ old('asal_sekolah', $siswas->asal_sekolah) }}"
                                placeholder="Masukkan Asal Sekolah">
                            @error('asal_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="berkebutuhan_khusus">Berkebutuhan Khusus</label>
                            <input name="berkebutuhan_khusus" class="form-control" id="berkebutuhan_khusus" value="{{ old('berkebutuhan_khusus', $siswas->berkebutuhan_khusus) }}"
                                placeholder="Masukkan Berkebutuhan Khusus">
                            @error('berkebutuhan_khusus')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr class="my-5">

                        <h5 class="card-sub-header">Biodata Orang Tua / Wali</h5><br>

                        <h5 class="card-sub-header">Data Ayah</h5>

                        <div class="form-group mb-3">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input name="nama_ayah" class="form-control" id="nama_ayah" value="{{ old('nama_ayah', $siswas->nama_ayah) }}"
                                placeholder="Masukkan Nama Ayah">
                            @error('nama_ayah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_lahir_ayah">Tanggal Lahir</label>
                            <input name="tanggal_lahir_ayah" class="form-control" type="date" value="{{ old('tanggal_lahir_ayah', $siswas->tanggal_lahir_ayah) }}" id="tanggal_lahir_ayah" />
                            @error('tamggal_lahir_ayah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenjang_pendidikan_ayah">Jenjang Pendidikan</label>
                            <input name="jenjang_pendidikan_ayah" class="form-control" id="jenjang_pendidikan_ayah" value="{{ old('jenjang_pendidikan_ayah', $siswas->jenjang_pendidikan_ayah) }}" placeholder="Masukkan Jenjang Pendidikan">
                            @error('jenjang_pendidikan_ayah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="pekerjaan_ayah">Pekerjaan</label>
                            <input name="pekerjaan_ayah" class="form-control" id="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $siswas->pekerjaan_ayah) }}" placeholder="Masukkan Pekerjaan">
                            @error('pekerjaan_ayah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="penghasilan_ayah">Penghasilan</label>
                            <input name="penghasilan_ayah" class="form-control" id="penghasilan_ayah" value="{{ old('penghasilan_ayah', $siswas->penghasilan_ayah) }}" placeholder="Masukkan Penghasilan">
                            @error('penghasilan_ayah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="berkebutuhan_khusus_ayah">Berkebutuhan Khusus</label>
                            <input name="berkebutuhan_khusus_ayah" class="form-control" id="berkebutuhan_khusus_ayah" value="{{ old('berkebutuhan_khusus_ayah', $siswas->berkebutuhan_khusus_ayah) }}" placeholder="Masukkan Berkebutuhan Khusus">
                            @error('berkebutuhan_khusus_ayah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div><br>

                        <h5 class="card-sub-header">Data Ibu</h5>

                        <div class="form-group mb-3">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input name="nama_ibu" class="form-control" id="nama_ibu" value="{{ old('nama_ibu', $siswas->nama_ibu) }}"
                                placeholder="Masukkan Nama Ibu">
                            @error('nama_ibu')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_lahir_ibu">Tanggal Lahir</label>
                            <input name="tanggal_lahir_ibu" class="form-control" type="date" value="{{ old('tanggal_lahir_ibu', $siswas->tanggal_lahir_ibu) }}" id="tanggal_lahir_ibu" />
                            @error('tamggal_lahir_ibu')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenjang_pendidikan_ibu">Jenjang Pendidikan</label>
                            <input name="jenjang_pendidikan_ibu" class="form-control" id="jenjang_pendidikan_ibu" value="{{ old('jenjang_pendidikan_ibu', $siswas->jenjang_pendidikan_ibu) }}" placeholder="Masukkan Jenjang Pendidikan">
                            @error('jenjang_pendidikan_ibu')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="pekerjaan_ibu">Pekerjaan</label>
                            <input name="pekerjaan_ibu" class="form-control" id="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $siswas->pekerjaan_ibu) }}" placeholder="Masukkan Pekerjaan">
                            @error('pekerjaan_ibu')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="penghasilan_ibu">Penghasilan</label>
                            <input name="penghasilan_ibu" class="form-control" id="penghasilan_ibu" value="{{ old('penghasilan_ibu', $siswas->penghasilan_ibu) }}" placeholder="Masukkan Penghasilan">
                            @error('penghasilan_ibu')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="berkebutuhan_khusus_ibu">Berkebutuhan Khusus</label>
                            <input name="berkebutuhan_khusus_ibu" class="form-control" id="berkebutuhan_khusus_ibu" value="{{ old('berkebutuhan_khusus_ibu', $siswas->berkebutuhan_khusus_ibu) }}" placeholder="Masukkan Berkebutuhan Khusus">
                            @error('berkebutuhan_khusus_ibu')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr class="my-5">

                        <h5 class="card-sub-header">Data Layanan</h5>

                        <div class="form-group mb-3">
                            <label for="penerima_kip">Penerima KIP</label>
                            <select name="penerima_kip" class="form-control" id="penerima_kip">
                                @if ($siswas->penerima_kip == "NULL")
                                <option>- Pilih -</option>
                                <option>Iya</option>
                                <option>Tidak</option>
                                @elseif ($siswas->penerima_kip == "Iya")
                                <option>Iya</option>
                                <option>Tidak</option>
                                @else
                                <option>Tidak</option>
                                <option>Iya</option>
                                @endif
                            </select>
                            @error('penerima_kip')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nomor_kip">Nomor KIP</label>
                            <input name="nomor_kip" class="form-control" id="nomor_kip" value="{{ old('nomor_kip', $siswas->nomor_kip) }}" placeholder="Masukkan Nomor KIP">
                            @error('nomor_kip')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama_kip">Nama di KIP</label>
                            <input name="nama_kip" class="form-control" id="nama_kip" value="{{ old('nama_kip', $siswas->nama_kip) }}" placeholder="Masukkan Nama di KIP">
                            @error('nama_kip')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nomor_kks">Nomor KKS</label>
                            <input name="nomor_kks" class="form-control" id="nomor_kks" value="{{ old('nomor_kks', $siswas->nomor_kks) }}" placeholder="Masukkan Nomor KKS">
                            @error('nomor_kks')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr class="my-5">

                        <h5 class="card-sub-header">Data Lanjutan</h5>

                        <div class="form-group mb-3">
                            <label for="no_akta_lahir">Nomor Akta Lahir</label>
                            <input name="no_akta_lahir" class="form-control" id="no_akta_lahir" value="{{ old('no_akta_lahir', $siswas->no_akta_lahir) }}" placeholder="Masukkan Nomor Akta Lahir">
                            @error('no_akta_lahir')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="layak_pip">Layak PIP</label>
                            <select name="layak_pip" class="form-control" id="layak_pip">
                                @if ($siswas->layak_pip == "NULL")
                                <option>- Pilih -</option>
                                <option>Layak</option>
                                <option>Tidak Layak</option>
                                @elseif ($siswas->layak_pip == "Layak")
                                <option>Layak</option>
                                <option>Tidak Layak</option>
                                @else
                                <option>Tidak Layak</option>
                                <option>Layak</option>
                                @endif
                            </select>
                            @error('layak_pip')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="alasan_pip">Alasan Mendapatkan PIP</label>
                            <input name="alasan_pip" class="form-control" id="alasan_pip" value="{{ old('alasan_pip', $siswas->alasan_pip) }}" placeholder="Masukkan Alasan Mendapatkan PIP">
                            @error('alasan_pip')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="kebutuhan_khusus">Kebutuhan Khusus</label>
                            <input name="kebutuhan_khusus" class="form-control" id="kebutuhan_khusus" value="{{ old('kebutuhan_khusus', $siswas->kebutuhan_khusus) }}" placeholder="Masukkan Kebutuhan Khusus">
                            @error('kebutuhan_khusus')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="anak_ke">Anak Ke</label>
                            <input name="anak_ke" class="form-control" id="anak_ke" value="{{ old('anak_ke', $siswas->anak_ke) }}" placeholder="Masukkan Anak Ke">
                            @error('anak_ke')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="lintang">Koordinat Lintang</label>
                            <input name="lintang" class="form-control" id="lintang" value="{{ old('lintang', $siswas->lintang) }}" placeholder="Masukkan Koordinat Lintang">
                            @error('lintang')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="bujur">Koordinat Bujur</label>
                            <input name="bujur" class="form-control" id="bujur" value="{{ old('bujur', $siswas->bujur) }}" placeholder="Masukkan Koordinat Bujur">
                            @error('bujur')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="berat_badan">Berat Badan Siswa</label>
                            <input name="berat_badan" class="form-control" id="berat_badan" value="{{ old('berat_badan', $siswas->berat_badan) }}" placeholder="Masukkan Berat Badan Siswa">
                            @error('berat_badan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tinggi_badan">Tinggi Badan Siswa</label>
                            <input name="tinggi_badan" class="form-control" id="tinggi_badan" value="{{ old('tinggi_badan', $siswas->tinggi_badan) }}" placeholder="Masukkan Tinggi Badan Siswa">
                            @error('tinggi_badan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jumlah_saudara">Jumlah Saudara</label>
                            <input name="jumlah_saudara" class="form-control" id="jumlah_saudara" value="{{ old('jumlah_saudara', $siswas->jumlah_saudara) }}" placeholder="Masukkan Jumlah Saudara">
                            @error('jumlah_saudara')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jarak_rumah">Jarak Rumah ke Sekolah</label>
                            <input name="jarak_rumah" class="form-control" id="jarak_rumah" value="{{ old('jarak_rumah', $siswas->jarak_rumah) }}" placeholder="Masukkan Jarak Rumah ke Sekolah">
                            @error('jarak_rumah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan*</label>
                            <select name="keterangan" class="form-control" id="keterangan">
                                @if ($siswas->keterangan == "NULL")
                                <option>- Pilih -</option>
                                <option>Aktif</option>
                                <option>Tidak Aktif</option>
                                @elseif ($siswas->keterangan == "Aktif")
                                <option>Aktif</option>
                                <option>Tidak Aktif</option>
                                @else
                                <option>Tidak Aktif</option>
                                <option>Aktif</option>
                                @endif
                            </select>
                            @error('keterangan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <a href="{{ route('guru.index') }}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
