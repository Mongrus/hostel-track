<?php

namespace App\Services\Interfaces;

use App\Models\Resident;
use Illuminate\Support\Collection;

interface ResidentServiceInterface
{
    public function index(): Collection;

    public function store(array $data): Resident;

}
