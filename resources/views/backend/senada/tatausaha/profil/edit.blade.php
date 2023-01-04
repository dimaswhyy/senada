@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Profil Sekolah /</span> Ubah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Ubah Profil Sekolah</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('profilsekolah.update', $profilsekolahs->id) }}"
                        method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')


                        <input name="id_unit_account" class="form-control" id="id_unit_account" value="{{ auth()->user()->id }}" readonly hidden>
                        <input name="id_unit" class="form-control" id="id_unit" value="{{ auth()->user()->id_unit }}" readonly hidden>

                        <div class="form-group mb-3">
                            <label for="nis">Nomor Induk Sekolah</label>
                            <input name="nis" class="form-control" id="nis"
                                value="{{ old('nis', $profilsekolahs->nis) }}"
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
                                value="{{ old('npsn', $profilsekolahs->npsn) }}"
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
                                value="{{ old('nss', $profilsekolahs->nss) }}"
                                placeholder="Masukkan Nama Yayasan">
                            @error('nss')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="telepon_sekolah">Nomor Telepon</label>
                            <input name="telepon_sekolah" class="form-control" id="telepon_sekolah"
                                value="{{ old('telepon_sekolah', $profilsekolahs->telepon_sekolah) }}"
                                placeholder="Masukkan Nomor Telepon">
                            @error('telepon_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="hp_sekolah">Seluler</label>
                            <input name="hp_sekolah" class="form-control" id="hp_sekolah"
                                value="{{ old('hp_sekolah', $profilsekolahs->hp_sekolah) }}"
                                placeholder="Masukkan Seluler Sekolah">
                            @error('hp_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email_sekolah">Email Sekolah</label>
                            <input name="email_sekolah" class="form-control" id="email_sekolah"
                                value="{{ old('email_sekolah', $profilsekolahs->email_sekolah) }}"
                                placeholder="Masukkan email Sekolah">
                            @error('email_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="instagram_sekolah">Instagram Sekolah</label>
                            <input name="instagram_sekolah" class="form-control" id="instagram_sekolah"
                                value="{{ old('instagram_sekolah', $profilsekolahs->instagram_sekolah) }}"
                                placeholder="Masukkan instagram Sekolah">
                            @error('instagram_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="facebook_sekolah">Facebook Sekolah</label>
                            <input name="facebook_sekolah" class="form-control" id="facebook_sekolah"
                                value="{{ old('facebook_sekolah', $profilsekolahs->facebook_sekolah) }}"
                                placeholder="Masukkan Facebook Sekolah">
                            @error('facebook_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="youtube_sekolah">Youtube Sekolah</label>
                            <input name="youtube_sekolah" class="form-control" id="youtube_sekolah"
                                value="{{ old('youtube_sekolah', $profilsekolahs->youtube_sekolah) }}"
                                placeholder="Masukkan Youtube Sekolah">
                            @error('youtube_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="website_sekolah">Website Sekolah</label>
                            <input name="website_sekolah" class="form-control" id="website_sekolah"
                                value="{{ old('website_sekolah', $profilsekolahs->website_sekolah) }}"
                                placeholder="Masukkan Wbsite Sekolah">
                            @error('website_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="visi_sekolah">Visi Sekolah</label>
                            <textarea name="visi_sekolah" class="form-control" id="visi" rows="4">{{ old('visi_sekolah', $profilsekolahs->visi_sekolah) }}</textarea>
                            @error('visi_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="misi_sekolah">Misi Sekolah</label>
                            <textarea name="misi_sekolah" class="form-control" id="misi" rows="4">{{ old('misi_sekolah', $profilsekolahs->misi_sekolah) }}</textarea>
                            @error('misi_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Ubah & Simpan</button>
                        <a href="{{ route('profilsekolah.index') }}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
