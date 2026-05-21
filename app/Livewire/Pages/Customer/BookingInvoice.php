<?php

namespace App\Livewire\Pages\Customer;

use App\Models\Booking;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;

class BookingInvoice extends Component
{
    public string $order_id;
    public string $bookingId = '';

    // Invoice header
    public string $invoiceNumber = '';
    public string $customerName = '';
    public string $customerPhone = '';
    public string $customerEmail = '';

    // Payment details
    public string $paymentMethod = '-';
    public string $paymentStatus = '';
    public string $paymentDate = '-';
    public string $bookingStatus = '';
    public string $bookingType = '';
    public string $verificationCode = '';

    // Booking details
    public string $playstationName = '';
    public int $pricePerHour = 0;
    public int $totalDuration = 0;
    public int $totalPaid = 0;
    public array $bookingSlots = [];

    public function mount(string $order_id): void
    {
        $user = getAuthUser();
        $customer = Customer::where('user_id', '=', $user->id)->firstOrFail();

        // Find bookings for this order — must belong to this customer
        $bookings = Booking::with('computer')
            ->where('midtrans_order_id', $order_id)
            ->where('customer_id', $customer->id)
            ->where('status', 'confirmed')
            ->orderBy('booking_start_date')
            ->get();
        if ($bookings->isEmpty()) {
            abort(404, 'Invoice tidak ditemukan.');
        }

        $first = $bookings->first();
        $this->bookingId = strtoupper(substr($first->id, 0, 8));

        // Only show invoice for paid bookings
        if ($first->payment_status !== 'paid') {
            abort(403, 'Invoice belum tersedia karena pembayaran belum selesai.');
        }

        $this->order_id = $order_id;

        // Generate invoice number from order_id + date
        $paidAt = $first->paid_at ? Carbon::parse($first->paid_at) : now();
        $this->invoiceNumber = 'INV-' . $paidAt->format('Ymd') . '-' . strtoupper(substr(md5($order_id), 0, 6));

        // Customer info
        $this->customerName = $customer->name ?? '-';
        $this->customerPhone = $customer->phone ?? '-';
        $this->customerEmail = $user->email ?? '-';

        // Payment info
        $this->paymentMethod = $this->formatPaymentMethod($first->payment_type);
        $this->paymentStatus = $first->payment_status;
        $this->paymentDate = $first->paid_at ? Carbon::parse($first->paid_at)->format('d-m-Y H:i') : '-';
        $this->bookingStatus = $first->getDisplayStatus();
        $this->bookingType = $first->booking_type;

        // Verification code (generated from order_id)
        $this->verificationCode = strtoupper(substr(md5($order_id . 'verify'), 0, 6));

        // Booking details
        $this->playstationName = $first->computer->computer_number ?? '-';
        $this->pricePerHour = (int) ($first->computer->booking_price_per_hour ?? 0);
        $this->totalDuration = $bookings->sum('booking_hour');
        $this->totalPaid = $bookings->sum('total_booking_fee');

        $this->bookingSlots = $bookings->map(function ($booking) {
            return [
                'date' => $booking->booking_start_date->format('d-m-Y'),
                'start' => $booking->booking_start_date->format('H:i'),
                'end' => $booking->booking_end_date->format('H:i'),
                'label' => $booking->booking_start_date->format('d-m-Y H:i') . ' – ' . $booking->booking_end_date->format('H:i'),
            ];
        })->all();
    }

    private function formatPaymentMethod(?string $type): string
    {
        if (!$type) {
            return '-';
        }

        return match ($type) {
            'bank_transfer' => 'Bank Transfer (VA)',
            'credit_card' => 'Kartu Kredit',
            'qris' => 'QRIS',
            'gopay' => 'GoPay',
            'shopeepay' => 'ShopeePay',
            'cash' => 'Tunai (Kasir)',
            default => ucfirst(str_replace('_', ' ', $type)),
        };
    }

    public function render()
    {
        return view('livewire.pages.customer.booking-invoice');
    }
}
