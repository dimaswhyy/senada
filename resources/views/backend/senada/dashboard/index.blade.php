@extends('backend.master')
@section('content')
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Beraktifitas Sekolah Hebat! 🎉</h5>
                            <p class="mb-4">
                                Assalamu'alaikum Wr. Wb.
                                @if (auth()->user()->jenis_kelamin == 'Laki-laki')
                                    <span>Ustadz</span>
                                @else
                                    <span>Ustadzah</span>
                                @endif
                                <span class="fw-bold">{{ auth()->user()->name }}</span> anda memiiki
                                akses sebagai
                                @if (auth()->user()->role_id == 1)
                                    <span class="fw-bold">Yayasan</span>
                                @elseif(auth()->user()->role_id == 2)
                                    <span class="fw-bold">Tata Usaha</span>
                                @elseif(auth()->user()->role_id == 3)
                                    <span class="fw-bold">Keuangan</span>
                                @elseif(auth()->user()->role_id == 4)
                                    <span class="fw-bold">Perpustakaan</span>
                                @elseif(auth()->user()->role_id == 5)
                                    <span class="fw-bold">Guru</span>
                                @else
                                    <span class="fw-bold">Siswa</span>
                                @endif
                                pada
                                @foreach ($getUnit as $item)
                                    @if (auth()->user()->id_unit == $item->id)
                                        <span class="fw-bold">{{ $item->nama_sekolah }} - </span>
                                    @else
                                        <span></span>
                                    @endif
                                    @if (auth()->user()->id_unit == $item->id)
                                        <span class="fw-bold">{{ $item->daerah_sekolah }}</span>
                                    @else
                                        <span></span>
                                    @endif
                                @endforeach
                                .<br>Semoga Allah SWT mudahkan dan lancarkan segala
                                urusan kita. <br><i>Aamiin Allahumma Aamiin</i>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            @if (auth()->user()->jenis_kelamin == 'Laki-laki')
                                <img src="{{ asset('assets/backend/img/illustrations/man.png') }}" height="140"
                                    alt="View Badge User Man">
                            @else
                                <img src="{{ asset('assets/backend/img/illustrations/woman.png') }}" height="140"
                                    alt="View Badge User Woman">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 md-4 order-0">
            <div class="row">
                <div class="col-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/backend/img/icons/unicons/chart-success.png') }}"
                                        alt="chart success" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Penerimaan Hari Ini</span>
                            <h6 class="card-title mb-2">Rp 12.500.000</h6>
                        </div>
                    </div>
                </div>

                <div class="col-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/backend/img/icons/unicons/wallet-info.png') }}"
                                        alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Pengeluaran Hari Ini</span>
                            <h6 class="card-title mb-2">Rp 12.500.000</h6>
                        </div>
                    </div>
                </div>

                <div class="col-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/backend/img/icons/unicons/paypal.png') }}" alt="Credit Card"
                                        class="rounded" />
                                </div>
                            </div>
                            <span class="d-block mb-1">Total Keuangan</span>
                            <h6 class="card-title mb-2">Rp 12.500.000</h6>
                        </div>
                    </div>
                </div>

                <div class="col-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/backend/img/icons/unicons/cc-primary.png') }}"
                                        alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Transaksi Hari Ini</span>
                            <h6 class="card-title mb-2">Rp 12.500.000</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 md-4 col-lg-4 order-1">
            <div class="row">
                <div class="col-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/backend/img/icons/unicons/cc-warning.png') }}"
                                        alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Tagihan Bulanan</span>
                            <h6 class="card-title mb-2">Rp 12.500.000</h6>
                        </div>
                    </div>
                </div>

                <div class="col-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/backend/img/icons/unicons/cc-warning.png') }}"
                                        alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Tagihan Sekolah</span>
                            <h6 class="card-title mb-2">Rp 12.500.000</h6>
                        </div>
                    </div>
                </div>

                <div class="col-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/backend/img/icons/unicons/wallet-info.png') }}"
                                        alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Total Pembayaran</span>
                            <h6 class="card-title mb-2">Rp 20.000.000</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
