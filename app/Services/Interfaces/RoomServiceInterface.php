<?php

namespace App\Services\Interfaces;

use Illuminate\Support\Collection;
use App\Models\Room;

interface RoomServiceInterface
{
    public function getAllRooms(): Collection;

    public function getById(int $id): ?Room;
}
