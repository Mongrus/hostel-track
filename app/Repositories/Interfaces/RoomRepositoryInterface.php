<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;
use App\Models\Room;

interface RoomRepositoryInterface
{
    public function index(): Collection;

    public function findById(int $id): ?Room;
}
