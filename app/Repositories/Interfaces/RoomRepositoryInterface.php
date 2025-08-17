<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;
use App\Models\Room;

interface RoomRepositoryInterface
{
    public function all(): Collection;

    public function getById(int $id): ?Room;

    public function store(array $data): Room;
}
