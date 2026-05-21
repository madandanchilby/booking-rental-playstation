<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Computer extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'computer_number',
        'booking_price_per_hour'
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'computer_id', 'id');
    }
}
