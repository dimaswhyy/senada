@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola / Kelola Kelas /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Transaksi</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('pembayaran.store') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <input name="id_unit" class="form-control" id="id_unit" value="{{ auth()->user()->id_unit }}"
                            readonly hidden>
                        <input name="id_unit_account" class="form-control" id="id_unit_account"
                            value="{{ auth()->user()->id }}" readonly hidden>

                        <div class="form-group mb-3">
                            <label for="id_rombel">Rombongan Belajar</label>
                            <select name="id_rombel" class="form-control" id="id_rombel">
                                <option>- Pilih Rombongan Belajar -</option>
                                @foreach ($getRombel as $item)
                                    <option value="{{ $item->id }}">{{ $item->rombongan_belajar }}</option>
                                @endforeach
                            </select>
                            @error('id_kelas')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_kelas">Kelas</label>
                            <select name="id_kelas" class="form-control" id="pilihan_kelas">
                                <option>- Pilih Kelas -</option>
                                @foreach ($getKelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                                @endforeach
                            </select>
                            @error('id_kelas')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_siswa">Siswa</label>
                            <select name="id_siswa" class="form-control" id="pilihan_siswa">
                            </select>
                            @error('id_siswa')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_transaksi">Tanggal Transaksi</label>
                            <input name="tanggal_transaksi" class="form-control" type="date" value="1999-11-17"
                                id="tanggal_transaksi" />
                            @error('tanggal_transaksi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="no_transaksi">Nomor Transaksi</label>
                            <input name="no_transaksi" class="form-control" id="no_transaksi" readonly>
                        </div>

                        {{-- Repeater Form --}}
                        <hr class="my-5">
                        <div class="row">
                            <div class="form-group reapeat-pay-table">
                                <table class="table table-bordered table-responsive repeat-form-pay">
                                    <thead>
                                        <tr>
                                            <th>Jenis Transaksi</th>
                                            <th>Bulan</th>
                                            <th>Biaya</th>
                                            <th><a href="javascript:void(0)" class="btn btn-sm btn-success addRow">+</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group mb-3">
                                                    <label for="jenis_transaksi">Jenis Transaksi</label>
                                                    <select name="jenis_transaksi" class="form-control"
                                                        id="jenis_transaksi">
                                                        <option>- Pilih Jenis Transaksi -</option>
                                                        @foreach ($getJenis as $item)
                                                            <option>{{ $item->jenis_transaksi }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('jenis_transaksi')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-3">
                                                    <label for="transaksi_bulan">Transaksi Bulan</label>
                                                    <select name="transaksi_bulan" class="form-control" id="transaksi_bulan">
                                                        <option>- Pilih Bulan -</option>
                                                        <option value="1">Januari</option>
                                                        <option value="2">Februari</option>
                                                        <option value="3">Maret</option>
                                                        <option value="4">April</option>
                                                        <option value="5">Mei</option>
                                                        <option value="6">Juni</option>
                                                        <option value="7">Juli</option>
                                                        <option value="8">Agustus</option>
                                                        <option value="9">September</option>
                                                        <option value="10">Oktober</option>
                                                        <option value="11">November</option>
                                                        <option value="12">Desember</option>
                                                    </select>
                                                    @error('transaksi_bulan')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td><input name="biaya" class="form-control" id="biaya" readonly></td>
                                            <th><a href="javascript:void(0)" class="btn btn-sm btn-danger deleteRow">-</a></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="my-5">
                        {{-- End Repeat Pay Form --}}

                        <div class="form-group mb-3">
                            <label for="total">Total</label>
                            <input name="total" class="form-control" id="total" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan</label>
                            <select name="keterangan" class="form-control" id="keterangan">
                                <option>- Pilih -</option>
                                <option>Lunas</option>
                                <option>Belum Lunas</option>
                            </select>
                            @error('keterangan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Upload Bukti Transfer</label>
                            <div class="input-group col-xs-12">
                                <input type="file" class="form-control @error('bukti_transfer') is-invalid @enderror"
                                    name="bukti_transfer">
                                @error('bukti_transfer')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <a href="{{ route('kelas.index') }}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
