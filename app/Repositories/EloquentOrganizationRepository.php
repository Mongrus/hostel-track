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

}
