@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Laporan
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
            <h5>Laporan</h5>

            <a href="{{route('cetakForm')}}" class="btn btn-sm btn-primary">Buat Laporan</a>
            <a href="#" class="btn btn-sm btn-primary">Upload Laporan</a>

            <div class="card-datatable table">
                <div class="card-datatable table-responsive text-nowrap">
                    <table class="dt-scrollableTable table data-table-laporan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Jenis</th>
                                <th>Bulan</th>
                                {{-- <th>Tahun</th> --}}
                                <th>Ket.</th>
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endsection
