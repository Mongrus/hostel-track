<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\RoomServiceInterface;

class RoomController extends Controller
{
    public function __construct(
        protected RoomServiceInterface $roomService
    ) {

    }
    public function index()
    {

        $rooms = $this->roomService->getAllRooms();

        return view('rooms.index', ['rooms' => $rooms]);
    }
}
