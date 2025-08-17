<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface BedRepositoryInterface
{
    public function listForRoom(int $id): Collection;

}
