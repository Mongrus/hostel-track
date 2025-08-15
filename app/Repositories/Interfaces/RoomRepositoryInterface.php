<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface RoomRepositoryInterface
{
    public function index(): Collection;

}
