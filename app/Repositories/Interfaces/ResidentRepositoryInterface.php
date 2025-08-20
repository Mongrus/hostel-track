<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;
use App\Models\Resident;

interface ResidentRepositoryInterface
{
    public function index(): Collection;

    public function store(array $data): Resident;

    public function update(Resident $resident, array $attrs): Resident;

}
