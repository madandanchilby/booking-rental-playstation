<?php

namespace App\Livewire\Pages\Admin\Booking;

use App\Models\Booking;
use App\Models\Computer;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class WalkinBookingCreate extends Component
{
    public string $computer_id = '';
    public string $duration = '1';
    public string $customer_name = '';
    public string $customer_phone = '';

    public function mount(): void
    {
        $user = getAuthUser();
        $permissions = $user->getPermissionsViaRoles();

        if (!$permissions->contains('name', 'create-walkin-booking')) {
            abort(403);
        }
    }

    /**
     * Get the current time and calculated end time.
     */
    public function getTimePreview(): array
    {
        $now = Carbon::now();
        $start = $now->copy();
        $end = $start->copy()->addHours((int) $this->duration);

        return [
            'start' => $start->format('H:i'),
            'end' => $end->format('H:i'),
            'start_full' => $start->format('d-m-Y H:i'),
            'end_full' => $end->format('d-m-Y H:i'),
            'date' => $now->format('d-m-Y'),
        ];
    }

    /**
     * Get estimated total price.
     */
    public function getTotalPrice(): int
    {
        if (blank($this->computer_id)) {
            return 0;
        }

        $computer = Computer::find($this->computer_id);
        if (!$computer) {
            return 0;
        }

        return (int) $this->duration * (int) $computer->booking_price_per_hour;
    }

    /**
     * Check if selected computer is available right now for the chosen duration.
     */
    public function getAvailabilityStatus(): string
    {
        if (blank($this->computer_id)) {
            return 'no_computer';
        }

        $now = Carbon::now();
        $end = $now->copy()->addHours((int) $this->duration);

        $hasConflict = Booking::query()
            ->active()
            ->where('computer_id', $this->computer_id)
            ->where('booking_start_date', '<', $end->format('Y-m-d H:i:s'))
            ->where('booking_end_date', '>', $now->format('Y-m-d H:i:s'))
            ->exists();

        return $hasConflict ? 'unavailable' : 'available';
    }

    /**
     * Create the walk-in booking.
     */
    public function createWalkinBooking(): void
    {
        $validator = Validator::make([
            'computer_id' => $this->computer_id,
            'duration' => $this->duration,
            'customer_name' => $this->customer_name,
            'customer_phone' => $this->customer_phone,
        ], [
            'computer_id' => 'required|string|exists:computers,id',
            'duration' => 'required|integer|min:1|max:8',
            'customer_name' => 'required|string|min:2|max:100',
            'customer_phone' => 'required|string|min:8|max:20',
        ], [
            'computer_id.required' => 'Silakan pilih PlayStation.',
            'computer_id.exists' => 'PlayStation tidak ditemukan.',
            'duration.required' => 'Silakan pilih durasi.',
            'duration.min' => 'Durasi minimal 1 jam.',
            'duration.max' => 'Durasi maksimal 8 jam.',
            'customer_name.required' => 'Nama pelanggan wajib diisi.',
            'customer_name.min' => 'Nama pelanggan minimal 2 karakter.',
            'customer_phone.required' => 'Nomor telepon wajib diisi.',
            'customer_phone.min' => 'Nomor telepon minimal 8 digit.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $now = Carbon::now();
        $start = $now->copy();
        $end = $start->copy()->addHours((int) $this->duration);

        // Check conflict
        $hasConflict = Booking::query()
            ->active()
            ->where('computer_id', $this->computer_id)
            ->where('booking_start_date', '<', $end->format('Y-m-d H:i:s'))
            ->where('booking_end_date', '>', $start->format('Y-m-d H:i:s'))
            ->exists();

        if ($hasConflict) {
            $conflictValidator = Validator::make(
                ['computer_id' => null],
                ['computer_id' => 'required'],
                ['computer_id.required' => 'PlayStation ini sedang digunakan pada waktu tersebut. Silakan pilih PlayStation lain.']
            );
            throw new ValidationException($conflictValidator);
        }

        $computer = Computer::findOrFail($this->computer_id);
        $totalFee = (int) $this->duration * (int) $computer->booking_price_per_hour;

        DB::transaction(function () use ($start, $end, $computer, $totalFee) {
            Booking::create([
                'booking_type' => 'walk_in',
                'status' => 'confirmed',
                'customer_id' => null,
                'computer_id' => $computer->id,
                'booking_start_date' => $start->format('Y-m-d H:i:s'),
                'booking_end_date' => $end->format('Y-m-d H:i:s'),
                'booking_hour' => (int) $this->duration,
                'total_booking_fee' => $totalFee,
                'payment_status' => 'paid',
                'payment_type' => 'cash',
                'paid_at' => $start,
                'customer_name_walkin' => $this->customer_name,
                'customer_phone_walkin' => $this->customer_phone,
            ]);
        });

        session()->flash('success', 'Booking walk-in berhasil dibuat untuk ' . $this->customer_name . '!');
        $this->redirectRoute('admin.history');
    }

    public function render()
    {
        return view('livewire.pages.admin.booking.walkin-booking-create', [
            'computers' => Computer::query()->orderBy('computer_number')->get(),
            'time_preview' => $this->getTimePreview(),
            'total_price' => $this->getTotalPrice(),
            'availability' => $this->getAvailabilityStatus(),
        ]);
    }
}
