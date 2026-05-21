@section('title', 'Pembayaran Booking')

<div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            {{-- Payment Status: PAID --}}
            @if ($paymentStatus === 'paid')
                <div class="card border-success">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="bx bx-check-circle text-success" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="text-success mb-2">Pembayaran Berhasil!</h4>
                        <p class="text-muted mb-4">Booking Anda telah dikonfirmasi dan siap digunakan.</p>

                        <div class="bg-light rounded p-3 mb-4 text-start">
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <small class="text-muted">ID Booking</small>
                                    <div class="fw-semibold">{{ $bookingId }}</div>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <small class="text-muted">PlayStation</small>
                                    <div class="fw-semibold">{{ $computerNumber }}</div>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <small class="text-muted">Total Dibayar</small>
                                    <div class="fw-semibold">Rp. {{ number_format($totalFee, 0, ',', '.') }}</div>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <small class="text-muted">Status</small>
                                    <div><span class="badge bg-success">Lunas</span></div>
                                </div>
                            </div>

                            @if (!empty($bookingSlots))
                                <hr>
                                <small class="text-muted">Jadwal Booking</small>
                                <div class="d-flex flex-wrap gap-2 mt-1">
                                    @foreach ($bookingSlots as $slot)
                                        <span class="badge bg-primary">{{ $slot }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <a href="{{ route('customer.booking.invoice', ['order_id' => $order_id]) }}" class="btn btn-primary">
                            <i class="bx bx-receipt me-1"></i> Lihat Invoice
                        </a>
                        <a href="{{ route('customer.history') }}" class="btn btn-outline-primary ms-2">
                            <i class="bx bx-history me-1"></i> Lihat Riwayat Booking
                        </a>
                        <a href="{{ route('customer.booking') }}" class="btn btn-outline-primary ms-2">
                            <i class="bx bx-home me-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>

            {{-- Payment Status: FAILED --}}
            @elseif ($paymentStatus === 'failed')
                <div class="card border-danger">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="bx bx-x-circle text-danger" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="text-danger mb-2">Pembayaran Gagal</h4>
                        <p class="text-muted mb-4">Pembayaran tidak berhasil diproses. Silakan coba lagi.</p>

                        <a href="{{ route('customer.booking') }}" class="btn btn-primary">
                            <i class="bx bx-refresh me-1"></i> Booking Ulang
                        </a>
                    </div>
                </div>

            {{-- Payment Status: EXPIRED --}}
            @elseif ($paymentStatus === 'expired')
                <div class="card border-warning">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="bx bx-time-five text-warning" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="text-warning mb-2">Pembayaran Kedaluwarsa</h4>
                        <p class="text-muted mb-4">Batas waktu pembayaran telah habis. Silakan buat booking baru.</p>

                        <a href="{{ route('customer.booking') }}" class="btn btn-primary">
                            <i class="bx bx-refresh me-1"></i> Booking Ulang
                        </a>
                    </div>
                </div>

            {{-- Payment Status: PENDING --}}
            @else
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Pembayaran Booking</h5>
                        <span class="badge bg-warning">Menunggu Pembayaran</span>
                    </div>
                    <div class="card-body">
                        {{-- Order Summary --}}
                        <div class="bg-light rounded p-3 mb-4">
                            <h6 class="mb-3">Ringkasan Pesanan</h6>
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <small class="text-muted">Order ID</small>
                                    <div class="fw-semibold">{{ $order_id }}</div>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <small class="text-muted">PlayStation</small>
                                    <div class="fw-semibold">{{ $computerNumber }}</div>
                                </div>
                            </div>

                            @if (!empty($bookingSlots))
                                <div class="mb-2">
                                    <small class="text-muted">Jadwal Booking</small>
                                    <div class="d-flex flex-wrap gap-2 mt-1">
                                        @foreach ($bookingSlots as $slot)
                                            <span class="badge bg-primary">{{ $slot }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>Total Pembayaran</strong>
                                <strong class="text-primary" style="font-size: 1.25rem;">Rp. {{ number_format($totalFee, 0, ',', '.') }}</strong>
                            </div>
                        </div>

                        {{-- Payment Method Info --}}
                        <div class="alert alert-info">
                            <i class="bx bx-info-circle me-1"></i>
                            <strong>Metode Pembayaran: Bank Transfer (Virtual Account)</strong>
                            <p class="mb-0 mt-1 small">
                                Klik tombol <strong>"Bayar Sekarang"</strong> untuk memilih bank dan mendapatkan nomor Virtual Account.
                                Setelah mendapatkan nomor VA, Anda dapat mensimulasikan pembayaran melalui
                                <a href="https://simulator.sandbox.midtrans.com/" target="_blank" class="fw-semibold">
                                    Midtrans Payment Simulator
                                </a>.
                            </p>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex flex-column flex-sm-row gap-2">
                            @if ($snapToken)
                                <button type="button" id="btn-pay" class="btn btn-primary btn-lg flex-grow-1"
                                    onclick="payWithSnap()">
                                    <i class="bx bx-credit-card me-1"></i> Bayar Sekarang
                                </button>
                            @else
                                <div class="alert alert-warning w-100 mb-0">
                                    <i class="bx bx-error me-1"></i>
                                    <strong>Snap token belum tersedia.</strong>
                                    Pastikan konfigurasi Midtrans (Server Key & Client Key) sudah benar di file <code>.env</code>.
                                    <hr>
                                    <small>
                                        Anda tetap bisa mensimulasikan pembayaran dengan mengklik tombol dibawah ini.
                                    </small>
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-sm btn-primary" wire:click="handlePaymentSuccess('{{ $order_id }}', 'SIMULATED-{{ $order_id }}', 'bank_transfer')">
                                            <i class="bx bx-check me-1"></i> Simulasi Pembayaran Berhasil
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <button type="button" class="btn btn-outline-secondary btn-lg" wire:click="checkPaymentStatus">
                                <i class="bx bx-refresh me-1"></i> Cek Status
                            </button>
                        </div>

                        <hr>

                        <div class="text-center">
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                wire:click="cancelBooking"
                                wire:confirm="Apakah Anda yakin ingin membatalkan booking ini?">
                                <i class="bx bx-x me-1"></i> Batalkan Booking
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@if ($paymentStatus === 'pending' && $snapToken)
    @push('pricing-script')
        <script src="{{ $snapJsUrl }}" data-client-key="{{ $clientKey }}"></script>
        <script>
            function payWithSnap() {
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        @this.call('handlePaymentSuccess', result.order_id, result.transaction_id, result.payment_type);
                    },
                    onPending: function(result) {
                        @this.call('handlePaymentPending', result.order_id);
                    },
                    onError: function(result) {
                        @this.call('handlePaymentError', result.order_id);
                    },
                    onClose: function() {
                        // User closed the popup without completing payment
                        console.log('Payment popup closed');
                    }
                });
            }
        </script>
    @endpush
@endif
