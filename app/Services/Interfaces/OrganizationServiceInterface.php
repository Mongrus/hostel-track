<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface OrganizationServiceInterface
{
    public function index(): Collection;

}
