<?php

namespace App\Models;

use App\Enums\RoomType;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'type',
        'description'
    ];

    protected $casts = [
        'type' => RoomType::class
    ];

    public function beds(): HasMany
    {
        return $this->hasMany(Bed::class);
    }
}
