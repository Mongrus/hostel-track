<?php

namespace App\Repositories;

use App\Models\Bed;
use App\Models\Room;
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

    public function createForRoom(Room $room, array $data): Bed
    {
        return $room->beds()->create($data);
    }

}
