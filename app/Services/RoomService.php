<?php

namespace App\Services;

use App\Services\Interfaces\RoomServiceInterface;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Support\Collection;

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
}
