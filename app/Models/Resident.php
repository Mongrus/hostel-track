<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'name',
        'surname',
        'phone',
    ];

    public function organizations(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
