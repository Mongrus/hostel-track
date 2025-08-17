<?php

namespace App\Repositories;

use App\Models\Bed;
use App\Repositories\Interfaces\BedRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentBedRepository implements BedRepositoryInterface
{
    public function listForRoom(int $id): Collection
    {

        return Bed::where('room_id', $id)
        ->orderBy('label')
        ->get();

    }

}
