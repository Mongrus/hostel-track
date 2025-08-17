<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
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

        $rooms = $this->roomService->all();

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

    public function create()
    {
        return view('rooms.create');
    }

    public function store(StoreRoomRequest $request)
    {
        $data = $request->validated();

        $this->roomService->store($data);

        return redirect()->route('rooms.index');
    }
}
