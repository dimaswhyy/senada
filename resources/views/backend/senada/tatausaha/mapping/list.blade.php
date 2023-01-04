@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Mapping Kelas
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
                <h5>Mapping Kelas</h5>

                <div class="alert alert-danger" role="alert">
                    <i class='bx bx-bell me-1'></i> Perhatian ! <br><br>
                    1. Buatlah Rombongan Belajar terlebih dahulu<br>
                    2. Kemudian, buatlah kelas dan dilengkapi dengan wali kelasnya<br>
                    3. Jika sudah membuat kelas, lakukan kelola kelas untuk memasukkan siswa ke dalam kelas
                </div>
                <a href="{{ route('rombel.index') }}" class="btn btn-sm btn-primary">Tambah Rombongan Belajar</a>
                <a href="{{ route('mapping.create') }}" class="btn btn-sm btn-info">Tambah Kelas</a>
                <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-success">Kelola Kelas</a>
            <div class="card-datatable table">
                <div class="card-datatable table-responsive text-nowrap">
                    <table class="dt-scrollableTable table data-table-mapping">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Rombel</th>
                                <th>Kelas</th>
                                <th>Wali Kelas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endsection
