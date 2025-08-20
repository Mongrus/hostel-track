<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface OrganizationRepositoryInterface
{
    public function index(): Collection;

}
