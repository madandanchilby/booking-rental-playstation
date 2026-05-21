@section('title', 'Booking Walk-in')

<div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form wire:submit="createWalkinBooking">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bx bx-walk me-1"></i> Booking Walk-in
                        </h5>
                        <span class="badge bg-info">Pelanggan Datang Langsung</span>
                    </div>

                    <div class="card-body">
                        {{-- Time Preview --}}
                        <div class="alert alert-primary mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bx bx-time-five me-2" style="font-size: 1.5rem;"></i>
                                <div>
                                    <strong>Waktu Mulai (otomatis)</strong>
                                    <div class="small">Sistem menggunakan waktu saat ini sebagai waktu mulai</div>
                                </div>
                            </div>
                            <div class="row mt-2" wire:poll.5s>
                                <div class="col-sm-4">
                                    <small class="text-primary-emphasis">Tanggal</small>
                                    <div class="fw-semibold">{{ $time_preview['date'] }}</div>
                                </div>
                                <div class="col-sm-4">
                                    <small class="text-primary-emphasis">Mulai</small>
                                    <div class="fw-semibold">{{ $time_preview['start'] }}</div>
                                </div>
                                <div class="col-sm-4">
                                    <small class="text-primary-emphasis">Selesai (estimasi)</small>
                                    <div class="fw-semibold">{{ $time_preview['end'] }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            {{-- Customer Name --}}
                            <div class="col-md-6">
                                <label for="customer_name" class="form-label">Nama Pelanggan <span class="text-danger">*</span></label>
                                <input wire:model="customer_name" type="text" class="form-control" id="customer_name"
                                    placeholder="Masukkan nama pelanggan">
                                @error('customer_name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Customer Phone --}}
                            <div class="col-md-6">
                                <label for="customer_phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                <input wire:model="customer_phone" type="text" class="form-control" id="customer_phone"
                                    placeholder="08xxxxxxxxxx">
                                @error('customer_phone')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Computer --}}
                            <div class="col-md-6">
                                <label for="computer_id" class="form-label">Pilih PlayStation <span class="text-danger">*</span></label>
                                <select wire:model.live="computer_id" class="form-select" id="computer_id">
                                    <option value="">-- Pilih PlayStation --</option>
                                    @foreach ($computers as $computer)
                                        <option value="{{ $computer->id }}">
                                            Komputer {{ $computer->computer_number }}
                                            (Rp. {{ number_format($computer->booking_price_per_hour, 0, ',', '.') }}/jam)
                                        </option>
                                    @endforeach
                                </select>
                                @error('computer_id')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror

                                {{-- Availability indicator --}}
                                @if ($availability === 'available')
                                    <div class="mt-2">
                                        <span class="badge bg-success"><i class="bx bx-check me-1"></i> Tersedia</span>
                                    </div>
                                @elseif ($availability === 'unavailable')
                                    <div class="mt-2">
                                        <span class="badge bg-danger"><i class="bx bx-x me-1"></i> Sedang digunakan</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Duration --}}
                            <div class="col-md-6">
                                <label for="duration" class="form-label">Durasi <span class="text-danger">*</span></label>
                                <select wire:model.live="duration" class="form-select" id="duration">
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}">{{ $i }} jam</option>
                                    @endfor
                                </select>
                                @error('duration')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Summary --}}
                        @if ($total_price > 0)
                            <hr class="my-4">
                            <div class="bg-light rounded p-3">
                                <h6 class="mb-2">Ringkasan</h6>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <small class="text-muted">Waktu</small>
                                        <div class="fw-semibold">{{ $time_preview['start_full'] }} - {{ $time_preview['end_full'] }}</div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <small class="text-muted">Durasi</small>
                                        <div class="fw-semibold">{{ $duration }} jam</div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <small class="text-muted">Pembayaran</small>
                                        <div><span class="badge bg-info">Bayar di Kasir</span></div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>Total Biaya</strong>
                                    <strong class="text-primary" style="font-size: 1.25rem;">
                                        Rp. {{ number_format($total_price, 0, ',', '.') }}
                                    </strong>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.history') }}" class="btn btn-outline-secondary">
                            <i class="bx bx-arrow-back me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary"
                            @disabled($availability !== 'available' || blank($customer_name) || blank($customer_phone))>
                            <i class="bx bx-check me-1"></i> Buat Booking Walk-in
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
