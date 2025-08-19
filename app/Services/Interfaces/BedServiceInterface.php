<?php

namespace App\Services\Interfaces;

use Illuminate\Support\Collection;
use App\Models\Room;
use App\Models\Bed;

interface BedServiceInterface
{
    public function listForRoom(int $id): Collection;

    public function storeMany(Room $room, array $labels, array $descriptions = []): void;

    public function update(array $data, Room $room, Bed $bed): Bed;

    public function delete(int $id): void;


}
