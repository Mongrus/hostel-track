<?php

namespace App\Services;

use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Services\Interfaces\BookingServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class BookingService implements BookingServiceInterface
{
    public function __construct(protected BookingRepositoryInterface $bookRep)
    {

    }

    public function index(): Collection
    {

        return $this->bookRep->index();

    }

}
