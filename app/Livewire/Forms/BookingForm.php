<?php

namespace App\Livewire\Forms;

use App\Models\Booking;
use App\Models\Computer;
use App\Models\Customer;
use App\Services\MidtransService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class BookingForm extends Form
{
    public string $computer_id = '';

    public string $booking_date = '';

    public array $booking_times = [];

    /**
     * Create booking with pending payment status and generate Midtrans Snap token.
     *
     * @return array{order_id: string, snap_token: string, booking_ids: array}
     */
    public function booking(): array
    {
        $validator = Validator::make([
            'computer_id' => $this->computer_id,
            'booking_date' => $this->booking_date,
            'booking_times' => $this->booking_times,
        ], [
            'computer_id' => 'required|string',
            'booking_date' => 'required|date',
            'booking_times' => 'required|array|min:1',
            'booking_times.*' => 'required|string',
        ], [
            'computer_id.required' => 'Silakan pilih PlayStation terlebih dahulu.',
            'booking_date.required' => 'Silakan pilih tanggal booking.',
            'booking_times.required' => 'Silakan pilih minimal 1 timeslot.',
            'booking_times.min' => 'Silakan pilih minimal 1 timeslot.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // Validate 2-hour minimum rule
        $this->validateMinimumBookingTime();

        $user = getAuthUser();
        $customer = Customer::where('user_id', '=', $user->id)->firstOrFail();
        $computer = Computer::findOrFail($this->computer_id);

        $selectedTimes = collect($this->booking_times)
            ->unique()
            ->sort()
            ->values();

        // Generate a unique order ID for Midtrans
        $orderId = 'BOOK-' . strtoupper(Str::random(8)) . '-' . time();
        $totalFee = $selectedTimes->count() * (int) $computer->booking_price_per_hour;

        $bookingIds = [];

        DB::transaction(function () use ($selectedTimes, $customer, $computer, $orderId, &$bookingIds) {
            foreach ($selectedTimes as $bookingTime) {
                [$hour] = explode(':', $bookingTime);
                $start = Carbon::parse($this->booking_date)->setTime((int) $hour, 0, 0);
                $end = $start->copy()->addHour();

                $hasConflict = Booking::query()
                    ->active()
                    ->where('computer_id', $this->computer_id)
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

                $booking = Booking::create([
                    'booking_type' => 'online',
                    'status' => 'pending',
                    'customer_id' => $customer->id,
                    'computer_id' => $this->computer_id,
                    'booking_start_date' => $start->format('Y-m-d H:i:s'),
                    'booking_end_date' => $end->format('Y-m-d H:i:s'),
                    'booking_hour' => 1,
                    'total_booking_fee' => (int) $computer->booking_price_per_hour,
                    'midtrans_order_id' => $orderId,
                    'payment_status' => 'pending',
                ]);

                $bookingIds[] = $booking->id;
            }
        });

        // Generate Midtrans Snap Token
        $midtransService = new MidtransService();

        $itemDetails = $selectedTimes->map(function (string $time) use ($computer) {
            return [
                'id' => $computer->id,
                'price' => (int) $computer->booking_price_per_hour,
                'quantity' => 1,
                'name' => 'PlayStation ' . $computer->computer_number . ' (' . $time . ')',
            ];
        })->values()->all();

        $params = $midtransService->buildTransactionParams(
            orderId: $orderId,
            grossAmount: $totalFee,
            customerName: $customer->name,
            customerEmail: $user->email,
            customerPhone: $customer->phone ?? '-',
            itemDetails: $itemDetails
        );

        $snapToken = $midtransService->createSnapToken($params);

        // Update bookings with snap token
        if ($snapToken) {
            Booking::where('midtrans_order_id', $orderId)->update([
                'snap_token' => $snapToken,
            ]);
        }

        return [
            'order_id' => $orderId,
            'snap_token' => $snapToken,
            'booking_ids' => $bookingIds,
            'total_fee' => $totalFee,
        ];
    }

    /**
     * Validate that all selected timeslots are at least 2 hours from now.
     */
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
}
