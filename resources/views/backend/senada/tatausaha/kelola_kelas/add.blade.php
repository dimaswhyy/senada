@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola / Kelola Kelas /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Siswa Kelas</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <input name="id_unit" class="form-control" id="id_unit" value="{{ auth()->user()->id_unit }}" readonly hidden>
                        <input name="id_unit_account" class="form-control" id="id_unit_account" value="{{ auth()->user()->id }}" readonly hidden>

                        <div class="form-group mb-3">
                            <label for="id_siswa">Siswa</label>
                            <select name="id_siswa" class="form-control" id="id_siswa">
                                <option>- Pilih -</option>
                                @foreach ($getSiswa as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('id_siswa')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_kelas">Kelas</label>
                            <select name="id_kelas" class="form-control" id="id_kelas">
                                <option>- Pilih -</option>
                                @foreach ($getMapping as $item)
                                <option value="{{$item->id}}">{{$item->kelas}}</option>
                                @endforeach
                            </select>
                            @error('id_kelas')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <a href="{{route('kelas.index')}}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
