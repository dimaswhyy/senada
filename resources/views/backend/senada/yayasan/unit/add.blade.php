@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola / Unit /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Unit</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('unit.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        @foreach ($profils as $item)
                        <input name="id_yayasan" class="form-control" id="id_yayasan" value="{{$item->id}}" hidden>
                        @endforeach

                        <div class="form-group mb-3">
                            <label>Logo Sekolah</label>
                            <div class="input-group col-xs-12">
                                <input type="file" class="form-control @error('logo_sekolah') is-invalid @enderror"
                                    name="logo_sekolah">
                                @error('logo_sekolah')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama_sekolah">Nama Sekolah</label>
                            <input name="nama_sekolah" class="form-control" id="nama_sekolah"
                                placeholder="Masukkan Nama Sekolah">
                            @error('nama_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="unit">Unit</label>
                            <select name="unit" class="form-control" id="unit">
                                <option>- Pilih -</option>
                                <option>TPA</option>
                                <option>TK</option>
                                <option>Day Care</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA</option>
                                <option>SMK</option>
                                <option>Pesantren</option>
                            </select>
                            @error('unit')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat_sekolah">Alamat Sekolah</label>
                            <textarea name="alamat_sekolah" class="form-control" id="alamat_sekolah" rows="4"></textarea>
                            @error('alamat_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="daerah_sekolah">Daerah Sekolah</label>
                            <input name="daerah_sekolah" class="form-control" id="daerah_sekolah"
                                placeholder="Masukkan daerah Sekolah">
                            @error('daerah_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <a href="{{route('unit.index')}}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
