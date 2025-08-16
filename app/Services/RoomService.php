<?php

namespace App\Services;

use App\Services\Interfaces\RoomServiceInterface;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\Room;

class RoomService implements RoomServiceInterface
{
    public function __construct(
        protected RoomRepositoryInterface $roomRepo
    ) {
    }

    public function getAllRooms(): Collection
    {
        return $this->roomRepo->index();
    }

    public function getById(int $id): ?Room
    {
        return $this->roomRepo->findById($id);
    }
}
