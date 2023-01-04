@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard/ Kelola / Unit /</span> Ubah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Ubah Unit</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('unit.update', $units->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <input name="id_yayasan" class="form-control" id="id_yayasan" value="{{ old('id_yayasan', $units->id_yayasan) }}" hidden>

                        <div>
                            <img src="{{ Storage::url('public/logo_sekolah/') . $units->logo_sekolah }}" class="rounded" style="width: 150px">
                        </div>
                        <div class="form-group mb-3">
                            <label>Logo Sekolah</label>
                            <div class="input-group col-xs-12">
                                <input type="file" class="form-control @error('logo_sekolah') is-invalid @enderror" name="logo_sekolah">
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
                                placeholder="Masukkan Nama Sekolah" value="{{ old('nama_sekolah', $units->nama_sekolah) }}">
                            @error('nama_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="unit">Unit</label>
                            <select name="unit" class="form-control" id="unit">
                                @if ($units->unit == "NULL")
                                <option>- Pilih -</option>
                                <option>TPA</option>
                                <option>TK</option>
                                <option>Day Care</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA</option>
                                <option>SMK</option>
                                <option>Pesantren</option>
                                @elseif ($units->unit == "TPA")
                                <option>TPA</option>
                                <option>TK</option>
                                <option>Day Care</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA</option>
                                <option>SMK</option>
                                <option>Pesantren</option>
                                @elseif ($units->unit == "TK")
                                <option>TK</option>
                                <option>Day Care</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA</option>
                                <option>SMK</option>
                                <option>Pesantren</option>
                                <option>TPA</option>
                                @elseif ($units->unit == "Day Care")
                                <option>Day Care</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA</option>
                                <option>SMK</option>
                                <option>Pesantren</option>
                                <option>TPA</option>
                                <option>TK</option>
                                @elseif ($units->unit == "SD")
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA</option>
                                <option>SMK</option>
                                <option>Pesantren</option>
                                <option>TPA</option>
                                <option>TK</option>
                                <option>Day Care</option>
                                @elseif ($units->unit == "SMP")
                                <option>SMP</option>
                                <option>SMA</option>
                                <option>SMK</option>
                                <option>Pesantren</option>
                                <option>TPA</option>
                                <option>TK</option>
                                <option>Day Care</option>
                                <option>SD</option>
                                @elseif ($units->unit == "SMA")
                                <option>SMA</option>
                                <option>SMK</option>
                                <option>Pesantren</option>
                                <option>TPA</option>
                                <option>TK</option>
                                <option>Day Care</option>
                                <option>SD</option>
                                <option>SMP</option>
                                @elseif ($units->unit == "SMK")
                                <option>SMK</option>
                                <option>Pesantren</option>
                                <option>TPA</option>
                                <option>TK</option>
                                <option>Day Care</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA</option>
                                @else
                                <option>Pesantren</option>
                                <option>TPA</option>
                                <option>TK</option>
                                <option>Day Care</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA</option>
                                <option>SMK</option>
                                @endif
                            </select>
                            @error('unit')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat_sekolah">Alamat Sekolah</label>
                            <input name="alamat_sekolah" class="form-control" id="alamat_sekolah"
                                placeholder="Masukkan Alamat Sekolah" value="{{ old('alamat_sekolah', $units->alamat_sekolah) }}">
                            @error('alamat_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="daerah_sekolah">Daerah Sekolah</label>
                            <input name="daerah_sekolah" class="form-control" id="daerah_sekolah"
                                placeholder="Masukkan Daerah sekolah" value="{{ old('daerah_sekolah', $units->daerah_sekolah) }}">
                            @error('daerah_sekolah')
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
