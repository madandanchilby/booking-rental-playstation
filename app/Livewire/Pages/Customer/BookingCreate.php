<?php

namespace App\Livewire\Pages\Customer;

use App\Livewire\Forms\BookingForm;
use App\Models\Booking;
use App\Models\Computer;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class BookingCreate extends Component
{
    public BookingForm $form;
    public Computer $computer;

    public function mount(): void
    {
        $user = getAuthUser();
        $permissions = $user->getPermissionsViaRoles();

        if (!$permissions->contains('name', 'create-booking-computer')) {
            abort(403);
        }

        $this->form->booking_date = now()->format('Y-m-d');
        $this->form->computer_id = $this->computer->id;
    }

    public function toggleTimeSlot(string $time): void
    {
        $selectedSlots = collect($this->form->booking_times);

        if ($selectedSlots->contains($time)) {
            $this->form->booking_times = $selectedSlots
                ->reject(fn (string $slot) => $slot === $time)
                ->values()
                ->all();

            return;
        }

        $selectedSlots->push($time);

        $this->form->booking_times = $selectedSlots
            ->unique()
            ->sort()
            ->values()
            ->all();
    }

    public function updatedFormComputerId(): void
    {
        $this->resetInvalidSelectedSlots();
    }

    public function updatedFormBookingDate(): void
    {
        $this->resetInvalidSelectedSlots();
    }

    private function resetInvalidSelectedSlots(): void
    {
        if (blank($this->form->booking_times)) {
            return;
        }

        $availableSlots = $this->getTimeSlots()
            ->where('is_available', true)
            ->pluck('value')
            ->all();

        $this->form->booking_times = collect($this->form->booking_times)
            ->filter(fn (string $slot) => in_array($slot, $availableSlots, true))
            ->unique()
            ->sort()
            ->values()
            ->all();
    }

    public function getTimeSlots(): Collection
    {
        if (blank($this->form->computer_id) || blank($this->form->booking_date)) {
            return collect();
        }

        $selectedDate = Carbon::parse($this->form->booking_date)->startOfDay();
        $now = Carbon::now();
        $minimumTime = $now->copy()->addHours(2);

        $bookings = Booking::query()
            ->active()
            ->where('computer_id', $this->form->computer_id)
            ->whereDate('booking_start_date', $selectedDate->toDateString())
            ->get(['booking_start_date', 'booking_end_date']);

        return collect(range(0, 23))->map(function (int $hour) use ($selectedDate, $bookings, $minimumTime) {
            $start = $selectedDate->copy()->setTime($hour, 0, 0);
            $end = $start->copy()->addHour();

            $isBooked = $bookings->contains(function ($booking) use ($start, $end) {
                return Carbon::parse($booking->booking_start_date)->lt($end)
                    && Carbon::parse($booking->booking_end_date)->gt($start);
            });

            // Check if slot is at least 2 hours from now
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
            ->whereIn('value', $this->form->booking_times)
            ->sortBy('value')
            ->pluck('label')
            ->values();
    }

    public function getTotalPrice(): int
    {
        $computer = Computer::find($this->form->computer_id);
        if (!$computer) {
            return 0;
        }

        return count($this->form->booking_times) * (int) $computer->booking_price_per_hour;
    }

    public function booking()
    {
        try {
            $result = $this->form->booking();

            // Redirect to payment page with order ID
            $this->redirectRoute('customer.booking.payment', [
                'order_id' => $result['order_id'],
            ]);
        } catch (ValidationException $ex) {
            throw $ex;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function render()
    {
        return view('livewire.pages.customer.booking-create', [
            'available_computers' => Computer::query()->orderBy('computer_number')->get(),
            'time_slots' => $this->getTimeSlots(),
            'selected_slot_labels' => $this->getSelectedSlotLabels(),
            'total_price' => $this->getTotalPrice(),
        ]);
    }
}
