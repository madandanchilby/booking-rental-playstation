<?php

namespace App\Livewire\Pages\Admin\Booking;

use App\Models\Booking;
use App\Models\Computer;
use Carbon\Carbon;
use Livewire\Component;

class AdminBookingList extends Component
{
    public function getAvailability(Computer $computer): array
    {
        $now = Carbon::now();

        $currentBooking = Booking::query()
            ->active()
            ->where('computer_id', $computer->id)
            ->where('booking_start_date', '<=', $now->format('Y-m-d H:i:s'))
            ->where('booking_end_date', '>', $now->format('Y-m-d H:i:s'))
            ->orderBy('booking_end_date')
            ->first();

        if ($currentBooking) {
            return [
                'status' => 'in_use',
                'badge' => 'DIGUNAKAN',
                'badge_class' => 'bg-danger',
                'label' => 'Sedang digunakan sampai ' . Carbon::parse($currentBooking->booking_end_date)->format('H:i'),
                'alert_class' => 'alert-danger',
            ];
        }

        $nextBooking = Booking::query()
            ->active()
            ->where('computer_id', $computer->id)
            ->where('booking_start_date', '>', $now->format('Y-m-d H:i:s'))
            ->whereDate('booking_start_date', $now->toDateString())
            ->orderBy('booking_start_date')
            ->first();

        if ($nextBooking) {
            return [
                'status' => 'available',
                'badge' => 'TERSEDIA',
                'badge_class' => 'bg-success',
                'label' => 'Tersedia sekarang — booking berikutnya pukul ' . Carbon::parse($nextBooking->booking_start_date)->format('H:i'),
                'alert_class' => 'alert-success',
            ];
        }

        return [
            'status' => 'available',
            'badge' => 'TERSEDIA',
            'badge_class' => 'bg-success',
            'label' => 'Tersedia sekarang',
            'alert_class' => 'alert-success',
        ];
    }

    public function render()
    {
        return view('livewire.pages.admin.booking.admin-booking-list', [
            'computers' => Computer::query()
                ->orderBy('computer_number')
                ->get(),
        ]);
    }
}