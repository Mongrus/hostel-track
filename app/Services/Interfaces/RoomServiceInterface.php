<?php

namespace App\Services\Interfaces;

use Illuminate\Support\Collection;
use App\Models\Room;

interface RoomServiceInterface
{
    public function all(): Collection;

    public function getById(int $id): ?Room;

    public function store(array $data): Room;

    public function update(int $id, array $data): Room;

    public function delete(int $id): void;

}
