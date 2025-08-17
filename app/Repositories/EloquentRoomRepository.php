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

        return Room::findOrFail($id);

    }

    public function store(array $data): Room
    {
        return Room::create($data);
    }
}
