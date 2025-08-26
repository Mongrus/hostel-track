<?php

namespace App\Services;

use App\Models\Organization;
use App\Services\Interfaces\OrganizationServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\OrganizationRepositoryInterface;

class OrganizationService implements OrganizationServiceInterface
{
    public function __construct(protected OrganizationRepositoryInterface $orgRep)
    {

    }

    public function index(): Collection
    {

        return $this->orgRep->index();

    }

    public function store(array $data, int $ownerId): Organization
    {

        $data["owner_id"] = $ownerId;

        return $this->orgRep->store($data);

    }
}
