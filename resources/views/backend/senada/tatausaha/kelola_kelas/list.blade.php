@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Mapping Kelas /</span> Kelola Kelas
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
            <h5>Kelola Kelas</h5>

            <a href="{{route('kelas.create')}}" class="btn btn-sm btn-primary">Tambah Siswa</a>
            <a href="{{route('mapping.index')}}" class="btn btn-sm btn-warning">Kembali ke Mapping</a>

            <div class="card-datatable table">
                <div class="card-datatable table-responsive text-nowrap">
                    <table class="dt-scrollableTable table data-table-kelola-kelas">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endsection
