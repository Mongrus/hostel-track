<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface BookingServiceInterface
{
    public function index(): Collection;

}
