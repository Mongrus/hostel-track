<?php

namespace App\Models;

use App\Enums\LogActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'user_id',
        'actions',
        'description',
        'data'
    ];

    protected $casts = [
        'actions' => LogActions::class
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
