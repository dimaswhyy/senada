@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola / Mapping Kelas /</span> Rombongan Belajar
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
            <h5>Rombongan Belajar</h5>

            <a href="{{ route('rombel.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            <a href="{{ route('mapping.index') }}" class="btn btn-sm btn-warning">Kembali ke Mapping</a>

            <div class="card-datatable table">
                <div class="card-datatable table-responsive text-nowrap">
                    <table class="dt-scrollableTable table data-table-rombongan-belajar">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Rombongan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endsection
