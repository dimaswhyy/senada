@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard/ Kelola / Data Guru /</span> Ubah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Ubah Data Guru</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('guru.update', $gurus->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <input name="id_unit" class="form-control" id="id_unit" value="{{ auth()->user()->id_unit }}" readonly hidden>
                        <input name="id_unit_account" class="form-control" id="id_unit_account" value="{{ auth()->user()->id }}" readonly hidden>
                        <input name="role_id" class="form-control" id="role_id" value="5" readonly hidden>

                        <div>
                            <img src="{{ Storage::url('public/profil_guru/') . $gurus->profil_guru }}" class="rounded" style="width: 150px">
                        </div>
                        <div class="form-group mb-3">
                            <label>Foto Profil</label>
                            <div class="input-group col-xs-12">
                                <input type="file" class="form-control @error('profil_guru') is-invalid @enderror" name="profil_guru">
                                @error('profil_guru')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="name">Nama Lengkap</label>
                            <input name="name" class="form-control" id="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name', $gurus->name) }}">
                            @error('name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input name="tanggal_lahir" class="form-control" type="date" value="{{ old('tanggal_lahir', $gurus->tanggal_lahir) }}" id="tanggal_lahir" />
                            @error('tanggal_lahir')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input name="email" class="form-control" id="email" placeholder="Masukkan Email" value="{{ old('email', $gurus->email) }}">
                            @error('email')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-5">
                            <label for="password">Kata Sandi</label>
                            <input name="password" class="form-control" id="password" placeholder="Masukkan Kata Sandi">
                            @error('password')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <h5 class="card-sub-header">Biodata Guru</h5>

                        <div class="form-group mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                @if ($gurus->jenis_kelamin == "NULL")
                                <option>- Pilih -</option>
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                                @elseif ($gurus->jenis_kelamin == "Laki-laki")
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
                            <label for="nip">Nomor Induk Pegawai</label>
                            <input name="nip" class="form-control" id="nip" placeholder="Masukkan Nomor Induk Pegawai" value="{{ old('nip', $gurus->nip) }}">
                            @error('nip')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="niy">Nomor Induk Yayasan</label>
                            <input name="niy" class="form-control" id="niy" placeholder="Masukkan Nomor Induk Yayasan" value="{{ old('niy', $gurus->niy) }}">
                            @error('niy')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="pangkat_golongan">Pangkat Golongan</label>
                            <input name="pangkat_golongan" class="form-control" id="pangkat_golongan" placeholder="Masukkan Pangkat Golongan" value="{{ old('pangkat_golongan', $gurus->pangkat_golongan) }}">
                            @error('pangkat_golongan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="pangkat_tmt">Pangkat TMT</label>
                            <input name="pangkat_tmt" class="form-control" id="pangkat_tmt" placeholder="Masukkan Pangkat TMT" value="{{ old('pangkat_tmt', $gurus->pangkat_tmt) }}">
                            @error('pangkat_tmt')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jabatan_guru">Jabatan</label>
                            <input name="jabatan_guru" class="form-control" id="jabatan_guru" placeholder="Masukkan Jabatan" value="{{ old('jabatan_guru', $gurus->jabatan_guru) }}">
                            @error('jabatan_guru')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jabatan_tmt">Jabatan TMT</label>
                            <input name="jabatan_tmt" class="form-control" id="jabatan_tmt" placeholder="Masukkan Jabatan TMT" value="{{ old('jabatan_tmt', $gurus->jabatan_tmt) }}">
                            @error('jabatan_tmt')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="masa_kerja_tahun">Masa Kerja Tahun</label>
                            <input name="masa_kerja_tahun" class="form-control" id="masa_kerja_tahun" placeholder="Masukkan Masa Kerja Tahun" value="{{ old('masa_kerja_tahun', $gurus->masa_kerja_tahun) }}">
                            @error('masa_kerja_tahun')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="masa_kerja_bulan">Masa Kerja Bulan</label>
                            <input name="masa_kerja_bulan" class="form-control" id="masa_kerja_bulan" placeholder="Masukkan Masa Kerja Bulan" value="{{ old('masa_kerja_bulan', $gurus->masa_kerja_bulan) }}">
                            @error('masa_kerja_bulan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="pendidikan_nama">Nama Pendidikan / Kampus</label>
                            <input name="pendidikan_nama" class="form-control" id="pendidikan_nama" placeholder="Masukkan Nama Pendidikan / Kampus" value="{{ old('pendidikan_nama', $gurus->pendidikan_nama) }}">
                            @error('pendidikan_nama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="pendidikan_tahun_lulus">Tahun Lulus</label>
                            <input name="pendidikan_tahun_lulus" class="form-control" id="pendidikan_tahun_lulus" placeholder="Masukkan Tahun Lulus" value="{{ old('pendidikan_tahun_lulus', $gurus->pendidikan_tahun_lulus) }}">
                            @error('pendidikan_tahun_lulus')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="pendidikan_fakultas">Nama Fakultas</label>
                            <input name="pendidikan_fakultas" class="form-control" id="pendidikan_fakultas" placeholder="Masukkan Nama Fakultas" value="{{ old('pendidikan_fakultas', $gurus->pendidikan_fakultas) }}">
                            @error('pendidikan_fakultas')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Masukkan Tempat Lahir" value="{{ old('tempat_lahir', $gurus->tempat_lahir) }}">
                            @error('tempat_lahir')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_mulai_kerja">Tanggal Mulai Kerja</label>
                            <input name="tanggal_mulai_kerja" class="form-control" type="date" value="{{ old('tanggal_mulai_kerja', $gurus->tanggal_mulai_kerja) }}" id="tanggal_mulai_kerja" />
                            @error('tamggal_mulai_kerja')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nrg">Nomor Registrasi Guru</label>
                            <input name="nrg" class="form-control" id="nrg" placeholder="Masukkan Nomor Registrasi Guru" value="{{ old('nrg', $gurus->nrg) }}">
                            @error('nrg')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nuptk">NUPTK</label>
                            <input name="nuptk" class="form-control" id="nuptk" placeholder="Masukkan NUPTK" value="{{ old('nuptk', $gurus->nuptk) }}">
                            @error('nuptk')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan</label>
                            <select name="keterangan" class="form-control" id="keterangan">
                                @if ($gurus->keterangan == "NULL")
                                <option>- Pilih -</option>
                                <option>Aktif</option>
                                <option>Tidak Aktif</option>
                                @elseif ($gurus->keterangan == "Aktif")
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

                        <button type="submit" class="btn btn-primary mr-2">Ubah & Simpan</button>
                        <a href="{{route('guru.index')}}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
