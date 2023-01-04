@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Profil Sekolah
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
            <h5>Profil Sekolah</h5>

            <div class="alert alert-danger" role="alert">
                <i class='bx bx-bell me-1'></i> Perhatian ! <br><br>
                  1. Jika data sekolah belum muncul pada tabel, silahkan menambah data. NOTE : Cukup Sekali Menambahkan Data <br>
                  2. Jika sudah, maka mohon lengkapi data sekolah dengan mengklik toggle <i class="bx bx-dots-vertical-rounded"></i> pada Tab "AKSI"
            </div>
            <a href="{{route('profilsekolah.create')}}" class="btn btn-sm btn-primary">Tambah Data Sekolah</a>

        </div>
        <div class="card-datatable table">
            <div class="card-datatable table-responsive text-nowrap">
                <table class="dt-scrollableTable table data-table-profil-sekolah">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sekolah</th>
                            <th>Daerah</th>
                            <th>NPSN</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
