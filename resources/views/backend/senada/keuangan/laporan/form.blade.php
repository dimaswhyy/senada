@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Laporan /</span> Cetak Laporan
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Cetak Laporan</h5>
                <div class="card-body">
                    <form class="forms-sample" action="" method="GET" enctype="multipart/form-data">

                        <div class="form-group mb-3">
                            <label for="jenisPrint">Jenis Transaksi</label>
                            <select name="jenisPrint" class="form-control" id="jenisPrint">
                                <option>- Pilih -</option>
                                <option>Pilih Semua</option>
                                @foreach ($getJenis as $item)
                                <option>{{$item->jenis_transaksi}}</option>
                                @endforeach
                            </select>
                            @error('jenisPrint')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_awal">Tanggal Awal</label>
                            <input name="tanggal_awal" class="form-control" type="date" value="1999-11-17"
                                id="tanggal_awal" />
                            @error('tanggal_awal')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                            <input name="tanggal_akhir" class="form-control" type="date" value="1999-11-17"
                                id="tanggal_akhir" />
                            @error('tanggal_akhir')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Cetak Sekarang</button>
                        <a href="{{route('laporan.index')}}" class="btn btn-light">Nanti</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
