<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\RoomServiceInterface;
use App\Models\Room;

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

    public function show(int $id)
    {
        $room = $this->roomService->getById($id);

        if (!$room) {
            abort(404);
        }

        return view('rooms.show', ['room' => $room]);
    }
}
