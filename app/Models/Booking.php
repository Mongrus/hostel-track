<?php

namespace App\Models;

use App\Enums\BookingLevel;
use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'bed_id',
        'user_id',
        'resident_id',
        'booking_level',
        'status',
        'comment',
        'start_date',
        'end_date',
    ];

    protected $casts = [
    'status' => BookingStatus::class,
    'booking_level' => BookingLevel::class
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function bed(): BelongsTo
    {
        return $this->belongsTo(Bed::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }
}
