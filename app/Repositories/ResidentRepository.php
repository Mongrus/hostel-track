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

    public function update(Resident $resident, array $attrs): Resident
    {

        $resident->update($attrs);

        return $resident;

    }

    public function delete(int $id): void
    {

        Resident::destroy($id);

    }

}
