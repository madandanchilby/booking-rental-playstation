@section('title', 'Detail Invoice')

<div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card" id="invoice-card">
                {{-- Invoice Header --}}
                <div class="card-header text-center pb-2">
                    <h4 class="mb-1">Detail Invoice</h4>
                    <small class="text-muted">Tunjukkan invoice ini kepada operator saat tiba di lokasi.</small>
                </div>

                <div class="card-body">
                    {{-- Invoice Number & ID Booking --}}
                    <div class="bg-light rounded p-3 mb-4">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <small class="text-muted">Nomor Invoice</small>
                                <div class="fw-semibold">{{ $invoiceNumber }}</div>
                            </div>
                            <div class="col-sm-6 mb-2">
                            <small class="text-muted">ID Booking</small>
                            <div class="fw-semibold">{{ $bookingId }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- Customer Info --}}
                    <h6 class="mb-3"><i class="bx bx-user me-1"></i> Informasi Pelanggan</h6>
                    <div class="row mb-4">
                        <div class="col-sm-4 mb-2">
                            <small class="text-muted">Nama</small>
                            <div class="fw-semibold">{{ $customerName }}</div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <small class="text-muted">Telepon</small>
                            <div class="fw-semibold">{{ $customerPhone }}</div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <small class="text-muted">Email</small>
                            <div class="fw-semibold">{{ $customerEmail }}</div>
                        </div>
                    </div>

                    <hr>

                    {{-- Payment Info --}}
                    <h6 class="mb-3"><i class="bx bx-credit-card me-1"></i> Informasi Pembayaran</h6>
                    <div class="row mb-4">
                        <div class="col-sm-4 mb-2">
                            <small class="text-muted">Tanggal Pembayaran</small>
                            <div class="fw-semibold">{{ $paymentDate }}</div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <small class="text-muted">Metode Pembayaran</small>
                            <div class="fw-semibold">{{ $paymentMethod }}</div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <small class="text-muted">Status Pembayaran</small>
                            <div>
                                @if ($paymentStatus === 'paid')
                                    <span class="badge bg-success">LUNAS</span>
                                @else
                                    <span class="badge bg-warning">{{ strtoupper($paymentStatus) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Booking Detail --}}
                    <h6 class="mb-3"><i class="bx bx-calendar me-1"></i> Detail Booking</h6>
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-2">
                            <small class="text-muted">PlayStation</small>
                            <div class="fw-semibold">{{ $playstationName }}</div>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <small class="text-muted">Durasi</small>
                            <div class="fw-semibold">{{ $totalDuration }} jam</div>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <small class="text-muted">Status Booking</small>
                            <div>
                                @if ($bookingStatus === 'done')
                                    <span class="badge bg-info">DONE</span>
                                @elseif ($bookingStatus === 'confirmed')
                                    <span class="badge bg-success">DIKONFIRMASI</span>
                                @else
                                    <span class="badge bg-secondary">{{ strtoupper($bookingStatus) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Timeslots --}}
                    <div class="mb-3">
                        <small class="text-muted d-block mb-2">Jadwal Booking:</small>
                        @foreach ($bookingSlots as $slot)
                            <div class="d-flex align-items-center mb-1">
                                <i class="bx bx-time-five text-primary me-2"></i>
                                <span>{{ $slot['label'] }}</span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pricing --}}
                    <div class="bg-light rounded p-3 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Harga per Jam</span>
                            <span>Rp. {{ number_format($pricePerHour, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Durasi</span>
                            <span>{{ $totalDuration }} jam</span>
                        </div>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between">
                            <strong>Total Dibayar</strong>
                            <strong class="text-primary" style="font-size: 1.25rem;">Rp. {{ number_format($totalPaid, 0, ',', '.') }}</strong>
                        </div>
                    </div>

                    {{-- Verification Code --}}
                    <div class="text-center mb-3">
                        <small class="text-muted d-block mb-1">Kode Verifikasi</small>
                        <span class="d-inline-block px-4 py-2 rounded fw-bold"
                              style="font-size: 1.5rem; letter-spacing: 4px; background-color: #f0f0f0; border: 2px dashed #ccc;">
                            {{ $verificationCode }}
                        </span>
                        <div class="text-muted mt-1" style="font-size: 0.75rem;">
                            Tunjukkan kode ini kepada operator untuk verifikasi booking Anda.
                        </div>
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="card-footer d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                    <a href="{{ route('customer.history') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back me-1"></i> Kembali
                    </a>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-primary" onclick="window.print()">
                            <i class="bx bx-printer me-1"></i> Print Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('pricing-script')
<style>
    @media print {
        body * { visibility: hidden; }
        #invoice-card, #invoice-card * { visibility: visible; }
        #invoice-card { position: absolute; left: 0; top: 0; width: 100%; }
        .card-footer { display: none !important; }
        .layout-menu, .layout-navbar, .content-footer { display: none !important; }
    }
</style>
@endpush
