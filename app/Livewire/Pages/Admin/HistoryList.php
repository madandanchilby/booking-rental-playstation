<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Booking;
use App\Models\History;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryList extends Component
{
    use WithPagination;

    public function mount()
    {
        $user = getAuthUser();
        $permissions = $user->getPermissionsViaRoles();

        if (
            !$permissions->contains('name', 'list-history-booking')
            && !$permissions->contains('name', 'cancel-booking-computer')
        ) {
            abort(403);
        }
    }

    public function cancel_booking($booking)
{
    try {
        DB::transaction(function () use ($booking) {

            $selectedBooking = Booking::findOrFail($booking['id']);

            // Jika walk-in / tidak punya midtrans_order_id, batalkan hanya booking itu
            if (empty($selectedBooking->midtrans_order_id)) {
                $selectedBooking->update(['status' => 'cancelled']);
                $selectedBooking->delete();
                return;
            }

            // Jika booking online, batalkan semua slot dalam transaksi yang sama
            Booking::where('midtrans_order_id', $selectedBooking->midtrans_order_id)
                ->where('customer_id', $selectedBooking->customer_id)
                ->update(['status' => 'cancelled']);

            Booking::where('midtrans_order_id', $selectedBooking->midtrans_order_id)
                ->where('customer_id', $selectedBooking->customer_id)
                ->delete();
        });

        $this->redirectRoute('admin.history');

    } catch (Exception $ex) {
        throw $ex;
    }
}

    public function render()
    {
        $now = Carbon::now();

        $current_bookings = Booking::with(['computer', 'customer'])
    ->whereNull('deleted_at')
    ->whereNotIn('status', ['cancelled', 'rescheduled'])
    ->where('booking_end_date', '>', $now)
    ->orderBy('booking_start_date', 'desc')
    ->get()
    ->groupBy(function ($booking) {
    return $booking->midtrans_order_id
        ?: 'walkin-' . $booking->id;
    })
    ->map(function ($items) {
        $first = $items->sortBy('booking_start_date')->first();

        $first->booking_start_date = $items->min('booking_start_date');
        $first->booking_end_date = $items->max('booking_end_date');
        $first->booking_hour = $items->sum('booking_hour');
        $first->total_booking_fee = $items->sum('total_booking_fee');

        return $first;
    });

$completed_bookings = Booking::with(['computer', 'customer'])
    ->whereNull('deleted_at')
    ->whereNotIn('status', ['cancelled', 'rescheduled'])
    ->where('booking_end_date', '<=', $now)
    ->orderBy('booking_start_date', 'desc')
    ->get()
    ->groupBy('midtrans_order_id')
    ->map(function ($items) {
        $first = $items->sortBy('booking_start_date')->first();

        $first->booking_start_date = $items->min('booking_start_date');
        $first->booking_end_date = $items->max('booking_end_date');
        $first->booking_hour = $items->sum('booking_hour');
        $first->total_booking_fee = $items->sum('total_booking_fee');

        return $first;
    });

return view('livewire.pages.admin.history-list', [
    'current_bookings' => $current_bookings,
    'completed_bookings' => $completed_bookings,
]);
    }
}
