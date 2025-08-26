<?php

namespace App\Repositories;

use App\Models\Organization;
use App\Repositories\Interfaces\OrganizationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentOrganizationRepository implements OrganizationRepositoryInterface
{
    public function index(): Collection
    {

        return Organization::all();

    }

    public function store(array $data): Organization
    {

        return Organization::create($data);

    }

    public function update(array $data, int $id): Organization
    {

        $organization = Organization::findOrFail($id);

        $organization->update($data);

        return $organization;

    }

}
