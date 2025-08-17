<?php

namespace App\Services\Interfaces;

use Illuminate\Support\Collection;

interface BedServiceInterface
{
    public function listForRoom(int $id): Collection;

}
