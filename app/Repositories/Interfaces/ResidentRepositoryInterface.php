<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface ResidentRepositoryInterface
{
    public function index(): Collection;

}
