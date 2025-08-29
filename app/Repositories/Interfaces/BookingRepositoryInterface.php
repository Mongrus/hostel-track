<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface BookingRepositoryInterface
{
    public function index(): Collection;

}
