@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Profil Yayasan /</span> Ubah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Ubah Profil Yayasan</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('profilyayasan.update', $profilyayasans->id) }}"
                        method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <img src="{{ Storage::url('public/logo_yayasan/') . $profilyayasans->logo_yayasan }}"
                                class="rounded" style="width: 150px">
                        </div>
                        <div class="form-group mb-3">
                            <label>Logo Yayasan</label>
                            <div class="input-group col-xs-12">
                                <input type="file" class="form-control @error('logo_yayasan') is-invalid @enderror"
                                    name="logo_yayasan">
                                @error('logo_yayasan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama_yayasan">Nama Yayasan</label>
                            <input name="nama_yayasan" class="form-control" id="nama_yayasan"
                                value="{{ old('nama_yayasan', $profilyayasans->nama_yayasan) }}"
                                placeholder="Masukkan Nama Yayasan">
                            @error('nama_yayasan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat_yayasan">Alamat Yayasan</label>
                            <input name="alamat_yayasan" class="form-control" id="alamat_yayasan"
                                value="{{ old('alamat_yayasan', $profilyayasans->alamat_yayasan) }}"
                                placeholder="Masukkan Alamat Yayasan">
                            @error('alamat_yayasan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="telepon_yayasan">Telepon Yayasan</label>
                            <input name="telepon_yayasan" class="form-control" id="telepon_yayasan"
                                value="{{ old('telepon_yayasan', $profilyayasans->telepon_yayasan) }}"
                                placeholder="Masukkan Telepon Yayasan">
                            @error('telepon_yayasan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="hp_yayasan">Hp Yayasan</label>
                            <input name="hp_yayasan" class="form-control" id="hp_yayasan"
                                value="{{ old('hp_yayasan', $profilyayasans->hp_yayasan) }}"
                                placeholder="Masukkan Hp Yayasan">
                            @error('hp_yayasan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email_yayasan">Email Yayasan</label>
                            <input name="email_yayasan" class="form-control" id="email_yayasan"
                                value="{{ old('email_yayasan', $profilyayasans->email_yayasan) }}"
                                placeholder="Masukkan email Yayasan">
                            @error('email_yayasan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="instagram_yayasan">Instagram Yayasan</label>
                            <input name="instagram_yayasan" class="form-control" id="instagram_yayasan"
                                value="{{ old('instagram_yayasan', $profilyayasans->instagram_yayasan) }}"
                                placeholder="Masukkan instagram Yayasan">
                            @error('instagram_yayasan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="facebook_yayasan">Facebook Yayasan</label>
                            <input name="facebook_yayasan" class="form-control" id="facebook_yayasan"
                                value="{{ old('facebook_yayasan', $profilyayasans->facebook_yayasan) }}"
                                placeholder="Masukkan Facebook Yayasan">
                            @error('facebook_yayasan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="youtube_yayasan">Youtube Yayasan</label>
                            <input name="youtube_yayasan" class="form-control" id="youtube_yayasan"
                                value="{{ old('youtube_yayasan', $profilyayasans->youtube_yayasan) }}"
                                placeholder="Masukkan Youtube Yayasan">
                            @error('youtube_yayasan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="sejarah_yayasan">Sejarah Yayasan</label>
                            <textarea name="sejarah_yayasan" class="form-control" id="sejarah" rows="4">{{ old('sejarah_yayasan', $profilyayasans->sejarah_yayasan) }}</textarea>
                            @error('sejarah_yayasan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="visi_yayasan">Visi Yayasan</label>
                            <textarea name="visi_yayasan" class="form-control" id="visi" rows="4">{{ old('visi_yayasan', $profilyayasans->visi_yayasan) }}</textarea>
                            @error('visi_yayasan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="misi_yayasan">Misi Yayasan</label>
                            <textarea name="misi_yayasan" class="form-control" id="misi" rows="4">{{ old('misi_yayasan', $profilyayasans->misi_yayasan) }}</textarea>
                            @error('misi_yayasan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Ubah & Simpan</button>
                        <a href="{{ route('profilyayasan.index') }}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
