<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Bed;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBedRequest;
use App\Http\Requests\UpdateBedRequest;
use App\Services\Interfaces\BedServiceInterface;

class BedController extends Controller
{
    public function __construct(
        protected BedServiceInterface $bedService
    ) {

    }
    public function index(Room $room)
    {

        $beds = $this->bedService->listForRoom($room->id);

        return view('beds.index', ['beds' => $beds, 'room' => $room]);
    }

    public function show(Room $room, Bed $bed)
    {

        return view('beds.show', ['room' => $room, 'bed' => $bed]);

    }

    public function create(Room $room)
    {
        return view('beds.create', compact('room'));
    }

    public function store(StoreBedRequest $request, Room $room, BedServiceInterface $service)
    {
        $data = $request->validated();
        $labels = $data['beds'];
        $descriptions = $data['descriptions'] ?? [];

        $service->storeMany($room, $labels, $descriptions);

        return redirect()
            ->route('rooms.show', $room)
            ->with('success', 'Койки добавлены');
    }

    public function edit(Room $room, Bed $bed)
    {

        return view('beds.edit', ['room' => $room, 'bed' => $bed]);

    }

    public function update(UpdateBedRequest $request, Room $room, Bed $bed)
    {
        $data = $request->validated();

        $this->bedService->update($data, $room, $bed);

        return redirect()
        ->route('beds.index', $room)
        ->with('success', 'Информация успешно обновлена');

    }

    public function destroy(Room $room, Bed $bed)
    {

        $this->bedService->delete($bed->id);

        return redirect()
        ->route('beds.index', $room)
        ->with('success', 'Кровать удалена');

    }
}
