<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
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

    public function update(UpdateRoomRequest $request, int $id)
    {

        $this->roomService->update($id, $request->validated());

        return redirect()
            ->route('rooms.show', $id)
            ->with('success', 'Комната обновлена.');

    }

    public function edit(int $id)
    {
        $room = $this->roomService->getById($id);

        return view('rooms.edit', ['room' => $room]);

    }

    public function destroy(int $id)
    {
        $this->roomService->delete($id);

        return redirect()
        ->route('rooms.index')
        ->with('success', "Комната #$id удаленна");
    }
}
