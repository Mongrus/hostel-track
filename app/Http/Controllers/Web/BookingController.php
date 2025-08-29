<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\BookingServiceInterface;

class BookingController extends Controller
{
    public function __construct(protected BookingServiceInterface $bookService)
    {
    }

    public function index()
    {

        $bookings = $this->bookService->index();

        return view('bookings.index', ['bookings' => $bookings]);

    }
}
