@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola / Mapping Kelas / Rombongan Belajar /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Rombongan Belajar</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('rombel.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <input name="id_unit" class="form-control" id="id_unit" value="{{ auth()->user()->id_unit }}" readonly hidden>
                        <input name="id_unit_account" class="form-control" id="id_unit_account" value="{{ auth()->user()->id }}" readonly hidden>

                        <div class="form-group mb-3">
                            <label for="rombongan_belajar">Rombongan Belajar</label>
                            <input name="rombongan_belajar" class="form-control" id="rombongan_belajar"
                                placeholder="Masukkan Rombongan Belajar">
                            @error('rombongan_belajar')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <a href="{{route('rombel.index')}}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
