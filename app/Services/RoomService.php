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

    public function all(): Collection
    {
        return $this->roomRepo->all();
    }

    public function getById(int $id): ?Room
    {
        return $this->roomRepo->getById($id);
    }

    public function store(array $data): Room
    {
        return $this->roomRepo->store($data);
    }
}
