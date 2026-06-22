<?php

namespace App\Livewire\Pages\Admin\Booking;

use App\Models\Booking;
use App\Models\Computer;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AdminBookingCreate extends Component
{
    public Computer $computer;

    public string $customer_name = '';

    public string $customer_phone = '';

    public string $booking_date = '';

    public array $booking_times = [];

    public function mount(Computer $computer): void
    {
        $this->computer = $computer;
        $this->booking_date = now()->format('Y-m-d');
    }

    public function updatedBookingDate(): void
    {
        $this->resetInvalidSelectedSlots();
    }

    private function resetInvalidSelectedSlots(): void
    {
        if (blank($this->booking_times)) {
            return;
        }

        $availableSlots = $this->getTimeSlots()
            ->where('is_available', true)
            ->pluck('value')
            ->all();

        $this->booking_times = collect($this->booking_times)
            ->filter(fn (string $slot) => in_array($slot, $availableSlots, true))
            ->unique()
            ->sort()
            ->values()
            ->all();
    }

    public function toggleTimeSlot(string $time): void
    {
        $selectedSlots = collect($this->booking_times);

        if ($selectedSlots->contains($time)) {
            $this->booking_times = $selectedSlots
                ->reject(fn (string $slot) => $slot === $time)
                ->values()
                ->all();

            return;
        }

        $selectedSlots->push($time);

        $this->booking_times = $selectedSlots
            ->unique()
            ->sort()
            ->values()
            ->all();
    }

    public function getTimeSlots(): Collection
    {
        if (blank($this->booking_date)) {
            return collect();
        }

        $selectedDate = Carbon::parse($this->booking_date)->startOfDay();
        $now = Carbon::now();
        $minimumTime = $now->copy()->addHours(2);

        $bookings = Booking::query()
            ->active()
            ->where('computer_id', $this->computer->id)
            ->whereDate('booking_start_date', $selectedDate->toDateString())
            ->get(['booking_start_date', 'booking_end_date']);

        return collect(range(0, 23))->map(function (int $hour) use ($selectedDate, $bookings, $minimumTime) {
            $start = $selectedDate->copy()->setTime($hour, 0, 0);
            $end = $start->copy()->addHour();

            $isBooked = $bookings->contains(function ($booking) use ($start, $end) {
                return Carbon::parse($booking->booking_start_date)->lt($end)
                    && Carbon::parse($booking->booking_end_date)->gt($start);
            });

            $isTooSoon = $start->lt($minimumTime);

            return [
                'value' => $start->format('H:i'),
                'label' => $start->format('H.i') . ' - ' . $end->format('H.i'),
                'is_available' => !$isBooked && !$isTooSoon,
                'is_booked' => $isBooked,
                'is_too_soon' => $isTooSoon && !$isBooked,
            ];
        });
    }

    public function getSelectedSlotLabels(): Collection
    {
        return $this->getTimeSlots()
            ->whereIn('value', $this->booking_times)
            ->sortBy('value')
            ->pluck('label')
            ->values();
    }

    public function getTotalPrice(): int
    {
        return count($this->booking_times) * (int) $this->computer->booking_price_per_hour;
    }

    private function validateMinimumBookingTime(): void
    {
        $now = Carbon::now();
        $minimumTime = $now->copy()->addHours(2);

        foreach ($this->booking_times as $time) {
            [$hour] = explode(':', $time);
            $slotStart = Carbon::parse($this->booking_date)->setTime((int) $hour, 0, 0);

            if ($slotStart->lt($minimumTime)) {
                $failValidator = Validator::make(
                    ['booking_times' => null],
                    ['booking_times' => 'required'],
                    ['booking_times.required' => 'Timeslot ' . $time . ' tidak dapat dipilih. Booking minimal 2 jam sebelum waktu timeslot dimulai.']
                );

                throw new ValidationException($failValidator);
            }
        }
    }

    public function booking(): void
    {
            $validator = Validator::make([
            'customer_name' => $this->customer_name,
            'customer_phone' => $this->customer_phone,
            'booking_date' => $this->booking_date,
            'booking_times' => $this->booking_times,
            ], [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'booking_date' => 'required|date',
            'booking_times' => 'required|array|min:1',
            'booking_times.*' => 'required|string',
            ], [
            'customer_name.required' => 'Silakan isi nama customer terlebih dahulu.',
            'booking_date.required' => 'Silakan pilih tanggal booking.',
            'booking_times.required' => 'Silakan pilih minimal 1 timeslot.',
            'booking_times.min' => 'Silakan pilih minimal 1 timeslot.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $this->validateMinimumBookingTime();


        $selectedTimes = collect($this->booking_times)
            ->unique()
            ->sort()
            ->values();

        $orderId = 'ADMIN-BOOK-' . strtoupper(Str::random(8)) . '-' . time();

        DB::transaction(function () use ($selectedTimes, $orderId) {
            foreach ($selectedTimes as $bookingTime) {
                [$hour] = explode(':', $bookingTime);
                $start = Carbon::parse($this->booking_date)->setTime((int) $hour, 0, 0);
                $end = $start->copy()->addHour();

                $hasConflict = Booking::query()
                    ->active()
                    ->where('computer_id', $this->computer->id)
                    ->where('booking_start_date', '<', $end->format('Y-m-d H:i:s'))
                    ->where('booking_end_date', '>', $start->format('Y-m-d H:i:s'))
                    ->exists();

                if ($hasConflict) {
                    $conflictValidator = Validator::make([
                        'booking_times' => null,
                    ], [
                        'booking_times' => 'required',
                    ], [
                        'booking_times.required' => 'Salah satu timeslot yang dipilih sudah dibooking. Silakan pilih slot lain.',
                    ]);

                    throw new ValidationException($conflictValidator);
                }

                Booking::create([
                    'booking_type' => 'online',
                    'status' => 'confirmed',
                    'customer_id' => null,
                    'customer_name_walkin' => $this->customer_name,
                    'customer_phone_walkin' => $this->customer_phone,
                    'computer_id' => $this->computer->id,
                    'booking_start_date' => $start->format('Y-m-d H:i:s'),
                    'booking_end_date' => $end->format('Y-m-d H:i:s'),
                    'booking_hour' => 1,
                    'total_booking_fee' => (int) $this->computer->booking_price_per_hour,
                    'midtrans_order_id' => $orderId,
                    'payment_status' => 'paid',
                ]);
            }
        });

        session()->flash('success', 'Booking customer berhasil dibuat oleh admin.');

        $this->redirectRoute('admin.booking.customer');
    }

    public function render()
    {
        return view('livewire.pages.admin.booking.admin-booking-create', [
            'time_slots' => $this->getTimeSlots(),
            'selected_slot_labels' => $this->getSelectedSlotLabels(),
            'total_price' => $this->getTotalPrice(),
        ]);
    }
}