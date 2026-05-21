<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes, HasUuids, Prunable;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'booking_type',
        'status',
        'customer_id',
        'computer_id',
        'booking_start_date',
        'booking_end_date',
        'booking_hour',
        'total_booking_fee',
        'midtrans_order_id',
        'snap_token',
        'payment_status',
        'payment_type',
        'midtrans_transaction_id',
        'paid_at',
        'rescheduled_from_id',
        'customer_name_walkin',
        'customer_phone_walkin',
    ];

    protected $casts = [
        'booking_start_date' => 'datetime',
        'booking_end_date' => 'datetime',
        'paid_at' => 'datetime',
    ];

    // ── Booking type helpers ───────────────────────────────

    public function isOnline(): bool
    {
        return $this->booking_type === 'online';
    }

    public function isWalkIn(): bool
    {
        return $this->booking_type === 'walk_in';
    }

    // ── Status helpers ─────────────────────────────────────

    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function isRescheduled(): bool
    {
        return $this->status === 'rescheduled';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    // ── Payment helpers ────────────────────────────────────

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isPending(): bool
    {
        return $this->payment_status === 'pending';
    }

    public function isExpired(): bool
    {
        return $this->payment_status === 'expired';
    }

    // ── Display helpers ────────────────────────────────────

    /**
     * Check if the booking timeslot has already passed (done).
     * Uses server time to avoid timezone inconsistency.
     */
    public function isDone(): bool
    {
        if (!$this->booking_end_date) {
            return false;
        }

        return now()->gte($this->booking_end_date);
    }

    /**
     * Get the display status for the UI.
     * If the timeslot has passed, returns 'done' regardless of the stored status.
     * Payment status is NOT affected.
     */
    public function getDisplayStatus(): string
    {
        // Only override for active bookings (confirmed/pending).
        // Cancelled and rescheduled keep their own status labels.
        if ($this->isDone() && in_array($this->status, ['confirmed', 'pending'])) {
            return 'done';
        }

        return $this->status ?? 'pending';
    }

    /**
     * Get customer display name (works for both online & walk-in).
     */
    public function getCustomerDisplayName(): string
    {
        if ($this->isWalkIn()) {
            return $this->customer_name_walkin ?: 'Walk-in';
        }

        return $this->customer?->name ?? '-';
    }

    // ── Scope: active bookings (not cancelled/expired/rescheduled) ──

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereNotIn('status', ['cancelled', 'rescheduled'])
                     ->where('payment_status', '!=', 'expired')
                     ->where('payment_status', '!=', 'failed');
    }

    // ── Relationships ──────────────────────────────────────

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function computer(): BelongsTo
    {
        return $this->belongsTo(Computer::class, 'computer_id', 'id');
    }

    public function rescheduledFrom(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'rescheduled_from_id', 'id');
    }

    public function rescheduledTo(): HasOne
    {
        return $this->hasOne(Booking::class, 'rescheduled_from_id', 'id');
    }

    // ── Pruning ────────────────────────────────────────────

    public function prunable(): Builder
    {
        return static::whereNull('deleted_at');
    }

    protected function pruning(): void
    {
        $previous_bookings = static::all();

        foreach ($previous_bookings as $booking) {
            History::create([
                'customer_id' => $booking->customer_id,
                'computer_id' => $booking->computer_id,
                'booking_start_date' => $booking->booking_start_date,
                'booking_end_date' => $booking->booking_start_date,
                'booking_hour' => $booking->booking_hour,
                'total_booking_fee' => $booking->total_booking_fee
            ]);
        }
    }
}
