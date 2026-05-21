@php
    $minDate = now()->format('Y-m-d');
    $selectedDuration = count($this->form->booking_times ?? []);
@endphp

@section('title', 'Booking PlayStation')

<div>
    <form wire:submit="booking">
        <div class="card">
            <h5 class="card-header">Booking PlayStation</h5>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="computer_id" class="form-label">PlayStation</label>
                        <select wire:model.live="form.computer_id" name="form.computer_id" id="computer_id"
                            class="form-select">
                            <option value="">Pilih PlayStation</option>
                            @foreach ($available_computers as $computer)
                                <option value="{{ $computer->id }}">Komputer {{ $computer->computer_number }}</option>
                            @endforeach
                        </select>
                        @error('form.computer_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="booking_date" class="col-form-label">Tanggal Booking</label>
                        <input wire:model.live="form.booking_date" class="form-control" type="date" id="booking_date"
                            min="{{ $minDate }}" value="{{ $minDate }}" />
                        @error('form.booking_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="w-100 rounded border p-3 bg-light">
                            <div class="fw-semibold mb-1">Pilihan Anda</div>
                            <div class="small text-muted mb-2">
                                Durasi terpilih: {{ $selectedDuration }} jam
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
                                <span class="text-muted small">Belum memilih timeslot.</span>
                            @endif
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <h6 class="mb-1">Pilih Timeslot</h6>
                        <small class="text-muted">
                            Anda bisa memilih 1, 2, atau beberapa timeslot sekaligus. Booking minimal <strong>2 jam sebelum</strong> waktu timeslot dimulai.
                        </small>
                    </div>
                </div>

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
                            $isSelected = in_array($slot['value'], $this->form->booking_times, true);
                            $isTooSoon = $slot['is_too_soon'] ?? false;
                            $isBooked = $slot['is_booked'] ?? false;

                            if ($isSelected) {
                                $btnClass = 'btn-primary';
                            } elseif ($slot['is_available']) {
                                $btnClass = 'btn-outline-primary';
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
                                @disabled(!$slot['is_available'])
                                @if ($isTooSoon) title="Tidak bisa booking, kurang dari 2 jam dari sekarang" @endif>
                                <span class="fw-semibold d-block text-center">{{ $slot['label'] }}</span>
                                @if ($isTooSoon)
                                    <small class="d-block text-center" style="font-size: 0.65rem;">< 2 jam</small>
                                @endif
                            </button>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info mb-0">
                                Pilih PlayStation dan tanggal terlebih dahulu untuk melihat timeslot yang tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>

                @error('form.booking_times')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
                @error('form.booking_times.*')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="card-footer d-flex justify-content-between align-items-center">
                <div>
                    @if ($total_price > 0)
                        <span class="fw-semibold">Total Pembayaran: Rp. {{ number_format($total_price, 0, ',', '.') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary" @disabled($selectedDuration === 0)>
                    <i class="bx bx-credit-card me-1"></i> Lanjut ke Pembayaran
                </button>
            </div>
        </div>
    </form>
</div>
