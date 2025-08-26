<?php

namespace App\Repositories\Interfaces;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;

interface OrganizationRepositoryInterface
{
    public function index(): Collection;

    public function store(array $data): Organization;

}
