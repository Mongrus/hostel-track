<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentRoomRepository implements RoomRepositoryInterface
{
    public function all(): Collection
    {
        return Room::all();
    }

    public function getById(int $id): ?Room
    {

        return Room::withCount('beds')->findOrFail($id);

    }

    public function store(array $data): Room
    {
        return Room::create($data);
    }

    public function update(int $id, array $data): Room
    {
        $room = Room::findOrFail($id);

        $room->update($data);

        return $room;
    }

    public function delete(int $id): void
    {

        Room::destroy($id);

    }
}
