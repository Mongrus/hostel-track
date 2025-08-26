<?php

namespace App\Services\Interfaces;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;

interface OrganizationServiceInterface
{
    public function index(): Collection;

    public function store(array $data, int $ownerId): Organization;

    public function update(array $data, int $id): Organization;

    public function delete(int $id): void;

}
