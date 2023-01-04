@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Data Siswa
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
            <h5>Data Siswa</h5>
            <form action="{{route('siswa.import')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control mb-2">
                <button class="btn btn-sm btn-info mb-3" class="form-control">Import</button>
            </form>
            <a href="{{route('siswa.create')}}" class="btn btn-sm btn-primary">Tambah</a>
            <a href="{{route('siswa.export')}}">
                <button class="btn btn-sm btn-success">Export</button>
            </a>


        </div>
        <div class="card-datatable table">
            <div class="card-datatable table-responsive text-nowrap">
                <table class="dt-scrollableTable table data-table-siswa">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
