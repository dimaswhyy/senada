@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Profil Sekolah /</span> Lengkapi
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Lengkapi Profil</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('profilsekolah.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <input name="id_unit_account" class="form-control" id="id_unit_account" value="{{ auth()->user()->id }}" readonly hidden>
                        <input name="id_unit" class="form-control" id="id_unit" value="{{ auth()->user()->id_unit }}" readonly hidden>

                        <div class="form-group mb-3">
                            <label for="nis">Nomor Induk Sekolah</label>
                            <input name="nis" class="form-control" id="nis"
                                placeholder="Masukkan Nomor Induk Sekolah">
                            @error('nis')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="npsn">NPSN</label>
                            <input name="npsn" class="form-control" id="npsn"
                                placeholder="Masukkan NPSN">
                            @error('npsn')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nss">Nomor Statistik Sekolah</label>
                            <input name="nss" class="form-control" id="nss"
                                placeholder="Masukkan Nomor Statistik Sekolah">
                            @error('nss')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="telepon_sekolah">Telepon</label>
                            <input name="telepon_sekolah" class="form-control" id="telepon_sekolah"
                                placeholder="Masukkan Telepon Sekolah">
                            @error('telepon_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="hp_sekolah">Seluler</label>
                            <input name="hp_sekolah" class="form-control" id="hp_sekolah"
                                placeholder="Masukkan Seluler Sekolah">
                            @error('hp_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email_sekolah">Email</label>
                            <input name="email_sekolah" class="form-control" id="email_sekolah"
                                placeholder="Masukkan Seluler Sekolah">
                            @error('email_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="instagram_sekolah">Instagram</label>
                            <input name="instagram_sekolah" class="form-control" id="instagram_sekolah"
                                placeholder="Masukkan Instagram Sekolah">
                            @error('instagram_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="facebook_sekolah">Facebook</label>
                            <input name="facebook_sekolah" class="form-control" id="facebook_sekolah"
                                placeholder="Masukkan Facebook Sekolah">
                            @error('facebook_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="youtube_sekolah">Youtube</label>
                            <input name="youtube_sekolah" class="form-control" id="youtube_sekolah"
                                placeholder="Masukkan Youtube Sekolah">
                            @error('youtube_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="website_sekolah">Website</label>
                            <input name="website_sekolah" class="form-control" id="website_sekolah"
                                placeholder="Masukkan Website Sekolah">
                            @error('website_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="visi_sekolah">Visi</label>
                            <textarea name="visi_sekolah" class="form-control" id="visi" rows="4"></textarea>
                            @error('visi_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="misi_sekolah">Misi</label>
                            <textarea name="misi_sekolah" class="form-control" id="misi" rows="4"></textarea>
                            @error('misi_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <a href="{{route('profilsekolah.index')}}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
