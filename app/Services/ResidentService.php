<?php

namespace App\Services;

use App\Services\Interfaces\ResidentServiceInterface;
use App\Repositories\Interfaces\ResidentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ResidentService implements ResidentServiceInterface
{
    public function __construct(protected ResidentRepositoryInterface $resRep)
    {

    }

    public function index(): Collection
    {

        return $this->resRep->index();

    }

}
