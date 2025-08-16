<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentRoomRepository implements RoomRepositoryInterface
{
    public function index(): Collection
    {
        return Room::all();
    }

    public function findById(int $id): ?Room
    {

        return Room::findOrFail($id);

    }

}
