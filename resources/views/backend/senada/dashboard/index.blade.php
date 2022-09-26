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
                                You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                                your profile.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/backend/img/illustrations/woman.png') }}" height="140"
                                alt="View Badge User">
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
