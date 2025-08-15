<?php

namespace App\Services\Interfaces;

use Illuminate\Support\Collection;

interface RoomServiceInterface
{
    public function getAllRooms(): Collection;
}
