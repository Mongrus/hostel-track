<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Resident;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'phone',
        'email',
        'description'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function residents(): HasMany
    {
        return $this->hasMany(Resident::class, 'organization_id');
    }
}
