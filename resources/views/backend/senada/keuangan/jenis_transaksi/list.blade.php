@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Transaksi /</span> Jenis Transaksi
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
            <h5>Jenis Transaksi</h5>

            <a href="{{route('jenistransaksi.create')}}" class="btn btn-sm btn-primary">Tambah</a>

            <div class="card-datatable table">
                <div class="card-datatable table-responsive text-nowrap">
                    <table class="dt-scrollableTable table data-table-jenis-transaksi">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Rombel</th>
                                <th>Nama Transaksi</th>
                                <th>Biaya</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endsection
