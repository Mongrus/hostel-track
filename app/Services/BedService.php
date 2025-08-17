<?php

namespace App\Services;

use App\Services\Interfaces\BedServiceInterface;
use App\Repositories\Interfaces\BedRepositoryInterface;
use Illuminate\Support\Collection;

class BedService implements BedServiceInterface
{
    public function __construct(
        protected BedRepositoryInterface $bedRepo
    ) {
    }

    public function listForRoom(int $id): Collection
    {
        return $this->bedRepo->listForRoom($id);
    }
}
