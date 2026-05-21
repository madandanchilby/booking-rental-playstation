<?php

namespace App\Livewire\Pages\Customer;

use App\Models\Booking;
use App\Models\Computer;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Livewire\Component;

class BookingList extends Component
{
    public Collection $computers;

    public function mount()
    {
        $user = getAuthUser();
        $permissions = $user->getPermissionsViaRoles();

        if (!$permissions->contains('name', 'list-computer')) {
            abort(403);
        }

        $this->computers = Computer::with([
            'bookings' => function ($query) {
                $query->active()
                    ->where('booking_end_date', '>', now())
                    ->orderBy('booking_start_date', 'asc');
            }
        ])->orderBy('computer_number')->get();
    }

    /**
     * Get availability info for a single computer.
     *
     * Returns:
     *   status    => 'available' | 'in_use' | 'booked_soon'
     *   label     => human-readable Indonesian string
     *   current   => the booking currently in session (or null)
     *   upcoming  => collection of upcoming bookings today (max 3)
     */
    public function getAvailability(Computer $computer): array
    {
        $now = Carbon::now();
        $todayEnd = $now->copy()->endOfDay();

        // Future bookings only (not yet ended)
        $futureBookings = $computer->bookings
            ->where('booking_end_date', '>', $now)
            ->sortBy('booking_start_date');

        // Is the computer IN USE right now?
        $currentBooking = $futureBookings->first(function ($b) use ($now) {
            return Carbon::parse($b->booking_start_date)->lte($now)
                && Carbon::parse($b->booking_end_date)->gt($now);
        });

        // Next upcoming bookings today (that haven't started yet)
        $upcomingToday = $futureBookings->filter(function ($b) use ($now, $todayEnd) {
            $start = Carbon::parse($b->booking_start_date);
            return $start->gt($now) && $start->lte($todayEnd);
        })->take(3);

        if ($currentBooking) {
            return [
                'status' => 'in_use',
                'label' => 'Sedang digunakan sampai ' . Carbon::parse($currentBooking->booking_end_date)->format('H:i'),
                'current' => $currentBooking,
                'upcoming' => $upcomingToday,
            ];
        }

        if ($upcomingToday->isNotEmpty()) {
            $next = $upcomingToday->first();
            return [
                'status' => 'booked_soon',
                'label' => 'Tersedia sekarang — booking berikutnya ' . Carbon::parse($next->booking_start_date)->format('H:i'),
                'current' => null,
                'upcoming' => $upcomingToday,
            ];
        }

        return [
            'status' => 'available',
            'label' => 'Tersedia sekarang',
            'current' => null,
            'upcoming' => collect(),
        ];
    }

    public function render()
    {
        return view('livewire.pages.customer.booking-list');
    }
}
