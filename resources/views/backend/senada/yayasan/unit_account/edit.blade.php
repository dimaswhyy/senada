@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard/ Kelola / Akun /</span> Ubah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Ubah Akun</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('unitaccount.update', $unitaccounts->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="id_unit">Unit</label>
                            <select name="id_unit" class="form-control" id="id_unit">
                                @foreach ($getUnit as $item)
                                <option value="{{$item->id}}" {{$unitaccounts->id_unit == $item->id ? 'selected':''}}>{{$item->nama_sekolah . ' - ' . $item->daerah_sekolah}}</option>
                                @endforeach
                            </select>
                            @error('id_unit')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <img src="{{ Storage::url('public/profil_unit_account/') . $unitaccounts->profil_unit_account }}" class="rounded" style="width: 150px">
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
                                placeholder="Masukkan Nama" value="{{ old('name', $unitaccounts->name) }}">
                            @error('name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                @if ($unitaccounts->jenis_kelamin == "NULL")
                                <option>- Pilih -</option>
                                <option>Ikhwan</option>
                                <option>Akhwat</option>
                                @elseif ($unitaccounts->jenis_kelamin == "Ikhwan")
                                <option>Ikhwan</option>
                                <option>Akhwat</option>
                                @else
                                <option>Akhwat</option>
                                <option>Ikhwan</option>
                                @endif
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
                                placeholder="Masukkan Telepon" value="{{ old('telepon', $unitaccounts->telepon) }}">
                            @error('telepon')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input name="email" class="form-control" id="email"
                                placeholder="Masukkan Email" value="{{ old('email', $unitaccounts->email) }}">
                            @error('email')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Kata Sandi</label>
                            <input name="password" class="form-control" id="password"
                                placeholder="Masukkan Kata Sandi">
                            @error('password')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="role_id">Jabatan</label>
                            <select name="role_id" class="form-control" id="role_id">
                                @if ($unitaccounts->role_id == "NULL")
                                <option>- Pilih -</option>
                                <option value="2">Tata Usaha</option>
                                <option value="3">Keuangan</option>
                                @elseif ($unitaccounts->role_id == 2)
                                <option value="2">Tata Usaha</option>
                                <option value="3">Keuangan</option>
                                @else
                                <option value="3">Keuangan</option>
                                <option value="2">Tata Usaha</option>
                                @endif
                            </select>
                            @error('role_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Ubah & Simpan</button>
                        <a href="{{route('unit.index')}}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
