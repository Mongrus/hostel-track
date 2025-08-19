<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;
use App\Models\Bed;
use App\Models\Room;

interface BedRepositoryInterface
{
    public function listForRoom(int $id): Collection;

    public function createForRoom(Room $room, array $data): Bed;

    public function update(array $data, Room $room, Bed $bed): Bed;

    public function destroy(int $id): void;

}
