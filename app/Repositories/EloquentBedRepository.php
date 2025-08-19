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

    public function update(array $data, Room $room, Bed $bed): Bed
    {

        if ($bed->room_id !== $room->id) {
            throw new \DomainException('Койка не принадлежит данной комнате');
        }

        $bed->update($data);

        return $bed;

    }

    public function destroy($id): void
    {

        Bed::destroy($id);

    }

}
