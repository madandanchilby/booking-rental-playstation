@section('title', 'Riwayat Booking')

<div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible mb-3">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mb-3">
        <h5 class="card-header">Booking Yang Berjalan</h5>
        {{-- DESKTOP TABLE --}}
        <div class="d-none d-md-block">
            <div class="table-responsive">
                <table class="table table-sm">
            <thead>
                <tr>
                    <th>ID Booking</th>
                    <th>PlayStation</th>
                    <th>Waktu</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
                
                <tbody class="table-border-bottom-0">
                    @forelse ($current_bookings as $booking)
                        <tr>
                            <td>
                            <span class="badge bg-label-secondary">
                                {{ substr($booking->id, 0, 8) }}
                            </span>
                            </td>
                            <td>{{ $booking->computer->computer_number ?? '-' }}</td>
                            <td>
                                {{ $booking->booking_start_date->format('d-m-Y H:i') }}
                                <br>
                                <small class="text-muted">s/d {{ $booking->booking_end_date->format('H:i') }}</small>
                            </td>
                            <td>Rp. {{ number_format($booking->total_booking_fee, 0, ',', '.') }}</td>
                            <td>
                                @if ($booking->status === 'confirmed')
                                    <span class="badge bg-success">Dikonfirmasi</span>
                                @elseif ($booking->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($booking->status ?? '-') }}</span>
                                @endif

                                @if ($booking->rescheduled_from_id)
                                    <br><small class="text-info"><i class="bx bx-calendar-edit"></i> Rescheduled</small>
                                @endif
                            </td>
                            <td>
                                @if ($booking->payment_status === 'paid')
                                    <span class="badge bg-success">Lunas</span>
                                @elseif ($booking->payment_status === 'pending')
                                    <span class="badge bg-warning">Belum</span>
                                @elseif ($booking->payment_status === 'expired')
                                    <span class="badge bg-secondary">Expired</span>
                                @elseif ($booking->payment_status === 'failed')
                                    <span class="badge bg-danger">Gagal</span>
                                @else
                                    <span class="badge bg-secondary">{{ $booking->payment_status ?? '-' }}</span>
                                @endif
                            </td>
                            <td style="min-width: 80px;">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        @if ($booking->payment_status === 'paid' && $booking->midtrans_order_id)
                                            <a href="{{ route('customer.booking.invoice', ['order_id' => $booking->midtrans_order_id]) }}"
                                                class="dropdown-item">
                                                <i class="bx bx-receipt me-1"></i> Lihat Invoice
                                            </a>
                                        @endif

                                        @if ($booking->payment_status === 'pending' && $booking->midtrans_order_id)
                                            <a href="{{ route('customer.booking.payment', ['order_id' => $booking->midtrans_order_id]) }}"
                                                class="dropdown-item">
                                                <i class="bx bx-credit-card me-1"></i> Bayar Sekarang
                                            </a>
                                        @endif

                                        @if (now()->lt($booking->booking_start_date->copy()->subHours(2)))

                                        <a href="{{ route('customer.booking.reschedule', $booking->id) }}"
                                        class="dropdown-item">
                                            <i class="bx bx-edit-alt me-1"></i>
                                            Reschedule
                                        </a>
                                        @endif

                                        <div wire:click="cancel_booking({{ $booking }})" class="dropdown-item"
                                            style="cursor: pointer;"
                                            wire:confirm="Yakin ingin membatalkan booking ini?">
                                            <i class="bx bx-trash me-1"></i> Batalkan
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Tidak ada booking yang sedang berjalan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-2">
            {{-- {{ $current_bookings->links() }} --}}
        </div>
    </div>

    {{-- MOBILE CARD --}}
<div class="d-block d-md-none">

    @forelse ($current_bookings as $booking)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">

                <h6 class="fw-bold mb-2">
                    Booking #{{ $booking->id }}
                </h6>

                <p class="mb-1">
                    <strong>PlayStation:</strong>
                    {{ $booking->computer->computer_number ?? '-' }}
                </p>

                <p class="mb-1">
                    <strong>Waktu:</strong>
                    {{ $booking->booking_start_date->format('d M Y H:i') }}
                </p>

                <p class="mb-1">
                    <strong>Total:</strong>
                    Rp {{ number_format($booking->total_booking_fee, 0, ',', '.') }}
                </p>

                <p class="mb-3">
                    <strong>Status:</strong>
                    {{ $booking->status }}
                </p>

                <div class="dropdown">
                    <button class="btn btn-sm btn-primary dropdown-toggle w-100"
                            type="button"
                            data-bs-toggle="dropdown">
                        Aksi
                    </button>

                    <ul class="dropdown-menu w-100">

                        <li>
                            <a class="dropdown-item"
                            href="#">
                                Lihat Invoice
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item"
                               href="#">
                                Reschedule
                            </a>
                        </li>

                        <li>
                            <button class="dropdown-item text-danger"
                                    type="button"
                                    wire:click="cancelBooking({{ $booking->id }})">
                                Batalkan Booking
                            </button>
                        </li>

                    </ul>
                </div>

            </div>
        </div>

    @empty
        <div class="alert alert-info">
            Tidak ada booking berjalan.
        </div>
    @endforelse

</div>

    <div class="card">
        <h5 class="card-header">Booking Yang Telah Selesai</h5>
        {{-- DESKTOP TABLE --}}
        <div class="d-none d-md-block">
            <div class="table-responsive">
                <table class="table table-sm">
            <thead>
                <tr>
                    <th>ID Booking</th>
                    <th>PlayStation</th>
                    <th>Waktu</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Bayar</th>
                    <th>Aksi</th>
            </tr>
        </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($completed_bookings as $booking)
                        <tr>
                            <td>
                            <span class="badge bg-label-secondary">
                                {{ substr($booking->id, 0, 8) }}
                            </span>
                            </td>
                            <td>{{ $booking->computer->computer_number ?? '-' }}</td>
                            <td>
                                {{ $booking->booking_start_date->format('d-m-Y H:i') }}
                                <br>
                                <small class="text-muted">s/d {{ $booking->booking_end_date->format('H:i') }}</small>
                            </td>
                            <td>Rp. {{ number_format($booking->total_booking_fee, 0, ',', '.') }}</td>
                            <td>
                                @if ($booking->payment_status === 'paid')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($booking->payment_status ?? '-') }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($booking->payment_status === 'paid' && $booking->midtrans_order_id)
                                    <a href="{{ route('customer.booking.invoice', ['order_id' => $booking->midtrans_order_id]) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bx bx-receipt me-1"></i> Invoice
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada riwayat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-2">
            {{-- {{ $completed_bookings->links() }} --}}
        </div>
    </div>
</div>
