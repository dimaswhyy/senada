@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard/ Transaksi / Jenis Transaksi /</span> Ubah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Ubah Jenis Transaksi</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('jenistransaksi.update', $jenises->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <input name="id_unit" class="form-control" id="id_unit" value="{{ old('id_unit', $jenises->id_unit) }}" readonly hidden>
                        <input name="id_unit_account" class="form-control" id="id_unit_account" value="{{ old('id_unit_account', $jenises->id_unit_account) }}" readonly hidden>

                        <div class="form-group mb-3">
                            <label for="id_rombel">Rombongan Belajar</label>
                            <select name="id_rombel" class="form-control" id="id_rombel">
                                @foreach ($getRombel as $item)
                                <option value="{{$item->id}}" {{$jenises->id_rombel == $item->id ? 'selected':''}}>{{$item->rombongan_belajar}}</option>
                                @endforeach
                            </select>
                            @error('id_rombel')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenis_transaksi">Jenis Transaksi</label>
                            <input name="jenis_transaksi" class="form-control" id="jenis_transaksi"
                                placeholder="Masukkan Jenis Transaksi" value="{{ old('jenis_transaksi', $jenises->jenis_transaksi) }}">
                            @error('jenis_transaksi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="biaya_transaksi">Biaya Transaksi</label>
                            <input name="biaya_transaksi" class="form-control" id="biaya_transaksi"
                                placeholder="Masukkan Biaya Transaksi" value="{{ old('biaya_transaksi', $jenises->biaya_transaksi) }}">
                            @error('biaya_transaksi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Ubah & Simpan</button>
                        <a href="{{route('jenistransaksi.index')}}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
