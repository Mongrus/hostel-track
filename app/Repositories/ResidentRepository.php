<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ResidentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Resident;

class ResidentRepository implements ResidentRepositoryInterface
{
    public function index(): Collection
    {

        return Resident::all();

    }

    public function store(array $data): Resident
    {

        return Resident::create($data);

    }

}
