@section('title', 'Booking Customer')

<div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible mb-3">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Ketersediaan PlayStation</h5>
            
        </div>
    </div>

    <div class="row">
        @forelse ($computers as $computer)
            @php
                $availability = $this->getAvailability($computer);
            @endphp

            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title mb-1">
                                    {{ $computer->computer_number }}
                                </h5>
                                <small class="text-muted">
                                    Rp. {{ number_format($computer->booking_price_per_hour, 0, ',', '.') }} / jam
                                </small>
                            </div>

                            <span class="badge {{ $availability['badge_class'] }}">
                                {{ $availability['badge'] }}
                            </span>
                        </div>

                        <div class="alert {{ $availability['alert_class'] }} py-2 mb-3">
                            <i class="bx bx-info-circle me-1"></i>
                            {{ $availability['label'] }}
                        </div>

                        <a href="{{ route('admin.booking.customer.create', $computer->id) }}"
                           class="btn btn-primary w-100">
                            <i class="bx bx-calendar-plus me-1"></i>
                            Booking untuk Customer
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Data PlayStation belum tersedia.
                </div>
            </div>
        @endforelse
    </div>
</div>