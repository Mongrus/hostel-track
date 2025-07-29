<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Room;

class Bed extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'label',
        'description'
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
