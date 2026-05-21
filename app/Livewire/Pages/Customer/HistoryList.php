<?php

namespace App\Livewire\Pages\Customer;

use App\Models\Booking;
use App\Models\Customer;
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

            Booking::where('midtrans_order_id', $selectedBooking->midtrans_order_id)
                ->where('customer_id', $selectedBooking->customer_id)
                ->update(['status' => 'cancelled']);

            Booking::where('midtrans_order_id', $selectedBooking->midtrans_order_id)
                ->where('customer_id', $selectedBooking->customer_id)
                ->delete();
        });

        $this->redirectRoute('customer.history');
    } catch (Exception $ex) {
        throw $ex;
    }
}

    public function render()
{
    $user = getAuthUser();
    $customer = Customer::where('user_id', '=', $user->id)->first();
    $now = Carbon::now();

    $current_bookings = Booking::with('computer')
        ->whereNull('deleted_at')
        ->where('customer_id', '=', $customer->id)
        ->whereNotIn('status', ['cancelled', 'rescheduled'])
        ->where('booking_end_date', '>', $now)
        ->orderBy('booking_start_date', 'desc')
        ->get()
        ->groupBy('midtrans_order_id')
        ->map(function ($items) {
            $first = $items->sortBy('booking_start_date')->first();
            $last = $items->sortBy('booking_end_date')->last();

            $first->booking_start_date = $items->min('booking_start_date');
            $first->booking_end_date = $items->max('booking_end_date');
            $first->booking_hour = $items->sum('booking_hour');
            $first->total_booking_fee = $items->sum('total_booking_fee');

            return $first;
        });

    $completed_bookings = Booking::with('computer')
        ->whereNull('deleted_at')
        ->where('customer_id', '=', $customer->id)
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

    return view('livewire.pages.customer.history-list', [
        'current_bookings' => $current_bookings,
        'completed_bookings' => $completed_bookings,
    ]);
}}