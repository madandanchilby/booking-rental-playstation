@section('title', 'Booking Customer')

<div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Booking Customer</h5>
            <small class="text-muted">
                Admin membuat booking terjadwal untuk customer.
            </small>
        </div>

        <div class="card-body">
            <div class="alert alert-info">
                <strong>PlayStation:</strong> {{ $computer->computer_number }}
                <br>
                <strong>Harga per Jam:</strong> Rp. {{ number_format($computer->booking_price_per_hour, 0, ',', '.') }}
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Nama Customer</label>
                    <input type="text"
                        class="form-control @error('customer_name') is-invalid @enderror"
                        wire:model.live="customer_name"
                        placeholder="Masukkan nama customer">

                    @error('customer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

        
             <div class="col-md-4">
                    <label class="form-label">No. HP Customer</label>
                    <input type="text"
                        class="form-control @error('customer_phone') is-invalid @enderror"
                        wire:model.live="customer_phone"
                        placeholder="Masukkan nomor HP">

                    @error('customer_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tanggal Booking</label>
                    <input type="date"
                        class="form-control @error('booking_date') is-invalid @enderror"
                        wire:model.live="booking_date">

                    @error('booking_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr>

            <div class="mb-3">
                <h6 class="mb-1">Pilih Timeslot</h6>
                <small class="text-muted">
                    Admin dapat memilih satu atau beberapa timeslot yang tersedia.
                </small>
            </div>

            @error('booking_times')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="row g-2">
                @forelse ($time_slots as $slot)
                    @php
                        $isAvailable = $slot['is_available'] ?? false;
                        $isSelected = in_array($slot['value'], $booking_times ?? [], true) && $isAvailable;
                        $isTooSoon = $slot['is_too_soon'] ?? false;
                        $isBooked = $slot['is_booked'] ?? false;

                         if ($isSelected) {
                                $btnClass = 'btn-primary';
                            } elseif ($slot['is_available']) {
                                $btnClass = 'btn-outline-primary';
                            } elseif ($isTooSoon) {
                                $btnClass = 'btn-outline-warning disabled';
                            } else {
                                $btnClass = 'btn-outline-secondary';
                            }
                    @endphp

                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <button type="button"
                                class="btn w-100 border px-3 py-3 {{ $btnClass }}"
                                @if ($isAvailable)
                                    wire:click="toggleTimeSlot('{{ $slot['value'] }}')"
                                @else
                                    onclick="alert('Slot ini tidak tersedia. Silakan pilih jadwal lain.'); return false;"
                                @endif>
                            <span class="fw-semibold d-block text-center">
                                {{ $slot['label'] }}
                            </span>

                            @if ($isTooSoon)
                                <small class="d-block text-center text-warning fw-bold" style="font-size: 0.65rem;">
                                    &lt; 2 jam
                                </small>
                            @elseif ($isBooked)
                                <small class="d-block text-center" style="font-size: 0.65rem;">
                                    Sudah dibooking
                                </small>
                            @endif
                        </button>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info mb-0">
                            Pilih tanggal terlebih dahulu untuk melihat timeslot.
                        </div>
                    </div>
                @endforelse
            </div>

            <hr>

            <div class="bg-light rounded p-3 mb-3">
                <h6>Ringkasan Booking</h6>

                <div class="mb-2">
                    <small class="text-muted">Timeslot Dipilih</small>
                    <div class="d-flex flex-wrap gap-2 mt-1">
                        @forelse ($selected_slot_labels as $label)
                            <span class="badge bg-primary">{{ $label }}</span>
                        @empty
                            <span class="text-muted">Belum ada timeslot dipilih.</span>
                        @endforelse
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <strong>Total Harga</strong>
                    <strong class="text-primary">
                        Rp. {{ number_format($total_price, 0, ',', '.') }}
                    </strong>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="button"
                        class="btn btn-primary"
                        wire:click="booking"
                        wire:loading.attr="disabled">
                    <i class="bx bx-save me-1"></i>
                    Simpan Booking
                </button>

                <a href="{{ route('admin.booking.customer') }}" class="btn btn-outline-secondary">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>