<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'customer_id',
        'computer_id',
        'booking_start_date',
        'booking_end_date',
        'booking_hour',
        'total_booking_fee'
    ];

    protected $casts = [
        'booking_start_date' => 'datetime:d-m-Y H:00:00',
        'booking_end_date' => 'datetime:d-m-Y H:00:00'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function computer(): BelongsTo
    {
        return $this->belongsTo(Computer::class, 'computer_id', 'id');
    }
}
