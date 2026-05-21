@php
    $minDate = now()->format('Y-m-d');
    $selectedDuration = count($this->new_booking_times ?? []);
@endphp

@section('title', 'Reschedule Booking')

<div>
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Original Booking Info --}}
            <div class="card mb-3 border-warning">
                <div class="card-header bg-warning bg-opacity-10">
                    <h6 class="mb-0"><i class="bx bx-info-circle me-1"></i> Booking Asal yang Akan Di-Reschedule</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <small class="text-muted">PlayStation</small>
                            <div class="fw-semibold">{{ $booking->computer->computer_number }}</div>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <small class="text-muted">Waktu Asal</small>
                            <div class="fw-semibold">{{ $booking->booking_start_date->format('d-m-Y H:i') }} - {{ $booking->booking_end_date->format('H:i') }}</div>
                        </div>
                        <div class="col-sm-2 mb-2">
                            <small class="text-muted">Durasi</small>
                            <div class="fw-semibold">{{ $booking->booking_hour }} jam</div>
                        </div>
                        <div class="col-sm-2 mb-2">
                            <small class="text-muted">Biaya</small>
                            <div class="fw-semibold">Rp. {{ number_format($booking->total_booking_fee, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-sm-2 mb-2">
                            <small class="text-muted">Status Bayar</small>
                            <div>
                                @if ($booking->payment_status === 'paid')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning">{{ ucfirst($booking->payment_status) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Reschedule Form --}}
            <form wire:submit="rescheduleBooking">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-calendar-edit me-1"></i> Pilih Jadwal Baru</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="new_computer_id" class="form-label">PlayStation</label>
                                <select wire:model.live="new_computer_id" class="form-select" id="new_computer_id">
                                    <option value="">Pilih PlayStation</option>
                                    @foreach ($computers as $computer)
                                        <option value="{{ $computer->id }}">
                                            Komputer {{ $computer->computer_number }}
                                            (Rp. {{ number_format($computer->booking_price_per_hour, 0, ',', '.') }}/jam)
                                        </option>
                                    @endforeach
                                </select>
                                @error('new_computer_id')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="new_booking_date" class="form-label">Tanggal Baru</label>
                                <input wire:model.live="new_booking_date" class="form-control" type="date"
                                    id="new_booking_date" min="{{ $minDate }}" />
                                @error('new_booking_date')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Selection Summary --}}
                            <div class="col-12">
                                <div class="w-100 rounded border p-3 bg-light">
                                    <div class="fw-semibold mb-1">Jadwal Baru Dipilih</div>
                                    <div class="small text-muted mb-2">
                                        Dipilih: {{ $selectedDuration }} / {{ $max_slots }} timeslot
                                        @if ($total_price > 0)
                                            &bull; Total: <strong>Rp. {{ number_format($total_price, 0, ',', '.') }}</strong>
                                        @endif
                                    </div>

                                    @if ($selected_slot_labels->isNotEmpty())
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($selected_slot_labels as $slotLabel)
                                                <span class="badge bg-primary">{{ $slotLabel }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-muted small">Belum memilih timeslot baru.</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h6 class="mb-0">Pilih Timeslot Pengganti</h6>
                            <span class="badge bg-dark">Maks. {{ $max_slots }} timeslot</span>
                        </div>
                        <small class="text-muted d-block mb-3">
                            @if ($max_slots === 1)
                                Pilih <strong>1 timeslot</strong> pengganti untuk menggantikan jadwal asal. Booking minimal <strong>2 jam sebelum</strong> waktu timeslot dimulai.
                            @else
                                Pilih tepat <strong>{{ $max_slots }} timeslot</strong> pengganti sesuai durasi booking asal. Booking minimal <strong>2 jam sebelum</strong> waktu timeslot dimulai.
                            @endif
                        </small>

                        {{-- Legend --}}
                        <div class="d-flex flex-wrap gap-3 mb-3">
                            <small><span class="badge bg-primary">&nbsp;&nbsp;</span> Dipilih</small>
                            <small><span class="badge bg-outline-primary border border-primary">&nbsp;&nbsp;</span> Tersedia</small>
                            <small><span class="badge bg-secondary">&nbsp;&nbsp;</span> Sudah dibooking</small>
                            <small><span class="badge bg-warning">&nbsp;&nbsp;</span> Kurang dari 2 jam</small>
                        </div>

                        <div class="row g-2">
                            @forelse ($time_slots as $slot)
                                @php
                                    $isSelected = in_array($slot['value'], $this->new_booking_times, true);
                                    $isTooSoon = $slot['is_too_soon'] ?? false;
                                    $isBooked = $slot['is_booked'] ?? false;
                                    $isLocked = $slot['is_locked'] ?? false;

                                    if ($isSelected) {
                                        $btnClass = 'btn-primary';
                                    } elseif ($slot['is_available']) {
                                        $btnClass = 'btn-outline-primary';
                                    } elseif ($isLocked) {
                                        $btnClass = 'btn-outline-secondary disabled';
                                    } elseif ($isTooSoon) {
                                        $btnClass = 'btn-outline-warning disabled';
                                    } else {
                                        $btnClass = 'btn-outline-secondary disabled';
                                    }
                                @endphp
                                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                                    <button type="button"
                                        class="btn w-100 border px-3 py-3 {{ $btnClass }}"
                                        wire:click="toggleTimeSlot('{{ $slot['value'] }}')"
                                        @disabled(!$slot['is_available'] && !$isSelected)
                                        @if ($isTooSoon) title="Tidak bisa booking, kurang dari 2 jam dari sekarang" @endif
                                        @if ($isLocked) title="Batas maksimal {{ $max_slots }} timeslot sudah tercapai" @endif>
                                        <span class="fw-semibold d-block text-center">{{ $slot['label'] }}</span>
                                        @if ($isTooSoon)
                                            <small class="d-block text-center" style="font-size: 0.65rem;">< 2 jam</small>
                                        @endif
                                    </button>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info mb-0">
                                        Pilih PlayStation dan tanggal untuk melihat timeslot yang tersedia.
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        @error('new_booking_times')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <a href="{{ route('customer.history') }}" class="btn btn-outline-secondary">
                            <i class="bx bx-arrow-back me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-warning" @disabled($selectedDuration !== $max_slots)>
                            <i class="bx bx-calendar-edit me-1"></i> Konfirmasi Reschedule
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
