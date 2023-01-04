@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola / Akun /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Akun</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('unitaccount.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group mb-3">
                            <label for="id_unit">Unit</label>
                            <select name="id_unit" class="form-control" id="id_unit">
                                <option>- Pilih -</option>
                                @foreach ($getUnit as $item)
                                <option value="{{$item->id}}">{{$item->nama_sekolah . ' - ' . $item->daerah_sekolah}}</option>
                                @endforeach
                            </select>
                            @error('id_unit')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Foto Profil</label>
                            <div class="input-group col-xs-12">
                                <input type="file" class="form-control @error('profil_unit_account') is-invalid @enderror" name="profil_unit_account">
                                @error('profil_unit_account')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input name="name" class="form-control" id="name"
                                placeholder="Masukkan Nama">
                            @error('name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                <option>- Pilih -</option>
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="telepon">Telepon</label>
                            <input name="telepon" class="form-control" id="telepon"
                                placeholder="Masukkan Nomor Telepon">
                            @error('telepon')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input name="email" class="form-control" id="email"
                                placeholder="Masukkan Alamat Email">
                            @error('email')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Kata Sandi</label>
                            <input name="password" class="form-control" id="password"
                                placeholder="Masukkan Kata Sandi" type="password">
                            @error('password')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="role_id">Jabatan</label>
                            <select name="role_id" class="form-control" id="role_id">
                                <option>- Pilih -</option>
                                <option value="2">Tata Usaha</option>
                                <option value="3">Keuangan</option>
                            </select>
                            @error('role_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <a href="{{route('unitaccount.index')}}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
