<?php

namespace App\Livewire\Pages\Customer;

use App\Models\Booking;
use App\Models\Customer;
use App\Services\MidtransService;
use Livewire\Component;

class BookingPayment extends Component
{
    public string $order_id;
    public string $bookingId = '';
    public string $snapToken = '';
    public string $clientKey = '';
    public string $snapJsUrl = '';
    public int $totalFee = 0;
    public string $paymentStatus = 'pending';
    public string $computerNumber = '';
    public array $bookingSlots = [];

    public function mount(string $order_id): void
    {

        $user = getAuthUser();
        $customer = Customer::where('user_id', '=', $user->id)->firstOrFail();

        // Find bookings for this order
        $bookings = Booking::where('midtrans_order_id', $order_id)
            ->where('customer_id', $customer->id)
            ->get();

        if ($bookings->isEmpty()) {
            abort(404, 'Booking tidak ditemukan.');
        }
        $firstBooking = $bookings->first();
        $this->bookingId = strtoupper(substr($firstBooking->id, 0, 8));

        $this->order_id = $order_id;
        $this->snapToken = $firstBooking->snap_token ?? '';
        $this->paymentStatus = $firstBooking->payment_status;
        $this->totalFee = $bookings->sum('total_booking_fee');
        $this->computerNumber = $firstBooking->computer->computer_number ?? '-';

        $this->bookingSlots = $bookings->map(function ($booking) {
            return $booking->booking_start_date->format('d-m-Y H:i') . ' - ' . $booking->booking_end_date->format('H:i');
        })->all();

        $midtransService = new MidtransService();
        $this->clientKey = $midtransService->getClientKey();
        $this->snapJsUrl = $midtransService->getSnapJsUrl();
    }

    /**
     * Called from JS after Midtrans Snap returns success.
     */
    public function handlePaymentSuccess(string $orderId, string $transactionId, string $paymentType): void
    {
        Booking::where('midtrans_order_id', $orderId)->update([
            'payment_status' => 'paid',
            'status' => 'confirmed',
            'payment_type' => $paymentType,
            'midtrans_transaction_id' => $transactionId,
            'paid_at' => now(),
        ]);

        $this->paymentStatus = 'paid';

        session()->flash('success', 'Pembayaran berhasil! Booking Anda telah dikonfirmasi.');
    }

    /**
     * Called from JS after Midtrans Snap returns pending.
     */
    public function handlePaymentPending(string $orderId): void
    {
        $this->paymentStatus = 'pending';
    }

    /**
     * Called from JS after Midtrans Snap returns error/failure.
     */
    public function handlePaymentError(string $orderId): void
    {
        Booking::where('midtrans_order_id', $orderId)->update([
            'payment_status' => 'failed',
        ]);

        $this->paymentStatus = 'failed';
    }

    /**
     * Cancel unpaid booking.
     */
    public function cancelBooking(): void
    {
        Booking::where('midtrans_order_id', $this->order_id)
            ->where('payment_status', 'pending')
            ->update(['payment_status' => 'expired']);

        $this->redirectRoute('customer.booking');
    }

    /**
     * Refresh payment status (poll from DB).
     */
    public function checkPaymentStatus(): void
    {
        $booking = Booking::where('midtrans_order_id', $this->order_id)->first();
        if ($booking) {
            $this->paymentStatus = $booking->payment_status;
        }
    }

    public function render()
    {
        return view('livewire.pages.customer.booking-payment');
    }
}
