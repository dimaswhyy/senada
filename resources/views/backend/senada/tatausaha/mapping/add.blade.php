@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola / Mapping Kelas /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Mapping Kelas</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('mapping.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <input name="id_unit" class="form-control" id="id_unit" value="{{ auth()->user()->id_unit }}" readonly hidden>
                        <input name="id_unit_account" class="form-control" id="id_unit_account" value="{{ auth()->user()->id }}" readonly hidden>

                        <div class="form-group mb-3">
                            <label for="id_rombel">Rombongan Belajar</label>
                            <select name="id_rombel" class="form-control" id="id_rombel">
                                <option>- Pilih -</option>
                                @foreach ($getRombel as $item)
                                <option value="{{$item->id}}">{{$item->rombongan_belajar}}</option>
                                @endforeach
                            </select>
                            @error('id_rombel')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="kelas">Nama Kelas</label>
                            <input name="kelas" class="form-control" id="kelas"
                                placeholder="Masukkan Nama Kelas">
                            @error('kelas')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_guru">Walikelas</label>
                            <select name="id_guru" class="form-control" id="id_guru">
                                <option>- Pilih -</option>
                                @foreach ($getGuru as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('id_guru')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan</label>
                            <select name="keterangan" class="form-control" id="keterangan">
                                <option>- Pilih -</option>
                                <option>Aktif</option>
                                <option>Tidak Aktif</option>
                            </select>
                            @error('keterangan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <a href="{{route('mapping.index')}}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
